<?php
// Shared article data helpers for frontend and admin.
// Uses the admin DB credentials and auto-creates the articles table if missing.

$__lv_project_root = dirname(__DIR__);
require_once $__lv_project_root . '/admin/config/database.php';

/** @return ?mysqli */
function lv_articles_connection()
{
    static $conn = null;
    static $tried = false;

    if ($conn instanceof mysqli) {
        return $conn;
    }

    if ($tried) {
        return null;
    }

    $tried = true;

    try {
        $conn = getSashDBConnection();
        lv_ensure_articles_table($conn);
    } catch (mysqli_sql_exception $e) {
        error_log('Articles DB connection failed: ' . $e->getMessage());
        $conn = null;
    }

    if ($conn instanceof mysqli) {
        register_shutdown_function(function () use (&$conn) {
            if ($conn instanceof mysqli) {
                $conn->close();
                $conn = null;
            }
        });
    }

    return $conn;
}

function lv_ensure_articles_table(?mysqli $conn = null): void
{
    $conn = $conn ?? lv_articles_connection();
    if (!$conn) {
        return;
    }

    $sql = <<<SQL
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT NULL,
    body_html LONGTEXT NULL,
    featured_image VARCHAR(255) NULL,
    categories_json LONGTEXT NULL,
    publish_date DATE NULL,
    status ENUM('draft','published') NOT NULL DEFAULT 'draft',
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    meta_keywords TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status_date (status, publish_date),
    INDEX idx_publish_date (publish_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;

    try {
        $conn->query($sql);
    } catch (mysqli_sql_exception $e) {
        error_log('Articles table creation failed: ' . $e->getMessage());
    }
}

function lv_slugify(string $value): string
{
    $value = strtolower(trim($value));
    $value = preg_replace('/[^a-z0-9]+/i', '-', $value) ?: '';
    $value = trim($value, '-');
    return $value !== '' ? $value : uniqid('article-', false);
}

function lv_normalize_categories($raw): array
{
    if (is_string($raw)) {
        $raw = explode(',', $raw);
    }
    if (!is_array($raw)) {
        return [];
    }

    $normalized = [];
    foreach ($raw as $item) {
        $item = trim((string) $item);
        if ($item === '') {
            continue;
        }
        $normalized[$item] = true;
    }

    return array_keys($normalized);
}

function lv_categories_to_storage(array $categories): string
{
    return json_encode(array_values($categories), JSON_UNESCAPED_UNICODE) ?: '[]';
}

function lv_categories_from_storage(?string $json): array
{
    if ($json === null || $json === '') {
        return [];
    }

    $decoded = json_decode($json, true);
    if (is_array($decoded)) {
        return array_values(array_filter(array_map('trim', $decoded), static fn($v) => $v !== ''));
    }

    // Legacy comma-separated fallback
    return lv_normalize_categories($json);
}

function lv_map_article_row(array $row): array
{
    return [
        'id' => (int) ($row['id'] ?? 0),
        'title' => $row['title'] ?? '',
        'slug' => $row['slug'] ?? '',
        'excerpt' => $row['excerpt'] ?? '',
        'body_html' => $row['body_html'] ?? '',
        'featured_image' => $row['featured_image'] ?? '',
        'categories' => lv_categories_from_storage($row['categories_json'] ?? ''),
        'publish_date' => $row['publish_date'] ?? null,
        'status' => $row['status'] ?? 'draft',
        'meta_title' => $row['meta_title'] ?? '',
        'meta_description' => $row['meta_description'] ?? '',
        'meta_keywords' => $row['meta_keywords'] ?? '',
        'created_at' => $row['created_at'] ?? null,
        'updated_at' => $row['updated_at'] ?? null,
    ];
}

function lv_build_article_where(array $filters, mysqli $conn): string
{
    $clauses = [];

    if (!empty($filters['status'])) {
        $status = $conn->real_escape_string($filters['status']);
        $clauses[] = "status = '{$status}'";
    }

    if (!empty($filters['category'])) {
        $category = $conn->real_escape_string($filters['category']);
        $clauses[] = "categories_json LIKE '%\"{$category}\"%'";
    }

    if (!empty($filters['search'])) {
        $search = '%' . $conn->real_escape_string($filters['search']) . '%';
        $clauses[] = "(title LIKE '{$search}' OR excerpt LIKE '{$search}' OR meta_description LIKE '{$search}')";
    }

    return $clauses ? ('WHERE ' . implode(' AND ', $clauses)) : '';
}

function lv_filter_fallback_articles(array $articles, array $filters): array
{
    return array_values(array_filter($articles, static function (array $article) use ($filters): bool {
        if (!empty($filters['category'])) {
            $category = $filters['category'];
            if (empty($article['categories']) || !in_array($category, $article['categories'], true)) {
                return false;
            }
        }

        if (!empty($filters['search'])) {
            $haystack = ($article['title'] ?? '') . ' ' . implode(' ', $article['categories'] ?? []);
            if (stripos($haystack, (string) $filters['search']) === false) {
                return false;
            }
        }

        return true;
    }));
}

function lv_get_articles(array $filters = [], bool $allowFallback = false): array
{
    $conn = lv_articles_connection();
    if (!$conn) {
        if (!$allowFallback) {
            return [];
        }
        $fallback = lv_filter_fallback_articles(lv_default_articles(), $filters);
        $limit = isset($filters['limit']) ? max(1, (int) $filters['limit']) : 0;
        $offset = isset($filters['offset']) ? max(0, (int) $filters['offset']) : 0;
        if ($limit > 0) {
            $fallback = array_slice($fallback, $offset, $limit);
        }
        return $fallback;
    }

    $limit = isset($filters['limit']) ? max(1, (int) $filters['limit']) : 0;
    $offset = isset($filters['offset']) ? max(0, (int) $filters['offset']) : 0;

    $where = lv_build_article_where($filters, $conn);
    $orderBy = 'ORDER BY COALESCE(publish_date, created_at) DESC, id DESC';
    $limitSql = $limit > 0 ? "LIMIT {$limit} OFFSET {$offset}" : '';

    $sql = "SELECT * FROM articles {$where} {$orderBy} {$limitSql}";
    $rows = [];

    try {
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = lv_map_article_row($row);
            }
            $result->free();
        }
    } catch (mysqli_sql_exception $e) {
        error_log('Fetch articles failed: ' . $e->getMessage());
    }

    if ($allowFallback && empty($rows)) {
        $fallback = lv_filter_fallback_articles(lv_default_articles(), $filters);
        if ($limit > 0) {
            $fallback = array_slice($fallback, $offset, $limit);
        }
        return $fallback;
    }

    return $rows;
}

function lv_count_articles(array $filters = [], bool $allowFallback = false): int
{
    $conn = lv_articles_connection();
    if (!$conn) {
        return $allowFallback ? count(lv_filter_fallback_articles(lv_default_articles(), $filters)) : 0;
    }

    $where = lv_build_article_where($filters, $conn);
    $sql = "SELECT COUNT(*) AS total FROM articles {$where}";

    try {
        if ($result = $conn->query($sql)) {
            $row = $result->fetch_assoc();
            $result->free();
            $count = (int) ($row['total'] ?? 0);
            if ($allowFallback && $count === 0) {
                return count(lv_filter_fallback_articles(lv_default_articles(), $filters));
            }
            return $count;
        }
    } catch (mysqli_sql_exception $e) {
        error_log('Count articles failed: ' . $e->getMessage());
    }

    return $allowFallback ? count(lv_default_articles()) : 0;
}

function lv_get_article_by_slug(string $slug, bool $includeDrafts = false): ?array
{
    $slug = trim($slug);
    if ($slug === '') {
        return null;
    }

    $conn = lv_articles_connection();
    if (!$conn) {
        return null;
    }

    $statusClause = $includeDrafts ? '' : "AND status = 'published'";
    $stmt = $conn->prepare("SELECT * FROM articles WHERE slug = ? {$statusClause} LIMIT 1");
    if ($stmt === false) {
        return null;
    }

    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result ? $result->fetch_assoc() : null;
    $stmt->close();

    return $row ? lv_map_article_row($row) : null;
}

function lv_get_article_by_id(int $id): ?array
{
    if ($id <= 0) {
        return null;
    }

    $conn = lv_articles_connection();
    if (!$conn) {
        return null;
    }

    $stmt = $conn->prepare('SELECT * FROM articles WHERE id = ? LIMIT 1');
    if ($stmt === false) {
        return null;
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result ? $result->fetch_assoc() : null;
    $stmt->close();

    return $row ? lv_map_article_row($row) : null;
}

function lv_save_article(array $data): array
{
    $conn = lv_articles_connection();
    if (!$conn) {
        return ['success' => false, 'errors' => ['Database connection unavailable.']];
    }

    $errors = [];

    $id = isset($data['id']) ? (int) $data['id'] : null;
    $title = trim((string) ($data['title'] ?? ''));
    $slug = trim((string) ($data['slug'] ?? ''));
    $excerpt = trim((string) ($data['excerpt'] ?? ''));
    $body = (string) ($data['body_html'] ?? '');
    $featuredImage = trim((string) ($data['featured_image'] ?? ''));
    $categories = lv_normalize_categories($data['categories'] ?? []);
    $publishDate = trim((string) ($data['publish_date'] ?? ''));
    $status = ($data['status'] ?? 'draft') === 'published' ? 'published' : 'draft';
    $metaTitle = trim((string) ($data['meta_title'] ?? ''));
    $metaDescription = trim((string) ($data['meta_description'] ?? ''));
    $metaKeywords = trim((string) ($data['meta_keywords'] ?? ''));

    if ($title === '') {
        $errors[] = 'Title is required.';
    }

    if ($slug === '') {
        $slug = lv_slugify($title);
    }

    if (!preg_match('/^[a-z0-9\-]+$/', $slug)) {
        $errors[] = 'Slug can only contain letters, numbers, and hyphens.';
    }

    if ($errors) {
        return ['success' => false, 'errors' => $errors];
    }

    $categoriesJson = lv_categories_to_storage($categories);

    if ($id) {
        $sql = "UPDATE articles SET title = ?, slug = ?, excerpt = ?, body_html = ?, featured_image = NULLIF(?, ''), categories_json = ?, publish_date = NULLIF(?, ''), status = ?, meta_title = NULLIF(?, ''), meta_description = NULLIF(?, ''), meta_keywords = NULLIF(?, '') WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            return ['success' => false, 'errors' => ['Unable to prepare update statement.']];
        }

        $stmt->bind_param(
            'sssssssssssi',
            $title,
            $slug,
            $excerpt,
            $body,
            $featuredImage,
            $categoriesJson,
            $publishDate,
            $status,
            $metaTitle,
            $metaDescription,
            $metaKeywords,
            $id,
        );
    } else {
        $sql = "INSERT INTO articles (title, slug, excerpt, body_html, featured_image, categories_json, publish_date, status, meta_title, meta_description, meta_keywords) VALUES (?, ?, ?, ?, NULLIF(?, ''), ?, NULLIF(?, ''), ?, NULLIF(?, ''), NULLIF(?, ''), NULLIF(?, ''))";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            return ['success' => false, 'errors' => ['Unable to prepare insert statement.']];
        }

        $stmt->bind_param(
            'sssssssssss',
            $title,
            $slug,
            $excerpt,
            $body,
            $featuredImage,
            $categoriesJson,
            $publishDate,
            $status,
            $metaTitle,
            $metaDescription,
            $metaKeywords,
        );
    }

    try {
        $stmt->execute();
        $newId = $id ?: $stmt->insert_id;
        $stmt->close();
        return ['success' => true, 'id' => (int) $newId, 'slug' => $slug];
    } catch (mysqli_sql_exception $e) {
        $stmt->close();
        if ((int) $e->getCode() === 1062) {
            return ['success' => false, 'errors' => ['Slug must be unique. Another article already uses this slug.']];
        }
        return ['success' => false, 'errors' => ['Database error: ' . $e->getMessage()]];
    }
}

function lv_delete_article(int $id): bool
{
    if ($id <= 0) {
        return false;
    }

    $conn = lv_articles_connection();
    if (!$conn) {
        return false;
    }

    try {
        $stmt = $conn->prepare('DELETE FROM articles WHERE id = ?');
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $affected = $stmt->affected_rows;
        $stmt->close();
        return $affected > 0;
    } catch (mysqli_sql_exception $e) {
        error_log('Delete article failed: ' . $e->getMessage());
        return false;
    }
}

function lv_get_category_counts(array $filters = [], bool $allowFallback = false): array
{
    $conn = lv_articles_connection();
    if (!$conn) {
        if ($allowFallback) {
            $counts = [];
            foreach (lv_filter_fallback_articles(lv_default_articles(), $filters) as $article) {
                foreach ($article['categories'] as $cat) {
                    $counts[$cat] = ($counts[$cat] ?? 0) + 1;
                }
            }
            return $counts;
        }
        return [];
    }

    $filters = $filters;
    $where = lv_build_article_where($filters, $conn);
    $sql = "SELECT categories_json FROM articles {$where}";
    $counts = [];

    try {
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                foreach (lv_categories_from_storage($row['categories_json'] ?? '') as $cat) {
                    $counts[$cat] = ($counts[$cat] ?? 0) + 1;
                }
            }
            $result->free();
        }
    } catch (mysqli_sql_exception $e) {
        error_log('Category count failed: ' . $e->getMessage());
    }

    if ($allowFallback && $counts === []) {
        foreach (lv_filter_fallback_articles(lv_default_articles(), $filters) as $article) {
            foreach ($article['categories'] as $cat) {
                $counts[$cat] = ($counts[$cat] ?? 0) + 1;
            }
        }
    }

    ksort($counts);
    return $counts;
}

function lv_get_related_articles(array $article, int $limit = 2, bool $allowFallback = false): array
{
    $conn = lv_articles_connection();
    $categories = $article['categories'] ?? [];
    if (!$categories) {
        return [];
    }

    if ($conn) {
        $escaped = array_map(static fn($cat) => "categories_json LIKE '%\"" . $conn->real_escape_string($cat) . "\"%'", $categories);
        $where = "WHERE status = 'published' AND slug <> '" . $conn->real_escape_string($article['slug'] ?? '') . "'";
        if ($escaped) {
            $where .= ' AND (' . implode(' OR ', $escaped) . ')';
        }
        $sql = "SELECT * FROM articles {$where} ORDER BY COALESCE(publish_date, created_at) DESC LIMIT " . max(0, $limit);
        $rows = [];
        try {
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $rows[] = lv_map_article_row($row);
                }
                $result->free();
            }
        } catch (mysqli_sql_exception $e) {
            error_log('Related articles query failed: ' . $e->getMessage());
        }
        if ($rows) {
            return $rows;
        }
    }

    if ($allowFallback) {
        $fallback = [];
        foreach (lv_default_articles() as $item) {
            if ($item['slug'] === ($article['slug'] ?? '')) {
                continue;
            }
            if (array_intersect($categories, $item['categories'])) {
                $fallback[] = $item;
            }
            if (count($fallback) >= $limit) {
                break;
            }
        }
        return $fallback;
    }

    return [];
}

function lv_handle_article_image_upload(array $file): array
{
    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'error' => 'Please choose an image to upload.'];
    }

    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
    ];

    $mime = null;
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if ($finfo) {
            $mime = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
        }
    }

    if ($mime === null && function_exists('mime_content_type')) {
        $mime = mime_content_type($file['tmp_name']);
    }

    $ext = $allowed[$mime] ?? null;
    if ($ext === null) {
        $legacy = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if ($legacy === 'jpeg') {
            $legacy = 'jpg';
        }
        if (in_array($legacy, array_values($allowed), true)) {
            $ext = $legacy;
        }
    }

    if ($ext === null) {
        return ['success' => false, 'error' => 'Only JPG, PNG, GIF or WEBP files are allowed.'];
    }

    $projectRoot = dirname(__DIR__);
    $uploadDir = $projectRoot . '/images/articles';
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
        return ['success' => false, 'error' => 'Unable to create articles image directory.'];
    }

    $filename = uniqid('article_', true) . '.' . $ext;
    $targetPath = $uploadDir . '/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        return ['success' => false, 'error' => 'Unable to save the uploaded image.'];
    }

    return [
        'success' => true,
        'path' => 'images/articles/' . $filename,
    ];
}

function lv_default_articles(): array
{
    return [
        ['slug' => 'georgias-new-work-permit-regime', 'title' => 'Georgia’s New Work Permit Regime from March 2026: What Digital Nomads & Entrepreneurs Must Know', 'image' => 'images/georgias-new-work-permit-regime.jpg', 'publish_date' => '2026-03-12', 'categories' => ['New Law Changes', 'Resident Permit'], 'excerpt' => 'Georgia’s new work permit regime takes effect March 2026.'],
        ['slug' => 'temporary-residence-permit-changes-202526', 'title' => 'Temporary Residence Permit Changes 2025–26: New Rules for Entrepreneurs, Investors, and IT Specialists in Georgia', 'image' => 'images/temporary-residence-permit-changes-202526.jpg', 'publish_date' => '2026-02-18', 'categories' => ['New Law Changes', 'Resident Permit'], 'excerpt' => 'New residence permit rules for entrepreneurs, investors, and IT specialists.'],
        ['slug' => 'got-denied-a-residence-permit-in-georgia', 'title' => 'Got Denied a Residence Permit in Georgia? Here’s What You Need to Do Next', 'image' => 'images/got-denied-a-residence-permit-in-georgia.jpg', 'publish_date' => '2026-01-30', 'categories' => ['Resident Permit', 'Guides'], 'excerpt' => 'Steps to take after a residence permit denial.'],
        ['slug' => 'how-to-become-a-tax-resident-in-georgia-a-2025-guide', 'title' => 'How to Become a Tax Resident in Georgia: A 2025 Guide', 'image' => 'images/how-to-become-a-tax-resident-in-georgia-a-2025-guide.jpg', 'publish_date' => '2025-12-11', 'categories' => ['Tax Residency', 'Taxes', 'Guides'], 'excerpt' => 'Step-by-step guide to Georgian tax residency.'],
        ['slug' => 'moving-to-georgia-with-your-family', 'title' => 'Moving to Georgia with Your Family: What You Need to Know', 'image' => 'images/low-tax-jurisdiction-why-entrepreneurs-are-moving-to-georgia.jpg', 'publish_date' => '2025-10-14', 'categories' => ['Resident Permit', 'Guides'], 'excerpt' => 'Family-focused checklist for relocating to Georgia.'],
        ['slug' => 'new-aml-compliance-rules-for-company', 'title' => 'New AML Compliance Rules for Company Formation in Georgia (2025 Update)', 'image' => 'images/new-aml-compliance-rules-for-company.jpg', 'publish_date' => '2025-09-03', 'categories' => ['Company Formation', 'New Law Changes'], 'excerpt' => 'Key AML changes affecting new companies.'],
        ['slug' => 'georgia-is-easy-until-it-isnt', 'title' => 'Georgia is Easy Until It Isn’t: A Lawyer’s View on What Can Go Wrong', 'image' => 'images/georgia-is-easy-until-it-isnt.jpg', 'publish_date' => '2025-07-21', 'categories' => ['Company Formation', 'Guides'], 'excerpt' => 'Common pitfalls when doing business in Georgia.'],
        ['slug' => 'low-tax-jurisdiction-why-entrepreneurs-are-moving-to-georgia', 'title' => 'Low-Tax Jurisdiction: Why Entrepreneurs Are Moving to Georgia', 'image' => 'images/low-tax-jurisdiction-why-entrepreneurs-are-moving-to-georgia.jpg', 'publish_date' => '2025-05-06', 'categories' => ['Tax Residency', 'Taxes'], 'excerpt' => 'Why founders choose Georgia for low-tax advantages.'],
        ['slug' => 'ultimate-guide-to-georgias-tax-haven-for-digital-nomads', 'title' => "The Ultimate Guide to Georgia's Tax Haven for Digital Nomads", 'image' => 'images/ultimate-guide-to-georgias-tax-haven-for-digital-nomads1.jpg', 'publish_date' => '2025-03-19', 'categories' => ['Tax Residency', 'Taxes', 'Guides'], 'excerpt' => 'Comprehensive overview for digital nomads in Georgia.'],
        ['slug' => 'unlock-entrepreneurial-freedom', 'title' => 'Unlock Entrepreneurial Freedom', 'image' => 'images/nlock-entrepreneurial.jpg', 'publish_date' => '2024-11-28', 'categories' => ['Company Formation', 'Guides'], 'excerpt' => 'How Georgia enables entrepreneurial freedom.'],
        ['slug' => 'compelling-reasons-to-register-your-business-in-georgia', 'title' => '5 Compelling Reasons to Register Your Business in Georgia', 'image' => 'images/your-business-in-georgia.jpg', 'publish_date' => '2024-09-12', 'categories' => ['Company Formation', 'Guides'], 'excerpt' => 'Top reasons to register a business in Georgia.'],
    ];
}

function lv_articles_table_has_rows(): bool
{
    return lv_count_articles([], false) > 0;
}

?>

<?php
require_once __DIR__ . '/includes/article-bootstrap.php';

$slug = isset($_GET['slug']) ? trim((string) $_GET['slug']) : '';
if ($slug === '') {
    http_response_code(404);
    echo 'Article not found.';
    return;
}

// If a static page exists for this slug, prefer it (keeps older content working).
$staticFile = __DIR__ . '/' . $slug . '.php';
if (is_file($staticFile)) {
    header('Location: ' . basename($staticFile));
    exit;
}

// Otherwise try to render from the database.
if (lv_render_article_if_exists($slug)) {
    return;
}

http_response_code(404);
echo 'Article not found.';

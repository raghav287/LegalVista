<?php
require_once dirname(__DIR__, 2) . '/bootstrap.php';
require_once APP_ROOT . '/app/auth.php';
requireAdminLogin();
require_once dirname(__DIR__, 3) . '/includes/article-repository.php';

$pageTitle = 'Article Form';
$errors = [];
$articleId = null;
$formValues = [
    'title' => '',
    'slug' => '',
    'publish_date' => '',
    'status' => 'draft',
    'categories' => '',
    'excerpt' => '',
    'body_html' => '',
    'featured_image' => '',
    'meta_title' => '',
    'meta_description' => '',
    'meta_keywords' => '',
];

if (!empty($_GET['id'])) {
    $articleId = (int) $_GET['id'];
    $article = lv_get_article_by_id($articleId);
    if ($article !== null) {
        $formValues = [
            'title' => $article['title'] ?? '',
            'slug' => $article['slug'] ?? '',
            'publish_date' => $article['publish_date'] ?? '',
            'status' => $article['status'] ?? 'draft',
            'categories' => implode(', ', $article['categories'] ?? []),
            'excerpt' => $article['excerpt'] ?? '',
            'body_html' => $article['body_html'] ?? '',
            'featured_image' => $article['featured_image'] ?? ($article['image'] ?? ''),
            'meta_title' => $article['meta_title'] ?? '',
            'meta_description' => $article['meta_description'] ?? '',
            'meta_keywords' => $article['meta_keywords'] ?? '',
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $formValues = [
        'title' => trim($_POST['title'] ?? ''),
        'slug' => trim($_POST['slug'] ?? ''),
        'publish_date' => trim($_POST['publish_date'] ?? ''),
        'status' => $_POST['status'] === 'published' ? 'published' : 'draft',
        'categories' => trim($_POST['categories'] ?? ''),
        'excerpt' => trim($_POST['excerpt'] ?? ''),
        'body_html' => $_POST['body_html'] ?? '',
        'featured_image' => trim($_POST['existing_image'] ?? ''),
        'meta_title' => trim($_POST['meta_title'] ?? ''),
        'meta_description' => trim($_POST['meta_description'] ?? ''),
        'meta_keywords' => trim($_POST['meta_keywords'] ?? ''),
    ];

    if ($formValues['title'] === '') {
        $errors[] = 'Title is required.';
    } elseif (mb_strlen($formValues['title']) > 75) {
        $errors[] = 'Title must be 75 characters or fewer.';
    }

    if ($formValues['excerpt'] === '') {
        $errors[] = 'Excerpt is required.';
    } elseif (mb_strlen($formValues['excerpt']) > 45) {
        $errors[] = 'Excerpt must be 45 characters or fewer.';
    }

    if (trim(strip_tags($formValues['body_html'])) === '') {
        $errors[] = 'Body is required.';
    }

    if (!empty($_FILES['featured_image']) && $_FILES['featured_image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $upload = lv_handle_article_image_upload($_FILES['featured_image']);
        if (!$upload['success']) {
            $errors[] = $upload['error'];
        } else {
            $formValues['featured_image'] = $upload['path'];
        }
    }

    if (empty($errors)) {
        $payload = $formValues;
        $payload['categories'] = $formValues['categories'];
        $payload['id'] = $articleId ?: null;

        $result = lv_save_article($payload);
        if ($result['success']) {
            header('Location: ' . file_url('articles/list.php') . '?saved=1');
            exit();
        }

        $errors = $result['errors'] ?? ['Unable to save article right now.'];
    }
}

include LAYOUT_PATH . '/head.php';
?>
<body class="app sidebar-mini ltr light-mode">
    <div id="global-loader">
        <img src="<?= asset_url('images/loader.svg') ?>" class="loader-img" alt="Loader">
    </div>

    <div class="page">
        <div class="page-main">
            <?php include LAYOUT_PATH . '/header.php'; ?>
            <?php include LAYOUT_PATH . '/sidebar.php'; ?>

            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <div class="main-container container-fluid">
                        <div class="page-header">
                            <h1 class="page-title">Article Form</h1>
                        </div>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0"><?= $articleId ? 'Edit Article' : 'Add Article' ?></h3>
                                <a href="<?= file_url('articles/list.php') ?>" class="btn btn-outline-secondary btn-sm">Back to Articles</a>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($errors)): ?>
                                    <div class="alert alert-danger">
                                        <?php foreach ($errors as $error): ?>
                                            <div><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <form method="post" action="<?= htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8') ?>" enctype="multipart/form-data" id="article-form">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars((string) ($articleId ?? ''), ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="hidden" name="existing_image" value="<?= htmlspecialchars($formValues['featured_image'], ENT_QUOTES, 'UTF-8') ?>">

                                    <div class="row">
                                        <div class="col-xl-8">
                                            <div class="form-group">
                                                <label class="form-label">Title <small class="text-muted">(max 75 chars)</small></label>
                                                <input type="text" class="form-control" name="title" maxlength="75" value="<?= htmlspecialchars($formValues['title'], ENT_QUOTES, 'UTF-8') ?>" required>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-label">Slug</label>
                                                <input type="text" class="form-control" name="slug" value="<?= htmlspecialchars($formValues['slug'], ENT_QUOTES, 'UTF-8') ?>" placeholder="auto-generated if empty">
                                                <small class="text-muted">Use lowercase letters, numbers, and hyphens. Example: georgia-work-permit-update</small>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-label">Excerpt <small class="text-muted">(max 45 chars)</small></label>
                                                <textarea class="form-control" name="excerpt" rows="2" maxlength="45" placeholder="Short summary for listings and meta." required><?= htmlspecialchars($formValues['excerpt'], ENT_QUOTES, 'UTF-8') ?></textarea>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-label">Body (HTML allowed)</label>
                                                <textarea class="form-control summernote" name="body_html" rows="14" placeholder="Write or paste article content here." required><?= htmlspecialchars($formValues['body_html'], ENT_QUOTES, 'UTF-8') ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="draft" <?= ($formValues['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                                                    <option value="published" <?= ($formValues['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                                                </select>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-label">Publish Date</label>
                                                <input type="date" class="form-control" name="publish_date" value="<?= htmlspecialchars($formValues['publish_date'], ENT_QUOTES, 'UTF-8') ?>">
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-label">Categories</label>
                                                <input type="text" class="form-control" name="categories" value="<?= htmlspecialchars($formValues['categories'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Comma separated e.g. Company Formation, Guides">
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-label">Featured Image</label>
                                                <?php if ($formValues['featured_image'] !== ''): ?>
                                                    <div class="mb-2">
                                                        <img src="/<?= htmlspecialchars($formValues['featured_image'], ENT_QUOTES, 'UTF-8') ?>" alt="Current image" style="max-width: 100%; height: auto; border-radius: 8px;">
                                                    </div>
                                                <?php endif; ?>
                                                <input type="file" class="form-control" name="featured_image" accept="image/*">
                                                <small class="text-muted">JPG, PNG, GIF, or WEBP. Max 5MB.</small>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-label">Meta Title</label>
                                                <input type="text" class="form-control" name="meta_title" value="<?= htmlspecialchars($formValues['meta_title'], ENT_QUOTES, 'UTF-8') ?>" maxlength="255">
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-label">Meta Description</label>
                                                <textarea class="form-control" name="meta_description" rows="3" maxlength="400"><?= htmlspecialchars($formValues['meta_description'], ENT_QUOTES, 'UTF-8') ?></textarea>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-label">Meta Keywords</label>
                                                <input type="text" class="form-control" name="meta_keywords" value="<?= htmlspecialchars($formValues['meta_keywords'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Optional">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 d-flex gap-2">
                                        <button type="submit" class="btn btn-primary"><?= $articleId ? 'Update' : 'Add' ?> Article</button>
                                        <a class="btn btn-secondary" href="<?= file_url('articles/list.php') ?>">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include LAYOUT_PATH . '/footer.php'; ?>
    </div>

        <?php include LAYOUT_PATH . '/scripts.php'; ?>
    <!-- Summernote (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
    <script>
    document.getElementById('article-form').addEventListener('submit', function(e) {
        const title = this.title.value.trim();
        const body = this.body_html.value.trim();
        const excerpt = this.excerpt.value.trim();
        let msg = '';
        if (!title) {
            msg = 'Title is required.';
        } else if (title.length > 75) {
            msg = 'Title must be 75 characters or fewer.';
        } else if (!excerpt) {
            msg = 'Excerpt is required.';
        } else if (excerpt.length > 45) {
            msg = 'Excerpt must be 45 characters or fewer.';
        } else if (!body || body.replace(/<[^>]*>/g,'').trim() === '') {
            msg = 'Body is required.';
        }
        if (msg) {
            e.preventDefault();
            alert(msg);
        }
    });
    $(function() {
        $('.summernote').summernote({
            height: 400,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['fontsize', 'color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
    </script>
</body>
</html>

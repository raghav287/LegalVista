<?php
require_once dirname(__DIR__, 2) . '/bootstrap.php';
require_once APP_ROOT . '/app/auth.php';
requireAdminLogin();
require_once dirname(__DIR__, 3) . '/includes/article-repository.php';

$pageTitle = 'Articles';
$page     = max(1, (int)($_GET['page'] ?? 1));
$perPage  = 8;
$offset   = ($page - 1) * $perPage;
$total    = lv_count_articles([], false);
$articles = lv_get_articles(['limit' => $perPage, 'offset' => $offset], false);
$hasArticles = !empty($articles);

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
                            <h1 class="page-title">Articles</h1>
                        </div>

                        <?php if (isset($_GET['saved']) && $_GET['saved'] === '1'): ?>
                            <div class="alert alert-success js-flash-alert" data-flash-param="saved">Article saved successfully.</div>
                        <?php endif; ?>
                        <?php if (isset($_GET['deleted'])): ?>
                            <div class="alert alert-<?= $_GET['deleted'] === '1' ? 'success' : 'danger' ?> js-flash-alert" data-flash-param="deleted">
                                <?= $_GET['deleted'] === '1' ? 'Article deleted successfully.' : 'Unable to delete article.' ?>
                            </div>
                        <?php endif; ?>

                            <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">All Articles</h3>
                                <a href="<?= file_url('articles/form.php') ?>" class="btn btn-primary btn-sm">Add Article</a>
                            </div>
                            <div class="card-body">
                                <?php if (!$hasArticles): ?>
                                    <p class="text-muted mb-0">No articles yet. Click "Add Article" to create your first one.</p>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap border-bottom align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Status</th>
                                                    <th>Publish Date</th>
                                                    <th>Categories</th>
                                                    <th>Updated</th>
                                                    <th style="width: 170px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($articles as $article): ?>
                                                    <?php
                                                        $categories = $article['categories'] ?? [];
                                                        $publishDate = $article['publish_date'] ?? '';
                                                        $updated = $article['updated_at'] ?? '';
                                                        $displayDate = $publishDate ? date('M j, Y', strtotime($publishDate)) : '—';
                                                        $displayUpdated = $updated ? date('M j, Y H:i', strtotime($updated)) : '—';
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class="fw-semibold mb-1"><?= htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8') ?></div>
                                                            <small class="text-muted">Slug: <?= htmlspecialchars($article['slug'], ENT_QUOTES, 'UTF-8') ?></small>
                                                        </td>
                                                        <td><span class="badge bg-<?= ($article['status'] ?? 'draft') === 'published' ? 'success' : 'secondary' ?>"><?= ucfirst($article['status'] ?? 'draft') ?></span></td>
                                                        <td><?= htmlspecialchars($displayDate, ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td><?= htmlspecialchars(implode(', ', $categories), ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td><?= htmlspecialchars($displayUpdated, ENT_QUOTES, 'UTF-8') ?></td>
                                                        <td>
                                                            <a href="<?= file_url('articles/form.php') ?>?id=<?= urlencode((string) ($article['id'] ?? 0)) ?>" class="btn btn-primary btn-sm me-1">Edit</a>
                                                            <form method="post" action="<?= file_url('articles/delete.php') ?>" class="d-inline" onsubmit="return confirm('Delete this article?');">
                                                                <input type="hidden" name="id" value="<?= (int) ($article['id'] ?? 0) ?>">
                                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                        $totalPages = (int)ceil($total / $perPage);
                                        if ($totalPages > 1):
                                    ?>
                                    <nav aria-label="Article pagination" class="mt-3">
                                        <ul class="pagination mb-0">
                                            <?php
                                            $queryBase = $_GET;
                                            for ($p = 1; $p <= $totalPages; $p++):
                                                $queryBase['page'] = $p;
                                                $url = htmlspecialchars(file_url('articles/list.php') . '?' . http_build_query($queryBase), ENT_QUOTES, 'UTF-8');
                                                $active = $p === $page ? 'active' : '';
                                            ?>
                                                <li class="page-item <?= $active ?>"><a class="page-link" href="<?= $url ?>"><?= $p ?></a></li>
                                            <?php endfor; ?>
                                        </ul>
                                    </nav>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include LAYOUT_PATH . '/footer.php'; ?>
    </div>

    <?php include LAYOUT_PATH . '/scripts.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const flashAlerts = document.querySelectorAll('.js-flash-alert');
            if (flashAlerts.length === 0) return;
            const url = new URL(window.location.href);
            flashAlerts.forEach(function (alertEl) {
                const param = alertEl.getAttribute('data-flash-param');
                if (param && url.searchParams.has(param)) {
                    url.searchParams.delete(param);
                }
                setTimeout(function () {
                    alertEl.style.transition = 'opacity 0.35s ease';
                    alertEl.style.opacity = '0';
                    setTimeout(function () { alertEl.remove(); }, 350);
                }, 3000);
            });
            const cleaned = url.pathname + (url.searchParams.toString() ? '?' + url.searchParams.toString() : '') + url.hash;
            window.history.replaceState({}, document.title, cleaned);
        });
    </script>
</body>
</html>

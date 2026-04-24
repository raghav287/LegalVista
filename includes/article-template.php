<?php
require_once __DIR__ . '/article-repository.php';

function lv_article_display_date(array $article): string
{
    $date = $article['publish_date'] ?? ($article['created_at'] ?? null);
    if (!$date) {
        return '';
    }

    $timestamp = strtotime($date);
    return $timestamp ? strtoupper(date('F j, Y', $timestamp)) : '';
}

function lv_render_article_page(array $article): void
{
    $pageTitle = $article['meta_title'] !== '' ? $article['meta_title'] : $article['title'] . ' | Legal Vista Ltd';
    $metaDescription = $article['meta_description'] !== '' ? $article['meta_description'] : ($article['excerpt'] ?? 'Insights from Legal Vista');
    $metaKeywords = $article['meta_keywords'] !== '' ? $article['meta_keywords'] : 'Legal Vista, Georgia business law, company formation, tax residency';
    $categories = $article['categories'] ?? [];
    $categoryText = implode(', ', $categories);
    $dateDisplay = lv_article_display_date($article);
    $categoryCounts = lv_get_category_counts(['status' => 'published'], true);
    $relatedArticles = lv_get_related_articles($article, 2, true);
    // Prev/next navigation (ordered by publish/created desc)
    $allPublished = lv_get_articles(['status' => 'published'], true);
    $prevLink = $nextLink = null;
    if (!empty($allPublished)) {
        foreach ($allPublished as $idx => $item) {
            if (($item['slug'] ?? '') === ($article['slug'] ?? '')) {
                $prevLink = $allPublished[($idx - 1 + count($allPublished)) % count($allPublished)];
                $nextLink = $allPublished[($idx + 1) % count($allPublished)];
                break;
            }
        }
    }
    $bodyHtml = $article['body_html'] ?: '<p>This article is ready to publish. Add content in the admin panel.</p>';
    $featuredImage = $article['featured_image'] ?? '';
    ?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8') ?>" />
    <meta name="keywords" content="<?= htmlspecialchars($metaKeywords, ENT_QUOTES, 'UTF-8') ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" type="image/x-icon" href="images/fevicon.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/fontawesome.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/pbminfotech-base-icons.css" />
    <link rel="stylesheet" href="css/swiper.min.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/shortcode.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="css/demo-4.css" />
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="revolution/rs6.css" />
    <style>
    body.articles-page .navigation>li>a[href="articles-and-resources"] {
        color: #c6a354;
    }

    .article-hero {
        position: relative;
        padding: 118px 0 112px;
        background: linear-gradient(0deg, rgba(12, 32, 70, 0.92), rgba(12, 32, 70, 0.92)), url("images/titlebar-img.jpg") center center / cover no-repeat;
    }

    .article-hero-content {
        text-align: center;
        color: #fff;
    }

    .article-hero-content h1 {
        margin: 0;
        color: #fff;
        font-size: clamp(40px, 5vw, 64px);
        line-height: 1.1;
    }

    .article-hero-content p {
        margin: 18px 0 0;
        color: rgba(255, 255, 255, 0.88);
        font-size: 18px;
    }

    .article-detail-section {
        padding: 86px 0 100px;
        background: #fff;
    }

    .article-detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 56px;
        align-items: start;
        max-width: 1200px;
        margin: 0 auto;
    }

    .article-detail-main {
        max-width: 900px;
        width: 100%;
        margin: 0 auto;
    }

    .article-detail-meta {
        margin-bottom: 14px;
        color: #c6a354;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.03em;
        text-transform: uppercase;
    }

    .article-detail-meta a:hover {
        color: #163760 !important;
        text-decoration: underline !important;
    }

    .article-detail-title {
        margin: 0;
        color: #111111;
        font-size: clamp(34px, 3.5vw, 52px);
        line-height: 1.12;
        word-break: break-word;
        overflow-wrap: anywhere;
    }

    .article-detail-date {
        margin-top: 16px;
        margin-bottom: 28px;
        color: #111111;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .article-featured-image {
        border-radius: 16px;
        overflow: hidden;
        margin: 0 0 28px;
        box-shadow: 0 18px 34px rgba(16, 30, 54, 0.08);
    }

    .article-featured-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .article-detail-content img {
        max-width: 100%;
        height: auto !important;
        border-radius: 12px;
    }

    .article-detail-content table {
        width: 100% !important;
        max-width: 100% !important;
        display: block;
        overflow-x: auto;
        border-collapse: collapse;
        margin-bottom: 24px;
    }

    .article-detail-content table td,
    .article-detail-content table th {
        padding: 12px;
        border: 1px solid #e5e9ef;
    }

    .article-detail-content p,
    .article-detail-content li {
        color: #274667;
        font-size: 16px;
        line-height: 1.9;
        text-align: left;
        word-break: break-word;
        overflow-wrap: anywhere;
        hyphens: auto;
    }

    /* Ensure lists inside article body show bullets/numbers despite global resets */
    .article-detail-content ul {
        list-style: disc;
        padding-left: 22px;
        margin: 16px 0;
    }

    .article-detail-content ol {
        list-style: decimal;
        padding-left: 22px;
        margin: 16px 0;
    }

    .article-detail-content li {
        margin-bottom: 8px;
        list-style-position: outside;
    }

    .article-detail-content {
        max-width: 880px;
        margin: 0 auto;
        padding-left: 12px;
        padding-right: 12px;
        text-align: left;
        word-break: break-word;
        overflow-wrap: anywhere;
        hyphens: auto;
    }

    .article-detail-content h2,
    .article-detail-content h3,
    .article-detail-content h4 {
        margin: 32px 0 14px;
        color: #163760;
    }

    .article-detail-sidebar {
        position: sticky;
        top: 120px;
        align-self: start;
    }

    .article-sidebar-widget+.article-sidebar-widget {
        margin-top: 34px;
    }

    .article-sidebar-widget h3 {
        margin: 0 0 20px;
        color: #163760;
        font-size: 24px;
    }

    .article-search-form {
        position: relative;
    }

    .article-search-form input {
        width: 100%;
        height: 58px;
        padding: 0 56px 0 16px;
        border: 1px solid #d9dfe6;
        border-radius: 10px;
    }

    .article-search-form button {
        position: absolute;
        top: 50%;
        right: 8px;
        width: 42px;
        height: 42px;
        border: 0;
        border-radius: 50%;
        background: transparent;
        color: #7b8591;
        transform: translateY(-50%);
    }

    .article-category-list {
        display: grid;
        gap: 12px;
    }

    .article-category-list a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        color: #163760;
        font-size: 16px;
        text-decoration: none;
    }

    .article-category-list a:hover {
        color: #c6a354;
    }

    .article-related {
        margin-top: 56px;
        padding-top: 30px;
        border-top: 1px solid #e5e9ef;
        max-width: 1000px;
    }

    .article-related h3 {
        margin: 0 0 22px;
        color: #163760;
        font-size: 30px;
    }

    .article-related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 320px));
        gap: 28px;
        justify-content: start;
    }

    .article-related-card-image {
        display: block;
        overflow: hidden;
        border-radius: 14px;
        margin-bottom: 12px;
    }

    .article-related-card-image img {
        width: 100%;
        height: 230px;
        object-fit: cover;
        display: block;
    }

    .article-related-card-meta {
        color: #c6a354;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .article-related-card h4 {
        margin: 0;
        color: #111111;
        font-size: 22px;
        line-height: 1.25;
        word-break: break-word;
        overflow-wrap: anywhere;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-related-card h4 a {
        color: inherit;
    }

    .article-related-card-date {
        margin-top: 8px;
        color: #111111;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .article-nav-divider {
        border: 0;
        border-top: 1px solid #e5e9ef;
        margin: 32px 0;
    }

    .article-post-nav {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        margin-top: 12px;
        margin-bottom: 12px;
        align-items: center;
    }

    .article-post-nav a {
        min-height: 46px;
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #dfe5ec;
        border-radius: 10px;
        color: #163760;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        justify-self: start;
        letter-spacing: 0.02em;
    }

    .article-post-nav .article-post-nav-next {
        justify-self: end;
    }

    .article-post-nav a:hover {
        color: #c6a354;
        border-color: #c6a354;
    }

    @media (max-width: 991px) {
        .article-hero {
            padding: 92px 0 88px;
        }

        .article-detail-layout {
            grid-template-columns: 1fr;
            gap: 42px;
        }

        .article-related-grid,
        .article-post-nav {
            grid-template-columns: 1fr;
        }

        .article-post-nav .article-post-nav-next {
            justify-self: start;
        }
    }

    @media (max-width: 767px) {
        .article-hero {
            padding: 72px 0 68px;
        }

        .article-hero-content h1 {
            font-size: 34px;
        }

        .article-hero-content p {
            font-size: 16px;
        }

        .article-detail-section {
            padding: 56px 0 64px;
        }

        .article-detail-layout {
            gap: 34px;
        }

        .article-detail-title {
            font-size: 28px;
        }

        .article-detail-content p,
        .article-detail-content li {
            font-size: 15px;
        }

        .article-featured-image {
            border-radius: 12px;
            margin-bottom: 22px;
        }

        .article-related h3 {
            font-size: 26px;
        }
    }
    </style>
</head>

<body class="articles-page">
    <div class="page-wrapper">
        <?php include "includes/header.php"; ?>

        <section class="article-hero">
            <div class="container">
                <div class="article-hero-content">
                    <h1>Articles &amp; Resources</h1>
                    <p>Explore insights, legal updates, and practical guidance for Georgia.</p>
                </div>
            </div>
        </section>

        <section class="article-detail-section">
            <div class="container">
                <div class="article-detail-layout">
                    <article class="article-detail-main">
                        <?php if (!empty($categories)): ?>
                        <div class="article-detail-meta">
                            <?php foreach ($categories as $idx => $cat): ?>
                                <a href="articles-and-resources?category=<?= urlencode($cat) ?>" style="color: inherit; text-decoration: none;"><?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?></a><?= ($idx < count($categories) - 1) ? ', ' : '' ?>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <h1 class="article-detail-title"><?= htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8') ?>
                        </h1>
                        <?php if ($dateDisplay !== ''): ?>
                        <div class="article-detail-date"><?= $dateDisplay ?></div>
                        <?php endif; ?>

                        <?php if ($featuredImage !== ''): ?>
                        <div class="article-featured-image"><img
                                src="<?= htmlspecialchars($featuredImage, ENT_QUOTES, 'UTF-8') ?>"
                                alt="<?= htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8') ?>"></div>
                        <?php endif; ?>

                        <div class="article-detail-content">
                            <?= $bodyHtml ?>
                        </div>
                    </article>

                    <aside class="article-detail-sidebar">
                        <div class="article-sidebar-widget">
                            <h3>Search</h3>
                            <form class="article-search-form" method="get" action="articles-and-resources">
                                <input type="search" name="search" placeholder="Search..."
                                    aria-label="Search articles" />
                                <button type="submit" aria-label="Search articles"><i
                                        class="pbmit-base-icon-search"></i></button>
                            </form>
                        </div>
                        <?php if ($categoryCounts): ?>
                        <div class="article-sidebar-widget">
                            <h3>Categories</h3>
                            <div class="article-category-list">
                                <?php foreach ($categoryCounts as $cat => $count): ?>
                                <a href="articles-and-resources?category=<?= urlencode($cat) ?>">
                                    <span><?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?></span>
                                    <span>(<?= (int) $count ?>)</span>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </aside>
                </div>

                <?php if ($prevLink && $nextLink): ?>
                <hr class="article-nav-divider" />
                <div class="article-post-nav">
                    <a href="article?slug=<?= htmlspecialchars($prevLink['slug'] ?? '#', ENT_QUOTES, 'UTF-8') ?>">
                        <span aria-hidden="true">&lsaquo;</span> Previous
                    </a>
                    <a class="article-post-nav-next"
                        href="article?slug=<?= htmlspecialchars($nextLink['slug'] ?? '#', ENT_QUOTES, 'UTF-8') ?>">
                        Next <span aria-hidden="true">&rsaquo;</span>
                    </a>
                </div>
                <?php endif; ?>

                <?php if ($relatedArticles): ?>
                <div class="article-related">
                    <h3>Related posts</h3>
                    <div class="article-related-grid">
                        <?php foreach ($relatedArticles as $related): ?>
                        <article class="article-related-card">
                            <a class="article-related-card-image"
                                href="article?slug=<?= htmlspecialchars($related['slug'], ENT_QUOTES, 'UTF-8') ?>">
                                <img src="<?= htmlspecialchars($related['image'] ?? $related['featured_image'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                    alt="<?= htmlspecialchars($related['title'], ENT_QUOTES, 'UTF-8') ?>" />
                            </a>
                            <div class="article-related-card-meta">
                                <?= htmlspecialchars(implode(', ', $related['categories'] ?? []), ENT_QUOTES, 'UTF-8') ?>
                            </div>
                            <h4><a
                                    href="article?slug=<?= htmlspecialchars($related['slug'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($related['title'], ENT_QUOTES, 'UTF-8') ?></a>
                            </h4>
                            <?php $relatedDate = lv_article_display_date($related); ?>
                            <?php if ($relatedDate !== ''): ?><div class="article-related-card-date"><?= $relatedDate ?>
                            </div><?php endif; ?>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <?php include "includes/footer.php"; ?>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.appear.js"></script>
    <script src="js/numinate.min.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/circle-progress.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
<?php
}

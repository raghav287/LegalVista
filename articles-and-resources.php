<?php
require_once __DIR__ . '/includes/article-repository.php';

$categoryOrder = [
    'Company Formation',
    'New Law Changes',
    'Tax Residency',
    'Resident Permit',
    'Taxes',
    'Guides',
];

$searchQuery = isset($_GET['search']) ? trim((string) $_GET['search']) : '';
$selectedCategory = isset($_GET['category']) ? trim((string) $_GET['category']) : '';

if (!in_array($selectedCategory, $categoryOrder, true)) {
    $selectedCategory = '';
}

$perPage = 6;
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$currentPage = max(1, $currentPage);

$baseFilters = [
    'status' => 'published',
];

if ($searchQuery !== '') {
    $baseFilters['search'] = $searchQuery;
}
if ($selectedCategory !== '') {
    $baseFilters['category'] = $selectedCategory;
}

$totalArticles = lv_count_articles($baseFilters, true);
$totalPages = max(1, (int) ceil($totalArticles / $perPage));
$currentPage = min($currentPage, $totalPages);
$offset = ($currentPage - 1) * $perPage;

$pageArticles = lv_get_articles(array_merge($baseFilters, [
    'limit' => $perPage,
    'offset' => $offset,
]), true);

$categoryCounts = lv_get_category_counts(['status' => 'published'], true);
foreach ($categoryOrder as $categoryName) {
    $categoryCounts[$categoryName] = $categoryCounts[$categoryName] ?? 0;
}

function buildArticlesUrl(array $params = []): string
{
    $query = array_filter(
        $params,
        static fn($value): bool => $value !== null && $value !== ''
    );

    return 'articles-and-resources' . ($query ? '?' . http_build_query($query) : '');
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Articles & Resources | Legal Vista Ltd</title>
    <meta name="description" content="Explore Legal Vista articles and resources on company formation, tax residency, resident permits, compliance updates, and practical guides for doing business in Georgia." />
    <meta name="keywords" content="Legal Vista articles, Georgia company formation, tax residency Georgia, resident permit Georgia, legal updates Georgia, business guides Georgia" />
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
        body.articles-page .navigation > li > a[href="articles-and-resources"] {
            color: #c6a354;
        }

        .articles-hero {
            position: relative;
            padding: 118px 0 112px;
            background:
                linear-gradient(0deg, rgba(12, 32, 70, 0.92), rgba(12, 32, 70, 0.92)),
                url("images/titlebar-img.jpg") center center / cover no-repeat;
            overflow: hidden;
        }

        .articles-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(10, 30, 60, 0.18), rgba(10, 30, 60, 0));
        }

        .articles-hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: #fff;
        }

        .articles-hero-content h1 {
            margin: 0;
            font-size: clamp(42px, 5vw, 64px);
            line-height: 1.08;
            color: #fff;
        }

        .articles-hero-content p {
            margin: 18px 0 0;
            font-size: 18px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.88);
        }

        .articles-section {
            padding: 86px 0 100px;
            background: #fff;
        }

        .articles-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 330px;
            gap: 64px;
            align-items: start;
        }

        .articles-list {
            display: grid;
            gap: 42px;
        }

        .article-card {
            display: grid;
            grid-template-columns: 174px minmax(0, 1fr);
            gap: 28px;
            align-items: center;
        }

        .article-card-image {
            display: block;
            overflow: hidden;
            border-radius: 16px;
            aspect-ratio: 1 / 1;
            box-shadow: 0 18px 34px rgba(16, 30, 54, 0.08);
        }

        .article-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.35s ease;
        }

        .article-card:hover .article-card-image img {
            transform: scale(1.04);
        }

        .article-card-meta {
            margin-bottom: 10px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            color: #c6a354;
        }

        .article-card-title {
            margin: 0;
            font-size: 22px;
            line-height: 1.25;
            font-weight: 700;
            word-break: break-word;
            overflow-wrap: anywhere;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-card-title a {
            color: #111111;
        }

        .article-card-title a:hover {
            color: #1f2f45;
        }

        .article-card-date {
            margin-top: 12px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            color: #111111;
        }

        .articles-sidebar {
            padding-top: 4px;
            position: sticky;
            top: 120px;
            align-self: start;
        }

        .articles-widget + .articles-widget {
            margin-top: 34px;
        }

        .articles-widget h3 {
            margin: 0 0 22px;
            font-size: 24px;
            line-height: 1.2;
            color: #163760;
        }

        .articles-search-form {
            position: relative;
        }

        .articles-search-input {
            width: 100%;
            height: 58px;
            padding: 0 58px 0 18px;
            border: 1px solid #d7dde5;
            border-radius: 10px;
            font-size: 15px;
            color: #1e2d3f;
            background: #fff;
        }

        .articles-search-input:focus {
            outline: none;
            border-color: #c6a354;
            box-shadow: 0 0 0 3px rgba(198, 163, 84, 0.12);
        }

        .articles-search-button {
            position: absolute;
            top: 50%;
            right: 8px;
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 50%;
            background: transparent;
            color: #6d7886;
            transform: translateY(-50%);
        }

        .articles-search-button:hover {
            color: #c6a354;
        }

        .articles-category-list {
            display: grid;
            gap: 14px;
        }

        .articles-category-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            font-size: 17px;
            line-height: 1.4;
            color: #163760;
        }

        .articles-category-link:hover,
        .articles-category-link.is-active {
            color: #c6a354;
        }

        .articles-results-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 30px;
            padding-bottom: 18px;
            border-bottom: 1px solid #eef1f4;
        }

        .articles-results-text {
            font-size: 14px;
            line-height: 1.6;
            color: #6c7684;
        }

        .articles-clear-link {
            font-size: 14px;
            font-weight: 700;
            color: #163760;
        }

        .articles-clear-link:hover {
            color: #c6a354;
        }

        .articles-empty {
            padding: 38px 32px;
            border: 1px solid #edf1f5;
            border-radius: 18px;
            background: #fbfcfd;
        }

        .articles-empty h3 {
            margin: 0 0 12px;
            font-size: 24px;
            color: #163760;
        }

        .articles-empty p {
            margin: 0;
            color: #6c7684;
        }

        .articles-pagination {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin-top: 52px;
        }

        .articles-page-link {
            min-width: 46px;
            height: 46px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dfe5ec;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            color: #163760;
            background: #fff;
        }

        .articles-page-link:hover {
            border-color: #c6a354;
            color: #c6a354;
        }

        .articles-page-link.is-active {
            border-color: #c6a354;
            background: #c6a354;
            color: #fff;
        }

        .articles-page-link.next-link {
            gap: 8px;
            text-transform: uppercase;
        }

        @media (max-width: 1199px) {
            .articles-layout {
                grid-template-columns: minmax(0, 1fr) 290px;
                gap: 40px;
            }
        }

        @media (max-width: 991px) {
            .articles-hero {
                padding: 92px 0 88px;
            }

            .articles-section {
                padding: 70px 0 84px;
            }

            .articles-layout {
                grid-template-columns: 1fr;
                gap: 48px;
            }

            .articles-sidebar {
                order: -1;
            }
        }

        @media (max-width: 767px) {
            .article-card {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .article-card-image {
                max-width: 280px;
            }

            .articles-results-bar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body class="articles-page">
    <div class="page-wrapper">
        <?php include("includes/header.php"); ?>

        <section class="articles-hero">
            <div class="container">
                <div class="articles-hero-content">
                    <h1>Articles &amp; Resources</h1>
                    <p>Explore insights, legal updates, and practical guidance for building and growing in Georgia.</p>
                </div>
            </div>
        </section>

        <section class="articles-section">
            <div class="container">
                <div class="articles-layout">
                    <div class="articles-main">
                        <div class="articles-results-bar">
                            <div class="articles-results-text">
                                <?php if ($searchQuery !== '' || $selectedCategory !== ''): ?>
                                    Showing <?php echo count($pageArticles); ?> of <?php echo $totalArticles; ?> article<?php echo $totalArticles === 1 ? '' : 's'; ?>
                                    <?php if ($searchQuery !== ''): ?>
                                        for "<?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?>"
                                    <?php endif; ?>
                                    <?php if ($selectedCategory !== ''): ?>
                                        in <?php echo htmlspecialchars($selectedCategory, ENT_QUOTES, 'UTF-8'); ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    Showing the latest insights from Legal Vista.
                                <?php endif; ?>
                            </div>
                            <?php if ($searchQuery !== '' || $selectedCategory !== ''): ?>
                                <a class="articles-clear-link" href="articles-and-resources">Clear filters</a>
                            <?php endif; ?>
                        </div>

                        <?php if ($pageArticles): ?>
                            <div class="articles-list">
                                <?php foreach ($pageArticles as $article): ?>
                                    <?php
                                        $articleCategories = $article['categories'] ?? [];
                                        $articleImage = $article['featured_image'] ?? ($article['image'] ?? '');
                                        $articleDateValue = $article['publish_date'] ?? ($article['date'] ?? '');
                                        $articleDateText = $articleDateValue ? strtoupper(date('F j, Y', strtotime($articleDateValue))) : '';
                                    ?>
                                    <article class="article-card">
                                        <a class="article-card-image" href="<?php echo htmlspecialchars('article.php?slug=' . $article['slug'], ENT_QUOTES, 'UTF-8'); ?>">
                                            <img src="<?php echo htmlspecialchars($articleImage, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>" />
                                        </a>
                                        <div class="article-card-content">
                                            <div class="article-card-meta"><?php echo htmlspecialchars(implode(', ', $articleCategories), ENT_QUOTES, 'UTF-8'); ?></div>
                                            <h2 class="article-card-title">
                                                <a href="<?php echo htmlspecialchars('article.php?slug=' . $article['slug'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>
                                                </a>
                                            </h2>
                                            <?php if ($articleDateText !== ''): ?>
                                                <div class="article-card-date"><?php echo $articleDateText; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>

                            <?php if ($totalPages > 1): ?>
                                <nav class="articles-pagination" aria-label="Articles pagination">
                                    <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                                        <a
                                            class="articles-page-link<?php echo $page === $currentPage ? ' is-active' : ''; ?>"
                                            href="<?php echo htmlspecialchars(buildArticlesUrl([
                                                'search' => $searchQuery,
                                                'category' => $selectedCategory,
                                                'page' => $page,
                                            ]), ENT_QUOTES, 'UTF-8'); ?>"
                                        >
                                            <?php echo $page; ?>
                                        </a>
                                    <?php endfor; ?>

                                    <?php if ($currentPage < $totalPages): ?>
                                        <a
                                            class="articles-page-link next-link"
                                            href="<?php echo htmlspecialchars(buildArticlesUrl([
                                                'search' => $searchQuery,
                                                'category' => $selectedCategory,
                                                'page' => $currentPage + 1,
                                            ]), ENT_QUOTES, 'UTF-8'); ?>"
                                        >
                                            Next <span aria-hidden="true">&rsaquo;</span>
                                        </a>
                                    <?php endif; ?>
                                </nav>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="articles-empty">
                                <h3>No articles found</h3>
                                <p>Try a different search term or choose another category to explore more resources.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <aside class="articles-sidebar">
                        <div class="articles-widget">
                            <h3>Search</h3>
                            <form class="articles-search-form" method="get" action="articles-and-resources">
                                <?php if ($selectedCategory !== ''): ?>
                                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($selectedCategory, ENT_QUOTES, 'UTF-8'); ?>" />
                                <?php endif; ?>
                                <input
                                    class="articles-search-input"
                                    type="search"
                                    name="search"
                                    value="<?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?>"
                                    placeholder="Search..."
                                    aria-label="Search articles"
                                />
                                <button class="articles-search-button" type="submit" aria-label="Search articles">
                                    <i class="pbmit-base-icon-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="articles-widget">
                            <h3>Categories</h3>
                            <div class="articles-category-list">
                                <?php foreach ($categoryOrder as $categoryName): ?>
                                    <a
                                        class="articles-category-link<?php echo $selectedCategory === $categoryName ? ' is-active' : ''; ?>"
                                        href="<?php echo htmlspecialchars(buildArticlesUrl([
                                            'search' => $searchQuery,
                                            'category' => $categoryName,
                                        ]), ENT_QUOTES, 'UTF-8'); ?>"
                                    >
                                        <span><?php echo htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8'); ?></span>
                                        <span>(<?php echo $categoryCounts[$categoryName]; ?>)</span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <?php include("includes/footer.php"); ?>
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

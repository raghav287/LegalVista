<?php
$allArticles = [
    [
        'slug' => 'georgias-new-work-permit-regime',
        'title' => 'Georgia’s New Work Permit Regime from March 2026: What Digital Nomads & Entrepreneurs Must Know',
        'image' => 'images/georgias-new-work-permit-regime.jpg',
        'date' => '2026-03-12',
        'categories' => ['New Law Changes', 'Resident Permit'],
    ],
    [
        'slug' => 'temporary-residence-permit-changes-202526',
        'title' => 'Temporary Residence Permit Changes 2025–26: New Rules for Entrepreneurs, Investors, and IT Specialists in Georgia',
        'image' => 'images/temporary-residence-permit-changes-202526.jpg',
        'date' => '2026-02-18',
        'categories' => ['New Law Changes', 'Resident Permit'],
    ],
    [
        'slug' => 'got-denied-a-residence-permit-in-georgia',
        'title' => 'Got Denied a Residence Permit in Georgia? Here’s What You Need to Do Next',
        'image' => 'images/got-denied-a-residence-permit-in-georgia.jpg',
        'date' => '2026-01-30',
        'categories' => ['Resident Permit', 'Guides'],
    ],
    [
        'slug' => 'how-to-become-a-tax-resident-in-georgia-a-2025-guide',
        'title' => 'How to Become a Tax Resident in Georgia: A 2025 Guide',
        'image' => 'images/how-to-become-a-tax-resident-in-georgia-a-2025-guide.jpg',
        'date' => '2025-12-11',
        'categories' => ['Tax Residency', 'Taxes', 'Guides'],
    ],
    [
        'slug' => 'moving-to-georgia-with-your-family',
        'title' => 'Moving to Georgia with Your Family: What You Need to Know',
        'image' => 'images/low-tax-jurisdiction-why-entrepreneurs-are-moving-to-georgia.jpg',
        'date' => '2025-10-14',
        'categories' => ['Resident Permit', 'Guides'],
    ],
    [
        'slug' => 'new-aml-compliance-rules-for-company',
        'title' => 'New AML Compliance Rules for Company Formation in Georgia (2025 Update)',
        'image' => 'images/new-aml-compliance-rules-for-company.jpg',
        'date' => '2025-09-03',
        'categories' => ['Company Formation', 'New Law Changes'],
    ],
    [
        'slug' => 'georgia-is-easy-until-it-isnt',
        'title' => 'Georgia is Easy Until It Isn’t: A Lawyer’s View on What Can Go Wrong',
        'image' => 'images/georgia-is-easy-until-it-isnt.jpg',
        'date' => '2025-07-21',
        'categories' => ['Company Formation', 'Guides'],
    ],
    [
        'slug' => 'low-tax-jurisdiction-why-entrepreneurs-are-moving-to-georgia',
        'title' => 'Low-Tax Jurisdiction: Why Entrepreneurs Are Moving to Georgia',
        'image' => 'images/low-tax-jurisdiction-why-entrepreneurs-are-moving-to-georgia.jpg',
        'date' => '2025-05-06',
        'categories' => ['Tax Residency', 'Taxes'],
    ],
    [
        'slug' => 'ultimate-guide-to-georgias-tax-haven-for-digital-nomads',
        'title' => 'The Ultimate Guide to Georgia\'s Tax Haven for Digital Nomads',
        'image' => 'images/ultimate-guide-to-georgias-tax-haven-for-digital-nomads1.jpg',
        'date' => '2025-03-19',
        'categories' => ['Tax Residency', 'Taxes', 'Guides'],
    ],
    [
        'slug' => 'unlock-entrepreneurial-freedom',
        'title' => 'Unlock Entrepreneurial Freedom',
        'image' => 'images/nlock-entrepreneurial.jpg',
        'date' => '2024-11-28',
        'categories' => ['Company Formation', 'Guides'],
    ],
    [
        'slug' => 'compelling-reasons-to-register-your-business-in-georgia',
        'title' => '5 Compelling Reasons to Register Your Business in Georgia',
        'image' => 'images/your-business-in-georgia.jpg',
        'date' => '2024-09-12',
        'categories' => ['Company Formation', 'Guides'],
    ],
];

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

$filteredArticles = array_values(array_filter(
    $allArticles,
    static function (array $article) use ($searchQuery, $selectedCategory): bool {
        $matchesSearch = true;
        $matchesCategory = true;

        if ($searchQuery !== '') {
            $haystack = $article['title'] . ' ' . implode(' ', $article['categories']);
            $matchesSearch = stripos($haystack, $searchQuery) !== false;
        }

        if ($selectedCategory !== '') {
            $matchesCategory = in_array($selectedCategory, $article['categories'], true);
        }

        return $matchesSearch && $matchesCategory;
    }
));

$perPage = 6; // Show more articles per page (increased from 3)
$totalArticles = count($filteredArticles);
$totalPages = max(1, (int) ceil($totalArticles / $perPage));
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages));
$offset = ($currentPage - 1) * $perPage;
$pageArticles = array_slice($filteredArticles, $offset, $perPage);

$categoryCounts = [];
foreach ($categoryOrder as $categoryName) {
    $categoryCounts[$categoryName] = 0;
}

foreach ($allArticles as $article) {
    foreach ($article['categories'] as $articleCategory) {
        if (isset($categoryCounts[$articleCategory])) {
            $categoryCounts[$articleCategory]++;
        }
    }
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
                linear-gradient(0deg, rgba(17, 44, 84, 0.88), rgba(17, 44, 84, 0.88)),
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
                                    <article class="article-card">
                                        <a class="article-card-image" href="<?php echo htmlspecialchars($article['slug'], ENT_QUOTES, 'UTF-8'); ?>">
                                            <img src="<?php echo htmlspecialchars($article['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>" />
                                        </a>
                                        <div class="article-card-content">
                                            <div class="article-card-meta"><?php echo htmlspecialchars(implode(', ', $article['categories']), ENT_QUOTES, 'UTF-8'); ?></div>
                                            <h2 class="article-card-title">
                                                <a href="<?php echo htmlspecialchars($article['slug'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>
                                                </a>
                                            </h2>
                                            <div class="article-card-date"><?php echo strtoupper(date('F j, Y', strtotime($article['date']))); ?></div>
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

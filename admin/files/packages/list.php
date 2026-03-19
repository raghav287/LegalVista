<?php
require_once dirname(__DIR__, 2) . "/bootstrap.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";

$pageTitle = "Homepage Packages";
$packages = getHomepagePackages();

include LAYOUT_PATH . "/head.php";
?>
<body class="app sidebar-mini ltr light-mode">
    <div id="global-loader">
        <img src="<?= asset_url("images/loader.svg") ?>" class="loader-img" alt="Loader">
    </div>

    <div class="page">
        <div class="page-main">
            <?php include LAYOUT_PATH . "/header.php"; ?>
            <?php include LAYOUT_PATH . "/sidebar.php"; ?>

            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <div class="main-container container-fluid">
                        <div class="page-header">
                            <h1 class="page-title">Homepage Packages</h1>
                        </div>

                        <?php if (isset($_GET["saved"]) && $_GET["saved"] === "1"): ?>
                            <div class="alert alert-success">Package saved successfully.</div>
                        <?php endif; ?>
                        <?php if (isset($_GET["deleted"])): ?>
                            <div class="alert alert-<?= $_GET["deleted"] === "1" ? "success" : "danger" ?>">
                                <?= $_GET["deleted"] === "1" ? "Package deleted successfully." : "Unable to delete package." ?>
                            </div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3 class="card-title">Packages</h3>
                                <a href="<?= file_url("packages/form.php") ?>" class="btn btn-primary btn-sm">Add Package</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price (EUR)</th>
                                                <th>Featured</th>
                                                <th>Sort Order</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($packages as $package): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($package["package_name"]) ?></td>
                                                    <td><?= htmlspecialchars($package["price_eur"]) ?></td>
                                                    <td><?= !empty($package["is_featured"]) ? "Yes" : "No" ?></td>
                                                    <td><?= htmlspecialchars((string) $package["sort_order"]) ?></td>
                                                    <td>
                                                        <a href="<?= file_url("packages/form.php") ?>?id=<?= urlencode((string) $package["id"]) ?>" class="btn btn-primary btn-sm me-1">Edit</a>
                                                        <form method="post" action="<?= file_url("packages/delete.php") ?>" class="d-inline" onsubmit="return confirm('Delete this package?');">
                                                            <input type="hidden" name="id" value="<?= (int) $package["id"] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include LAYOUT_PATH . "/footer.php"; ?>
    </div>

    <?php include LAYOUT_PATH . "/scripts.php"; ?>
</body>
</html>

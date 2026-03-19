<?php
require_once dirname(__DIR__, 2) . "/bootstrap.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";

$pageTitle = "Package Form";
$errors = [];
$packageId = null;
$formValues = [
    "package_name" => "",
    "price_eur" => "",
    "services_text" => "",
    "button_url" => "company-registration.php",
    "is_featured" => "0",
    "badge_text" => "",
    "sort_order" => "0",
];

if (!empty($_GET["id"])) {
    $packageId = (int) $_GET["id"];
    $package = getHomepagePackageById($packageId);
    if ($package !== null) {
        $formValues = [
            "package_name" => $package["package_name"] ?? "",
            "price_eur" => $package["price_eur"] ?? "",
            "services_text" => $package["services_text"] ?? "",
            "button_url" => $package["button_url"] ?? "company-registration.php",
            "is_featured" => !empty($package["is_featured"]) ? "1" : "0",
            "badge_text" => $package["badge_text"] ?? "",
            "sort_order" => (string) ($package["sort_order"] ?? "0"),
        ];
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $packageId = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $formValues = [
        "package_name" => trim($_POST["package_name"] ?? ""),
        "price_eur" => trim($_POST["price_eur"] ?? ""),
        "services_text" => trim($_POST["services_text"] ?? ""),
        "button_url" => trim($_POST["button_url"] ?? ""),
        "is_featured" => !empty($_POST["is_featured"]) ? "1" : "0",
        "badge_text" => trim($_POST["badge_text"] ?? ""),
        "sort_order" => trim($_POST["sort_order"] ?? "0"),
    ];

    if ($formValues["package_name"] === "") {
        $errors[] = "Package name is required.";
    }
    if ($formValues["price_eur"] === "") {
        $errors[] = "Price is required.";
    }
    if ($formValues["services_text"] === "") {
        $errors[] = "Services are required.";
    }
    if ($formValues["button_url"] === "") {
        $errors[] = "Button URL is required.";
    }

    if (empty($errors)) {
        $savedId = saveHomepagePackage([
            "id" => $packageId ?: null,
            "package_name" => $formValues["package_name"],
            "price_eur" => $formValues["price_eur"],
            "services_text" => $formValues["services_text"],
            "button_url" => $formValues["button_url"],
            "is_featured" => $formValues["is_featured"],
            "badge_text" => $formValues["badge_text"],
            "sort_order" => (int) $formValues["sort_order"],
        ]);

        if ($savedId !== null) {
            header("Location: " . file_url("packages/list.php") . "?saved=1");
            exit();
        }

        $errors[] = "Unable to save package right now.";
    }
}

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
                            <h1 class="page-title">Package Form</h1>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?= $packageId ? "Edit Package" : "Add Package" ?></h3>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($errors)): ?>
                                    <div class="alert alert-danger">
                                        <?php foreach ($errors as $error): ?>
                                            <div><?= htmlspecialchars($error) ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <form method="post" action="<?= htmlspecialchars($_SERVER["REQUEST_URI"]) ?>">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars((string) ($packageId ?? "")) ?>">

                                    <div class="form-group">
                                        <label class="form-label">Package Name</label>
                                        <input type="text" class="form-control" name="package_name" value="<?= htmlspecialchars($formValues["package_name"]) ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Price (EUR)</label>
                                        <input type="text" class="form-control" name="price_eur" value="<?= htmlspecialchars($formValues["price_eur"]) ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Services</label>
                                        <textarea class="form-control" name="services_text" rows="8" required><?= htmlspecialchars($formValues["services_text"]) ?></textarea>
                                        <small class="text-muted">Add one service per line.</small>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Button URL</label>
                                        <input type="text" class="form-control" name="button_url" value="<?= htmlspecialchars($formValues["button_url"]) ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Badge Text</label>
                                        <input type="text" class="form-control" name="badge_text" value="<?= htmlspecialchars($formValues["badge_text"]) ?>">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Sort Order</label>
                                        <input type="number" class="form-control" name="sort_order" value="<?= htmlspecialchars($formValues["sort_order"]) ?>" required>
                                    </div>

                                    <div class="form-group form-check mt-3">
                                        <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" <?= $formValues["is_featured"] === "1" ? "checked" : "" ?>>
                                        <label class="form-check-label" for="is_featured">Featured Package</label>
                                    </div>

                                    <div class="mt-4 d-flex gap-2">
                                        <button type="submit" class="btn btn-primary"><?= $packageId ? "Update" : "Add" ?> Package</button>
                                        <a class="btn btn-secondary" href="<?= file_url("packages/list.php") ?>">Back to Packages</a>
                                    </div>
                                </form>
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

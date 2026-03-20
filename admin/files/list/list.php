<?php
require_once dirname(__DIR__, 2) . "/bootstrap.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";
$pageTitle = "Contact Enquiries";
$listingItems = getListingItems();

function getLeadStatusBadgeClass(string $status): string
{
    return match ($status) {
        "Contacted" => "badge bg-info",
        "Qualified" => "badge bg-success",
        "Closed" => "badge bg-secondary",
        default => "badge bg-warning text-dark",
    };
}

include LAYOUT_PATH . "/head.php";
?>


<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="<?= asset_url(
            "images/loader.svg",
        ) ?>" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <?php include LAYOUT_PATH . "/header.php"; ?>
            <?php include LAYOUT_PATH . "/sidebar.php"; ?>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Contact Enquiries</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Listings</li>
                                </ol>
                            </div>
                        </div>
                        <?php if (
                            isset($_GET["saved"]) &&
                            $_GET["saved"] === "1"
                        ): ?>
                            <div class="alert alert-success js-flash-alert" data-flash-param="saved">
                                Enquiry saved successfully.
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_GET["deleted"])): ?>
                            <div class="alert alert-<?= $_GET["deleted"] === "1"
                                ? "success"
                                : "danger" ?> js-flash-alert" data-flash-param="deleted">
                                <?= $_GET["deleted"] === "1"
                                    ? "Enquiry deleted successfully."
                                    : "Unable to delete the enquiry right now." ?>
                            </div>
                        <?php endif; ?>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h3 class="card-title">Enquiries</h3>
                                        <a href="<?= file_url(
                                            "form/form.php",
                                        ) ?>" class="btn btn-primary btn-sm"><i class="fe fe-plus"></i> Add New</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="status-filter" class="form-label">Filter by status</label>
                                                <select id="status-filter" class="form-control form-select">
                                                    <option value="">All Statuses</option>
                                                    <?php foreach (getLeadStatusOptions() as $statusOption): ?>
                                                        <option value="<?= htmlspecialchars($statusOption) ?>">
                                                            <?= htmlspecialchars($statusOption) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                                <thead>
                                                    <tr>
                                                        <th class="border-bottom-0">Name</th>
                                                        <th class="border-bottom-0">Email</th>
                                                        <th class="border-bottom-0">Service</th>
                                                        <th class="border-bottom-0">Message</th>
                                                        <th class="border-bottom-0">Status</th>
                                                        <th class="border-bottom-0">Created At</th>
                                                        <th class="border-bottom-0">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (
                                                        empty($listingItems)
                                                    ): ?>
                                                        <tr>
                                                            <td colspan="7" class="text-center text-muted">No records found.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php foreach (
                                                        $listingItems
                                                        as $item
                                                    ): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars(
                                                                $item["name"],
                                                            ) ?></td>
                                                            <td><?= htmlspecialchars(
                                                                $item["email"],
                                                            ) ?></td>
                                                            <td><?= htmlspecialchars(
                                                                $item["service"],
                                                            ) ?></td>
                                                            <td><?= htmlspecialchars(
                                                                $item["message"],
                                                            ) ?></td>
                                                            <td data-status="<?= htmlspecialchars($item["status"] ?? "New") ?>">
                                                                <span class="<?= htmlspecialchars(getLeadStatusBadgeClass($item["status"] ?? "New")) ?>">
                                                                    <?= htmlspecialchars($item["status"] ?? "New") ?>
                                                                </span>
                                                            </td>
                                                            <td><?= htmlspecialchars(
                                                                $item["created_at"],
                                                            ) ?></td>
                                                            <td>
                                                                <a href="<?= file_url(
                                                                    "form/form.php",
                                                                ) ?>?id=<?= urlencode(
    $item["id"],
) ?>" class="btn btn-primary btn-sm me-1"><i class="fe fe-edit"></i></a>
                                                                <form method="post" action="<?= file_url(
                                                                    "list/delete.php",
                                                                ) ?>" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                                                    <input type="hidden" name="id" value="<?= (int) $item[
                                                                        "id"
                                                                    ] ?>">
                                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                                        <i class="fe fe-trash"></i>
                                                                    </button>
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
                        <!-- End Row -->

                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->

        </div>

        <?php include LAYOUT_PATH . "/footer.php"; ?>
    </div>

    <!-- REQUIRED JS COMPONENTS -->
    <?php include LAYOUT_PATH . "/scripts.php"; ?>

    <!-- INTERNAL Data tables js-->
    <script src="<?= asset_url(
        "plugins/datatable/js/jquery.dataTables.min.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/js/dataTables.bootstrap5.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/js/dataTables.buttons.min.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/js/buttons.bootstrap5.min.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/js/jszip.min.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/pdfmake/pdfmake.min.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/pdfmake/vfs_fonts.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/js/buttons.html5.min.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/js/buttons.print.min.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/js/buttons.colVis.min.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/dataTables.responsive.min.js",
    ) ?>"></script>
    <script src="<?= asset_url(
        "plugins/datatable/responsive.bootstrap5.min.js",
    ) ?>"></script>
    <script src="<?= asset_url("js/table-data.js") ?>"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const flashAlerts = document.querySelectorAll(".js-flash-alert");
            if (flashAlerts.length > 0) {
                const url = new URL(window.location.href);
                let urlChanged = false;

                flashAlerts.forEach(function (alertElement) {
                    const paramName = alertElement.getAttribute("data-flash-param");
                    if (paramName && url.searchParams.has(paramName)) {
                        url.searchParams.delete(paramName);
                        urlChanged = true;
                    }

                    window.setTimeout(function () {
                        alertElement.style.transition = "opacity 0.4s ease";
                        alertElement.style.opacity = "0";
                        window.setTimeout(function () {
                            alertElement.remove();
                        }, 400);
                    }, 3000);
                });

                if (urlChanged) {
                    const cleanedUrl = url.pathname + (url.searchParams.toString() ? "?" + url.searchParams.toString() : "") + url.hash;
                    window.history.replaceState({}, document.title, cleanedUrl);
                }
            }

            const filter = document.getElementById("status-filter");
            const rows = document.querySelectorAll("#responsive-datatable tbody tr");

            if (!filter) {
                return;
            }

            filter.addEventListener("change", function () {
                const selectedStatus = this.value.toLowerCase();

                rows.forEach(function (row) {
                    const statusCell = row.querySelector("[data-status]");
                    if (!statusCell) {
                        return;
                    }

                    const rowStatus = statusCell.getAttribute("data-status").toLowerCase();
                    row.style.display = selectedStatus === "" || rowStatus === selectedStatus ? "" : "none";
                });
            });
        });
    </script>

</body>

</html>

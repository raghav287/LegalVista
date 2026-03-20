<?php
require_once dirname(__DIR__, 2) . "/bootstrap.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
$pageTitle = "Settings";
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
                            <h1 class="page-title">Settings</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row">
                            <div class="col-lg-4 col-xl-3">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="list-group list-group-transparent mb-0 settings-tab">
                                            <a href="#general" data-bs-toggle="tab" class="list-group-item list-group-item-action active d-flex align-items-center">
                                                <i class="fe fe-settings me-3 fs-16"></i> General
                                            </a>
                                            <a href="#profile-settings" data-bs-toggle="tab" class="list-group-item list-group-item-action d-flex align-items-center">
                                                <i class="fe fe-user me-3 fs-16"></i> Profile Settings
                                            </a>
                                            <a href="#notifications" data-bs-toggle="tab" class="list-group-item list-group-item-action d-flex align-items-center">
                                                <i class="fe fe-bell me-3 fs-16"></i> Notifications
                                            </a>
                                            <a href="#security" data-bs-toggle="tab" class="list-group-item list-group-item-action d-flex align-items-center">
                                                <i class="fe fe-lock me-3 fs-16"></i> Security
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xl-9">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="general">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">General Settings</h3>
                                            </div>
                                            <div class="card-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label class="form-label">Site Title</label>
                                                        <input type="text" class="form-control" value="Sash Admin Panel">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Site Email</label>
                                                        <input type="email" class="form-control" value="admin@example.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Timezone</label>
                                                        <select class="form-control form-select select2">
                                                            <option value="UTC">UTC</option>
                                                            <option value="EST">EST</option>
                                                            <option value="PST">PST</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <div class="form-label">Maintenance Mode</div>
                                                        <div class="custom-controls-stacked">
                                                            <label class="custom-control custom-switch">
                                                                <input type="checkbox" name="maintenance" class="custom-control-input">
                                                                <span class="custom-control-label">Enable Maintenance Mode</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <button class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile-settings">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Profile Settings</h3>
                                            </div>
                                            <div class="card-body">
                                                <!-- Profile specific settings can go here -->
                                                <p class="text-muted">Manage your personal profile information and visibility.</p>
                                                    <div class="form-group">
                                                        <label class="form-label">Display Name</label>
                                                        <input type="text" class="form-control" value="Percy Kewshun">
                                                    </div>
                                                    <button class="btn btn-primary">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Additional panes for notifications and security can be added similarly -->
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

</body>

</html>

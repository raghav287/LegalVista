<?php
require_once dirname(__DIR__, 2) . "/bootstrap.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";
$pageTitle = "User Profile";
$profileData = getProfileDetails();
$adminAccount = getAdminUser((int) ($_SESSION["admin_id"] ?? 0)) ?? [];
$profilePicturePath =
    $adminAccount["profile_picture"] ??
    ($_SESSION["admin_profile_picture"] ?? "");
$profilePictureUrl = asset_url("images/users/21.jpg");
if ($profilePicturePath !== "") {
    if (strpos($profilePicturePath, "images/") === 0) {
        $profilePictureUrl = asset_url($profilePicturePath);
    } else {
        $profilePictureUrl = file_url($profilePicturePath);
    }
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
                            <h1 class="page-title">Profile</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW-1 OPEN -->
                        <div class="row" id="user-profile">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="wideget-user mb-2">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="row">
                                                        <div class="panel profile-cover">
                                                            <div class="profile-cover__action bg-img"></div>
                                                            <div class="profile-cover__img">
                                                                <div class="profile-img-1">
                                                                    <img src="<?= htmlspecialchars(
                                                                        $profilePictureUrl,
                                                                        ENT_QUOTES,
                                                                        "UTF-8",
                                                                    ) ?>" alt="img">
                                                                </div>
                                                            <div class="profile-img-content text-dark text-start">
                                                                <div class="text-dark">
                                                                    <h3 class="h3 mb-2"><?= htmlspecialchars(
                                                                        $profileData[
                                                                            "full_name"
                                                                        ] ??
                                                                            "Percy Kewshun",
                                                                    ) ?></h3>
                                                                    <h5 class="text-muted"><?= htmlspecialchars(
                                                                        $profileData[
                                                                            "job_title"
                                                                        ] ??
                                                                            "Web Developer",
                                                                    ) ?></h5>
                                                                    <p class="text-muted mb-0"><?= htmlspecialchars(
                                                                        ($profileData[
                                                                            "location"
                                                                        ] ??
                                                                            "") .
                                                                            ($profileData[
                                                                                "country"
                                                                            ] ??
                                                                            ""
                                                                                ? " · " .
                                                                                    $profileData[
                                                                                        "country"
                                                                                    ]
                                                                                : ""),
                                                                    ) ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="btn-profile">
                                                                <a href="<?= file_url(
                                                                    "edit-profile/edit-profile.php",
                                                                ) ?>" class="btn btn-primary mt-1 mb-1"> <i class="fe fe-edit"></i> <span>Edit Profile</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Personal Details</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table row table-borderless">
                                                        <tbody class="col-lg-12 col-xl-12 p-0">
                                                            <tr>
                                                                <td><strong>Full Name :</strong> <?= htmlspecialchars(
                                                                    $profileData[
                                                                        "full_name"
                                                                    ] ??
                                                                        "Percy Kewshun",
                                                                ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Location :</strong> <?= htmlspecialchars(
                                                                    ($profileData[
                                                                        "location"
                                                                    ] ??
                                                                        "") .
                                                                        ($profileData[
                                                                            "country"
                                                                        ] ?? ""
                                                                            ? ", " .
                                                                                $profileData[
                                                                                    "country"
                                                                                ]
                                                                            : ""),
                                                                ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Languages :</strong> <?= htmlspecialchars(
                                                                    $profileData[
                                                                        "languages"
                                                                    ] ??
                                                                        "English, German, Spanish",
                                                                ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Email :</strong> <?= htmlspecialchars(
                                                                    $profileData[
                                                                        "email"
                                                                    ] ??
                                                                        "georgeme@abc.com",
                                                                ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Phone :</strong> <?= htmlspecialchars(
                                                                    $profileData[
                                                                        "phone"
                                                                    ] ??
                                                                        "+125 254 3562",
                                                                ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Company :</strong> <?= htmlspecialchars(
                                                                    $profileData[
                                                                        "company"
                                                                    ] ??
                                                                        "BetaSoft LLC",
                                                                ) ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">About Me</div>
                                            </div>
                                            <div class="card-body">
                                                <p><?= nl2br(
                                                    htmlspecialchars(
                                                        $profileData["about"] ??
                                                            "Very well thought out and articulate description of my professional background and expertise. I have over 10 years of experience in web development, specializing in front-end technologies and modern frameworks.",
                                                    ),
                                                ) ?></p>
                                                <p><?= nl2br(
                                                    htmlspecialchars(
                                                        $profileData[
                                                            "experience"
                                                        ] ??
                                                            "My passion lies in creating intuitive and visually stunning user interfaces that provide exceptional user experiences.",
                                                    ),
                                                ) ?></p>
                                            </div>
                                        </div>
                                        <!--<div class="card">
                                            <div class="card-header">
                                                <div class="card-title">Recent Activity</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="activity">
                                                    <div class="activity-info">
                                                        <div class="icon-info-activity">
                                                            <i class="fe fe-check bg-primary-transparent text-primary"></i>
                                                        </div>
                                                        <div class="activity-info-text">
                                                            <div class="d-flex justify-content-between">
                                                                <p class="mb-1 text-dark fw-semibold">Task Completed</p>
                                                                <small class="text-muted">5 min ago</small>
                                                            </div>
                                                            <p class="text-muted fs-13">Finished the dashboard refactoring task.</p>
                                                        </div>
                                                    </div>
                                                    <div class="activity-info">
                                                        <div class="icon-info-activity">
                                                            <i class="fe fe-message-square bg-secondary-transparent text-secondary"></i>
                                                        </div>
                                                        <div class="activity-info-text">
                                                            <div class="d-flex justify-content-between">
                                                                <p class="mb-1 text-dark fw-semibold">New Comment</p>
                                                                <small class="text-muted">30 min ago</small>
                                                            </div>
                                                            <p class="text-muted fs-13">Peter Hill commented on your post.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ROW-1 CLOSED -->

                    </div>
                    <!-- CONTAINER CLOSED -->
                </div>
            </div>
            <!--app-content closed-->
        </div>

        <?php include LAYOUT_PATH . "/footer.php"; ?>
    </div>

    <!-- REQUIRED JS COMPONENTS -->
    <?php include LAYOUT_PATH . "/scripts.php"; ?>

</body>

</html>

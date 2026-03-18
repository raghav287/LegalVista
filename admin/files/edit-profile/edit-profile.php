<?php
require_once dirname(__DIR__, 2) . "/bootstrap.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";

$pageTitle = "Edit Profile";
$errors = [];
$passwordErrors = [];
$profileSaved = false;
$passwordUpdated = false;

$profileData = getProfileDetails();
$formValues = [
    "full_name" => $profileData["full_name"] ?? "",
    "job_title" => $profileData["job_title"] ?? "",
    "location" => $profileData["location"] ?? "",
    "country" => $profileData["country"] ?? "",
    "languages" => $profileData["languages"] ?? "",
    "email" => $profileData["email"] ?? "",
    "phone" => $profileData["phone"] ?? "",
    "about" => $profileData["about"] ?? "",
    "experience" => $profileData["experience"] ?? "",
    "company" => $profileData["company"] ?? "",
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mode = $_POST["mode"] ?? "";
    if ($mode === "profile") {
        $formValues = [
            "full_name" => trim($_POST["full_name"] ?? ""),
            "job_title" => trim($_POST["job_title"] ?? ""),
            "location" => trim($_POST["location"] ?? ""),
            "country" => trim($_POST["country"] ?? ""),
            "languages" => trim($_POST["languages"] ?? ""),
            "email" => trim($_POST["email"] ?? ""),
            "phone" => trim($_POST["phone"] ?? ""),
            "about" => trim($_POST["about"] ?? ""),
            "experience" => trim($_POST["experience"] ?? ""),
            "company" => trim($_POST["company"] ?? ""),
        ];

        foreach (
            ["full_name" => "Full name", "job_title" => "Job title"]
            as $key => $label
        ) {
            if ($formValues[$key] === "") {
                $errors[] = "{$label} is required.";
            }
        }

        if (empty($errors)) {
            if (saveProfileDetails($formValues)) {
                $profileSaved = true;
                $profileData = getProfileDetails();
                $formValues = [
                    "full_name" => $profileData["full_name"] ?? "",
                    "job_title" => $profileData["job_title"] ?? "",
                    "location" => $profileData["location"] ?? "",
                    "country" => $profileData["country"] ?? "",
                    "languages" => $profileData["languages"] ?? "",
                    "email" => $profileData["email"] ?? "",
                    "phone" => $profileData["phone"] ?? "",
                    "about" => $profileData["about"] ?? "",
                    "experience" => $profileData["experience"] ?? "",
                    "company" => $profileData["company"] ?? "",
                ];
            } else {
                $errors[] = "Unable to save profile changes right now.";
            }
        }
    } elseif ($mode === "password") {
        $currentPassword = $_POST["current_password"] ?? "";
        $newPassword = $_POST["new_password"] ?? "";
        $confirmPassword = $_POST["confirm_password"] ?? "";

        if ($currentPassword === "") {
            $passwordErrors[] = "Current password is required.";
        }
        if ($newPassword === "") {
            $passwordErrors[] = "New password is required.";
        }
        if ($confirmPassword === "") {
            $passwordErrors[] = "Confirm password is required.";
        }
        if (
            $newPassword !== "" &&
            $confirmPassword !== "" &&
            $newPassword !== $confirmPassword
        ) {
            $passwordErrors[] = "New password and confirmation must match.";
        }

        if (empty($passwordErrors)) {
            $adminId = $_SESSION["admin_id"] ?? null;
            if (
                $adminId === null ||
                !updateAdminPassword(
                    (int) $adminId,
                    $currentPassword,
                    $newPassword,
                )
            ) {
                $passwordErrors[] =
                    "Current password is incorrect or cannot be updated.";
            } else {
                $passwordUpdated = true;
            }
        }
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
                            <h1 class="page-title">Edit Profile</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW-1 OPEN -->
                        <div class="row">
                            <div class="col-xl-4">
                                <form method="post" action="<?= htmlspecialchars(
                                    $_SERVER["PHP_SELF"],
                                ) ?>">
                                    <input type="hidden" name="mode" value="password">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Edit Password</div>
                                        </div>
                                        <div class="card-body">
                                            <?php if ($passwordUpdated): ?>
                                                <div class="alert alert-success mb-3">
                                                    Password updated successfully.
                                                </div>
                                            <?php elseif (
                                                !empty($passwordErrors)
                                            ): ?>
                                                <div class="alert alert-danger mb-3">
                                                    <?php foreach (
                                                        $passwordErrors
                                                        as $error
                                                    ): ?>
                                                        <div><?= htmlspecialchars(
                                                            $error,
                                                        ) ?></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="text-center chat-image mb-5">
                                                <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                                    <a class="" href="<?= file_url(
                                                        "profile/profile.php",
                                                    ) ?>"><img alt="avatar" src="<?= asset_url(
    "images/users/21.jpg",
) ?>" class="brround"></a>
                                                </div>
                                                <div class="main-chat-msg-name">
                                                    <a href="<?= file_url(
                                                        "profile/profile.php",
                                                    ) ?>">
                                                        <h5 class="mb-1 text-dark fw-semibold"><?= htmlspecialchars(
                                                            $formValues[
                                                                "full_name"
                                                            ],
                                                        ) ?></h5>
                                                    </a>
                                                    <p class="text-muted mt-0 mb-0 pt-0 fs-13"><?= htmlspecialchars(
                                                        $formValues[
                                                            "job_title"
                                                        ],
                                                    ) ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Current Password</label>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted password-toggle" data-password-target="#currentPassword">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                    <input id="currentPassword" class="input100 form-control" type="password" name="current_password" placeholder="Current Password" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">New Password</label>
                                                <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted password-toggle" data-password-target="#newPassword">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                    <input id="newPassword" class="input100 form-control" type="password" name="new_password" placeholder="New Password" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Confirm Password</label>
                                                <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted password-toggle" data-password-target="#confirmPassword">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                    <input id="confirmPassword" class="input100 form-control" type="password" name="confirm_password" placeholder="Confirm Password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            <button class="btn btn-primary" type="submit">Update Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xl-8">
                                <form method="post" action="<?= htmlspecialchars(
                                    $_SERVER["PHP_SELF"],
                                ) ?>">
                                    <input type="hidden" name="mode" value="profile">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Edit Profile Information</h3>
                                        </div>
                                        <div class="card-body">
                                            <?php if ($profileSaved): ?>
                                                <div class="alert alert-success mb-4">
                                                    Profile updated successfully.
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($errors)): ?>
                                                <div class="alert alert-danger mb-4">
                                                    <?php foreach (
                                                        $errors
                                                        as $error
                                                    ): ?>
                                                        <div><?= htmlspecialchars(
                                                            $error,
                                                        ) ?></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="fullName">Full Name</label>
                                                        <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Full Name" value="<?= htmlspecialchars(
                                                            $formValues[
                                                                "full_name"
                                                            ],
                                                        ) ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="jobTitle">Job Title</label>
                                                        <input type="text" class="form-control" id="jobTitle" name="job_title" placeholder="Job Title" value="<?= htmlspecialchars(
                                                            $formValues[
                                                                "job_title"
                                                            ],
                                                        ) ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email address</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= htmlspecialchars(
                                                            $formValues[
                                                                "email"
                                                            ],
                                                        ) ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">Contact Number</label>
                                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact number" value="<?= htmlspecialchars(
                                                            $formValues[
                                                                "phone"
                                                            ],
                                                        ) ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Location</label>
                                                        <input class="form-control" name="location" placeholder="Location" value="<?= htmlspecialchars(
                                                            $formValues[
                                                                "location"
                                                            ],
                                                        ) ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Country</label>
                                                        <input class="form-control" name="country" placeholder="Country" value="<?= htmlspecialchars(
                                                            $formValues[
                                                                "country"
                                                            ],
                                                        ) ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Languages</label>
                                                <input class="form-control" name="languages" placeholder="Languages (comma separated)" value="<?= htmlspecialchars(
                                                    $formValues["languages"],
                                                ) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Company</label>
                                                <input class="form-control" name="company" placeholder="Company" value="<?= htmlspecialchars(
                                                    $formValues["company"],
                                                ) ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">About Me</label>
                                                <textarea class="form-control" name="about" rows="4" placeholder="Tell us about yourself"><?= htmlspecialchars(
                                                    $formValues["about"],
                                                ) ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Experience</label>
                                                <textarea class="form-control" name="experience" rows="4" placeholder="Describe your experience"><?= htmlspecialchars(
                                                    $formValues["experience"],
                                                ) ?></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                            <a href="<?= file_url(
                                                "profile/profile.php",
                                            ) ?>" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </form>
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

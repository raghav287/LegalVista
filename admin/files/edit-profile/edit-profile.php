<?php
require_once dirname(__DIR__, 2) . "/bootstrap.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";

if (!function_exists("handleAdminProfileImageUpload")) {
    function handleAdminProfileImageUpload(array $file): array
    {
        $maxSize = 2 * 1024 * 1024;

        if ($file["error"] !== UPLOAD_ERR_OK) {
            return [
                "success" => false,
                "error" => "Profile picture upload failed (code {$file["error"]}).",
            ];
        }

        if (!is_uploaded_file($file["tmp_name"])) {
            return [
                "success" => false,
                "error" => "The uploaded profile picture is invalid.",
            ];
        }

        if ($file["size"] > $maxSize) {
            return [
                "success" => false,
                "error" => "Profile picture must be 2 MB or less.",
            ];
        }

        $allowed = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/gif" => "gif",
        ];

        $mimeType = null;
        if (function_exists("finfo_open")) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            if ($finfo !== false) {
                $mimeType = finfo_file($finfo, $file["tmp_name"]);
                finfo_close($finfo);
            }
        }

        if ($mimeType === null && function_exists("mime_content_type")) {
            $mimeType = mime_content_type($file["tmp_name"]);
        }

        $extension =
            $mimeType !== null && isset($allowed[$mimeType])
                ? $allowed[$mimeType]
                : null;

        if ($extension === null) {
            $legacyExtension = strtolower(
                pathinfo($file["name"], PATHINFO_EXTENSION),
            );
            if ($legacyExtension === "jpeg") {
                $legacyExtension = "jpg";
            }
            if (
                $legacyExtension === "jpg" ||
                $legacyExtension === "png" ||
                $legacyExtension === "gif"
            ) {
                $extension = $legacyExtension;
            }
        }

        if ($extension === null) {
            return [
                "success" => false,
                "error" =>
                    "Only JPG, PNG, and GIF files are allowed for the profile picture.",
            ];
        }

        $uploadDir = APP_ROOT . "/assets/images/users";
        if (!is_dir($uploadDir)) {
            return [
                "success" => false,
                "error" =>
                    "Profile image directory is missing. Please check admin/assets/images/users.",
            ];
        }

        $filename = sprintf("%s.%s", uniqid("profile_", true), $extension);
        $targetPath = $uploadDir . "/" . $filename;

        if (!move_uploaded_file($file["tmp_name"], $targetPath)) {
            return [
                "success" => false,
                "error" => "Unable to save the uploaded profile picture.",
            ];
        }

        return [
            "success" => true,
            "relative_path" => "images/users/{$filename}",
        ];
    }
}

$pageTitle = "Edit Profile";
$errors = [];
$passwordErrors = [];
$profileSaved = false;
$passwordUpdated = false;

$adminId = (int) ($_SESSION["admin_id"] ?? 0);
$adminAccount = getAdminUser($adminId) ?? [];
$formValues = [
    "username" => $adminAccount["username"] ?? "",
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mode = $_POST["mode"] ?? "";
    if ($mode === "profile") {
        $formValues["username"] = trim($_POST["username"] ?? "");
        $profilePictureRelative = null;

        if ($formValues["username"] === "") {
            $errors[] = "Username is required.";
        }

        if (
            isset($_FILES["profile_picture"]) &&
            is_array($_FILES["profile_picture"]) &&
            $_FILES["profile_picture"]["error"] !== UPLOAD_ERR_NO_FILE
        ) {
            $uploadResult = handleAdminProfileImageUpload(
                $_FILES["profile_picture"],
            );
            if (!$uploadResult["success"]) {
                $errors[] = $uploadResult["error"];
            } else {
                $profilePictureRelative = $uploadResult["relative_path"];
            }
        }

        if (empty($errors)) {
            $adminEmail =
                $adminAccount["email"] ?? ($_SESSION["admin_email"] ?? "");
            if ($adminEmail === "") {
                $errors[] = "Unable to resolve the current email address.";
            } else {
                $adminUpdated = updateAdminAccount(
                    $adminId,
                    $formValues["username"],
                    $adminEmail,
                    $profilePictureRelative,
                );
                if ($adminUpdated) {
                    $profileSaved = true;
                    $_SESSION["admin_username"] = $formValues["username"];
                    if ($profilePictureRelative !== null) {
                        $_SESSION[
                            "admin_profile_picture"
                        ] = $profilePictureRelative;
                    }
                    $adminAccount = getAdminUser($adminId) ?? [];
                    $formValues["username"] = $adminAccount["username"] ?? "";
                } else {
                    $errors[] = "Unable to update profile details right now.";
                }
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
                                                    <img alt="avatar" src="<?= htmlspecialchars(
                                                        $profilePictureUrl,
                                                        ENT_QUOTES,
                                                        "UTF-8",
                                                    ) ?>" class="brround"></a>
                                                </div>
                                                <div class="main-chat-msg-name">
                                                    <a href="<?= file_url(
                                                        "profile/profile.php",
                                                    ) ?>">
                                                        <h5 class="mb-1 text-dark fw-semibold"><?= htmlspecialchars(
                                                            $adminAccount[
                                                                "username"
                                                            ] ?? "Admin User",
                                                        ) ?></h5>
                                                    </a>
                                                    <p class="text-muted mt-0 mb-0 pt-0 fs-13"><?= htmlspecialchars(
                                                        $adminAccount[
                                                            "email"
                                                        ] ?? "",
                                                    ) ?></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Current Password</label>
                                                <div class="wrap-input100 validate-input input-group"
                                                    id="Password-toggle">
                                                    <a href="javascript:void(0)"
                                                        class="input-group-text bg-white text-muted password-toggle"
                                                        data-password-target="#currentPassword">
                                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input id="currentPassword" class="input100 form-control"
                                                        type="password" name="current_password"
                                                        placeholder="Current Password" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">New Password</label>
                                                <div class="wrap-input100 validate-input input-group"
                                                    id="Password-toggle1">
                                                    <a href="javascript:void(0)"
                                                        class="input-group-text bg-white text-muted password-toggle"
                                                        data-password-target="#newPassword">
                                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input id="newPassword" class="input100 form-control"
                                                        type="password" name="new_password" placeholder="New Password"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Confirm Password</label>
                                                <div class="wrap-input100 validate-input input-group"
                                                    id="Password-toggle2">
                                                    <a href="javascript:void(0)"
                                                        class="input-group-text bg-white text-muted password-toggle"
                                                        data-password-target="#confirmPassword">
                                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input id="confirmPassword" class="input100 form-control"
                                                        type="password" name="confirm_password"
                                                        placeholder="Confirm Password" required>
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
                                ) ?>" enctype="multipart/form-data">
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
                                                            ENT_QUOTES,
                                                            "UTF-8",
                                                        ) ?></div>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php endif; ?>

                                            <div class="form-group">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" name="username" value="<?= htmlspecialchars(
                                                    $formValues["username"],
                                                    ENT_QUOTES,
                                                    "UTF-8",
                                                ) ?>" required>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label class="form-label mt-0">Profile picture</label>
                                                <input type="file" class="form-control" name="profile_picture"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                            <!--<a href="" class="btn btn-danger">Cancel</a>-->
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

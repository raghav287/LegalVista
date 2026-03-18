<?php
require_once __DIR__ . "/bootstrap.php";
require_once APP_ROOT . "/app/auth.php";

if (isAdminLoggedIn()) {
    header("Location: " . file_url("dashboard/dashboard.php"));
    exit();
}

header("Location: " . file_url("login/login.php"));
exit();

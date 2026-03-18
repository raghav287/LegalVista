<?php
require_once __DIR__ . "/bootstrap.php";
require_once APP_ROOT . "/app/auth.php";

requireAdminLogin();
header("Location: " . file_url("dashboard/dashboard.php"));
exit();

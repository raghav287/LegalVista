<?php
require_once dirname(__DIR__, 2) . "/bootstrap.php";
require_once APP_ROOT . "/app/auth.php";
requireAdminLogin();
require_once APP_ROOT . "/app/module-data.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . file_url("packages/list.php"));
    exit();
}

$packageId = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
if ($packageId === null || $packageId <= 0) {
    header("Location: " . file_url("packages/list.php") . "?deleted=0");
    exit();
}

$deleted = deleteHomepagePackage($packageId);
header("Location: " . file_url("packages/list.php") . "?deleted=" . ($deleted ? "1" : "0"));
exit();

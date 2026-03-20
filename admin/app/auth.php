<?php
declare(strict_types=1);

require_once APP_ROOT . "/config/database.php";

/**
 * Ensure session is always started before using auth helpers.
 */
function ensureAuthSession(): void
{
    if (session_status() !== PHP_SESSION_NONE) {
        return;
    }

    ini_set("session.cookie_httponly", "1");
    ini_set("session.use_only_cookies", "1");
    ini_set("session.cookie_samesite", "Lax");
    ini_set("session.cookie_path", "/");
    session_start();
}

function isAdminLoggedIn(): bool
{
    ensureAuthSession();
    return !empty($_SESSION["admin_id"]) && !empty($_SESSION["admin_username"]);
}

function requireAdminLogin(): void
{
    if (!isAdminLoggedIn()) {
        header("Location: " . file_url("login/login.php"));
        exit();
    }
}

function attemptAdminLogin(string $email, string $password): bool
{
    $connection = getSashDBConnection();
    if ($connection === null) {
        return false;
    }

    $stmt = $connection->prepare(
        "SELECT id, username, password FROM admin_users WHERE email = ? LIMIT 1",
    );
    if ($stmt === false) {
        error_log("Auth prepare failed: {$connection->error}");
        $connection->close();
        return false;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $dbUsername, $hashedPassword);
    $found = $stmt->fetch();
    $stmt->close();
    $connection->close();

    if (!$found || $hashedPassword === null) {
        return false;
    }

    if (!password_verify($password, $hashedPassword)) {
        return false;
    }

    ensureAuthSession();
    session_regenerate_id(true);
    $_SESSION["admin_id"] = $id;
    $_SESSION["admin_username"] = $dbUsername;

    return true;
}

function updateAdminPassword(
    int $adminId,
    string $currentPassword,
    string $newPassword,
): bool {
    if ($adminId <= 0) {
        return false;
    }

    $connection = getSashDBConnection();
    if ($connection === null) {
        return false;
    }

    $stmt = null;
    $updateStmt = null;

    try {
        $stmt = $connection->prepare(
            "SELECT password FROM admin_users WHERE id = ? LIMIT 1",
        );
        if ($stmt === false) {
            error_log("Password lookup failed: {$connection->error}");
            return false;
        }
        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $found = $stmt->fetch();
        $stmt->close();
        $stmt = null;

        if (!$found || $hashedPassword === null) {
            return false;
        }

        if (!password_verify($currentPassword, $hashedPassword)) {
            return false;
        }

        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateStmt = $connection->prepare(
            "UPDATE admin_users SET password = ? WHERE id = ?",
        );
        if ($updateStmt === false) {
            error_log("Password update prepare failed: {$connection->error}");
            return false;
        }
        $updateStmt->bind_param("si", $newHash, $adminId);
        $updateStmt->execute();
        $success = $updateStmt->affected_rows > 0;
        return $success;
    } catch (\mysqli_sql_exception $e) {
        error_log("Password update failed: {$e->getMessage()}");
        return false;
    } finally {
        if ($stmt !== null) {
            $stmt->close();
        }
        if ($updateStmt !== null) {
            $updateStmt->close();
        }
        $connection->close();
    }
}

function logoutAdmin(): void
{
    ensureAuthSession();
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            "",
            time() - 42000,
            $params["path"] ?? "/",
            $params["domain"] ?? "",
            $params["secure"] ?? false,
            $params["httponly"] ?? true,
        );
    }

    session_destroy();
    header("Location: " . file_url("login/login.php"));
    exit();
}

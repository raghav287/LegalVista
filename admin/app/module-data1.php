<?php
declare(strict_types=1);

require_once APP_ROOT . "/config/database.php";

/**
 * Lazily reuses the shared module connection so multiple helpers can run without extra opens.
 */
function getModuleConnection(): ?\mysqli
{
    static $connection = null;
    static $tried = false;

    if ($connection !== null) {
        return $connection;
    }

    if ($tried) {
        return null;
    }
    $tried = true;

    try {
        $connection = getSashDBConnection();
    } catch (\mysqli_sql_exception $e) {
        error_log("Module DB connection failed: {$e->getMessage()}");
        $connection = null;
        return null;
    }

    register_shutdown_function(function () use (&$connection) {
        if ($connection !== null) {
            $connection->close();
            $connection = null;
        }
    });

    return $connection;
}

function tryFetchRows(?\mysqli $connection, string $sql): array
{
    $rows = [];
    if ($connection === null) {
        return $rows;
    }
    try {
        if ($result = $connection->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $result->free();
        }
    } catch (\mysqli_sql_exception $e) {
        error_log("Query failed: {$e->getMessage()}");
    }
    return $rows;
}

function getListingItems(): array
{
    $rows = tryFetchRows(
        getModuleConnection(),
        "SELECT id, name, email, service, message, created_at FROM contact_enquiries ORDER BY id DESC",
    );
    return $rows !== [] ? $rows : getListingItemsFallback();
}

function getListingItemsFallback(): array
{
    return [
        [
            "id" => 1,
            "name" => "John Doe",
            "email" => "john@example.com",
            "service" => "Company Registration Packages",
            "message" => "Need help with company setup in Georgia.",
            "created_at" => "2026-03-19 10:00:00",
        ],
        [
            "id" => 2,
            "name" => "Jane Smith",
            "email" => "jane@example.com",
            "service" => "Accounting & Taxation",
            "message" => "Looking for monthly accounting support.",
            "created_at" => "2026-03-19 10:30:00",
        ],
        [
            "id" => 3,
            "name" => "Alex Brown",
            "email" => "alex@example.com",
            "service" => "Resident Permit",
            "message" => "Please guide me on residence permit options.",
            "created_at" => "2026-03-19 11:00:00",
        ],
    ];
}

function getListingItemById(int $id): ?array
{
    $connection = getModuleConnection();
    if ($connection === null) {
        return null;
    }

    try {
        $stmt = $connection->prepare(
            "SELECT id, name, email, service, message, created_at FROM contact_enquiries WHERE id = ? LIMIT 1",
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    } catch (\mysqli_sql_exception $e) {
        error_log("Listing fetch failed: {$e->getMessage()}");
        return null;
    }
}

function saveListingItem(array $data): ?int
{
    $connection = getModuleConnection();
    if ($connection === null) {
        return null;
    }

    $id = !empty($data["id"]) ? (int) $data["id"] : null;
    $name = $data["name"] ?? "";
    $email = $data["email"] ?? "";
    $service = $data["service"] ?? "";
    $message = $data["message"] ?? "";

    try {
        if ($id) {
            $stmt = $connection->prepare(
                "UPDATE contact_enquiries SET name = ?, email = ?, service = ?, message = ? WHERE id = ?",
            );
            $stmt->bind_param(
                "ssssi",
                $name,
                $email,
                $service,
                $message,
                $id,
            );
            $stmt->execute();
            $stmt->close();
            return $id;
        }

        $stmt = $connection->prepare(
            "INSERT INTO contact_enquiries (name, email, service, message) VALUES (?, ?, ?, ?)",
        );
        $stmt->bind_param("ssss", $name, $email, $service, $message);
        $stmt->execute();
        $newId = $stmt->insert_id;
        $stmt->close();
        return $newId ?: null;
    } catch (\mysqli_sql_exception $e) {
        error_log("Saving listing failed: {$e->getMessage()}");
        return null;
    }
}

function deleteListingItem(int $id): bool
{
    $connection = getModuleConnection();
    if ($connection === null) {
        return false;
    }

    try {
        $stmt = $connection->prepare("DELETE FROM contact_enquiries WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $affected = $stmt->affected_rows;
        $stmt->close();
        return $affected > 0;
    } catch (\mysqli_sql_exception $e) {
        error_log("Listing delete failed: {$e->getMessage()}");
        return false;
    }
}

function getProfileRow(): ?array
{
    $connection = getModuleConnection();
    if ($connection === null) {
        return null;
    }

    $query =
        "SELECT id, full_name, job_title, location, country, languages, email, phone, about, experience, company FROM profiles ORDER BY id DESC LIMIT 1";
    if ($result = $connection->query($query)) {
        $row = $result->fetch_assoc();
        $result->free();
        return $row ?: null;
    }

    return null;
}

function getProfileDetails(): array
{
    $row = getProfileRow();
    if ($row !== null) {
        unset($row["id"]);
        return $row;
    }
    return getProfileFallback();
}

function getProfileFallback(): array
{
    return [
        "full_name" => "Percy Kewshun",
        "job_title" => "Web Developer",
        "location" => "San Francisco, CA",
        "country" => "USA",
        "languages" => "English, German, Spanish",
        "email" => "georgeme@abc.com",
        "phone" => "+125 254 3562",
        "about" =>
            "Very well thought out and articulate description of my professional background and expertise. I have over 10 years of experience in web development, specializing in front-end technologies and modern frameworks.",
        "experience" =>
            "My passion lies in creating intuitive and visually stunning user interfaces that provide exceptional user experiences.",
        "company" => "BetaSoft LLC",
    ];
}

function saveProfileDetails(array $data): bool
{
    $connection = getModuleConnection();
    if ($connection === null) {
        return false;
    }

    $fullName = trim($data["full_name"] ?? "");
    $jobTitle = trim($data["job_title"] ?? "");
    $location = trim($data["location"] ?? "");
    $country = trim($data["country"] ?? "");
    $languages = trim($data["languages"] ?? "");
    $email = trim($data["email"] ?? "");
    $phone = trim($data["phone"] ?? "");
    $about = trim($data["about"] ?? "");
    $experience = trim($data["experience"] ?? "");
    $company = trim($data["company"] ?? "");

    $row = getProfileRow();

    try {
        if ($row !== null && isset($row["id"])) {
            $stmt = $connection->prepare(
                "UPDATE profiles SET full_name = ?, job_title = ?, location = ?, country = ?, languages = ?, email = ?, phone = ?, about = ?, experience = ?, company = ? WHERE id = ?",
            );
            $stmt->bind_param(
                "ssssssssssi",
                $fullName,
                $jobTitle,
                $location,
                $country,
                $languages,
                $email,
                $phone,
                $about,
                $experience,
                $company,
                $row["id"],
            );
        } else {
            $stmt = $connection->prepare(
                "INSERT INTO profiles (full_name, job_title, location, country, languages, email, phone, about, experience, company) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            );
            $stmt->bind_param(
                "ssssssssss",
                $fullName,
                $jobTitle,
                $location,
                $country,
                $languages,
                $email,
                $phone,
                $about,
                $experience,
                $company,
            );
        }

        $stmt->execute();
        $stmt->close();
        return true;
    } catch (\mysqli_sql_exception $e) {
        error_log("Profile save failed: {$e->getMessage()}");
        return false;
    }
}

function getDashboardMetrics(): array
{
    $rows = tryFetchRows(
        getModuleConnection(),
        "SELECT metric_label, metric_value, trend_direction, trend_value, trend_period FROM dashboard_metrics ORDER BY id",
    );
    return $rows !== [] ? $rows : getDashboardMetricsFallback();
}

function getDashboardMetricsFallback(): array
{
    return [
        [
            "metric_label" => "Total Users",
            "metric_value" => "44,278",
            "trend_direction" => "up",
            "trend_value" => "5%",
            "trend_period" => "Last week",
        ],
        [
            "metric_label" => "Total Profit",
            "metric_value" => '$67,987',
            "trend_direction" => "down",
            "trend_value" => "0.75%",
            "trend_period" => "Last 6 days",
        ],
        [
            "metric_label" => "Total Expenses",
            "metric_value" => '$76,965',
            "trend_direction" => "up",
            "trend_value" => "0.9%",
            "trend_period" => "Last 9 days",
        ],
        [
            "metric_label" => "Total Cost",
            "metric_value" => '$59,765',
            "trend_direction" => "up",
            "trend_value" => "0.6%",
            "trend_period" => "Last year",
        ],
    ];
}

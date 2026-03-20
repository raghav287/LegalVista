<?php
declare(strict_types=1);

require_once APP_ROOT . "/config/database.php";

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

function adminUsersHasProfilePictureColumn(?\mysqli $connection = null): bool
{
    static $hasColumn = null;

    if ($hasColumn !== null) {
        return $hasColumn;
    }

    $connection = $connection ?? getModuleConnection();
    if ($connection === null) {
        $hasColumn = false;
        return $hasColumn;
    }

    try {
        $result = $connection->query("SHOW COLUMNS FROM admin_users LIKE 'profile_picture'");
        $hasColumn = $result !== false && $result->num_rows > 0;
        if ($result !== false) {
            $result->free();
        }
    } catch (\mysqli_sql_exception $e) {
        error_log("Admin users column lookup failed: {$e->getMessage()}");
        $hasColumn = false;
    }

    return $hasColumn;
}

function getAdminUser(int $adminId): ?array
{
    if ($adminId <= 0) {
        return null;
    }

    $connection = getModuleConnection();
    if ($connection === null) {
        return null;
    }

    $selectProfilePicture = adminUsersHasProfilePictureColumn($connection)
        ? "profile_picture"
        : "NULL AS profile_picture";

    try {
        $stmt = $connection->prepare(
            "SELECT id, username, email, {$selectProfilePicture} FROM admin_users WHERE id = ? LIMIT 1",
        );
        if ($stmt === false) {
            return null;
        }

        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row ?: null;
    } catch (\mysqli_sql_exception $e) {
        error_log("Admin user fetch failed: {$e->getMessage()}");
        return null;
    }
}

function updateAdminAccount(
    int $adminId,
    string $username,
    string $email,
    ?string $profilePictureRelative = null,
): bool {
    if ($adminId <= 0) {
        return false;
    }

    $connection = getModuleConnection();
    if ($connection === null) {
        return false;
    }

    $username = trim($username);
    $email = trim($email);

    if ($username === "" || $email === "") {
        return false;
    }

    try {
        if (adminUsersHasProfilePictureColumn($connection) && $profilePictureRelative !== null) {
            $stmt = $connection->prepare(
                "UPDATE admin_users SET username = ?, email = ?, profile_picture = ? WHERE id = ?",
            );
            if ($stmt === false) {
                return false;
            }
            $stmt->bind_param(
                "sssi",
                $username,
                $email,
                $profilePictureRelative,
                $adminId,
            );
        } else {
            $stmt = $connection->prepare(
                "UPDATE admin_users SET username = ?, email = ? WHERE id = ?",
            );
            if ($stmt === false) {
                return false;
            }
            $stmt->bind_param("ssi", $username, $email, $adminId);
        }

        $stmt->execute();
        $stmt->close();
        return true;
    } catch (\mysqli_sql_exception $e) {
        error_log("Admin account update failed: {$e->getMessage()}");
        return false;
    }
}

function getHomepagePackages(): array
{
    $rows = tryFetchRows(
        getModuleConnection(),
        "SELECT id, package_name, price_eur, services_text, button_url, is_featured, badge_text, sort_order FROM homepage_packages ORDER BY sort_order ASC, id ASC",
    );

    return $rows !== [] ? $rows : getHomepagePackagesFallback();
}

function getHomepagePackagesFallback(): array
{
    return [
        [
            "id" => 1,
            "package_name" => "Bronze",
            "price_eur" => "499",
            "services_text" => "Limited Liability Company (LLC) Registration in 24 Hours\nCertificate of Incorporation\nLegal Address for 1 year\nAll Govt. Fees & Charges",
            "button_url" => "company-registration.php",
            "is_featured" => "0",
            "badge_text" => "",
            "sort_order" => 1,
        ],
        [
            "id" => 2,
            "package_name" => "Silver",
            "price_eur" => "799",
            "services_text" => "Limited Liability Company (LLC) Registration in 24 Hours\nCertificate of Incorporation\nLegal Address for 1 year\nAll Govt. Fees & Charges\nRegistration of Company with Georgian Revenue Service",
            "button_url" => "company-registration.php",
            "is_featured" => "1",
            "badge_text" => "Most Popular",
            "sort_order" => 2,
        ],
        [
            "id" => 3,
            "package_name" => "Gold",
            "price_eur" => "1199",
            "services_text" => "Limited Liability Company (LLC) Registration in 24 Hours\nCertificate of Incorporation\nLegal Address for 1 year\nAll Govt. Fees & Charges\nRegistration of Company with Georgian Revenue Service\nVAT Registration\nCorporate Bank Account",
            "button_url" => "company-registration.php",
            "is_featured" => "0",
            "badge_text" => "",
            "sort_order" => 3,
        ],
        [
            "id" => 4,
            "package_name" => "Platinum",
            "price_eur" => "1599",
            "services_text" => "Limited Liability Company (LLC) Registration in 24 Hours\nCertificate of Incorporation\nLegal Address for 1 year\nAll Govt. Fees & Charges\nRegistration of Company with Georgian Revenue Service\nVAT Registration\nCorporate Bank Account\nMonthly Tax Filing for 1 year",
            "button_url" => "company-registration.php",
            "is_featured" => "0",
            "badge_text" => "",
            "sort_order" => 4,
        ],
    ];
}

function getHomepagePackageById(int $id): ?array
{
    if ($id <= 0) {
        return null;
    }

    $connection = getModuleConnection();
    if ($connection === null) {
        return null;
    }

    try {
        $stmt = $connection->prepare(
            "SELECT id, package_name, price_eur, services_text, button_url, is_featured, badge_text, sort_order FROM homepage_packages WHERE id = ? LIMIT 1",
        );
        if ($stmt === false) {
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    } catch (\mysqli_sql_exception $e) {
        error_log("Homepage package fetch failed: {$e->getMessage()}");
        return null;
    }
}

function saveHomepagePackage(array $data): ?int
{
    $connection = getModuleConnection();
    if ($connection === null) {
        return null;
    }

    $id = !empty($data["id"]) ? (int) $data["id"] : null;
    $packageName = trim((string) ($data["package_name"] ?? ""));
    $priceEur = trim((string) ($data["price_eur"] ?? ""));
    $servicesText = trim((string) ($data["services_text"] ?? ""));
    $buttonUrl = trim((string) ($data["button_url"] ?? ""));
    $isFeatured = !empty($data["is_featured"]) ? 1 : 0;
    $badgeText = trim((string) ($data["badge_text"] ?? ""));
    $sortOrder = isset($data["sort_order"]) ? (int) $data["sort_order"] : 0;

    try {
        if ($id) {
            $stmt = $connection->prepare(
                "UPDATE homepage_packages SET package_name = ?, price_eur = ?, services_text = ?, button_url = ?, is_featured = ?, badge_text = ?, sort_order = ? WHERE id = ?",
            );
            if ($stmt === false) {
                return null;
            }
            $stmt->bind_param(
                "ssssisii",
                $packageName,
                $priceEur,
                $servicesText,
                $buttonUrl,
                $isFeatured,
                $badgeText,
                $sortOrder,
                $id,
            );
            $stmt->execute();
            $stmt->close();
            return $id;
        }

        $stmt = $connection->prepare(
            "INSERT INTO homepage_packages (package_name, price_eur, services_text, button_url, is_featured, badge_text, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)",
        );
        if ($stmt === false) {
            return null;
        }
        $stmt->bind_param(
            "ssssisi",
            $packageName,
            $priceEur,
            $servicesText,
            $buttonUrl,
            $isFeatured,
            $badgeText,
            $sortOrder,
        );
        $stmt->execute();
        $newId = $stmt->insert_id;
        $stmt->close();
        return $newId ?: null;
    } catch (\mysqli_sql_exception $e) {
        error_log("Homepage package save failed: {$e->getMessage()}");
        return null;
    }
}

function deleteHomepagePackage(int $id): bool
{
    if ($id <= 0) {
        return false;
    }

    $connection = getModuleConnection();
    if ($connection === null) {
        return false;
    }

    try {
        $stmt = $connection->prepare("DELETE FROM homepage_packages WHERE id = ?");
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $affected = $stmt->affected_rows;
        $stmt->close();
        return $affected > 0;
    } catch (\mysqli_sql_exception $e) {
        error_log("Homepage package delete failed: {$e->getMessage()}");
        return false;
    }
}

function getListingItems(): array
{
    $connection = getModuleConnection();
    $statusSelect = contactEnquiriesHasStatusColumn($connection)
        ? "status"
        : "'New' AS status";

    $rows = tryFetchRows(
        $connection,
        "SELECT id, name, email, service, message, {$statusSelect}, created_at FROM contact_enquiries ORDER BY id DESC",
    );
    return $rows !== [] ? $rows : getListingItemsFallback();
}

function getLeadStatusOptions(): array
{
    return ["New", "Contacted", "Qualified", "Closed"];
}

function normalizeLeadStatus(?string $status): string
{
    $status = trim((string) $status);
    $validStatuses = getLeadStatusOptions();

    if ($status === "" || !in_array($status, $validStatuses, true)) {
        return "New";
    }

    return $status;
}

function contactEnquiriesHasStatusColumn(?\mysqli $connection = null): bool
{
    static $hasColumn = null;

    if ($hasColumn !== null) {
        return $hasColumn;
    }

    $connection = $connection ?? getModuleConnection();
    if ($connection === null) {
        $hasColumn = false;
        return $hasColumn;
    }

    try {
        $result = $connection->query("SHOW COLUMNS FROM contact_enquiries LIKE 'status'");
        $hasColumn = $result !== false && $result->num_rows > 0;
        if ($result !== false) {
            $result->free();
        }

        if ($hasColumn === false) {
            $connection->query(
                "ALTER TABLE contact_enquiries ADD COLUMN status VARCHAR(50) NOT NULL DEFAULT 'New' AFTER message",
            );
            $hasColumn = true;
        }
    } catch (\mysqli_sql_exception $e) {
        error_log("Lead status column lookup failed: {$e->getMessage()}");
        $hasColumn = false;
    }

    return $hasColumn;
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
            "status" => "New",
            "created_at" => "2026-03-19 10:00:00",
        ],
        [
            "id" => 2,
            "name" => "Jane Smith",
            "email" => "jane@example.com",
            "service" => "Accounting & Taxation",
            "message" => "Looking for monthly accounting support.",
            "status" => "Contacted",
            "created_at" => "2026-03-19 10:30:00",
        ],
        [
            "id" => 3,
            "name" => "Alex Brown",
            "email" => "alex@example.com",
            "service" => "Resident Permit",
            "message" => "Please guide me on residence permit options.",
            "status" => "Qualified",
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

    $statusSelect = contactEnquiriesHasStatusColumn($connection)
        ? "status"
        : "'New' AS status";

    try {
        $stmt = $connection->prepare(
            "SELECT id, name, email, service, message, {$statusSelect}, created_at FROM contact_enquiries WHERE id = ? LIMIT 1",
        );
        if ($stmt === false) {
            return null;
        }
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
    $status = normalizeLeadStatus($data["status"] ?? "New");
    $hasStatusColumn = contactEnquiriesHasStatusColumn($connection);

    try {
        if ($id) {
            $query = $hasStatusColumn
                ? "UPDATE contact_enquiries SET name = ?, email = ?, service = ?, message = ?, status = ? WHERE id = ?"
                : "UPDATE contact_enquiries SET name = ?, email = ?, service = ?, message = ? WHERE id = ?";
            $stmt = $connection->prepare($query);
            if ($stmt === false) {
                return null;
            }
            if ($hasStatusColumn) {
                $stmt->bind_param(
                    "sssssi",
                    $name,
                    $email,
                    $service,
                    $message,
                    $status,
                    $id,
                );
            } else {
                $stmt->bind_param(
                    "ssssi",
                    $name,
                    $email,
                    $service,
                    $message,
                    $id,
                );
            }
            $stmt->execute();
            $stmt->close();
            return $id;
        }

        $query = $hasStatusColumn
            ? "INSERT INTO contact_enquiries (name, email, service, message, status) VALUES (?, ?, ?, ?, ?)"
            : "INSERT INTO contact_enquiries (name, email, service, message) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        if ($stmt === false) {
            return null;
        }
        if ($hasStatusColumn) {
            $stmt->bind_param("sssss", $name, $email, $service, $message, $status);
        } else {
            $stmt->bind_param("ssss", $name, $email, $service, $message);
        }
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
        if ($stmt === false) {
            return false;
        }
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

    try {
        if ($result = $connection->query($query)) {
            $row = $result->fetch_assoc();
            $result->free();
            return $row ?: null;
        }
    } catch (\mysqli_sql_exception $e) {
        error_log("Profile fetch failed: {$e->getMessage()}");
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
            if ($stmt === false) {
                return false;
            }
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
            if ($stmt === false) {
                return false;
            }
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

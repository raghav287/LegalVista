<?php
require_once 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $service = $_POST['service'] ?? '';
    $packageType = $_POST['package_type'] ?? '';
    $message = $_POST['message'] ?? '';

    // Fallback: some forms send package_type instead of service
    if ($service === '' && $packageType !== '') {
        $service = 'Package: ' . $packageType;
    }
    if ($service === '') {
        $service = 'General Enquiry';
    }

    $hasStatusColumn = false;
    try {
        $columnCheck = $pdo->query("SHOW COLUMNS FROM contact_enquiries LIKE 'status'");
        $hasStatusColumn = $columnCheck !== false && $columnCheck->fetch() !== false;
    } catch (PDOException $e) {
        $hasStatusColumn = false;
    }

    // INSERT
    if ($hasStatusColumn) {
        $stmt = $pdo->prepare("INSERT INTO contact_enquiries (name, email, service, message, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $service, $message, "New"]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO contact_enquiries (name, email, service, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $service, $message]);
    }

    // MAIL
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'raghav224745@gmail.com';
    $mail->Password = 'ieldxkboyucsswwr';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // ADMIN
    $mail->setFrom('raghav224745@gmail.com', 'Legal Vista');
    $mail->addAddress('raghav224745@gmail.com');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = "New Enquiry";
    $mail->Body = "Name: $name <br>Email: $email <br>Service: $service <br>Package Type: $packageType <br>Message: $message";
    $mail->send();

    // CUSTOMER
    $mail->clearAddresses();
    $mail->addAddress($email);
    $mail->Subject = "Thank You";
    $mail->Body = "Hi $name, we received your enquiry.";
    $mail->send();

    // Redirect back to the same page where the form was submitted.
    $redirectUrl = "../?lead_submitted=1&mail_sent=1#lead-form-section";
    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    $currentHost = $_SERVER['HTTP_HOST'] ?? '';

    if ($referer !== '') {
        $parsed = parse_url($referer);
        $refererHost = $parsed['host'] ?? '';
        $sameHost = $refererHost === '' || strcasecmp($refererHost, $currentHost) === 0;

        if ($sameHost) {
            $path = $parsed['path'] ?? '/';
            $query = [];
            if (!empty($parsed['query'])) {
                parse_str($parsed['query'], $query);
            }
            $query['lead_submitted'] = 1;
            $query['mail_sent'] = 1;
            $redirectUrl = $path . '?' . http_build_query($query);
        }
    }

    header("Location: " . $redirectUrl);
    exit();
}

<?php
require_once 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $service = $_POST['service'];
    $message = $_POST['message'];

    // INSERT
    $stmt = $pdo->prepare("INSERT INTO contact_enquiries (name, email, service, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $service, $message]);

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
    $mail->Body = "Name: $name <br>Email: $email <br>Service: $service <br>Message: $message";
    $mail->send();

    // CUSTOMER
    $mail->clearAddresses();
    $mail->addAddress($email);
    $mail->Subject = "Thank You";
    $mail->Body = "Hi $name, we received your enquiry.";
    $mail->send();

    header("Location: ../index.php");
    exit();
}
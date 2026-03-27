<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST['submit'])){ 
    $error=array();
    $name=$_REQUEST['name'];
    $email=$_REQUEST['email'];    
    $service=$_REQUEST['service'];
    $message=$_REQUEST['message']; 
    
    
    if(count($error)==0){
      
    $mail = new PHPMailer(true);
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='info@legal-vista.com';
    $mail->Password='jtumnfrazqjfbdjc';
    $mail->SMTPSecure='TLS';
    $mail->Port=587;
     $mail->setFrom('info@legal-vista.com', 'Legal Vista Ltd');
    $mail->addAddress('info@legal-vista.com');
    $mail->addReplyTo($email);
    $mail->IsHTML(true);
    $mail->Body="<p><strong>Name</strong> : $name<br/><strong>Email</strong>: $email<br/><strong>Service</strong>: $service<br/><strong>Message</strong>: $message</p>";
    $mail->Subject="Individual Entrepreneur Page Form Submitted By : ".$name."";
    if($mail->Send()){
        echo "<script>window.location='thanks'</script>";
    }
 }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Individual Entrepreneur in Georgia | Legal Vista Ltd</title>
    <meta name="description"
        content="Register as an Individual Entrepreneur in Georgia with Legal Vista. We handle Small Business Status applications, tax registration, and legal compliance." />
    <meta name="keywords"
        content="Individual Entrepreneur Georgia, Small Business Status Georgia, Sole Proprietor Georgia, 1% tax Georgia, Legal Vista" />
    <meta name="robots" content="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" type="image/x-icon" href="images/fevicon.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/fontawesome.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/pbminfotech-base-icons.css" />
    <link rel="stylesheet" href="css/swiper.min.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/shortcode.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="css/demo-4.css" />
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="revolution/rs6.css" />

    <style>
    .pbmit-title-bar-wrapper {
        position: relative;
        padding: 118px 0 112px;
        background: linear-gradient(0deg, rgba(12, 32, 70, 0.92), rgba(12, 32, 70, 0.92)),
            url("images/titlebar-img.jpg") center center / cover no-repeat;
        color: #fff;
    }

    .pbmit-title-bar-wrapper h1 {
        color: #fff;
        margin: 0;
        font-size: clamp(42px, 5vw, 64px);
        line-height: 1.08;
        font-weight: 700;
    }

    .ie-hero {
        position: relative;
        background: linear-gradient(120deg, rgba(9, 42, 86, 0.94), rgba(15, 57, 108, 0.9)), url('images/banner1.jpg') center/cover no-repeat;
        color: #fff;
        padding: 130px 0 120px;
        overflow: hidden;
    }

    .ie-hero h1 {
        font-size: 46px;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .ie-section {
        padding: 20px 0;
    }

    .ie-section p {
        font-size: 17px;
        line-height: 1.7;
        color: #1e335c;
    }

    .ie-intro-img {
        border-radius: 16px;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .ie-card {
        background: #f3eded;
        border-radius: 14px;
        padding: 30px 32px;
        margin: 0 0 32px;
        width: 100%;
        border: 1px solid #e3d7c5;
        box-shadow: 0 10px 24px rgba(16, 35, 73, 0.05);
    }

    .ie-card h3 {
        font-size: 24px;
        color: #123b6a;
        margin-bottom: 18px;
        font-weight: 700;
    }

    .ie-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .ie-list li {
        position: relative;
        padding-left: 30px;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 12px;
        color: #1e335c;
    }

    .ie-list li:before {
        content: "✓";
        position: absolute;
        left: 0;
        top: 4px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #1d4f8b;
        color: #ffffff;
        font-size: 11px;
        line-height: 16px;
        text-align: center;
        font-weight: 700;
        display: inline-block;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .ie-cta {
        background: linear-gradient(115deg, #0a234f 0%, #0c2f6a 50%, #0a234f 100%);
        color: #fff;
        border-radius: 16px;
        padding: 28px 36px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        box-shadow: 0 18px 42px rgba(6, 23, 51, 0.32);
        width: 100%;
        max-width: 1080px;
        margin: 12px auto 16px;
        gap: 18px;
        border: 1px solid rgba(15, 63, 122, 0.4);
    }

    .ie-cta h4 {
        font-size: 20px;
        font-weight: 800;
        margin: 0 0 4px;
        letter-spacing: 0.4px;
        color: #e7efff;
        text-transform: uppercase;
    }

    .ie-cta .price {
        font-size: 30px;
        font-weight: 900;
        color: #ffd880;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.35);
        letter-spacing: 0.4px;
    }

    .ie-cta .btn-cta {
        background: linear-gradient(135deg, #1e64d5, #0f3f7c);
        color: #ffc94f;
        padding: 12px 30px;
        border-radius: 999px;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-decoration: none;
        transition: all 0.25s ease;
        display: inline-block;
        text-transform: uppercase;
        border: 1px solid rgba(255, 255, 255, 0.14);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.22), inset 0 0 0 1px rgba(255, 255, 255, 0.08);
    }

    .ie-cta .btn-cta:hover,
    .ie-cta .btn-cta:focus {
        background: linear-gradient(135deg, #2b74ef, #1452a1);
        color: #ffe6a1;
        transform: translateY(-1px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.26), inset 0 0 0 1px rgba(255, 255, 255, 0.12);
    }

    .ie-included {
        padding-left: 0;
        list-style: none;
    }

    .ie-included li {
        position: relative;
        padding-left: 28px;
        margin-bottom: 10px;
        color: #1e335c;
        font-size: 17px;
    }

    .ie-included li:before {
        content: "✓";
        position: absolute;
        left: 0;
        top: 4px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #1d4f8b;
        color: #ffffff;
        font-size: 11px;
        line-height: 16px;
        text-align: center;
        font-weight: 700;
        display: inline-block;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    /* Package CTA bar */
    .package {
        width: 100%;
        margin: 12px 0 40px;
    }

    .package .cnt {
        position: relative;

        color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 14px 32px rgba(6, 23, 51, 0.22);
        padding: 0px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .package .cnt:after {
        content: "";
        position: absolute;
        left: 10px;
        right: 10px;
        bottom: -12px;
        height: 12px;
        background: rgba(32, 73, 105, 0.6);
        border-radius: 0 0 12px 12px;
        filter: blur(1px);
        z-index: -1;
    }

    .package h5 {
        margin: 0;
        font-size: 22px;
        font-weight: 900;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    .package .btnnnnnn {
        flex-shrink: 0;
    }

    .package .btnnnnnn p {
        margin: 0;
    }

    .package .price-button {
        display: inline-block;
        padding: 14px 56px;
        border-radius: 999px;
        background: linear-gradient(95deg, #0c46c3 0%, #0c2b63 100%);
        color: #ffb400;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        text-decoration: none;
        border: none;
        box-shadow: 0 10px 24px rgba(8, 28, 66, 0.35);
        transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease, color 0.18s ease;
    }

    .package .price-button:hover,
    .package .price-button:focus {
        background: linear-gradient(95deg, #0f59e0 0%, #103677 100%);
        color: #ffc94f;
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(8, 28, 66, 0.45);
    }

    @media (max-width: 991px) {
        .ie-hero {
            padding: 90px 0;
        }

        .ie-hero h1 {
            font-size: 34px;
        }

        .ie-section {
            padding: 60px 0;
        }

        .ie-cta {
            text-align: center;
            gap: 16px;
        }

        .ie-cta h4 {
            width: 100%;
        }
    }

    /* Enquiry modal tweaks */
    .enquiry-modal .modal-content {
        border-radius: 18px;
    }

    .enquiry-modal .form-control {
        background: #f7f8fb;
        border: 1px solid #dfe3ec;
        border-radius: 12px;
        padding: 12px 14px;
        color: #1a2433;
    }

    .enquiry-modal .form-control:focus {
        border-color: #3ea6ff;
        box-shadow: 0 0 0 3px rgba(62, 166, 255, 0.15);
        background: #fff;
    }

    .enquiry-modal .lead-submit-btn {
        background: linear-gradient(135deg, #f4c167 0%, #f0a73e 100%);
        color: #1f1407;
        border: none;
        border-radius: 12px;
        letter-spacing: .8px;
        transition: transform .15s ease, box-shadow .2s ease;
    }

    .enquiry-modal .lead-submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 24px rgba(240, 167, 62, 0.28);
    }

    .letter-sp-1 {
        letter-spacing: .12rem;
    }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <?php include("includes/header.php"); ?>
        <div class="modal fade enquiry-modal" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabe4"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content rounded-4 shadow-lg border-0">
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <p class="text-uppercase text-muted fw-semibold mb-1 small letter-sp-1">Let’s talk</p>
                            <h1 class="modal-title fs-4 fw-bold mb-0" id="exampleModalLabel">Submit your inquiry</h1>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-1">
                        <p class="text-muted small mb-3 d-flex align-items-center gap-2">
                            <i class="fa fa-bolt text-warning"></i> Average response time: under 1 hour
                        </p>
                        <form method="post" id="contact-form" action="backend/contact-form.php">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <input type="text" name="name" class="form-control form-control-lg"
                                        placeholder="Full name *" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        placeholder="Work email *" required>
                                </div>
                                <div class="col-12">
                                    <select name="service" id="service" class="form-control form-control-lg" required>
                                        <option value="">Select service *</option>
                                        <option value="Individual Entrepreneur" selected>Individual Entrepreneur
                                        </option>
                                        <option value="Company Registration Packages">Company Registration Packages
                                        </option>
                                        <option value="Bank Account Opening">Bank Account Opening</option>
                                        <option value="Tax Residency">Tax Residency</option>
                                        <option value="Nominee Services">Nominee Services</option>
                                        <option value="Accounting & Taxation">Accounting & Taxation</option>
                                        <option value="Resident Permit">Resident Permit</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" cols="40" rows="4" class="form-control form-control-lg"
                                        placeholder="Please describe your requirements or questions here."
                                        required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="submit"
                                        class="btn lead-submit-btn w-100 py-3 fw-bold text-uppercase">
                                        <i
                                            class="form-btn-loader fa fa-circle-o-notch fa-spin fa-fw margin-bottom d-none"></i>
                                        Send message
                                    </button>
                                </div>
                                <div class="col-12 message-status"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- 
        <section class="ie-hero d-flex align-items-center text-center">
            <div class="container">
                <h1 style="color: white;">Individual Entrepreneur</h1>
            </div>
        </section> -->

        <div class="pbmit-title-bar-wrapper">
            <div class="container">
                <div class="pbmit-title-bar-content">
                    <div class="pbmit-title-bar-content-inner">
                        <div class="pbmit-tbar">
                            <div class="pbmit-tbar-inner container">
                                <h1 style="color: white;">Individual Entrepreneur</h1>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="ie-section">
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-md-7">
                        <p>If you're looking to establish a business where you're the sole proprietor, registering as an
                            Individual Entrepreneur, with Small Business Status in Georgia can bring significant tax
                            advantages.</p>
                        <p>The Small Business Status (SBS) is a tailored tax program designed for Individual
                            Entrepreneurs (IEs) in Georgia. It allows eligible IEs to apply for the SBS, enabling them
                            to pay a reduced 1% tax on turnover up to a maximum annual turnover of 500,000 GEL. This
                            often translates into substantial tax savings, particularly beneficial for freelancers and
                            solopreneurs.</p>
                        <p>Legal Vista offers comprehensive support for both Individual Entrepreneur (IE) registration
                            and Small Business Status (SBS) application (for qualifying individuals). Our services
                            ensure a swift and professional setup, guiding you through potential translation challenges
                            and legal intricacies in Georgian law, guaranteeing a hassle-free registration process
                            without future legal complications.</p>
                    </div>
                    <div class="col-md-5 text-center">
                        <div class="ie-intro-img">
                            <img src="images/sole-trader.jpg" class="img-fluid"
                                alt="Individual Entrepreneur in Georgia">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ie-section">
            <div class="container">
                <div class="ie-card">
                    <h3>Advantages of Georgian "Small Business Status" (SBS)</h3>
                    <ul class="ie-list">
                        <li>Low Tax Rate: Enjoy a flat 1% tax rate on gross turnover, eliminating the need for
                            additional personal or corporate income taxes. For Individual Entrepreneurs (IEs) without
                            SBS status, a 20% tax on net profit applies.</li>
                        <li>VAT Exemptions: Benefit from a 0% VAT rate on most foreign services, particularly
                            advantageous for B2B services with clients outside Georgia. B2C services delivered
                            electronically also qualify for VAT exemption.*</li>
                        <li>Residency Flexibility: Legal residency in Georgia is not mandatory for SBS eligibility.
                            However, becoming a tax resident is a prerequisite.</li>
                    </ul>
                    <p class="mt-3 mb-0" style="font-size:14px;color:#6b6b6b;">*Always confirm VAT treatment for your
                        specific business model; exemptions may vary.</p>
                </div>

                <div class="ie-card">
                    <h3>Which Business Activities are Ineligible for Small Business Status?</h3>
                    <p class="mb-3">As per Government Resolution №415 of Georgia, the following activities are
                        ineligible for Small Business Status:</p>
                    <ul class="ie-list">
                        <li>Activities requiring specific licensing or permits</li>
                        <li>Currency exchange operations</li>
                        <li>Medical, architectural, legal, notarial, auditing, consulting (including tax consulting)
                            activities</li>
                        <li>Gambling businesses</li>
                        <li>Staffing activities (potentially including HR/recruitment, as per our interpretation due to
                            legislative vagueness)</li>
                        <li>Engagement in activities demanding significant investments or producing excisable goods</li>
                    </ul>
                    <p class="mb-0" style="font-size:14px;color:#6b6b6b;">Income from employment or similar activities
                        will be taxed at the standard 20% rate and is not part of the 1% taxable income for small
                        businesses.</p>
                </div>
            </div>
        </section>

        <section class="ie-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h3 style="color:#0b2c55; font-weight:800; margin-bottom:18px;">What is Included in the Package:
                        </h3>
                        <ul class="ie-included">
                            <li>Business registration at the business registry</li>
                            <li>Registration with the tax authorities</li>
                            <li>Legal fees</li>
                            <li>Legal address for 1 year</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <div class="container">
            <div class="package">
                <div class="cnt">
                    <h5>PACKAGE FEE - EUR 699</h5>
                    <div class="btnnnnnn">
                        <p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal4"
                                class="price-button">Enquire</a></p>
                    </div>
                </div>
            </div>
        </div>




        <?php include("includes/lead-form.php"); ?>
        <?php include("includes/footer.php"); ?>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.appear.js"></script>
    <script src="js/numinate.min.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/circle-progress.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="revolution/rslider.js"></script>
    <script src="revolution/rbtools.min.js"></script>
    <script src="revolution/rs6.min.js"></script>


    <script src="js/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- jquery Waypoints JS -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- jquery Appear JS -->
    <script src="js/jquery.appear.js"></script>
    <!-- Numinate JS -->
    <script src="js/numinate.min.js"></script>
    <!-- Swiper JS -->
    <script src="js/swiper.min.js"></script>
    <!-- Magnific JS -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- Circle Progress JS -->
    <script src="js/circle-progress.js"></script>
    <!-- AOS -->
    <script src="js/aos.js"></script>
    <!-- Isotope JS -->
    <script src="js/isotope.pkgd.min.js"></script>
    <!-- Scripts JS -->
    <script src="js/scripts.js"></script>
    <!-- Revolution JS -->

    <script src="revolution/rslider.js"></script>
    <script src="revolution/rbtools.min.js"></script>
    <script src="revolution/rs6.min.js"></script>
</body>

</html>

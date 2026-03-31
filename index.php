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
    $mail->Body="<p><strong>Name</strong> : $name<br/><strong>Email</strong>: $email<br/><strong>Service</strong>: $service<br/><strong>Package</strong>: $package<br/><strong>Message</strong>: $message</p>";
    $mail->Subject="Get in Touch  Form Submitted By : ".$name."";
    if($mail->Send()){
        echo "<script>window.location='thanks'</script>";
    }
 }
}

require_once __DIR__ . '/admin/bootstrap.php';
require_once APP_ROOT . '/app/module-data.php';
require_once __DIR__ . '/includes/article-repository.php';

$homepagePackages = getHomepagePackages();
$startingPackagePrice = null;
foreach ($homepagePackages as $homepagePackage) {
    $rawPrice = preg_replace('/[^\d.]/', '', (string) ($homepagePackage['price_eur'] ?? ''));
    if ($rawPrice === '') {
        continue;
    }
    $numericPrice = (float) $rawPrice;
    if ($startingPackagePrice === null || $numericPrice < $startingPackagePrice) {
        $startingPackagePrice = $numericPrice;
    }
}

$homepageArticlesRaw = lv_get_articles([
    'status' => 'published',
], true);

$homepageArticles = [];
foreach ($homepageArticlesRaw as $article) {
    if (empty($article['slug'])) {
        continue;
    }

    $imagePath = $article['featured_image'] ?? ($article['image'] ?? 'images/titlebar-img.jpg');
    $dateValue = $article['publish_date'] ?? ($article['date'] ?? null);
    $dateText = $dateValue ? date('M d, Y', strtotime($dateValue)) : '';

    $excerptSource = trim((string) ($article['excerpt'] ?? ''));
    if ($excerptSource === '' && !empty($article['body_html'])) {
        $excerptSource = trim(strip_tags((string) $article['body_html']));
    }
    if ($excerptSource !== '' && strlen($excerptSource) > 120) {
        $excerptSource = substr($excerptSource, 0, 117) . '...';
    }

    $homepageArticles[] = [
        'slug' => $article['slug'],
        'title' => $article['title'] ?? '',
        'image' => $imagePath,
        'date_text' => $dateText,
        'excerpt' => $excerptSource,
    ];
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Legal Vista Ltd - Limited Liability Company in Tbilisi, Georgia</title>
    <meta name="description"
        content="Legal Vista Ltd, a premier law firm founded in 2017, offers bespoke legal services to expatriates looking to set up base in Georgia. We offer a gamut of company start up services to kick start your business and assist in its growth. Limited Liability Company in Tbilisi, Georgia" />
    <meta name="keywords"
        content="Legal Vista Ltd, Limited Liability Company, Limited Liability Company in Tbilisi, Limited Liability Company in Georgia, Accounting & Taxation, Accounting & Taxation Company in Tbilisi, Accounting & Taxation Company in Georgia, Resident Permit, Resident Permit Company in Tbilisi, Resident Permit Company in Georgia , Bank Account Opening, Bank Account Opening Company in Tbilisi, Bank Account Opening Company in Georgia , Tax Residency, Tax Residency Company in Tbilisi, Tax Residency Company in Georgia, Nominee Services, Nominee Services Company in Tbilisi, Nominee Services Company in Georgia " />
    <meta name="robots" content="all" />
    <meta name="resource-type" content="document" />
    <meta name="page-topic" content="Taxation Services" />
    <meta name="clientbase" content="Global" />
    <meta name="distribution" content="World Wide Web" />
    <meta name="audience" content="all" />
    <link rel="canonical" href="https://legal-vista.com/" />
    <meta name="rating" content="general" />
    <meta id="googlebot" name="googlebot" content="index, follow">
    <meta name="expires" content="never" />
    <meta name="bingbot" content=" index, follow " />
    <meta name="revisit-after" content="Daily" />
    <meta name="author" content="Legal Vista Ltd">
    <meta name="HandheldFriendly" content="True" />
    <meta name="YahooSeeker" content="Index,Follow" />
    <meta name="geo.region" content="GA" />
    <meta name="State" content="Tbilisi" />
    <meta name="City" content="Tbilisi" />
    <meta name="subject" content="Rated #1 Legal Vista Ltd - Limited Liability Company in Tbilisi, Georgia" />


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/fevicon.png" />
    <!-- CSS
         ============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Fontawesome -->
    <link rel="stylesheet" href="css/fontawesome.css" />
    <!-- Flaticon -->
    <link rel="stylesheet" href="css/flaticon.css" />
    <!-- Base Icons -->
    <link rel="stylesheet" href="css/pbminfotech-base-icons.css" />
    <!-- Swiper -->
    <link rel="stylesheet" href="css/swiper.min.css" />
    <!-- Magnific -->
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <!-- Shortcode CSS -->
    <link rel="stylesheet" href="css/shortcode.css" />
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css" />
    <!-- root CSS -->
    <link rel="stylesheet" href="css/demo-4.css" />
    <!-- Base CSS -->
    <link rel="stylesheet" href="css/base.css" />
    <!-- AOS -->
    <link rel="stylesheet" href="css/aos.css" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- REVOLUTION STYLE SHEETS -->
    <link rel="stylesheet" type="text/css" href="revolution/rs6.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <style>
    .inf-testimonial-section {
        background-color: #f9f5eb;
        padding: 100px 0;
        text-align: center;
    }

    .inf-testimonial-title {
        color: #022d58;
        font-family: 'serif';
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 50px;
    }

    .inf-slider-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        margin-top: 32px;
    }

    .inf-slider-button {
        width: 52px;
        height: 52px;
        border: 1px solid #c5a66d;
        border-radius: 999px;
        background: #fff;
        color: #022d58;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        line-height: 1;
        transition: all 0.3s ease;
    }

    .inf-slider-button:hover,
    .inf-slider-button:focus {
        background: #c5a66d;
        color: #fff;
        outline: none;
    }

    .inf-testimonial-content {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 60px;
    }

    /* Quote Layout */
    .inf-quote-container {
        position: relative;
        display: inline-block;
        padding: 20px 0;
    }

    .inf-testimonial-text {
        font-size: 20px;
        line-height: 1.6;
        color: #333;
        max-width: 750px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    /* The Side Quote (Gold Box) */
    .inf-gold-quote {
        position: absolute;
        right: -70px;
        /* Moves it to the side like your image */
        top: 50%;
        transform: translateY(-50%);
        background: #c5a66d;
        color: white;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 45px;
        font-family: 'Georgia', serif;
        border-radius: 2px;
    }

    .inf-stars {
        color: #ffb400;
        font-size: 22px;
        margin: 25px 0;
        letter-spacing: 3px;
    }

    .inf-author-name {
        color: #022d58;
        font-size: 24px;
        font-weight: 700;
        margin: 0;
    }

    .inf-author-location {
        color: #666;
        font-size: 16px;
        font-weight: 600;
        margin-top: 5px;
        text-transform: uppercase;
    }

    /* Pagination Styling */
    .inf-swiper-container .swiper-pagination {
        position: relative;
        margin-top: 40px;
    }

    .inf-swiper-container .swiper-pagination-bullet-active {
        background: #c5a66d;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .inf-gold-quote {
            display: none;
        }

        /* Hide box on mobile to save space */
        .inf-testimonial-content {
            padding: 0 20px;
        }
    }

    .inf-blog-section {
        padding: 60px 0;
        background: #fff;
    }

    .inf-blog-header {
        margin-bottom: 48px;
    }

    .inf-blog-header .pbmit-heading-subheading {
        margin-bottom: 0 !important;
        text-align: center;
    }

    .inf-blog-actions {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-top: 32px;
    }

    .inf-blog-controls {
        margin-top: 0;
        display: flex;
        gap: 14px;
        justify-content: center;
        flex: 1;
    }

    .inf-main-swiper {
        overflow: hidden;
        width: 100%;
    }

    .inf-main-swiper .swiper-wrapper {
        align-items: stretch;
    }

    .inf-main-swiper .swiper-slide {
        height: auto;
    }

    .inf-blog-item {
        position: relative;
        height: 480px;
        /* Fixed height for consistency */
        border-radius: 12px;
        overflow: hidden;
        background: #133158;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .inf-image-holder {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .inf-image-holder img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* The Gradient from your inline style, applied as an overlay */
    .inf-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(2deg, #133158 0%, #133158 35%, #133158b3 70%, transparent 100%);
        z-index: 2;
    }

    .inf-blog-content {
        position: relative;
        z-index: 3;
        padding: 30px 25px;
        color: #fff;
    }

    .inf-view-all-btn {
        background: #c0a262;
        border: 1px solid #c0a262;
        color: #fff;
        padding: 12px 28px;
        letter-spacing: 1px;
        font-weight: 600;
        border-radius: 6px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-size: 13px;
    }

    .inf-view-all-btn:hover,
    .inf-view-all-btn:focus {
        background: #a5894f;
        border-color: #a5894f;
        color: #fff;
        text-decoration: none;
    }

    @media (max-width: 767.98px) {
        .inf-blog-actions {
            flex-direction: column;
            align-items: center;
        }

        .inf-view-all-btn {
            width: 100%;
            text-align: center;
        }
    }

    .inf-date {
        display: block;
        font-size: 13px;
        opacity: 0.8;
        margin-bottom: 10px;
    }

    .inf-title {
        font-size: 19px;
        line-height: 1.4;
        margin-bottom: 15px;
        font-weight: 700;
        word-break: break-word;
        overflow-wrap: anywhere;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .inf-title a {
        color: #fff !important;
        text-decoration: none;
    }

    .inf-excerpt {
        font-size: 14px;
        opacity: 0.85;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .inf-read-more {
        color: #c5a66d;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 1px;
        text-decoration: none;
        border-bottom: 1px solid #c5a66d;
        padding-bottom: 3px;
    }

    .page-wrapper {
        overflow: visible;
    }

    @media (max-width: 991px) {
        .inf-blog-header {
            margin-bottom: 32px;
        }

        .inf-blog-header .pbmit-heading-subheading {
            text-align: center;
        }
    }
    </style>
</head>

<body>
    <!-- page wrapper -->
    <div class="page-wrapper">








        <!-- Footer -->
        <?php include("includes/header.php"); ?>
        <!-- End  Footer-->







        <div class="banner">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/bannerswwww.jpg" class="d-block w-100" alt="..." />

                        <div class="container">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="carousel-caption bannertext d-md-block  text-left    align-items-left">
                                        <h1>Register Your Georgian Company </h1>

                                        <h6>With Our Expert Guidance Today</h6>

                                        <h2>Packages Starting As Low As
                                            <?= htmlspecialchars($startingPackagePrice !== null ? rtrim(rtrim(number_format($startingPackagePrice, 2, '.', ''), '0'), '.') : '499') ?>
                                            Euros</h2>

                                        <h5>No Hidden Costs or Last Minute Surprises</h5>

                                        <div class="btnnn">
                                            <a href="company-registration" class="pbmit-btn pbmit-btn-global">

                                                View Packages
                                                <i class="themifyicon ti-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
            <!-- Team Start -->


            <!-- Team End -->

            <!-- Our Pricing -->
            <section id="aboutttt" class="section-md1 bgg">
                <div class="container">
                    <div class="pbmit-heading-subheading text-center">
                        <h4 class="pbmit-subtitle">Affordable Limited Liability </h4>
                        <h2 class="pbmit-title">Company Registration Packages</h2>
                    </div>





                    <!--        <div class="row hhhh">
                            <div class="col-md-10">
                                <div class="aboutpackage text-center">
                                    <p>
                                        Our comprehensive LLC registration service ensures a swift and professional setup process. We handle all aspects, from overcoming translation challenges to navigating Georgian legal intricacies,
                                        ensuring a seamless registration without potential legal complications down the line.<br />
                                        <br />
                                        Included in our service is a customized dual-language charter (articles of association) tailored to your requirements, essential for registration with Georgian authorities.
                                    </p>
                                </div>
                            </div>
                        </div>
 -->



                    <div class="pbmit-ptables-w wpb_content_element">
                        <div class="row">
                            <?php foreach ($homepagePackages as $package): ?>
                            <?php
                                $services = preg_split('/\r\n|\r|\n/', (string) ($package['services_text'] ?? '')) ?: [];
                                $isFeatured = !empty($package['is_featured']);
                                $buttonUrl = trim((string) ($package['button_url'] ?? 'company-registration.php'));
                                $buttonClass = $isFeatured
                                    ? 'pbmit-vc_general pbmit-vc_btn3 pbmit-vc_btn3-size-md jklllllllll'
                                    : 'pbmit-vc_general pbmit-vc_btn3 pbmit-vc_btn3-size-md';
                                ?>
                            <div
                                class="pbmit-ptable-column-w col-md-12 col-lg-3 <?= $isFeatured ? 'pbmit-ptablebox-featured-col' : '' ?>">
                                <div class="pbmit-ptable-column-inner">
                                    <?php if ($isFeatured && trim((string) ($package['badge_text'] ?? '')) !== ''): ?>
                                    <div class="absoult">
                                        <h6><?= htmlspecialchars($package['badge_text']) ?> <i class="fa fa-star"
                                                aria-hidden="true"></i></h6>
                                    </div>
                                    <?php endif; ?>
                                    <div class="pbmit-ptablebox pbmit-ptablebox-style-1">
                                        <div class="pbmit-ptable-main">
                                            <h3 class="pbmit-ptable-heading">
                                                <?= htmlspecialchars($package['package_name']) ?></h3>
                                            <div class="pbmit-sep"></div>
                                        </div>
                                        <div class="pbmit-ptablebox-colum pbmit-ptablebox-featurebox min-heightt">
                                            <h6 class="servicessss">Services</h6>
                                            <ul class="list-style-two jklllll<?= $isFeatured ? ' active' : '' ?>">
                                                <?php foreach ($services as $serviceLine): ?>
                                                <?php $serviceLine = trim($serviceLine); ?>
                                                <?php if ($serviceLine === '') { continue; } ?>
                                                <li><?= htmlspecialchars($serviceLine) ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>

                                        <h6 class="servicessss pr-555">Price</h6>

                                        <div class="pbmit-ptable-price-w">
                                            <div class="pbmit-ptable-price kkk">
                                                €<?= htmlspecialchars((string) $package['price_eur']) ?></div>
                                        </div>

                                        <div class="pbmit-vc_btn3-container pbmit-vc_btn3-inline">
                                            <a class="<?= $buttonClass ?>" href="<?= htmlspecialchars($buttonUrl) ?>"
                                                title="">Select Package</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </section>



            <section class="section-md">
                <div class="container">
                    <div class="pbmit-heading-subheading text-center">
                        <!-- <h4 class="pbmit-subtitle">Why Set Up Business In georiga</h4> -->
                        <h2 class="pbmit-title">Why Set Up Business In Georgia?</h2>
                    </div>




                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <article class="pbmit-servicebox-style-5">
                                <div class="pbmit-post-item">
                                    <div class="pbmit-box-content text-center">
                                        <div class="pbmit-box-content-inner">
                                            <div class="pbmit-pf-box-title jkllll">
                                                <div class="pbmit-ihbox-icon">
                                                    <img src="images/7th-in-the-world1.png"
                                                        alt="Ease of doing business ranked 7th globally">

                                                </div>

                                                <h3><a href="#">Ease of Doing Business Ranked 7th in the World</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <article class="pbmit-servicebox-style-5">
                                <div class="pbmit-post-item">
                                    <div class="pbmit-box-content text-center">

                                        <div class="pbmit-box-content-inner">
                                            <div class="pbmit-pf-box-title jkllll">
                                                <div class="pbmit-ihbox-icon"> <img src="images/low-tax-rate1.png"
                                                        alt="Low tax rate in Georgia">
                                                </div>

                                                <h3><a href="#">Low Tax Rate</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <article class="pbmit-servicebox-style-5">
                                <div class="pbmit-post-item">
                                    <div class="pbmit-box-content text-center">

                                        <div class="pbmit-box-content-inner">
                                            <div class="pbmit-pf-box-title jkllll">
                                                <div class="pbmit-ihbox-icon"> <img
                                                        src="images/free-trade-agreement-with-eu1.png"
                                                        alt="Georgia free trade agreements with EU"> </div>

                                                <h3><a href="#">Free Trade Agreement with EU</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <article class="pbmit-servicebox-style-5">
                                <div class="pbmit-post-item">
                                    <div class="pbmit-box-content text-center">

                                        <div class="pbmit-box-content-inner">
                                            <div class="pbmit-pf-box-title jkllll">
                                                <div class="pbmit-ihbox-icon"> <img
                                                        src="images/premium-corporate-banking-services.png"
                                                        alt="Premium corporate banking services"> </div>

                                                <h3><a href="#">Premium corporate banking services</a></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>








                </div>
            </section>
            <!-- Our Pricing End -->

            <!-- About Start -->
            <!--   <section class="about-section-seven">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-lg-7">
                                <div class="about-seven-content">
                                    <div class="pbmit-firstlater aboutt jj">
                                        <h4>
                                            REGISTER AS AN
                                            <span class="colorrr">
                                                <br />
                                                INDIVIDUAL <br />
                                                ENTREPRENEUR
                                            </span>
                                            TODAY!

                                            <br />
                                            AND ENJOY JUST <span class="colorrr"> 1% TAX </span> ON TURNOVER!"
                                        </h4>

        

                                        <div class="about-seven-inner">
                                            <div class="row align-items-center">
                                                <div class="col-12 col-lg-5">
                                                    <a href="#" class="pbmit-btn pbmit-btn-global">
                                                        GET STARTED

                                                        <i class="themifyicon ti-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-5">
                                <div class="about-seven-imgbox border border-warning">
                                    <figure>
                                        <img src="images/about-img.jpg" class="img-fluid" alt="Legal Vista team providing company formation services in Georgia" />
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>-->
            <!-- About End -->


            <!-- Service Start -->
            <!--      <section class="section-xl service-six-bg11">
                    <div class="container">
                        <div class="pbmit-heading-subheading-style-1 text-center">
                            <h2 class="pbmit-title jklll">Other Services</h2>
                            
                        </div> -->

            <!-- 
 <div class="service-classic-blue elementor-widget elementor-widget-privsa-service" data-id="7de2527" data-element_type="widget" data-widget_type="privsa-service.default">
          <div class="elementor-widget-container">


<div class="row">
  <div class="col-lg-4">
    <div class="service-wrap style2 style3 mb-5" style="background-image: url(images/case_1.jpg)">
      <div class="service-content">
        <div class="service-intro-content">
          <div class="service-intro-iconll"> 
        <img src="images/sole-proprietorship1.png" alt="Sole proprietorship service icon">
          </div>
          <h3 class="ts-title">
            <a href="#">Sole Proprietorship </a>
          </h3>
          <p> A sole proprietorship is owned and run by one person only.






 </p>
          <a href="#" class="read-more">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </a> 
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="service-wrap style2 style3 mb-5" style="background-image: url(images/case_2.jpg)">
      <div class="service-content">
        <div class="service-intro-content">
            <div class="service-intro-iconll"> 
          <img src="images/accounting-and-bookkeeping1.png" alt="Accounting and bookkeeping service icon">
          </div>
          <h3 class="ts-title">
            <a href="#">Accounting & Bookkeeping </a>
          </h3>
          <p> Accounting and bookkeeping track, record, and manage financial.






</p>
          <a href="#" class="read-more">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </a> 
        </div>
      </div>
    </div>
  </div>

    <div class="col-lg-4">
    <div class="service-wrap style2 style3 mb-5" style="background-image: url(images/case_2.jpg)">
      <div class="service-content">
        <div class="service-intro-content">
        <div class="service-intro-iconll"> 
          <img src="images/resident-----permit.png" alt="Resident permit assistance icon">
          </div>
          <h3 class="ts-title">
            <a href="#">Resident Permit </a>
          </h3>
          <p> A resident permit allows a foreign national to live and work locally.






</p>
          <a href="#" class="read-more">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </a> 
        </div>
      </div>
    </div>
  </div>



  <div class="col-lg-4">
    <div class="service-wrap style2 style3 mb-5" style="background-image: url(images/case_3.jpg)">
      <div class="service-content">
        <div class="service-intro-content">
         <div class="service-intro-iconll"> 
          <img src="images/bank-account-opening11.png" alt="Bank account opening service icon">
          </div>
          <h3 class="ts-title">
            <a href="#">Bank Account Opening </a>
          </h3>
          <p>Bank account opening involves verifying identity, providing.






</p>
          <a href="#" class="read-more">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </a> 
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="service-wrap style2 style3 mb-5" style="background-image: url(images/case_8.jpg)">
      <div class="service-content">
        <div class="service-intro-content">
           <div class="service-intro-iconll"> 
          <img src="images/tax-residency1111.png" alt="Tax residency service icon">
          </div>
          <h3 class="ts-title">
            <a href="#">Tax Residency  </a>
          </h3>
          <p> Residency Simplified: Start Your New Chapter in Georgia






</p>
          <a href="#" class="read-more">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </a> 
        </div>
      </div>
    </div>
  </div>









  <div class="col-lg-4">
    <div class="service-wrap style2 style3 mb-5" style="background-image: url(images/case_9.jpg)">
      <div class="service-content">
        <div class="service-intro-content">
           <div class="service-intro-iconll"> 
          <img src="images/nominee-services111.png" alt="Nominee services icon">
          </div>
          <h3 class="ts-title">
            <a href="nominee-services">Nominee Services </a>
          </h3>
          <p> Preserve Your Privacy While Meeting Legal Obligations







</p>
          <a href="nominee-services" class="read-more">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
          </a> 
        </div>
      </div>
    </div>
  </div>

 


</div>

</div>
</div>
 -->





            <!--     <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/remote-company-formation1.png" alt="Remote company formation" /> Remote Company Formation</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/bank-account-opening.png" alt="Bank account opening with company registration" /> Bank Account Opening with Company Registration</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/registered-companies1.png" alt="Bank accounts for registered companies" /> Bank Account Opening for Registered Companies</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li>
                                            <img src="images/vat-registration-assistance1.png" alt="VAT registration assistance" /> VAT Registration <br />
                                            Assistance
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/virtual-office-services.png" alt="Virtual office services" /> Virtual Office Services (Starting from...)</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/accounting-and-bookkeeping-support1.png" alt="Accounting and bookkeeping support" /> Accounting and Bookkeeping Support</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li>
                                            <img src="images/tax-advisory-services1.png" alt="Tax advisory services" /> Tax Advisory <br />
                                            Services
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/legal-compliance-consulting1.png" alt="Legal compliance consulting" />Legal Compliance Consulting</li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
            <!--      </div>
                </section> -->
            <!-- Service End -->





            <div class="new-sectionnn">

                <div class="container">



                    <div class="pbmit-heading-subheading text-center">
                        <!-- <h4 class="pbmit-subtitle">Why Set Up Business In georiga</h4> -->
                        <h2 class="pbmit-title">Other Services</h2>
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="new-boxxes">

                                <div class="dataa">
                                    <h4><a href="individual-entrepreneur" #jjjj">Individual Entrepreneur
                                        </a></h4>
                                    <p>Own Your Business, Maximize Your Profits with Tax Savings.</p>
                                    <a href="individual-entrepreneur" #jjjj" class="laernnn">Learn More</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="new-boxxes">

                                <div class="dataa">
                                    <h4><a href="accounting-and-taxation">Accounting & Bookkeeping</a></h4>
                                    <p>Accurate. Reliable. Compliant – Your Financial Partner in Georgia.

                                    </p>
                                    <a href="accounting-and-taxation" class="laernnn">Learn More</a>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-4">
                            <div class="new-boxxes">

                                <div class="dataa">
                                    <h4><a href="resident-permit">Resident Permit</a></h4>
                                    <p>Residency Simplified: Start Your New Chapter in Georgia.</p>
                                    <a href="resident-permit" class="laernnn">Learn More</a>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-4">
                            <div class="new-boxxes">

                                <div class="dataa">
                                    <h4><a href="bank-account-opening">Bank Account Opening</a></h4>
                                    <p>Effortless Banking Solutions for You and Your Business.</p>
                                    <a href="bank-account-opening" class="laernnn">Learn More</a>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-4">
                            <div class="new-boxxes">

                                <div class="dataa">
                                    <h4><a href="tax-residency">Tax Residency</a></h4>
                                    <p>Achieve Financial Freedom with Georgian Tax Residency.</p>
                                    <a href="tax-residency" class="laernnn">Learn More</a>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-4">
                            <div class="new-boxxes">

                                <div class="dataa">
                                    <h4><a href="nominee-services">Nominee Services</a></h4>
                                    <p>Preserve Your Privacy While Meeting Legal Obligations.</p>
                                    <a href="nominee-services" class="laernnn">Learn More</a>
                                </div>
                            </div>
                        </div>










                    </div>
                </div>



            </div>














            <!-- 

<div class="new-section-bannerrr" style="background-image:url(images/new-section-bg.jpg); background-attachment:fixed; background-size:cover; ">

<div class="container">
<div class="row">
<div class="col-md-12">
<div class="upperr">
<h2>Ready For Your Next Journey In  Georgia</h2>
</div>

</div>


</div>
<div class="row">

<div class="col-md-5">
<div class="lefttt"> <div class="iconns"><i class="fa fa-calendar" aria-hidden="true"></i></div>
<h3>Schedule a Free consultation</h3>
<p>Book Your Free 30-Minute Consultation Now and Let’s Get Started!</p>
<div class="new-bttnn">
<a href="">Free Consultation
</a>

</div>








</div>

</div>

<div class="col-md-2">
<div class="ceeennter">

<h4>OR</h4>
</div>
</div>


<div class="col-md-5">
<div class="lefttt">  <div class="iconns"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></div>
<h3>Get in touch with us Now</h3>
<p>We answer usually within one hour</p>
<div class="new-bttnn ss">
<a href="">Contact Us Now
</a>

</div>








</div>

</div>











</div>
</div>
</div>
 -->







            <?php include("includes/lead-form.php"); ?>



            <!-- Why Choose Us Start -->
            <section class="section-xl" style="background-color: #f7f7f7;">
                <div class="container">
                    <div class="row h11">
                        <div class="col-md-5">
                            <div class="why-choose-five-heading">
                                <div class="pbmit-heading-subheading">
                                    <h4 class="pbmit-subtitle">Why</h4>
                                    <h2 class="pbmit-title">Choose Legal Vista LLC?</h2>
                                </div>

                                <div class="aboutn">
                                    <p>
                                        We are a leading corporate law firm in Georgia, offering expert services in
                                        company registration, residency permits, accounting, taxation, and legal
                                        assistance for expatriates. We provide tailored solutions to ensure seamless
                                        business operations and compliance.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="aboottt">
                                        <p><strong>Expert Team</strong></p>
                                        <p> Our professionals are well-versed in Georgian accounting and tax laws,
                                            ensuring your business is always in compliance with local regulations.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="aboottt">
                                        <p><strong>Tailored Solutions</strong></p>
                                        <p>We understand that each business is unique. Our flexible packages are
                                            designed to fit your specific financial needs and scale as your business
                                            grows.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="aboottt">
                                        <p><strong>Trusted Compliance</strong></p>
                                        <p>With our comprehensive accounting and taxation services, you can focus on
                                            your business.

                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="aboottt">
                                        <p><strong>Effortless Financial Management</strong></p>
                                        <p>From bookkeeping to VAT management and payroll, we offer everything under
                                            one
                                            roof, so you never have to worry about your finances.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Why Choose Us End -->

            <!-- Testimonial Start -->



            <section class="inf-testimonial-section" style="
    padding-top: 65px;
    padding-bottom: 65px;
">
                <div class="container">
                    <h2 class="inf-testimonial-title">What People Say</h2>

                    <div class="swiper inf-swiper-container">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class="inf-testimonial-content">
                                    <div class="inf-quote-container">
                                        <p class="inf-testimonial-text">
                                            "I was worried about setting up a company in Georgia, but Legal Vista
                                            made
                                            the process so easy. They explained everything clearly and handled all
                                            the
                                            paperwork."
                                        </p>

                                    </div>

                                    <div class="inf-stars">★★★★★</div>

                                    <div class="inf-author-meta">
                                        <h3 class="inf-author-name">Marco G</h3>
                                        <p class="inf-author-location">Italy</p>
                                    </div>

                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="inf-testimonial-content">
                                    <div class="inf-quote-container">
                                        <p class="inf-testimonial-text">
                                            "I’ve worked with several law firms before, but Legal Vista really
                                            stands
                                            out. They respond quickly, explain things in simple terms, and don’t
                                            overcomplicate the process."
                                        </p>

                                    </div>
                                    <div class="inf-stars">★★★★★</div>
                                    <div class="inf-author-meta">
                                        <h3 class="inf-author-name">Farah M.</h3>
                                        <p class="inf-author-location">UAE</p>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="inf-testimonial-content">
                                    <div class="inf-quote-container">
                                        <p class="inf-testimonial-text">
                                            "Legal Vista is one of the few legal firms I’ve worked with that are
                                            completely
                                            transparent about their pricing and services. No hidden fees, no
                                            unnecessary
                                            delays—just honest, professional service."
                                        </p>

                                    </div>
                                    <div class="inf-stars">★★★★★</div>
                                    <div class="inf-author-meta">
                                        <h3 class="inf-author-name">Sophia L</h3>
                                        <p class="inf-author-location">Greece </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="inf-slider-controls inf-testimonial-controls">
                        <button type="button" class="inf-slider-button inf-testimonial-prev"
                            aria-label="Previous testimonial">&#8592;</button>
                        <button type="button" class="inf-slider-button inf-testimonial-next"
                            aria-label="Next testimonial">&#8594;</button>
                    </div>
                </div>
            </section>

            <!-- Testimonial End -->


            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

            <script>
            const swiper = new Swiper('.inf-swiper-container', {
                loop: true,
                speed: 1000,
                navigation: {
                    prevEl: '.inf-testimonial-prev',
                    nextEl: '.inf-testimonial-next',
                },
                effect: 'slide',
            });
            </script>



            <!-- Client Start -->
            <section class="client-section-seven pbmit-bg-color-blackish"
                style="background-image: url(images/footer-bg.png); background-attachment: fixed; background-size: cover;">
                <div class="container">
                    <div class="row align-items-center justify-content-center ">
                        <div class="col-md-9">
                            <div class="get">
                                <h4>
                                    Ready to Register your Company now?<br />

                                </h4>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="get">
                                <div class="btnnn">
                                    <a href="company-registration">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Client End -->





            <!-- Service Start -->



            <section class="inf-blog-section section-md">
                <div class="container">
                    <div class="inf-blog-header">
                        <div class="pbmit-heading-subheading text-center mb-5">
                            <h4 class="pbmit-subtitle">Latest Articles</h4>
                            <h2 class="pbmit-title" style="color: #022d58;">Georgia Legal Insights: Essential Updates
                            </h2>
                        </div>
                    </div>

                    <div class="swiper-container inf-main-swiper">
                        <div class="swiper-wrapper">
                            <?php if ($homepageArticles): ?>
                            <?php foreach ($homepageArticles as $article): ?>
                            <div class="swiper-slide">
                                <article class="inf-blog-item">
                                    <div class="inf-image-holder">
                                        <img src="<?php echo htmlspecialchars($article['image'], ENT_QUOTES, 'UTF-8'); ?>"
                                            alt="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <div class="inf-image-overlay"></div>
                                    </div>
                                    <div class="inf-blog-content">
                                        <?php if (!empty($article['date_text'])): ?>
                                        <span
                                            class="inf-date"><?php echo htmlspecialchars($article['date_text'], ENT_QUOTES, 'UTF-8'); ?></span>
                                        <?php endif; ?>
                                        <h5 class="inf-title"><a
                                                href="article.php?slug=<?php echo htmlspecialchars($article['slug'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></a>
                                        </h5>
                                        <?php if (!empty($article['excerpt'])): ?>
                                        <p class="inf-excerpt">
                                            <?php echo htmlspecialchars($article['excerpt'], ENT_QUOTES, 'UTF-8'); ?>
                                        </p>
                                        <?php endif; ?>
                                        <a class="inf-read-more"
                                            href="article.php?slug=<?php echo htmlspecialchars($article['slug'], ENT_QUOTES, 'UTF-8'); ?>">Read
                                            More</a>
                                    </div>
                                </article>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <div class="swiper-slide">
                                <article class="inf-blog-item">
                                    <div class="inf-blog-content">
                                        <h5 class="inf-title">Articles coming soon</h5>
                                        <p class="inf-excerpt">Check back shortly for our latest legal insights.</p>
                                    </div>
                                </article>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="inf-blog-actions">
                        <div class="inf-slider-controls inf-blog-controls">
                            <button type="button" class="inf-slider-button inf-blog-prev"
                                aria-label="Previous article">&#8592;</button>
                            <button type="button" class="inf-slider-button inf-blog-next"
                                aria-label="Next article">&#8594;</button>
                        </div>
                        <a class="inf-view-all-btn" href="articles-and-resources">View All Articles</a>
                    </div>
                </div>
            </section>

            <!-- Service End -->
        </div>
        <!-- Page Content End -->






        <!-- Footer -->
        <?php include("includes/footer.php"); ?>
        <!-- End  Footer-->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var blogSwiper = new Swiper('.inf-main-swiper', {
                loop: true,
                speed: 1000,
                navigation: {
                    prevEl: '.inf-blog-prev',
                    nextEl: '.inf-blog-next'
                },
                slidesPerView: 1,
                slidesPerGroup: 1,
                spaceBetween: 30,
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                        slidesPerGroup: 1
                    },
                    768: {
                        slidesPerView: 2,
                        slidesPerGroup: 1
                    },
                    1024: {
                        slidesPerView: 3,
                        slidesPerGroup: 1
                    }
                }
            });
        });
        </script>









        <!-- JS
         ============================================ -->
        <!-- jQuery JS -->
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

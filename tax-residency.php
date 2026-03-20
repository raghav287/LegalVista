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
    $mail->Subject="Tax Residency Form Submitted By : ".$name."";
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
        <title>Legal Vista Ltd -  Tax Residency Company in Tbilisi, Georgia</title>
<meta name="description" content="Legal Vista Ltd, a premier law firm founded in 2017, offers bespoke legal services to expatriates looking to set up base in Georgia. We offer a gamut of company start up services to kick start your business and assist in its growth. Limited Liability Company in Tbilisi, Georgia"/>
<meta name="keywords" content=  "Legal Vista Ltd, Limited Liability Company, Limited Liability Company in Tbilisi, Limited Liability Company in Georgia, Accounting & Taxation, Accounting & Taxation Company in Tbilisi, Accounting & Taxation Company in Georgia, Resident Permit, Resident Permit Company in Tbilisi, Resident Permit Company in Georgia , Bank Account Opening, Bank Account Opening Company in Tbilisi, Bank Account Opening Company in Georgia , Tax Residency, Tax Residency Company in Tbilisi, Tax Residency Company in Georgia, Nominee Services, Nominee Services Company in Tbilisi, Nominee Services Company in Georgia "/> 
<meta name="robots" content="all"/>
<meta name= "resource-type" content="document"/>
<meta name= "page-topic" content="Taxation Services"/>
<meta name= "clientbase" content="Global"/>
<meta name= "distribution" content="World Wide Web"/>
<meta name= "audience" content="all"/>
<link rel="canonical" href="https://legal-vista.com/" />
<meta name="rating" content="general"/>
<meta id="googlebot" name="googlebot" content="index, follow">
<meta name= "expires" content="never"/>
<meta name="bingbot" content=" index, follow " />
<meta name="revisit-after" content="Daily"/>
<meta name="author" content="Legal Vista Ltd">
<meta name="HandheldFriendly" content="True" />
<meta name="YahooSeeker" content="Index,Follow" />
<meta name="geo.region" content="GA" />
<meta name="State" content="Tbilisi" />
<meta name="City" content="Tbilisi" />
<meta name="subject" content="Rated #1 Legal Vista Ltd - Limited Liability Company in Tbilisi, Georgia"/>


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
    </head>
    <body>
        <!-- page wrapper -->
        <div class="page-wrapper">
            <!-- Footer -->
            <?php include("includes/header.php"); ?>
            <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabe4" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Submit Your Inquiry</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="popup-form">
          <form method="post" id="contact-form" action="tax-residency">
            <div class="row"> 
              
              <!-- Name -->
              <div class="col-md-12 col-lg-12">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
              </div>
              
              <!-- Email -->
              <div class="col-md-12 col-lg-12">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
              </div>
              
<div class="col-md-12 col-lg-12">

  <select name="service" id="service" class="form-control">
    
    <option value="Tax Residency">Tax Residency</option>
  
  </select>
</div>

         
              
              <!-- Message / Brief Description -->
              <div class="col-md-12">
                <textarea name="message" cols="40" rows="4" class="form-control" placeholder="Please describe your requirements or questions here." required></textarea>
              </div>
              
              <!-- Submit Button -->
              <div class="col-md-12 col-lg-12">
                <button type="submit" name="submit" class="pbmit-btn pbmit-btn-global pbmit-btn-shape-round w-100 jkl"> <i class="form-btn-loader fa fa-circle-o-notch fa-spin fa-fw margin-bottom d-none"></i> SEND MESSAGE </button>
              </div>
              
              <!-- Status Message -->
              <div class="col-md-12 col-lg-12 message-status"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
            <!-- End  Footer-->

            <!-- Title Bar -->
            <div class="pbmit-title-bar-wrapper">
                <div class="container">
                    <div class="pbmit-title-bar-content">
                        <div class="pbmit-title-bar-content-inner">
                            <div class="pbmit-tbar">
                                <div class="pbmit-tbar-inner container">
                                    <h1 class="pbmit-tbar-title">Tax Residency</h1>


     <h6 style="color: white; text-align: center; font-weight: 300; font-size: 17px;"> Achieve Financial Freedom with Georgian Tax Residency</h6>    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Title Bar End-->

<!-- About Us Start -->

<section class="about-us-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="about-page aboutttinfo ">

<img src="images/tax-residency.png" class="ringhtimg">  
   <h1>Tax Residency in Georgia</h1>
<p>The High Net Worth Georgian Tax Residency program offers a unique opportunity for individuals with an income exceeding 200,000 GEL (approx. 80,000 USD) or personal assets over 3 million GEL (approx. 1,200,000 USD) to secure tax residency in Georgia without the need to physically reside in the country.</p>



        <h4>Benefits of the Program</h4>

       <ul class="listtttt">
  <li><strong>No Physical Presence Requirement</strong> Bypass the  traditional 183-day physical presence requirement and take advantage of  Georgia’s favorable tax regime, including a flat 20% personal income tax rate.</li>
  <li><strong>Significant Tax Savings</strong> Relocating your  business and personal tax residency to Georgia can substantially reduce your  current tax liabilities, allowing you to optimize your financial strategy.</li>
</ul>



<h4>Who Can Benefit from the High Net Worth Program ?</h4>




      <ul class="listtttt">
  <li><strong>Remote Professionals</strong> Ideal for remote  professionals who travel frequently and do not spend enough time in any single  country to establish tax residency, yet wish to avoid taxation in their home  country.</li>
  <li><strong>Global Individuals</strong> Perfect for  individuals who lack tax residency in any country and have arrived in Georgia  late in the tax year, needing Georgian tax residency to prevent taxation  elsewhere.</li>
</ul>



                        <div class="boxxxx-shadood mb-5">
<h4>Who Is Eligible for Georgian Tax Residency Via the High Net Worth Program?</h4>
<p>The High Net Worth Program for Georgian tax residency is designed for individuals (natural persons) with significant property. The eligibility rules are as follows:</p>
<!-- <h6>Eligible Applicants</h6>



        <ul class="listtttt">
  <li>Citizens of Georgia</li>
  <li>Foreign citizens</li>
  <li>Stateless persons</li>
</ul> -->



<p><strong> Asset Requirements -</strong> To qualify, individuals must meet one of the following criteria:</p>
        <ul class="listtttt">
  <li>Own property valued at over 3  million GEL</li>
  <li>Have an annual income exceeding  200,000 GEL for the last three consecutive years (the years immediately  preceding the application year)</li>



  <li>Present proof of owning assets in  Georgia valued at 500,000 USD or more, as mandated by the Order of the Ministry  of Finance published in March 2023.</li>
</ul>

<p><strong>Other  Conditions</strong> Applicants must also:</p>

  <ul class="listtttt">
  <li>Possess a legal residence permit  or a Georgian resident ID card</li>
  <li>Certify receiving an income of  25,000 GEL or more from a Georgian source in the tax year before the  application year</li>
</ul>

</div>









<h6>What is Included in the Package:</h6>


  <ul class="listtttt mb-4">
  <li>Preparation of documents by  experts.</li>
  <li>Final Assessment of documents by  our top Immigration Lawyer.</li>
  <li>Personalized support with  application filing.</li>
 
  <li>Complete guidance and assistance  during the entire process.</li>
  <li>Government fees is not included in the Package</li>
</ul>


    



    <div class="package">
                          <div class="row cnt">
                            <div class="col-md-10">
                              <h5>Package Fee - EUR 1699</h5>
                            </div>
                            <div class="col-lg-2">
                              <div class="btnnnnnn">
                                <p><a href=""   data-bs-toggle="modal" data-bs-target="#exampleModal4"  class="price-button">ENQUIRE</a></p>
                              </div>
                            </div>
                          </div>
                        </div>










      </div>
    </div>
  </div>
</div>
</section>
<!-- About Us End --> 


            <?php $leadFormCompact = true; include("includes/lead-form.php"); ?>

            <!-- Footer -->
            <?php include("includes/footer.php"); ?>
            <!-- End  Footer-->

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
        </div>
    </body>
</html>

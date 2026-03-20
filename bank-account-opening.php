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
    $mail->Subject="Bank Account Opening  Form Submitted By : ".$name."";
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
        <title>Legal Vista Ltd - Bank Account Opening Company in Tbilisi, Georgia</title>
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
          <form method="post" id="contact-form" action="bank-account-opening">
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
   
   
    <option value="Bank Account Opening">Bank Account Opening</option>
   
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
                                    <h1 class="pbmit-tbar-title">Bank Account Opening</h1>

     <h6 style="color: white; text-align: center; font-weight: 300; font-size: 17px;"> Effortless Banking Solutions for You and Your Business</h6>

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
        <div class="about-page aboutttinfo "> <img src="images/bank-account-opening1.jpg" class="ringhtimg">
          <h1>Open a Corporate Bank Account in Georgia</h1>
          <p>Starting a company in Georgia is just the beginning. Most businesses need a proper bank account to run smoothly. Opening a business bank account has certain requirements, and these have become stricter. In the past, companies didn't need to do much business activity in Georgia to keep their accounts open. Now, banks want to see more activity happening in the country. If you meet these requirements, you'll get excellent service with modern banking features.  
            A local company can open a bank account in different currencies at the Bank of Georgia, TBC Bank, or other local banks. You can also open an account remotely with a power of attorney. </p>
          <h4>Benefits of a Business Bank Account in Georgia</h4>
          <ul class="listtttt">
            <li>Accounts in multiple currencies like USD, EUR, and GBP.</li>
            <li>Access to company MasterCard and Visa cards.</li>
            <li>Ability to open an account without traveling to Georgia.</li>
            <li>Advanced online banking services.</li>
          </ul>
       






  <p class="priceee jklll">Price: €490</p>





























        </div>
      </div>
    </div>

    <br>

    <br>


        <div class="row mb-5">
      <div class="col-md-6">
         
<div class="ss1 "> <img src="images/opening-a-company-bank-account-in-georgia.jpg" class="lefttimg">
   
</div>  


</div>    <div class="col-md-6">
         <div class="about-page aboutttinfo">

          <h1 class="a1">Open a Personal Bank Account in Georgia</h1>
          <p>You can open a bank account in Georgia remotely, without the need to visit the bank in person. Simply provide a Power of Attorney from a local notary office and get it apostilled, and mailed to us along with a notarized copy of your passport. There is no minimum initial deposit required to open the account. Individuals from all countries, except those under sanction, are eligible to open a personal bank account in Georgia.</p>
          <h4>Benefits of a Personal Georgian Bank Account</h4>
          <ul class="listtttt">
            <li><strong>Strong Financial Stability </strong>Georgian  banks are well-regulated, with high capital adequacy ratios around 16%,  ensuring low risk and stability.</li>
            <li><strong>Convenient Remote Access </strong>Accounts can  be opened remotely with a Power of Attorney, a feature not widely available  elsewhere, especially for non-residents.</li>
            <li><strong>Attractive Interest Rates </strong>Earn up to  11% on local currency deposits, 4.5% in USD, and 1% in EUR. Deposit insurance  is limited to GEL 15,000, but the banks' stability offers safety.</li>


            <li><strong>Investment Opportunities </strong>Access local  and international markets with competitive yields, including nearly 10%  annually in USD bonds. We can assist with setting up an investment account.</li>
        </ul>
             <p class="priceee jklll"  >Price: €490</p>

</div>
</div>
 
          <!--    <div class="package">
                          <div class="row cnt">
                            <div class="col-md-12">
          <h4>Ready to Take Advantage of Georgian Banking Benefits?</h4>
          <p>Open your Georgian bank account today to enjoy the benefits.  <a href="contact-us" >Contact Us</a> now to get started and maximize your banking experience in Georgia.</p>

         
                            </div>
                        
                          </div>
                        </div>-->





        </div>



<br><br>
 <div class="row">
<div class="col-md-12 aboutttinfo ">

<div class="package">
  <div class="row cnt">
    <div class="col-md-10">
      <h5>Ready to Take Advantage of Georgian Banking Benefits?</h5>
      <p> Open your Georgian bank account today. </p>
    </div>


      <div class="col-lg-2">
                              <div class="btnnnnnn">
                                <p><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal4"  class="price-button">ENQUIRE</a></p>
                              </div>
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

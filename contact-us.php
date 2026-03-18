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
	if(empty($name)){
		$error['name']="<span class='text-danger'>Name field is required</span>";	
	}

	$email=$_REQUEST['email'];	
	if(empty($email)){
		$error['email']="<span class='text-danger'>Email Id field is required</span>";	
	}
    $service=$_REQUEST['service'];
	if(empty($service)){
		$error['service']="<span class='text-danger'>Service  field is required</span>";	
	}
	$message=$_REQUEST['message']; 
	if(empty($message)){
		$error['message']="<span class='text-danger'>Message field is required</span>";	
	}
	
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
    $mail->Subject="Book Now Form Submitted By : ".$name."";
    if($mail->Send()){
        echo "<script>window.location='thanks.php'</script>";
    }
 }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
         <title>Legal Vista Ltd - Limited Liability Company in Tbilisi, Georgia</title>
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
       <!-- End  Footer-->










  <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper">
      <div class="container">
        <div class="pbmit-title-bar-content">
          <div class="pbmit-title-bar-content-inner">
            <div class="pbmit-tbar">
              <div class="pbmit-tbar-inner container">
                <h1 class="pbmit-tbar-title">Contact Us</h1>
              </div>
            </div>
         
          </div>
        </div>
      </div>
  </div>
    <!-- Title Bar End-->






      <!-- Contact Form -->
      <section>
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="contact-details">
                <div class="pbmit-heading-subheading">
                  <h4 class="pbmit-subtitle">GET IN TOUCH</h4>
                  <h2 class="pbmit-title">Contact Details</h2>
                </div>
                


                       <ul class="contactus-11">
                                        <li>
                                            <i class="fa fa-map-marker"></i><strong>Legal Vista Ltd</strong><br />
                     Regus Business Center, 2, Leonidze St., Liberty Square, Tbilisi 0105, Georgia
                                        </li>
                                        <li>
                                                <i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+995599848487"> +995 599848487</a> Mobile / Whatsapp
                                        </li>

                                        <li>
                                          
                                                <i class="fa fa-phone" aria-hidden="true"></i>  <a href="tel:+995599848486"> +995 599848486</a>
                                        </li>
                                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@legal-vista.com">info@legal-vista.com</a></li>
                                        <!-- <li><i class="fa fa-globe"></i><a href="https://www.legal-vista.com/">www.legal-vista.com</a></li> -->
                                    </ul>




              </div>
            </div>










<div class="col-md-6">
  <div class="contact-form">
    <div class="pbmit-heading-subheading">
      <h4 class="pbmit-subtitle">PLEASE Fill Form</h4>
      <h2 class="pbmit-title text-white">Do You Have Any Questions?</h2>
    </div>
        <form method="post" id="contact-form" action="">
            
                 <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                           <input name="name" type="text"  class="form-control" placeholder="Name *" value="<?php if(isset($name)){ echo $name; } ?>">
                        <?php if(isset($error['name'])){ echo $error['name']; }?>
                                        </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                 <input name="email" type="email" class="form-control"   placeholder="Email *" value="<?php if(isset($email)){ echo $email; } ?>">
                        <?php if(isset($error['email'])){ echo $error['email']; }?>
                                        </div>
                                </div>
                                
                                 
<div class="row clearfix">
                                        
                                 
                                  <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <select name="service" class="form-control">
  <option value="">--Select Service -- </option>
  <option value="Company Registration Packages" <?php if(isset($_POST['service']) && $_POST['service']=="Company Registration Packages"){ echo "selected='selected'";} ?>>Company Registration Packages</option>
 <option value="Accounting & Taxation" <?php if(isset($_POST['service']) && $_POST['service']=="Accounting & Taxation"){ echo "selected='selected'";} ?>>Accounting & Taxation</option>
 <option value="Resident Permit" <?php if(isset($_POST['service']) && $_POST['service']=="Resident Permit"){ echo "selected='selected'";} ?>>Resident Permit</option>
 <option value="Bank Account Opening" <?php if(isset($_POST['service']) && $_POST['service']=="Bank Account Opening"){ echo "selected='selected'";} ?>>Bank Account Opening</option>
 <option value="Tax Residency" <?php if(isset($_POST['service']) && $_POST['service']=="Tax Residency"){ echo "selected='selected'";} ?>>Tax Residency</option>
 <option value="Nominee Services" <?php if(isset($_POST['service']) && $_POST['service']=="Nominee Services"){ echo "selected='selected'";} ?>>Nominee Services</option>

</select>
                        <?php if(isset($error['service'])){ echo $error['service']; }?>
                                        </div>
                                </div>
                                
                                
                                <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            
                                             <textarea name="message" rows="4" class="form-control"  placeholder=" Message *"><?php if(isset($message)){ echo $message; } ?>
</textarea>
                        <?php if(isset($error['message'])){ echo $error['message']; }?>
                                            
                                
                                        </div>
                                        </div>

                




                                        <div class="row">
                                        <div class="col-md-12 col-lg-6">
                                            <button type="submit" class="pbmit-btn pbmit-btn-global pbmit-btn-shape-round w-100 jkl" name="submit">
                                                <i class="form-btn-loader fa fa-circle-o-notch fa-spin fa-fw margin-bottom d-none"></i>
                                                SEND MESSAGE
                                            </button>
                                        </div>
                                    </div>
                                </form>






  </div>
</div>





















          </div>
        </div>
      </section>
      <!-- Contact Form End -->
      
      <!-- Iframe -->
      <section>
        <div class="contact-section-iframe">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2979.287220175531!2d44.79618198885496!3d41.692734900000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40440cee48649a3f%3A0x825ebef640cfd9fc!2s2%20Giorgi%20Leonidze%20St%2C%20T&#39;bilisi%2C%20Georgia!5e0!3m2!1sen!2sin!4v1721134458221!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </section>
      <!-- Iframe End -->









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
      
    </body>
</html>

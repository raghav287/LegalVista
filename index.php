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







            <div class="banner">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/bannerswwww.jpg" class="d-block w-100" alt="..." />
                          
                          <div  class="container">

                            <div class="row">
                                <div class="col-md-12">
                                      <div class="carousel-caption bannertext d-md-block  text-left    align-items-left">
                                <h1>Register Your Georgian Company  </h1>
                           
                                <h6>With Our Expert Guidance Today</h6>

                                <h2>Packages Starting As Low As 499 Euros</h2>

                                <h5>No Hidden Costs or Last Minute Surprises</h5>

                                <div class="btnnn">
                                    <a href="company-registration.php" class="pbmit-btn pbmit-btn-global">
                                       
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
  <div   class="row">
    <div class="pbmit-ptable-column-w col-md-12 col-lg-3 ">
      <div class="pbmit-ptable-column-inner  ">
        <div class="pbmit-ptablebox pbmit-ptablebox-style-1">
          <div class="pbmit-ptable-main">
            <h3 class="pbmit-ptable-heading">Bronze</h3>
            <div class="pbmit-sep"></div>
          
          </div>
          <div class="pbmit-ptablebox-colum pbmit-ptablebox-featurebox min-heightt">


            

         <h6 class="servicessss">Services</h6>




            <ul class="list-style-two jklllll">
              <li>Limited Liability Company (LLC)
Registration in 24 Hours</li>
              <li>Certificate of Incorporation</li>
              <li>Legal Address for 1 year</li>
              <li>All Govt. Fees & Charges</li>
            </ul>
          </div>


                <h6 class="servicessss pr-555">Price</h6>









            <div class="pbmit-ptable-price-w">
              <div class="pbmit-ptable-price kkk">€499</div>
              <!-- <div class="pbmit-ptable-cur-symbol-after">€</div> -->
              <!-- <div class="pbmit-ptable-frequency">EUR</div> -->
            </div>


          <div class="pbmit-vc_btn3-container pbmit-vc_btn3-inline"> <a class="pbmit-vc_general pbmit-vc_btn3 pbmit-vc_btn3-size-md"  href="company-registration.php" title="">Select Package</a> </div>
        </div>
      </div>
    </div>
    <div class="pbmit-ptable-column-w col-md-12 col-lg-3  pbmit-ptablebox-featured-col">
      <div class="pbmit-ptable-column-inner ">
        <div class="absoult">
          <h6>  Most Popular <i class="fa fa-star" aria-hidden="true"></i> </h6>
        </div>
        <div class="pbmit-ptablebox pbmit-ptablebox-style-1">
          <div class="pbmit-ptable-main">
            <h3 class="pbmit-ptable-heading">Silver</h3>
            <div class="pbmit-sep"></div>
          
          </div>
          <div class="pbmit-ptablebox-colum pbmit-ptablebox-featurebox min-heightt">

                     <h6 class="servicessss">Services</h6>
            <ul class="list-style-two jklllll active">
              <li>Limited Liability Company (LLC)
Registration in 24 Hours
</li>
              <li>Certificate of Incorporation</li>
              <li>Legal Address for 1 year</li>
              <li>All Govt. Fees & Charges</li>
              <li>Registration of Company with
Georgian Revenue Service
</li>
            </ul>
          </div>



    <h6 class="servicessss pr-555">Price</h6>




            <div class="pbmit-ptable-price-w">
              <div class="pbmit-ptable-price kkk">€799</div>
              <!-- <div class="pbmit-ptable-cur-symbol-after">€</div> -->
              <!-- <div class="pbmit-ptable-frequency">EUR</div> -->
            </div>

          <div class="pbmit-vc_btn3-container pbmit-vc_btn3-inline"> <a class="pbmit-vc_general pbmit-vc_btn3 pbmit-vc_btn3-size-md jklllllllll"   href="company-registration.php" title="">Select Package</a> </div>
        </div>
      </div>
    </div>
    <div class="pbmit-ptable-column-w col-md-12 col-lg-3 ">
      <div class="pbmit-ptable-column-inner ">
        <div class="pbmit-ptablebox pbmit-ptablebox-style-1">
          <div class="pbmit-ptable-main">
            <h3 class="pbmit-ptable-heading">Gold</h3>
            <div class="pbmit-sep"></div>
        
          </div>
          <div class="pbmit-ptablebox-colum pbmit-ptablebox-featurebox min-heightt">

                     <h6 class="servicessss">Services</h6>
            <ul class="list-style-two jklllll">
              <li>Limited Liability Company (LLC)
Registration in 24 Hours
</li>
              <li>Certificate of Incorporation</li>
              <li>Legal Address for 1 year</li>
              <li>All Govt. Fees & Charges</li>
              <li>Registration of Company with
Georgian Revenue Service
</li>
              <li>VAT Registration</li>
              <li>Corporate Bank Account</li>
            </ul>
          </div>






        <h6 class="servicessss pr-555">Price</h6>



              <div class="pbmit-ptable-price-w">
              <div class="pbmit-ptable-price kkk">€1,199</div>
           <!--    <div class="pbmit-ptable-cur-symbol-after">€</div>
              <div class="pbmit-ptable-frequency">EUR</div> -->
            </div>


          <div class="pbmit-vc_btn3-container pbmit-vc_btn3-inline"> <a class="pbmit-vc_general pbmit-vc_btn3 pbmit-vc_btn3-size-md"  href="company-registration.php" title="">Select Package</a> </div>
        </div>
      </div>
    </div>
    <div class="pbmit-ptable-column-w col-md-12 col-lg-3 ">
      <div class="pbmit-ptable-column-inner ">
        <div class="pbmit-ptablebox pbmit-ptablebox-style-1">
          <div class="pbmit-ptable-main">
            <!--<div class="pbmit-ptable-icon">
              <div class="pbmit-sbox-icon-wrapper"><i class=""></i></div>
            </div>-->
            <h3 class="pbmit-ptable-heading">Platinum</h3>
            <div class="pbmit-sep"></div>
         
          </div>
          <div class="pbmit-ptablebox-colum pbmit-ptablebox-featurebox min-heightt">






                     <h6 class="servicessss">Services</h6>


            <ul class="list-style-two jklllll">
              <li>Limited Liability Company (LLC)
Registration in 24 Hours</li>
              <li>Certificate of Incorporation</li>
              <li>Legal Address for 1 year</li>
              <li>All Govt. Fees & Charges</li>
              <li>Registration of Company with
Georgian Revenue Service</li>
              <li>VAT Registration</li>
              <li>Corporate Bank Account</li>
              <li>Monthly Tax Filing for 1 year</li>
            </ul>
          </div>

          
                     <h6 class="servicessss pr-555">Price</h6>





             <div class="pbmit-ptable-price-w">

              <div class="pbmit-ptable-price kkk">€1,599</div>
       <!--        <div class="pbmit-ptable-cur-symbol-after">€</div>
              <div class="pbmit-ptable-frequency">EUR</div> -->
            </div>


          <div class="pbmit-vc_btn3-container pbmit-vc_btn3-inline"> <a class="pbmit-vc_general pbmit-vc_btn3 pbmit-vc_btn3-size-md"  href="company-registration.php" title="">Select Package</a> </div>
        </div>
      </div>
    </div>
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
                <img src="images/7th-in-the-world1.png">

                  </div>
       
              <h3><a href="#">Ease of Doing Business  Ranked 7th in the World</a></h3>
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
              <div class="pbmit-ihbox-icon">  <img src="images/low-tax-rate1.png">  </div>
        
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
              <div class="pbmit-ihbox-icon">  <img src="images/free-trade-agreement-with-eu1.png"> </div>
              
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
              <div class="pbmit-ihbox-icon">  <img src="images/premium-corporate-banking-services.png">  </div>
             
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
                                        <img src="images/about-img.jpg" class="img-fluid" alt="" />
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
        <img src="images/sole-proprietorship1.png">
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
          <img src="images/accounting-and-bookkeeping1.png">
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
          <img src="images/resident-----permit.png">
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
          <img src="images/bank-account-opening11.png">
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
          <img src="images/tax-residency1111.png">
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
          <img src="images/nominee-services111.png">
          </div>
          <h3 class="ts-title">
            <a href="nominee-services.php">Nominee Services </a>
          </h3>
          <p> Preserve Your Privacy While Meeting Legal Obligations







</p>
          <a href="nominee-services.php" class="read-more">
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
                                        <li><img src="images/remote-company-formation1.png" /> Remote Company Formation</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/bank-account-opening.png" /> Bank Account Opening with Company Registration</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/registered-companies1.png" /> Bank Account Opening for Registered Companies</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li>
                                            <img src="images/vat-registration-assistance1.png" /> VAT Registration <br />
                                            Assistance
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/virtual-office-services.png" /> Virtual Office Services (Starting from...)</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/accounting-and-bookkeeping-support1.png" /> Accounting and Bookkeeping Support</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li>
                                            <img src="images/tax-advisory-services1.png" /> Tax Advisory <br />
                                            Services
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="box11">
                                    <ul class="bobbbb">
                                        <li><img src="images/legal-compliance-consulting1.png" />Legal Compliance Consulting</li>
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
<h4><a href="company-registration.php#jjjj">Sole Proprietorship</a></h4>
<p>Own Your Business, Maximize Your Profits with Tax Savings.</p>
 <a href="company-registration.php#jjjj" class="laernnn">Learn More</a>
</div>
</div>
</div>

    <div class="col-md-4">
<div class="new-boxxes">

    <div class="dataa">
<h4><a href="accounting-and-taxation.php">Accounting & Bookkeeping</a></h4>
<p>Accurate. Reliable. Compliant – Your Financial Partner in Georgia.

</p> 
<a href="accounting-and-taxation.php" class="laernnn">Learn More</a>
</div>
</div>
</div>




    <div class="col-md-4">
<div class="new-boxxes">

    <div class="dataa">
<h4><a href="resident-permit.php">Resident Permit</a></h4>
<p>Residency Simplified: Start Your New Chapter in Georgia.</p> 
<a href="resident-permit.php" class="laernnn">Learn More</a>
</div>
</div>
</div>




    <div class="col-md-4">
<div class="new-boxxes">

    <div class="dataa">
<h4><a href="bank-account-opening.php">Bank Account Opening</a></h4>
<p>Effortless Banking Solutions for You and Your Business.</p> 
<a href="bank-account-opening.php" class="laernnn">Learn More</a>
</div>
</div>
</div>




    <div class="col-md-4">
<div class="new-boxxes">

    <div class="dataa">
<h4><a href="tax-residency.php">Tax Residency</a></h4>
<p>Achieve Financial Freedom with Georgian Tax Residency.</p> 
<a href="tax-residency.php" class="laernnn">Learn More</a>
</div>
</div>
</div>




    <div class="col-md-4">
<div class="new-boxxes">

    <div class="dataa">
<h4><a href="nominee-services.php">Nominee Services</a></h4>
<p>Preserve Your Privacy While Meeting Legal Obligations.</p> 
<a href="nominee-services.php" class="laernnn">Learn More</a>
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



<!-- Contact Form -->
            <section >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="contact-details">
                                <div class="pbmit-heading-subheading">
                                    <h4 class="pbmit-subtitle">GET IN TOUCH</h4>
                                    <h2 class="pbmit-title">Prepare for<br>  Your Next Step in Georgia!

</h2>
                                </div>
        



<div class="tettttt">



        <p>Schedule your <strong>free 30-minute consultation today</strong>, and let us assist you in planning a tailored solution that meets your specific needs. Whether you are considering relocation, exploring investment opportunities, or seeking legal guidance on Georgian regulations, our experienced team is here to provide comprehensive support.<br><br>

We typically respond within one hour, ensuring timely communication as we guide you through every step of the process.</p>


    
</div>





                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-form jklll">
                                <div class="pbmit-heading-subheading">
                                    <h4 class="pbmit-subtitle">PLEASE Fill Form</h4>
                                    <h2 class="pbmit-title text-white">Get In Touch With Us Now

</h2>


                                </div>


                                <form method="post" id="contact-form" action="index.php">
                                    
                 <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                           <input name="name" type="text"  class="form-control" placeholder="Name *" value="<?php if(isset($name)){ echo $name; } ?>" required>
                        <?php if(isset($error['name'])){ echo $error['name']; }?>
                                        </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                 <input name="email" type="email" class="form-control"   placeholder="Email *" value="<?php if(isset($email)){ echo $email; } ?>" required>
                        <?php if(isset($error['email'])){ echo $error['email']; }?>
                                        </div>
                                </div>
                                
                                 
<div class="row clearfix">
                                        
                                 
                                  <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <select name="service" class="form-control" required>
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
                                            
                                             <textarea name="message" rows="4" class="form-control"  placeholder=" Message *" required><?php if(isset($message)){ echo $message; } ?>
</textarea>
                        <?php if(isset($error['message'])){ echo $error['message']; }?>
                                            
                                
                                        </div>
                                        </div>
 <div class="row clearfix">
                
                                        <div class="col-md-12 col-lg-6">
                                            <button type="submit" name="submit" class="pbmit-btn pbmit-btn-global pbmit-btn-shape-round w-100 jkl">
                                                <i class="form-btn-loader fa fa-circle-o-notch fa-spin fa-fw margin-bottom d-none"></i>
                                                SEND MESSAGE
                                            </button>
                                        </div>
                                        <div class="col-md-12 col-lg-12 message-status"></div>
                                    </div>
                                </form>
















                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Contact Form End -->






                <!-- Why Choose Us Start -->
                <section class="section-xl"  style="background-color: #f7f7f7;">
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
                                        We are a leading corporate law firm in Georgia, offering expert services in company registration, residency permits, accounting, taxation, and legal assistance for expatriates. We provide tailored solutions to ensure seamless business operations and compliance.
</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="aboottt">
                                            <p><strong>Expert Team</strong></p>
                                            <p> Our professionals are well-versed in Georgian accounting and tax laws, ensuring your business is always in compliance with local regulations.
</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="aboottt">
                                            <p><strong>Tailored Solutions</strong></p>
                                            <p>We understand that each business is unique. Our flexible packages are designed to fit your specific financial needs and scale as your business grows.
</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="aboottt">
                                            <p><strong>Trusted Compliance</strong></p>
                                            <p>With our comprehensive accounting and taxation services, you can focus on your business.

</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="aboottt">
                                            <p><strong>Effortless Financial Management</strong></p>
                                            <p>From bookkeeping to VAT management and payroll, we offer everything under one roof, so you never have to worry about your finances.
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
                <section class="section-md testimonial-five" style="background: #f9f5eb; background-attachment:fixed; background-size:cover;">
                    <div class="container">
                        <div class="row">
                            <div class="pbmit-heading-subheading-style-1 text-white">
                                <!--<h4 class="pbmit-subtitle" style="text-align: center;"> Testimonials</h4>-->
                                <h2 class="pbmit-title" style="color: #022d58;text-align: center;">What People Say</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="swiper-slider" data-loop="true" data-autoplay="true" data-dots="true" data-arrows="false" data-columns="1" data-margin="30" data-effect="slide">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <!-- Slide1 -->
                                            <article class="pbmit-box-testimonial pbmit-testimonialbox-style-5">
                                                <div class="pbmit-post-item">
                                                    <div class="pbmit-box-content">
                                                        
                                                        <div class="pbmit-box-desc">
                                                            <blockquote class="pbmit-testimonial-text">
                                                          I was worried about setting up a company in Georgia, but Legal Vista made the
process so easy. They explained everything clearly and handled all the
paperwork. I had my company registered in just a few days without any hassle!
                                                            </blockquote>
                                                        </div>

 <div class="pbmit-box-star">
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                        </div>



                                                    </div>
                                                    <div class="pbmit-box-author">
                                                        <div class="pbmit-box-title jklllll">
                                                            <h3 class="pbmit-author-name">Marco G</h3>
                                                            <span class="pbmit-box-footer jkll">Italy </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="swiper-slide">
                                            <!-- Slide2 -->
                                            <article class="pbmit-box-testimonial pbmit-testimonialbox-style-5">
                                                <div class="pbmit-post-item">
                                                    <div class="pbmit-box-content">
                                                         
                                                        <div class="pbmit-box-desc">
                                                            <blockquote class="pbmit-testimonial-text">
                                                         "I’ve worked with several law firms before, but Legal Vista really stands out. They
respond quickly, explain things in simple terms, and don’t overcomplicate the
process. If you need legal help in Georgia, these are the people to go to.
                                                            </blockquote>
                                                        </div>


<div class="pbmit-box-star">
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                        </div>




                                                    </div>
                                                    <div class="pbmit-box-author">
                                                        <div class="pbmit-box-title jklllll">
                                                            <h3 class="pbmit-author-name"> Farah M.</h3>
                                                            <span class="pbmit-box-footer jkll">UAE </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="swiper-slide">
                                            <!-- Slide3 -->
                                            <article class="pbmit-box-testimonial pbmit-testimonialbox-style-5">
                                                <div class="pbmit-post-item">
                                                    <div class="pbmit-box-content">
                                                      
                                                        <div class="pbmit-box-desc">
                                                            <blockquote class="pbmit-testimonial-text">
                                                        Legal Vista is one of the few legal firms I’ve worked with that are completely
transparent about their pricing and services. No hidden fees, no unnecessary
delays—just honest, professional service.
                                                            </blockquote>
                                                        </div>

   <div class="pbmit-box-star">
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                        </div>

                                                    </div>
                                                    <div class="pbmit-box-author">
                                                        <div class="pbmit-box-title jklllll">
                                                            <h3 class="pbmit-author-name">Sophia L</h3>
                                                            <span class="pbmit-box-footer jkll">Greece </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>






                                          <div class="swiper-slide">
                                            <!-- Slide3 -->
                                            <article class="pbmit-box-testimonial pbmit-testimonialbox-style-5">
                                                <div class="pbmit-post-item">
                                                    <div class="pbmit-box-content">
                                                      
                                                        <div class="pbmit-box-desc">
                                                            <blockquote class="pbmit-testimonial-text">
                                     I bought property in Georgia with the help of Legal Vista, and their team made sure
everything was legally sound. They handled the paperwork and contracts with
professionalism. I felt completely secure throughout the process.
                                                            </blockquote>
                                                        </div>

   <div class="pbmit-box-star">
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                            <i class="pbmit-base-icon-star pbmit-skincolor pbmit-active"></i>
                                                        </div>

                                                    </div>
                                                    <div class="pbmit-box-author">
                                                        <div class="pbmit-box-title jklllll">
                                                            <h3 class="pbmit-author-name">Stefan B.</h3>
                                                            <span class="pbmit-box-footer jkll">Germany </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Testimonial End -->

                <!-- Client Start -->
                <section class="client-section-seven pbmit-bg-color-blackish" style="background-image: url(images/footer-bg.png); background-attachment: fixed; background-size: cover;">
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
                                        <a href="company-registration.php">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Client End -->

 



                <!-- Service Start -->
                <section class="section-md">
                    <div class="container">
                        <div class="pbmit-heading-subheading text-center">
                            <h4 class="pbmit-subtitle">Latest Articles </h4>
                            <h2 class="pbmit-title"> Georgia Legal Insights: Essential Updates You Need to Know</h2>
                        </div>

                        <div class="swiper-slider" data-loop="true" data-autoplay="true" data-dots="true" data-arrows="false" data-columns="3" data-margin="30" data-effect="slide" data-speed="990000">
                            <div class="swiper-wrapper">

                               <div class="swiper-slide">
  <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3">
    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
      <article class="blog-item swiper-slide">
        <div class="holder">
          <div class="bg-overlay"></div>



          <div class="post-thumbnail" style="position:relative">
          <img src="images/georgias-new-work-permit-regime.jpg" class="img-fluid" alt="" />
  <div style="      position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(344deg, #00265e 0%, #016fb900 100%); */
    background: linear-gradient(2deg, #133158 0%, /* Original deep blue (start) */ #133158 30%, /* New midpoint 1 (richer blue) */ #133158b3 60%, /* New midpoint 2 (bright transition) */ #016fb952 100% /* Original transparent teal (end) */);">
  </div>
</div>



          <div class="content-area">
            <span class="date">October 15, 2025 </span>
            <h5><a href="georgias-new-work-permit-regime.php" class="blog-title-link">Georgia’s New Work Permit Regime from March 2026:

</a></h5>
            <p>Georgia has long been known for its open-door business policies ...</p>
            <a class="read" href="georgias-new-work-permit-regime.php">Read More</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>


 <div class="swiper-slide">
  <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3">
    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
      <article class="blog-item swiper-slide">
        <div class="holder">
          <div class="bg-overlay"></div>



          <div class="post-thumbnail" style="position:relative">
          <img src="images/temporary-residence-permit-changes-202526.jpg" class="img-fluid" alt="" />
  <div style="      position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(344deg, #00265e 0%, #016fb900 100%); */
    background: linear-gradient(2deg, #133158 0%, /* Original deep blue (start) */ #133158 30%, /* New midpoint 1 (richer blue) */ #133158b3 60%, /* New midpoint 2 (bright transition) */ #016fb952 100% /* Original transparent teal (end) */);">
  </div>
</div>



          <div class="content-area">
            <span class="date">October 15, 2025 </span>
            <h5><a href="temporary-residence-permit-changes-202526.php" class="blog-title-link">Temporary Residence Permit Changes 2025–26: New Rules for Entrepreneurs, Investors, and IT Specialists in Georgia


</a></h5>
            <p>Georgia has positioned itself as one of the most  ...</p>
            <a class="read" href="temporary-residence-permit-changes-202526.php">Read More</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>

                               <div class="swiper-slide">
  <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3">
    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
      <article class="blog-item swiper-slide">
        <div class="holder">
          <div class="bg-overlay"></div>



          <div class="post-thumbnail" style="position:relative">
          <img src="images/new-aml-compliance-rules-for-company.jpg" class="img-fluid" alt="" />
  <div style="      position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(344deg, #00265e 0%, #016fb900 100%); */
    background: linear-gradient(2deg, #133158 0%, /* Original deep blue (start) */ #133158 30%, /* New midpoint 1 (richer blue) */ #133158b3 60%, /* New midpoint 2 (bright transition) */ #016fb952 100% /* Original transparent teal (end) */);">
  </div>
</div>



          <div class="content-area">
            <span class="date">August 05, 2025 </span>
            <h5><a href="new-aml-compliance-rules-for-company.php" class="blog-title-link">New AML Compliance Rules for Company Formation in Georgia (2025 Update)


</a></h5>
            <p>New AML Compliance Rules for Company Formation in Georgia (2025 Update).....</p>
            <a class="read" href="new-aml-compliance-rules-for-company.php">Read More</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>

                               <div class="swiper-slide">
  <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3">
    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
      <article class="blog-item swiper-slide">
        <div class="holder">
          <div class="bg-overlay"></div>



          <div class="post-thumbnail" style="position:relative">
          <img src="images/georgia-is-easy-until-it-isnt.jpg" class="img-fluid" alt="" />
  <div style="      position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(344deg, #00265e 0%, #016fb900 100%); */
    background: linear-gradient(2deg, #133158 0%, /* Original deep blue (start) */ #133158 30%, /* New midpoint 1 (richer blue) */ #133158b3 60%, /* New midpoint 2 (bright transition) */ #016fb952 100% /* Original transparent teal (end) */);">
  </div>
</div>



          <div class="content-area">
            <span class="date">August 05, 2025 </span>
            <h5><a href="georgia-is-easy-until-it-isnt.php" class="blog-title-link">Georgia is Easy—Until It Isn’t:A Lawyer’s View on What Can Go Wrong

</a></h5>
            <p>Georgia has become a magnet for entrepreneurs, remote workers, investors, and lifestyle.....</p>
            <a class="read" href="georgia-is-easy-until-it-isnt.php">Read More</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>


  <div class="swiper-slide">
  <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3">
    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
      <article class="blog-item swiper-slide">
        <div class="holder">
          <div class="bg-overlay"></div>



          <div class="post-thumbnail" style="position:relative">
          <img src="images/got-denied-a-residence-permit-in-georgia.jpg" class="img-fluid" alt="" />
  <div style="      position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(344deg, #00265e 0%, #016fb900 100%); */
    background: linear-gradient(2deg, #133158 0%, /* Original deep blue (start) */ #133158 30%, /* New midpoint 1 (richer blue) */ #133158b3 60%, /* New midpoint 2 (bright transition) */ #016fb952 100% /* Original transparent teal (end) */);">
  </div>
</div>



          <div class="content-area">
            <span class="date">August 05, 2025 </span>
            <h5><a href="got-denied-a-residence-permit-in-georgia.php" class="blog-title-link">Got Denied a Residence Permit in Georgia?
</a></h5>
            <p>Got Denied a Residence Permit in Georgia? Here’s What
You Need to Do Next.....</p>
            <a class="read" href="got-denied-a-residence-permit-in-georgia.php">Read More</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>


 <div class="swiper-slide">
  <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3">
    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
      <article class="blog-item swiper-slide">
        <div class="holder">
          <div class="bg-overlay"></div>



          <div class="post-thumbnail" style="position:relative">
          <img src="images/low-tax-jurisdiction-why-entrepreneurs-are-moving-to-georgia.jpg" class="img-fluid" alt="" />
  <div style="      position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(344deg, #00265e 0%, #016fb900 100%); */
    background: linear-gradient(2deg, #133158 0%, /* Original deep blue (start) */ #133158 30%, /* New midpoint 1 (richer blue) */ #133158b3 60%, /* New midpoint 2 (bright transition) */ #016fb952 100% /* Original transparent teal (end) */);">
  </div>
</div>



          <div class="content-area">
            <span class="date">May 31, 2025 </span>
            <h5><a href="moving-to-georgia-with-your-family.php" class="blog-title-link">Moving to Georgia with Your Family: What You Need to Know
</a></h5>
            <p>Thinking about moving to Georgia with your family? You're not alone.....</p>
            <a class="read" href="moving-to-georgia-with-your-family.php">Read More</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>

<div class="swiper-slide">
  <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3">
    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
      <article class="blog-item swiper-slide">
        <div class="holder">
          <div class="bg-overlay"></div>


    
<div class="post-thumbnail" style="position:relative">
  <img src="images/how-to-become-a-tax-resident-in-georgia-a-2025-guide.jpg" class="img-fluid" alt="" />
  <div style="       position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(344deg, #00265e 0%, #016fb900 100%); */
    background: linear-gradient(2deg, #133158 0%, /* Original deep blue (start) */ #133158 30%, /* New midpoint 1 (richer blue) */ #133158b3 60%, /* New midpoint 2 (bright transition) */ #016fb952 100% /* Original transparent teal (end) */);">
  </div>
</div>


         
          <div class="content-area">
            <span class="date">May 31, 2025 </span>
            <h5><a href="how-to-become-a-tax-resident-in-georgia-a-2025-guide.php" class="blog-title-link">How to Become a Tax Resident in Georgia: A 2025 Guide</a></h5>
            <p>Georgia, the vibrant country at the crossroads of Europe and Asia, has rapidly emerged as an attractive.....</p>
            <a class="read" href="how-to-become-a-tax-resident-in-georgia-a-2025-guide.php">Read More</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>















<div class="swiper-slide">
  <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3">
    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
      <article class="blog-item swiper-slide">
        <div class="holder">
          <div class="bg-overlay"></div>

                 <div class="post-thumbnail" style="position:relative">
        
          <img src="images/the-side-hustle-series111.jpg" class="img-fluid" alt="" />
  <div style="        position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(344deg, #00265e 0%, #016fb900 100%); */
    background: linear-gradient(2deg, #133158 0%, /* Original deep blue (start) */ #133158 30%, /* New midpoint 1 (richer blue) */ #133158b3 60%, /* New midpoint 2 (bright transition) */ #016fb952 100% /* Original transparent teal (end) */);">
  </div>
</div>


          <div class="content-area">
            <span class="date">October 14, 2024</span>
            <h5><a href="compelling-reasons-to-register-your-business-in-georgia.php" class="blog-title-link">5 Compelling Reasons to Register Your Business</a></h5>
            <p>Thinking about registering a business in Georgia? You might be surprised at how easy it is.</p>
            <a class="read" href="compelling-reasons-to-register-your-business-in-georgia.php">Read More</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>






<div class="swiper-slide">
  <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3">
    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
      <article class="blog-item swiper-slide">
        <div class="holder">
          <div class="bg-overlay"></div>

                 <div class="post-thumbnail" style="position:relative">
        
   <img src="images/unlock-entrepreneurial-freedom1111.jpg" class="img-fluid" alt="" />
  <div style="        position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(344deg, #00265e 0%, #016fb900 100%); */
    background: linear-gradient(2deg, #133158 0%, /* Original deep blue (start) */ #133158 30%, /* New midpoint 1 (richer blue) */ #133158b3 60%, /* New midpoint 2 (bright transition) */ #016fb952 100% /* Original transparent teal (end) */);">
  </div>
</div>


       
          <div class="content-area">
            <span class="date">October 14, 2024</span>
            <h5><a href="unlock-entrepreneurial-freedom.php" class="blog-title-link">Unlock Entrepreneurial Freedom</a></h5>
            <p>Unlock Entrepreneurial Freedom: Why Georgia's 1% Tax for Individual Entrepreneurs Could be Your Golden Ticket</p>
            <a class="read" href="unlock-entrepreneurial-freedom.php">Read More</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>



<div class="swiper-slide">
  <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3">
    <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
      <article class="blog-item swiper-slide">
        <div class="holder">
          <div class="bg-overlay"></div>

               <div class="post-thumbnail" style="position:relative">
 <img src="images/ultimate-guide-to-georgias-tax-haven-for-digital-nomads11.jpg" class="img-fluid" alt="" />
  <div style="      position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(344deg, #00265e 0%, #016fb900 100%); */
    background: linear-gradient(2deg, #133158 0%, /* Original deep blue (start) */ #133158 30%, /* New midpoint 1 (richer blue) */ #133158b3 60%, /* New midpoint 2 (bright transition) */ #016fb952 100% /* Original transparent teal (end) */);">
  </div>
</div>




         
          <div class="content-area">
            <span class="date">October 14, 2024</span>
            <h5><a href="compelling-reasons-to-register-your-business-in-georgia.php" class="blog-title-link">The Ultimate Guide to Georgia's Tax </a></h5>
            <p>Are you a digital nomad or remote worker looking for a tax-friendly haven? Georgia might just be your next destination.</p>
            <a class="read" href="compelling-reasons-to-register-your-business-in-georgia.php">Read More</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>







<!-- 


                          <div class="swiper-slide">

      <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3"><div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;"> <article class="blog-item swiper-slide"><div class="holder"><div class="bg-overlay"></div><img src="images/unlock-entrepreneurial-freedom1111.jpg" class="img-fluid" alt="" /><div class="content-area"> <span class="date">October 14, 2024</span><h5>Unlock Entrepreneurial Freedom</h5><p>Unlock Entrepreneurial Freedom: Why Georgia's 1% Tax for Individual Entrepreneurs Could be Your Golden Ticket

</p><a class="read" href="unlock-entrepreneurial-freedom.php">Read More</a></div></div></article></div>
    </div>

  

 
                                </div>





                          <div class="swiper-slide">

      <div class="blog element-one swiper-container swiper-container-initialized swiper-container-horizontal" data-mobile-items="1" data-tab-items="2" data-desktop-items="3"><div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;"> <article class="blog-item swiper-slide"><div class="holder"><div class="bg-overlay"></div> <img src="images/ultimate-guide-to-georgias-tax-haven-for-digital-nomads11.jpg" class="img-fluid" alt="" /><div class="content-area"> <span class="date">October 14, 2024</span><h5>The Ultimate Guide to Georgia's Tax </h5><p>Are you a digital nomad or remote worker looking for a tax-friendly haven? Georgia might just be your next destination.</p><a class="read" href="compelling-reasons-to-register-your-business-in-georgia.php">Read More</a></div></div></article></div>
    </div>

  

 
                                </div> -->










                                <!--<div class="swiper-slide">
                                     
                                    <article class="pbmit-box-blog pbmit-blogbox-style-2">
                                        <div class="post-item">
                                            <div class="pbmit-blog-image-with-meta">
                                                <div class="pbmit-featured-wrapper pbmit-post-featured-wrapper">
                                                    <img src="images/sole-trader.jpg" class="img-fluid" alt="" />
                                                </div>
                                            </div>
                                            <div class="pbmit-box-content">
                                                <span class="pbmit-meta-line cat-links">
                                                    <a href="#">April 19, 2024 by Ankush Sharma</a>
                                                </span>
                                                <div class="pbmit-box-title">
                                                    <h4><a href="#">When Should I Change from a Sole Trader to an LTD? </a></h4>
                                                    <p>Many first-time business owners choose to set up as a sole trader over becoming....</p>
                                                </div>
                                                <div class="pbmit-blogbox-readmore">
                                                    <div class="pbmit-blogbox-footer-left">
                                                        <a href="#">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>

                                <div class="swiper-slide">
                                   
                                    <article class="pbmit-box-blog pbmit-blogbox-style-2">
                                        <div class="post-item">
                                            <div class="pbmit-blog-image-with-meta">
                                                <div class="pbmit-featured-wrapper pbmit-post-featured-wrapper">
                                                    <img src="images/the-side-hustle-series.jpg" class="img-fluid" alt="" />
                                                </div>
                                            </div>
                                            <div class="pbmit-box-content">
                                                <span class="pbmit-meta-line cat-links">
                                                    <a href="#">April 19, 2024 by Ankush Sharma</a>
                                                </span>
                                                <div class="pbmit-box-title">
                                                    <h4><a href="#">The Side Hustle Series: Co-Hosting on Airbnb, Our Handy Guide to What, Why and How.</a></h4>
                                                    <p>Today, we delve into the world of co-hosting. Are you interested in staging and....</p>
                                                </div>
                                                <div class="pbmit-blogbox-readmore">
                                                    <div class="pbmit-blogbox-footer-left">
                                                        <a href="#">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Service End -->
            </div>
            <!-- Page Content End -->






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

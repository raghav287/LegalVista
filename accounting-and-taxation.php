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
	$package_type=$_REQUEST['package_type'];
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
    $mail->Body="<p><strong>Name</strong> : $name<br/><strong>Email</strong>: $email<br/><strong>Package</strong>: $package<br/><strong>Message</strong>: $message</p>";
    $mail->Subject="Accounting & Taxation  Form Submitted By : ".$name."";
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
        <title>Legal Vista</title>
        <meta name="description" content="" />
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
    </style>
</head>
    <body>
        <!-- page wrapper -->
        <div class="page-wrapper">
            <!-- Footer -->
            <?php include("includes/header.php"); ?>
            
            <style>
            .enquiry-modal .modal-content{border-radius:18px;}
            .enquiry-modal .form-control{background:#f7f8fb;border:1px solid #dfe3ec;border-radius:12px;padding:12px 14px;color:#1a2433;}
            .enquiry-modal .form-control:focus{border-color:#3ea6ff;box-shadow:0 0 0 3px rgba(62,166,255,0.15);background:#fff;}
            .enquiry-modal .lead-submit-btn{background:linear-gradient(135deg,#f4c167 0%,#f0a73e 100%);color:#1f1407;border:none;border-radius:12px;letter-spacing:.8px;transition:transform .15s ease,box-shadow .2s ease;}
            .enquiry-modal .lead-submit-btn:hover{transform:translateY(-1px);box-shadow:0 14px 24px rgba(240,167,62,0.28);}
            .letter-sp-1{letter-spacing:.12rem;}
            </style>
            
            <div class="modal fade enquiry-modal" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <p class="text-muted small mb-3 d-flex align-items-center gap-2"><i class="fa fa-bolt text-warning"></i> Average response time: under 1 hour</p>
        <div class="popup-form">
          <form method="post" id="contact-form" action="backend/contact-form.php">
            <div class="row g-3"> 
              
              <div class="col-md-12 col-lg-6">
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Full name *" required>
              </div>
              
              <div class="col-md-12 col-lg-6">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Work email *" required>
              </div>
              
<div class="col-md-12 col-lg-12">
  <select name="package_type" id="package_type" class="form-control form-control-lg" required>
    <option value="">Select Package Type</option>
    <option value="Starter">Starter</option>
    <option value="Professional">Professional</option>
    <option value="Premium">Premium</option>
    <option value="Enterprise">Enterprise</option>
  </select>
</div>

              <div class="col-md-12">
                <textarea name="message" cols="40" rows="4" class="form-control form-control-lg" placeholder="Please describe your requirements or questions here." required></textarea>
              </div>
              
              <div class="col-md-12 col-lg-12">
                <button type="submit" name="submit" class="btn lead-submit-btn w-100 py-3 fw-bold text-uppercase"> <i class="form-btn-loader fa fa-circle-o-notch fa-spin fa-fw margin-bottom d-none"></i> Send message </button>
              </div>
              
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
                                    <h1 class="pbmit-tbar-title">Accounting & Taxation</h1>
                                    <p class="pbmit-tbar-desc">Accurate. Reliable. Compliant – Your Financial Partner in Georgia</p>
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




<p class="pb-5">At <strong>Legal  Vista LLC</strong>, we understand that managing your finances effectively is crucial for the success and growth of any business. Whether you're an entrepreneur, a small business owner, or a large corporation, navigating Georgia's accounting and tax regulations can be complex. Our team of experienced professionals is here to simplify the process, ensuring that your business complies with all local regulations while optimizing your tax position.<br><br>
With expertise in both Georgian tax law and international accounting standards, we offer tailored solutions to meet your specific needs. From ensuring accurate financial reporting to strategic tax planning, our goal is to help you stay focused on your core business while we handle your financial obligations seamlessly.</p>



<div class="pbmit-ptables-w wpb_content_element">
  <div class="row">
    <div class="pbmit-ptable-column-w col-md-12 col-lg-3 ">
      <div class="pbmit-ptable-column-inner  ">
        <div class="pbmit-ptablebox pbmit-ptablebox-style-1">
          <div class="pbmit-ptable-main">
            <h3 class="pbmit-ptable-heading">Starter</h3>
            <p class="ppp">Ideal for small businesses or individuals
              with minimal transactions and no VAT
              obligations.</p>
            <div class="pbmit-sep"> </div>
          </div>
          <div class="pbmit-ptablebox-colum pbmit-ptablebox-featurebox min-heightt1">
            <h6 class="servicessss">Services</h6>
            <ul class="list-style-two jklllll">
              <li><strong>Transactions : </strong> Up to 10 per month</li>
              <li><strong>Payroll: </strong> 2 employees</li>
              <li>Reporting to Statistics Department</li>
            </ul>
          </div>
          <h6 class="servicessss pr-555">Price</h6>
          <div class="pbmit-ptable-price-w">
            <div class="pbmit-ptable-price kkk">€59</div>
            <!-- <div class="pbmit-ptable-cur-symbol-after">€</div> --> 
            <div class="pbmit-ptable-frequency">/ month</div> 
            <p class="ppp">First quarter paid upfront.</p>
          </div>
          <div class="pbmit-vc_btn3-container pbmit-vc_btn3-inline"> <a class="pbmit-vc_general pbmit-vc_btn3 pbmit-vc_btn3-size-md open-modal-btn1" data-id="Starter" href="javascript:void(0)"> Select Package </a> </div>
        </div>
      </div>
    </div>
    <div class="pbmit-ptable-column-w col-md-12 col-lg-3  pbmit-ptablebox-featured-col">
      <div class="pbmit-ptable-column-inner ">
        <div class="absoult">
          <h6> Most Popular <i class="fa fa-star" aria-hidden="true"></i> </h6>
        </div>
        <div class="pbmit-ptablebox pbmit-ptablebox-style-1">
          <div class="pbmit-ptable-main">
            <h3 class="pbmit-ptable-heading">Professional</h3>
            <p class="ppp">Designed for growing businesses with
more transactions and payroll needs,
including basic VAT services.</p>
            <div class="pbmit-sep"></div>
          </div>
          <div class="pbmit-ptablebox-colum pbmit-ptablebox-featurebox min-heightt1">
            <h6 class="servicessss">Services</h6>
            <ul class="list-style-two jklllll active">
              <li><strong>Transactions:</strong>  Up to 25 per month</li>
              <li><strong>Payroll: </strong> 5 employees</li>
              <li><strong>VAT Transactions: </strong> Up to 10 per
month</li>
              <li>Reporting to Statistics Department</li>
              <li>Email support: 1 Hour per month for
accounting questions.</li>
            </ul>
          </div>
          <h6 class="servicessss pr-555">Price</h6>
          <div class="pbmit-ptable-price-w">
            <div class="pbmit-ptable-price kkk">€99</div>
            <!-- <div class="pbmit-ptable-cur-symbol-after">€</div> --> 
            <div class="pbmit-ptable-frequency">/ month</div>  

               <p class="ppp">First quarter paid upfront.</p>
          </div>
          <div class="pbmit-vc_btn3-container pbmit-vc_btn3-inline"> <a class="pbmit-vc_general pbmit-vc_btn3 pbmit-vc_btn3-size-md open-modal-btn1" data-id="Professional" href="javascript:void(0)"> Select Package </a> </div>
        </div>
      </div>
    </div>
    <div class="pbmit-ptable-column-w col-md-12 col-lg-3 ">
      <div class="pbmit-ptable-column-inner ">
        <div class="pbmit-ptablebox pbmit-ptablebox-style-1">
          <div class="pbmit-ptable-main">
            <h3 class="pbmit-ptable-heading">Premium</h3>
            <p class="ppp">Perfect for larger businesses with
complex accounting needs, multiple
employees, and regular VAT transactions.</p>
            <div class="pbmit-sep"></div>
          </div>
          <div class="pbmit-ptablebox-colum pbmit-ptablebox-featurebox min-heightt1">
            <h6 class="servicessss">Services</h6>
            <ul class="list-style-two jklllll">
              <li><strong>Transactions:</strong>  Up to 60 per month</li>
              <li><strong>Payroll: </strong> 15 employees</li>
              <li><strong>VAT Transactions:</strong>  Up to 30 per
month</li>
              <li>Reporting to Statistics Department</li>
              <li>Email support: 3 Hours per month
for accounting questions. </li>
              <li>Tax Advice</li>
            </ul>
          </div>
          <h6 class="servicessss pr-555">Price</h6>
          <div class="pbmit-ptable-price-w">
            <div class="pbmit-ptable-price kkk">€149</div>
            <!--    <div class="pbmit-ptable-cur-symbol-after">€</div>--> 

              <div class="pbmit-ptable-frequency">/ month</div>   

      <p class="ppp">First quarter paid upfront.</p>
                      </div>
          <div class="pbmit-vc_btn3-container pbmit-vc_btn3-inline"> <a class="pbmit-vc_general pbmit-vc_btn3 pbmit-vc_btn3-size-md open-modal-btn1" data-id="Premium" href="javascript:void(0)"> Select Package </a> </div>
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
            <h3 class="pbmit-ptable-heading">Enterprise</h3>
            <p class="ppp">Designed for established businesses with
high transaction volumes and complex
accounting needs.</p>
            <div class="pbmit-sep"></div>
          </div>
          <div class="pbmit-ptablebox-colum pbmit-ptablebox-featurebox min-heightt1">
            <h6 class="servicessss">Services</h6>
            <ul class="list-style-two jklllll">
              <li><strong>Transactions:</strong>  Unlimited</li>
              <li><strong>Payroll:</strong>  30 employees</li>
              <li><strong>VAT Transactions:</strong>  Unlimited</li>
              <li>Reporting to Statistics Department</li>
              <li>Email support: 3 Hours per month
for accounting questions.</li>
              <li>Tax Advice</li>
            </ul>
          </div>
          <h6 class="servicessss pr-555">Price</h6>
          <div class="pbmit-ptable-price-w">
            <div class="pbmit-ptable-price kkk">€199</div>
            <!--        <div class="pbmit-ptable-cur-symbol-after">€</div>--> 
              <div class="pbmit-ptable-frequency">/ month</div> 


      <p class="ppp">First quarter paid upfront.</p>
          </div>
          <div class="pbmit-vc_btn3-container pbmit-vc_btn3-inline"> <a class="pbmit-vc_general pbmit-vc_btn3 pbmit-vc_btn3-size-md open-modal-btn1" data-id="Enterprise" href="javascript:void(0)"> Select Package </a> </div>
        </div>
      </div>
    </div>
  </div>
</div>








      </div>
    </div>










</div>





</section>








     <section class="section-md11  mb-4">
        <div class="container">
                    <div class="row">
            <div class="col-md-12">
     <div class="Frequently text-center mb-4">
          <h3>Frequently Asked Questions (FAQs)</h3>

</div>

        </div></div>


          <div class="row">
            <div class="col-md-12">
              <div class="accordion accordion-style-1" id="accordionExample">
                <div class="accordion-item active">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
             What documents are required to get started?
                    <i class="pbmit-controls-icon-chevron"></i>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                To begin, we typically require basic company information, transaction history, payroll details, and any relevant tax documentation. We will guide you through the process step by step.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  How does VAT management work?
                    <i class="pbmit-controls-icon-chevron"></i>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" 
                  data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                  In our Standard and Enterprise packages, we handle all aspects of VAT compliance, from registration to reporting, ensuring your business adheres to all Georgian VAT regulations.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
               Can I upgrade my package later?
                    <i class="pbmit-controls-icon-chevron"></i>
                    </button>
                  </h2> 
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" 
                  data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                Yes! You can easily upgrade your package as your business grows or your accounting needs become more complex. Our team will help you transition smoothly.
                    </div>
                  </div>                         
                </div>   
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  . How often do you submit reports to the statistics department?
                    <i class="pbmit-controls-icon-chevron"></i>
                    </button>
                  </h2> 
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" 
                  data-bs-parent="#accordionExample">
                    <div class="accordion-body">
              We submit reports to the Georgian Statistics Department as required, ensuring your business remains compliant with all reporting obligations.
                    </div>
                  </div>                         
                </div> 
                                   
              </div>
            </div>
          </div>
        </div>
            </section>
            <!-- FAQ end -->





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
            <script>


$(document).ready(function () {
  $('.open-modal-btn1').on('click', function () {
    var selectedId = $(this).data('id');

    // Get the modal element
    var modalEl = document.getElementById('exampleModal2');

    // Create a new Bootstrap modal instance
    var myModal = new bootstrap.Modal(modalEl);

    // Remove old event handlers to avoid stacking them
    $(modalEl).off('shown.bs.modal');

    // Use shown.bs.modal to ensure the modal is fully open before interacting
    $(modalEl).on('shown.bs.modal', function () {
      $('#package_type').val(selectedId).trigger('change');
    });

    // Now show the modal
    myModal.show();
  });
});


  
  
</script>
        </div>
    </body>
</html>

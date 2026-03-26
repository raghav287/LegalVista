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
    $mail->Subject="Other Services Form Submitted By : ".$name."";
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
    <title>Legal Vista Ltd - Resident Permit Company in Tbilisi, Georgia</title>
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
            /* Modal specific styling for better spacing/visuals */
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
                box-shadow: 0 0 0 3px rgba(62,166,255,0.15);
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
                box-shadow: 0 14px 24px rgba(240,167,62,0.28);
            }
            .letter-sp-1 { letter-spacing: .12rem; }
        </style>

        <!-- Enquiry Modal -->
        <div class="modal fade enquiry-modal" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabe4" aria-hidden="true">
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
                        <form method="post" id="contact-form" action="/legal-vista/backend/contact-form">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Full name *" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Work email *" required>
                                </div>
                                <div class="col-12">
                                    <select name="service" id="service" class="form-control form-control-lg" required>
                                        <option value="">Select service *</option>
                                        <option value="Resident Permit" selected>Resident Permit</option>
                                        <option value="Company Registration Packages">Company Registration Packages</option>
                                        <option value="Bank Account Opening">Bank Account Opening</option>
                                        <option value="Tax Residency">Tax Residency</option>
                                        <option value="Nominee Services">Nominee Services</option>
                                        <option value="Accounting & Taxation">Accounting & Taxation</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" cols="40" rows="4" class="form-control form-control-lg" placeholder="Please describe your requirements or questions here." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn lead-submit-btn w-100 py-3 fw-bold text-uppercase">
                                        <i class="form-btn-loader fa fa-circle-o-notch fa-spin fa-fw margin-bottom d-none"></i>
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

        <!-- End  Footer-->

        <!-- Title Bar -->
        <div class="pbmit-title-bar-wrapper">
            <div class="container">
                <div class="pbmit-title-bar-content">
                    <div class="pbmit-title-bar-content-inner">
                        <div class="pbmit-tbar">
                            <div class="pbmit-tbar-inner container">
                                <h1 class="pbmit-tbar-title">Resident Permit</h1>
                                <p class="pbmit-tbar-desc">Residency Simplified: Start Your New Chapter in Georgia</p>
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

                            <img src="images/resident-permit.jpg" class="ringhtimg">

                            <p>At <strong>Legal Vista LLC</strong>, we specialize in assisting individuals and families
                                in obtaining Georgian residence permits. Whether you're looking to relocate for
                                business, retirement, or personal reasons, we ensure a smooth, efficient, and
                                transparent process, making your move to Georgia hassle-free.</p>

                            <h1>Why Choose Georgia for Residency?</h1>

                            <p>Georgia offers an attractive residency program for foreigners due to its friendly tax
                                regime, low cost of living, and strategic location at the crossroads of Europe and Asia.
                                With no wealth or capital gains tax on foreign income and easy access to neighboring
                                countries, Georgia has become an increasingly popular destination for entrepreneurs,
                                investors, and retirees. Below are the key types of residence permits we assist with:
                            </p>



                            <h4>Work Residence Permit</h4>

                            <p>The <strong>Work Residence Permit</strong> is ideal for individuals moving to Georgia for
                                entrepreneurial or labor activities. To qualify, applicants must meet the following
                                requirements:</p>



                            <ul class="listtttt">

                                <li><strong>Employment Contract</strong>: You must have a valid employment contract (or
                                    certificate of employment) with at least 6 months remaining, even if you are the
                                    owner of the sponsoring Limited Liability Company (LLC) or Individual Entrepreneur
                                    (IE).</li>
                                <li><strong>Registration</strong>: Employees must be registered in Georgia's unified
                                    database managed by the Ministry of Labor, Health, and Social Defense.</li>
                                <li><strong>Proof of Funds</strong>: Applicants must demonstrate sufficient funds to
                                    support themselves during the permit’s validity (initially between 6 to 12 months,
                                    with potential renewals of up to 11 years).</li>
                                <li><strong>Business Turnover</strong>: For LLCs or IEs sponsoring foreign workers, the
                                    business must have a turnover exceeding 50,000 GEL per foreign employee (director or
                                    staff) within the last 12 months.</li>
                            </ul>



                            <h4>Short-term Residence Permit (Property Ownership over $150K USD)</h4>



                            <p>The <strong>Short-term Residence Permit</strong> is available to individuals who own
                                immovable property in Georgia (excluding agricultural land) valued at over 150,000 USD
                                . This can be a single property or a portfolio of properties exceeding
                                the threshold. The permit also extends to immediate family members (spouse and
                                dependents).</p>






                            <!-- 

    <div class="package">
                          <div class="row cnt">
                            <div class="col-md-10">
                              <h5>Package Fee - EUR 3000</h5>
                            </div>
                            <div class="col-lg-2">
                              <div class="btnnnnnn">
                                <p><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal4" class="price-button">ENQUIRE</a></p>
                              </div>
                            </div>
                          </div>
                        </div>


 -->







                        </div>
                    </div>






                    <div class="row">
                        <div class="col-md-6">

                            <div class="ss1 "> <img src="images/swati.jpg" class="lefttimg">

                            </div>


                        </div>


                        <div class="col-md-6">
                            <div class="about-page aboutttinfo">
                                <h4>Permanent Residence Permit</h4>



                                <p>The <strong>Permanent Residence Permit</strong> is aimed at investors making
                                    significant contributions to Georgia’s economy. The investment can take several
                                    forms, not limited to real estate, though the requirements are detailed and
                                    specific. The key points include:</p>


                                <ul class="listtttt">
                                    <li><strong>Initial 5-Year Temporary Residence</strong>: Upon meeting the investment
                                        requirements, applicants and their family members (spouse and children) receive
                                        a 5-year temporary residence permit.</li>
                                    <li><strong>300,000 USD Investment</strong>: A continuous investment of 300,000 USD
                                        (or more) is required to maintain this status. The specific terms vary depending
                                        on the type of investment made.</li>
                                    <li><strong>Permanent Residency</strong>: After 5 years, investors can apply for
                                        permanent residency, provided they still meet the investment criteria.</li>
                                    <!-- <li><strong>100,000  USD Option</strong>: For property  investments exceeding 100,000 USD, applicants can apply for a short-term  residence permit, but permanent residency is only available after 10 years,  making the 300,000 USD option faster.</li> -->
                                </ul>




                            </div>
                        </div>







                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="about-page aboutttinfo pt-3">


                                <h4>Benefits of Having a Georgian Residence Permit</h4>


                                <ul class="listtttt">
                                    <li><strong>Right to Remain</strong>: Legally reside in Georgia and enjoy all the
                                        benefits that come with it.</li>
                                    <li><strong>Visa-Free Entry</strong>: Travel to Georgia without needing a visa.</li>
                                    <li><strong>Tax Benefits</strong>: Benefit from Georgia’s favorable tax regime,
                                        including no taxes on foreign income.</li>
                                    <li><strong>Low Cost of Living</strong>: Enjoy a high quality of life at a
                                        relatively low cost.</li>
                                    <li><strong>Ease of Doing Business</strong>: Georgia offers a business-friendly
                                        environment, making it an attractive destination for entrepreneurs and
                                        investors.</li>
                                </ul>



                                <p>With our team of legal experts, you can be assured of a seamless application process
                                    for your Georgian residence permit. Contact <strong>Legal Vista LLC</strong> today
                                    to get started.</p>






                                <h6>What is Included in the Package:</h6>


                                <ul class="listtttt mb-4">
                                    <li>Preparation of documents by experts.</li>
                                    <li>Final Assessment of documents by our top Immigration Lawyer.</li>
                                    <li>Personalized support with application filing.</li>
                                    <li>Assistance with obtaining resident card after application approval.</li>
                                    <li>Complete guidance and assistance during the entire process.</li>
                                    <li>Government fees is not included in the Package</li>
                                </ul>




                                <div class="package">
                                    <div class="row cnt">
                                        <div class="col-md-10">
                                            <h5>Package Fee - EUR 750</h5>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="btnnnnnn">
                                                <p><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal4" class="price-button">ENQUIRE</a></p>
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

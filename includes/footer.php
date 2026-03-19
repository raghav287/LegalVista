<!-- footer -->

<footer class="footer site-footer">
  <div class="pbmit-footer-widget-area">
    <div class="container">
      <div class="row">
        <div class="pbmit-footer-widget-col-3">
          <div class="widget">
            <h3 class="widget-title">About Us</h3>
            <p class="pbmit-footer-text"> Legal Vista Ltd, a premier law firm founded in 2017, offers bespoke legal services to expatriates looking to set up base in Georgia. We offer a gamut of company start up services to kick start your business and assist in its growth. <br>
              <br>
              Our company mission is to provide our esteemed clients with quality services in a transparent manner at affordable costs. </p>
          </div>
        </div>
        <div class="pbmit-footer-widget-col-2">
          <div class="widget">
            <h3 class="widget-title">Quick Links</h3>
            <div class="pbmit-footermenu-wrapper">
              <ul>
                <li><a href="company-registration">Company Registration Packages</a></li>
                <li><a href="bank-account-opening">Bank Account Opening</a></li>
                <li><a href="resident-permit">Resident Permits</a></li>
                <li><a href="tax-residency">Tax Residency</a></li>
                <li><a href="accounting-and-taxation">Accounting & Taxation</a></li>
                <li><a href="nominee-services">Nominee Services</a></li>
                <!-- <li><a href="faq">FAQ</a></li> -->

              </ul>
            </div>
          </div>
        </div>
        <div class="pbmit-footer-widget-col-2">
          <div class="widget">
            <h3 class="widget-title">Company Formation</h3>
            <div class="pbmit-footermenu-wrapper">
              <ul>
                <li><a href="company-registration">Limited Liability Company </a></li>
                <li><a href="company-registration">Limited Partnership</a></li>
                <li><a href="company-registration">Sole Proprietorship</a></li>
                <li><a href="company-registration">Joint Stock Company</a></li>
                
                <li><a href="company-registration">General Partnership </a></li>

                <li><a href="company-registration">Branch Office</a></li>
              </ul>
            </div>
          </div>
        </div>
        
        <!--<div class="pbmit-footer-widget-col-2">
                                <div class="widget">
                                    <h3 class="widget-title">Support</h3>
                                      <div class="pbmit-footermenu-wrapper">
                                        <ul>
                                            <li><a href="">Help Centre</a></li>
                                            <li><a href="">Complaints</a></li>
                                            <li><a href="">ID Requirements</a></li>
                                            <li><a href="">Faq's</a></li>
                                            <li><a href="">Login</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>-->
        
        <div class="pbmit-footer-widget-col-4">
          <div class="widget">
            <h3 class="widget-title">Contact Us</h3>
            <ul class="contactus-">
              <li> <i class="fa fa-map-marker"></i><strong>Legal Vista Ltd</strong><br />
                Regus Business Center, 2, Leonidze St., Liberty Square, Tbilisi 0105, Georgia </li>
              <li> <i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+995599848487"> +995 599848487</a> Mobile / Whatsapp </li>
              <li> <i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:+995599848486"> +995 599848486</a> </li>
              <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@legal-vista.com">info@legal-vista.com</a></li>
              <!-- <li><i class="fa fa-globe"></i><a href="https://www.legal-vista.com/">www.legal-vista.com</a></li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pbmit-footer-bottom">
    <div class="container">
      <div class="pbmit-footer-text-inner">
        <div class="row">
          <div class="col-md-12">
            <div class="copyyyy text-center">
              <p>Copyright © 2025 Legal Vista  Ltd. All Rights Reserved.    </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- footer End --> 

<!-- page wrapper End --> 

<!-- Search Box Start Here -->
<div class="pbmit-search-overlay">
  <div class="pbmit-icon-close"></div>
  <div class="pbmit-search-outer">
    <div class="pbmit-form-title">Hi, How Can We Help You?</div>
    <div class="pbmit-search-logo"> <img src="images/logo.png" alt="" /> </div>
    <form class="pbmit-site-searchform">
      <input type="search" class="form-control field searchform-s" name="s" placeholder="Type Word Then Press Enter" />
      <button type="submit"> <i class="pbmit-base-icon-search"></i> </button>
    </form>
  </div>
</div>
<!-- Search Box End Here --> 

<a href="#" class="scroll-to-top" aria-label="Back to top">
  <i class="pbmit-base-icon-angle-up" aria-hidden="true"></i>
</a>

<style>
  body .scroll-to-top {
    position: fixed;
    right: 24px;
    bottom: 24px;
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #c6a354;
    color: #ffffff;
    font-size: 24px;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.18);
    opacity: 0;
    visibility: hidden;
    transform: translateY(12px);
    transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s ease, background 0.3s ease;
    z-index: 99999;
  }

  body .scroll-to-top.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }

  body .scroll-to-top:hover,
  body .scroll-to-top:focus {
    background: #1f2f45;
    color: #ffffff;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const backToTopButton = document.querySelector(".scroll-to-top");
    if (!backToTopButton) {
      return;
    }

    const toggleBackToTop = function () {
      if (window.scrollY > 250) {
        backToTopButton.classList.add("show");
      } else {
        backToTopButton.classList.remove("show");
      }
    };

    toggleBackToTop();
    window.addEventListener("scroll", toggleBackToTop, { passive: true });

    backToTopButton.addEventListener("click", function (event) {
      event.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });
  });
</script>

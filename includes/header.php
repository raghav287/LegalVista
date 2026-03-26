<!-- Modal -->

































<div class="cp-widget-button">
  <div data-brand-color="background" onClick="show()" class="cp-widget-button__inner"> <a href="https://api.whatsapp.com/send?phone=+995599848487"><img src="images/whatsapp.png" /></a> </div>
</div>
<div class="cp-widget-button1">
  <div data-brand-color="background" onClick="show()" class="cp-widget-button__inner1"> <a href="tel:+995599848487"><img src="images/call.png" /></a> </div>
</div>

<!-- Header Main Area -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-BN2JY9MYKB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-BN2JY9MYKB');
</script>
<style>
  .site-header .site-header-menu {
    position: relative;
    z-index: 9999;
    background: #ffffff;
  }

  .site-header .site-header-menu .container {
    position: relative;
  }

  .site-header .site-header-menu.is-fixed {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    animation: headerSlideDown 0.25s ease;
  }

  .site-header-menu-spacer {
    display: none;
    width: 100%;
  }

  @keyframes headerSlideDown {
    from {
      transform: translateY(-100%);
    }
    to {
      transform: translateY(0);
    }
  }
</style>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const headerMenu = document.querySelector(".site-header .site-header-menu");
    if (!headerMenu) {
      return;
    }

    const spacer = document.createElement("div");
    spacer.className = "site-header-menu-spacer";
    headerMenu.parentNode.insertBefore(spacer, headerMenu);

    const headerMenuTop = headerMenu.offsetTop;

    const syncFixedHeader = function () {
      if (window.pageYOffset > headerMenuTop) {
        spacer.style.display = "block";
        spacer.style.height = headerMenu.offsetHeight + "px";
        headerMenu.classList.add("is-fixed");
      } else {
        spacer.style.display = "none";
        spacer.style.height = "0";
        headerMenu.classList.remove("is-fixed");
      }
    };

    syncFixedHeader();
    window.addEventListener("scroll", syncFixedHeader, { passive: true });
    window.addEventListener("resize", syncFixedHeader);
  });
</script>
<header class="site-header header-style-1">
  <div class="pre-header">
    <div class="container">
      <div class="d-flex justify-content-between">
        <div class="pbmit-pre-header-left"> </div>
        <div class="pbmit-social-links-wrapper">
          <ul class="call-icon">
            <li> <i class="pbmit-base-icon-phone"></i> <a href="tel:+995599848487"> +995 599848487</a> </li>
            <li> <i class="pbmit-base-icon-envelope"></i> <a href="mailto:info@legal-vista.com">info@legal-vista.com</a> </li>
            <!-- <li> <a href="#"> <i class="pbmit-base-icon-search-2"></i> </a> </li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="site-header-menu">
    <div class="container">
      <div class="row d-flex align-items-center justify-content-between ">
        <div class="col-md-2 col-7">

            <div class="site-branding"> 
    <span class="site-title"> 
        <a href="./"> 
            <img class="logo-img" src="images/logo.png" alt="" /> 
        </a> 
    </span> 
</div>
</div>

    <div class="col-md-8 col-5">

            <div class="site-navigations  mrrr">
              <nav class="main-menu navbar-expand-xl navbar-light">
                <div class="navbar-header"> 
                  <!-- Toggle Button -->
                  <button class="navbar-toggler" type="button"> <i class="pbmit-attorco-icon-bars"></i> </button>
                </div>
                <div class="pbmit-mobile-menu-bg"></div>
             
                <div class="collapse navbar-collapse clearfix show" id="pbmit-menu">
<div class="pbmit-menu-wrap mx-auto text-center">

    <ul class="navigation clearfix">
                      <!-- <li ><a href="">About </a></li> -->
                      
                      <!-- <li><a href="company-registration" class="active">Company Registration </a></li> -->



                           <li class="dropdown"> <a href="company-registration">Company Registration</a>
                        <ul>
                          <li><a href="company-registration">Limited Liability Company</a></li>
                          <li><a href="individual-entrepreneur">Individual Entrepreneur/ Sole proprietor</a></li>
                          <li><a href="company-registration">Limited Liability Partnership</a></li>
                          <li><a href="company-registration">Joint Stock Company </a></li>
                          <li><a href="company-registration">General Partnership</a></li>
                          <li><a href="company-registration">Branch Office</a></li>
                        </ul>
                      </li>



                      
                      <li class="dropdown"> <a href="#">Other Services</a>
                        <ul>
                          <li><a href="accounting-and-taxation">Accounting & Taxation</a></li>
                          <li><a href="resident-permit">Resident Permit </a></li>
                          <li><a href="bank-account-opening">Bank Account Opening </a></li>
                          <li><a href="tax-residency">Tax Residency </a></li>
                          <li><a href="nominee-services">Nominee Services</a></li>
                        </ul>
                      </li>
                      <li><a href="articles-and-resources">Articles & Resources</a></li>
                      <!-- <li><a href="contact-us">Contact </a></li> -->
                    </ul>
                  </div>
                </div>



                
              </nav>
            </div>




          </div>


              <div class="col-md-2">
            <div class="pbmit-right-side">
              <div class="right-logoo"> <img src="images/3e-international-3e-accounting-independent-member1-300x55.png" width="200px"> </div>
            </div>
          </div>

          </div>
        </div>
      </div>
  
</header>
<!-- Header Main Area End Here --> 

  <!-- Header -->
  <header id="header" >

<!-- Header Topbar -->
<div class="header-topbar">
    <div class="container">
        <div class="row g-0">
            <div class="col-6 col-xl-7 col-md-8">
                <div class="d-flex align-items-center">
                    <a href="tel:+84966704132">
                        <i class="hicon hicon-telephone me-1"></i>
                        <span>1800103006</span>
                    </a>
                    <span class="vr bg-white d-none d-md-inline ms-3 me-3"></span>
                    <a href="mailto:" class="d-none d-md-inline">
                        <i class="hicon hicon-email-envelope me-1"></i>
                        <span>booking@irctc-helicopterservice.com                        </span>
                    </a>
                </div>
            </div>
            <div class="col-6 col-xl-5 col-md-4">
                <div class="text-end">
                    <a class="d-inline-flex align-items-center me-3" data-bs-toggle="modal" href="#mdlLanguage">
                        <img src="assets/img/flags/en.svg" height="14" class="me-1" alt="">
                        <span class="me-1">English</span>
                        <i class="hicon hicon-thin-arrow-down hicon-bold hicon-60"></i>
                    </a>
                    <a class="d-inline-flex align-items-center" data-bs-toggle="modal" href="#mdlCurrency">
                        <span class="me-1">INR</span>
                        <i class="hicon hicon-thin-arrow-down hicon-bold hicon-60"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Header Topbar -->

<!-- Header Navbar -->
<div class="header-navbar">
    <nav class="navbar navbar-expand-xl">
        <div class="container">
            <button class="navbar-toggler me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="hicon hicon-bold hicon-hamburger-menu"></i>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('frontend/assets/img/logo.png')}}" style="width: 90px"  alt="">
            </a>
            <div class="offcanvas offcanvas-navbar offcanvas-start border-end-0" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header border-bottom p-4 p-xl-0">
                    <a href="{{url('/')}}" class="d-inline-block">
                        <img src="{{asset('frontend/assets/img/logo.png')}}" style="width: 90px" alt="">
                    </a>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-4 p-xl-0">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-hover active" href="{{url('/')}}" data-bs-display="static">
                                <span>Home</span>
                                <!-- <i class="hicon hicon-thin-arrow-down hicon-bold dropdown-toggle-icon"></i> -->
                            </a>
                           
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-hover" href="{{url('/destinations')}}" data-bs-display="static">
                                <span>Destinations</span>
                                <!-- <i class="hicon hicon-thin-arrow-down hicon-bold dropdown-toggle-icon"></i> -->
                            </a>
                            
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-hover" href="{{url('/about')}}" data-bs-display="static">
                                <span>About Us</span>
                                <!-- <i class="hicon hicon-thin-arrow-down hicon-bold dropdown-toggle-icon"></i> -->
                            </a>
                          
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-hover" href="#" data-bs-display="static">
                                <span>Travel Insight</span>
                               
                            </a>
                            
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-hover" href="{{url('/checkbooking')}}" data-bs-display="static">
                                <span>Booking Status</span>
                                <!-- <i class="hicon hicon-thin-arrow-down hicon-bold dropdown-toggle-icon"></i> -->
                            </a>
                            
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle-hover" href="{{url('/contact')}}" data-bs-display="static">
                                <span>Contact Us</span>
                                <!-- <i class="hicon hicon-thin-arrow-down hicon-bold dropdown-toggle-icon"></i> -->
                            </a>
                          
                        </li>
                        
                    </ul>
                   
                </div>
            </div>
           
        </div>
    </nav>
</div>
<!-- /Header Navbar -->

<!-- Language -->
<!-- <div class="modal fade" id="mdlLanguage" tabindex="-1" aria-labelledby="h3Language" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header">
                <span class="fs-3 modal-title text-body-emphasis fw-medium" id="h3Language">Select language</span>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled row mb-0">
                    <li class="col-6 col-lg-4">
                        <a href="index9ed2.html?lang=en" class="link-dark link-hover">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <img src="assets/img/flags/en.svg" height="16" alt="">
                                <span class="ms-2">English</span>
                            </span>
                        </a>
                    </li>
                    <li class="col-6 col-lg-4">
                        <a href="index9ed2.html?lang=en" class="link-dark link-hover">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <img src="assets/img/flags/fr.svg" height="16" alt="">
                                <span class="ms-2">Français</span>
                            </span>
                        </a>
                    </li>
                    <li class="col-6 col-lg-4">
                        <a href="index9ed2.html?lang=en" class="link-dark link-hover">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <img src="assets/img/flags/es.svg" height="16" alt="">
                                <span class="ms-2">Español</span>
                            </span>
                        </a>
                    </li>
                    <li class="col-6 col-lg-4">
                        <a href="index9ed2.html?lang=en" class="link-dark link-hover">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <img src="assets/img/flags/de.svg" height="16" alt="">
                                <span class="ms-2">Deutsch</span>
                            </span>
                        </a>
                    </li>
                    <li class="col-6 col-lg-4">
                        <a href="index9ed2.html?lang=en" class="link-dark link-hover">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <img src="assets/img/flags/it.svg" height="16" alt="">
                                <span class="ms-2">Italiano</span>
                            </span>
                        </a>
                    </li>
                    <li class="col-6 col-lg-4">
                        <a href="index9ed2.html?lang=en" class="link-dark link-hover">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <img src="assets/img/flags/nl.svg" height="16" alt="">
                                <span class="ms-2">Nederlands</span>
                            </span>
                        </a>
                    </li>
                    <li class="col-6 col-lg-4">
                        <a href="index9ed2.html?lang=en" class="link-dark link-hover">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <img src="assets/img/flags/pt.svg" height="16" alt="">
                                <span class="ms-2">Português</span>
                            </span>
                        </a>
                    </li>
                    <li class="col-6 col-lg-4">
                        <a href="index9ed2.html?lang=en" class="link-dark link-hover">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <img src="assets/img/flags/ru.svg" height="16" alt="">
                                <span class="ms-2">Русский</span>
                            </span>
                        </a>
                    </li>
                    <li class="col-6 col-lg-4">
                        <a href="index9ed2.html?lang=en" class="link-dark link-hover">
                            <span class="d-flex align-items-center pt-2 pb-2">
                                <img src="assets/img/flags/cn.svg" height="16" alt="">
                                <span class="ms-2">日本語</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> -->
<!-- /Language -->

<!-- Currency -->
<!-- <div class="modal fade" id="mdlCurrency" tabindex="-1" aria-labelledby="h3Currency" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header">
                <span class="fs-3 modal-title text-body-emphasis fw-medium" id="h3Currency">Select currency</span>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled row mb-0">
                    <li class="col-12 col-lg-6">
                        <a href="index277a.html?currency=usd" class="link-dark link-hover">
                            <span class="d-block pt-2 pb-2"><strong>USD</strong> (United States Dollar)</span>
                        </a>
                    </li>
                    <li class="col-12 col-lg-6">
                        <a href="index5e60.html?currency=eur" class="link-dark link-hover">
                            <span class="d-block pt-2 pb-2"><strong>EUR</strong> (Euro)</span>
                        </a>
                    </li>
                    <li class="col-12 col-lg-6">
                        <a href="index8ebb.html?currency=gbp" class="link-dark link-hover">
                            <span class="d-block pt-2 pb-2"><strong>GBP</strong> (Pound Sterling)</span>
                        </a>
                    </li>
                    <li class="col-12 col-lg-6">
                        <a href="index4878.html?currency=aud" class="link-dark link-hover">
                            <span class="d-block pt-2 pb-2"><strong>AUD</strong> (Australian Dollar)</span>
                        </a>
                    </li>
                    <li class="col-12 col-lg-6">
                        <a href="indexd000.html?currency=nzd" class="link-dark link-hover">
                            <span class="d-block pt-2 pb-2"><strong>NZD</strong> (New Zealand Dollar)</span>
                        </a>
                    </li>
                    <li class="col-12 col-lg-6">
                        <a href="indexc45f.html?currency=cad" class="link-dark link-hover">
                            <span class="d-block pt-2 pb-2"><strong>CAD</strong> (Canadian Dollar)</span>
                        </a>
                    </li>
                    <li class="col-12 col-lg-6">
                        <a href="index60d1.html?currency=jpy" class="link-dark link-hover">
                            <span class="d-block pt-2 pb-2"><strong>JPY</strong> (Japanese Yen)</span>
                        </a>
                    </li>
                    <li class="col-12 col-lg-6">
                        <a href="indexd046.html?currency=cny" class="link-dark link-hover">
                            <span class="d-block pt-2 pb-2"><strong>CNY</strong> (Chinese Yuan)</span>
                        </a>
                    </li>
                    <li class="col-12 col-lg-6">
                        <a href="indexb026.html?currency=vnd" class="link-dark link-hover">
                            <span class="d-block pt-2 pb-2"><strong>VND</strong> (Vietnam Dong)</span>
                        </a>
                    </li>
                    <li class="col-12 col-lg-6">
                        <a href="indexa48f.html?currency=sgd" class="link-dark link-hover">
                            <span class="d-block pt-2 pb-2"><strong>SGD</strong> (Singapore Dollar)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> -->
<!-- /Currency -->

</header>
<!-- /Header -->
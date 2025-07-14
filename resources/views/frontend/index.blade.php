
@extends('frontend.layouts.app')
@section('content')
    


        <!-- Hero -->
        <section class="hero" >
            <h1 class="d-none">Char Dham Yatra</h1>
            <!-- Carousel -->
            <div id="heroCarousel" class="hero-carousel carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Carousel item -->
                    <div class="hero-item carousel-item active">
                        <div class="hero-bg">
                            <img src="{{asset('frontend/assets/img/h1.jpeg')}}" srcset="./frontend/assets/img/h1.jpeg 2x" alt="">
                        </div>
                        <div class="hero-caption text-sm-start">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-xxl-6 col-xl-7 col-md-10">
                                        <div class="hero-sub-title">
                                            <span>Embark On a Divine Journey</span>
                                        </div>
                                        <h2 class="display-3 hero-title">
                                            Char Dham Yatra by Helicopter
                                        </h2>
                                        <p class="text-light mt-3">
                                            Experience the sacred Char Dham — Yamunotri, Gangotri, Kedarnath, and Badrinath — in unmatched comfort and speed.
                                        </p>
                                        <div class="hero-action">
                                            <a href="{{url('/destinations')}}" class="btn btn-outline-light btn-uppercase mnw-180 me-4">
                                                <span>Explore</span>
                                                <i class="hicon hicon-flights-one-ways"></i>
                                            </a>
                                            <!-- Optional video link -->
                                            <!-- <a class="btn-video-play btn-video-play-sm media-glightbox" href="assets/media/v1.mp4"><span></span></a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /Carousel item -->
                    <!-- Carousel item -->
                    <div class="hero-item carousel-item">
                        <div class="hero-bg">
                            <img src="{{asset('frontend/assets/img/h2.jpeg')}}" srcset="./frontend/assets/img/h2.jpeg 2x" alt="">
                        </div>
                        <div class="hero-caption text-sm-start">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-xxl-6 col-xl-7 col-md-10">
                                        <div class="hero-sub-title">
                                            <span>Touch the Skies</span>
                                        </div>
                                        <h2 class="display-3 hero-title">
                                            Reach the Shrines in Style
                                        </h2>
                                        <p class="text-light mt-3">
                                            Skip the long treks and enjoy a seamless aerial pilgrimage to the holiest sites of Uttarakhand.
                                        </p>
                                        <div class="hero-action">
                                            <a href="{{url('/destinations')}}" class="btn btn-outline-light btn-uppercase mnw-180 me-4">
                                                <span>Explore</span>
                                                <i class="hicon hicon-flights-one-ways"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /Carousel item -->
                    <!-- Carousel item -->
                    <div class="hero-item carousel-item">
                        <div class="hero-bg">
                            <img src="{{asset('assets/img/h3.jpeg')}}" srcset="./frontend/assets/img/h3.jpeg 2x" alt="">
                        </div>
                        <div class="hero-caption text-sm-start">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-xxl-6 col-xl-7 col-md-10">
                                        <div class="hero-sub-title">
                                            <span>Luxury Meets Devotion</span>
                                        </div>
                                        <h2 class="display-3 hero-title">
                                            VIP Char Dham Helicopter Tour
                                        </h2>
                                        <p class="text-light mt-3">
                                            Enjoy VIP darshan, luxury accommodation, and chartered flights with IRCTC Helicopter Services.
                                        </p>
                                        <div class="hero-action">
                                            <a href="{{url('/destinations')}}" class="btn btn-outline-light btn-uppercase mnw-180 me-4">
                                                <span>Discover More</span>
                                                <i class="hicon hicon-flights-one-ways"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /Carousel item -->
                </div>
                <div class="carousel-control">
                    <button class="carousel-control-next prev-custom" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-prev next-custom" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="carousel-indicators hero-indicators-right">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
            </div>
            <!-- Carousel -->
            <!-- Check tour -->
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-12 col-xl-6">
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="search-tours search-hero search-hero-half">
                            <form class="search-tour-form" method="post" action="{{ route('contact.submit') }}">
                                @csrf
                                <div class="search-tour-input">
                                    <div class="row g-3 g-xl-2">
                                        <!-- Full Name -->
                                        <div class="col-12 col-md-6">
                                            <div class="input-icon-group">
                                                <label for="txtKeyword" class="input-icon fas fa-user"></label>
                                                <input id="txtKeyword" name="yourname" type="text" class="form-control shadow-sm" placeholder="Full Name *" required>
                                            </div>
                                        </div>
                                        <!-- Email -->
                                        <div class="col-12 col-md-6">
                                            <div class="input-icon-group tour-date">
                                                <label class="input-icon fas fa-envelope" for=""></label>
                                                <input id="" name="email" type="text" class="form-control shadow-sm" placeholder="Email *" required>
                                            </div>
                                        </div>
                                        <!-- Number -->
                                        <div class="col-12 col-md-6">
                                            <div class="input-icon-group">
                                                <label for="txtNumber" class="input-icon fas fa-phone-alt"></label>
                                                <input id="txtNumber" type="text" name="number" class="form-control shadow-sm" placeholder="Number *" required>
                                            </div>
                                        </div>
                                        <!-- Submit -->
                                        <div class="col-12 col-md-6">
                                            <button type="submit" class="btn btn-primary btn-uppercase w-100">
                                                <i class="fas fa-paper-plane"></i>
                                                <span>Submit</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Check tour -->
        </section>
        <!-- /Hero -->

        <!-- Featured -->
        <section class="pt-5 pb-4 bg-gray-gradient">
            <div class="container">
                <ul class="stats-list row g-0">
                    <li class="col-6 col-xl-3">
                        <div class="stats-item">
                            <h3 class="h1 stats-number">+500</h3>
                            <p class="stats-desc">
                                Successful <br> IRCTC Helicopter Tours
                            </p>
                        </div>
                    </li>
                    <li class="col-6 col-xl-3">
                        <div class="stats-item">
                            <h3 class="h1 stats-number">+2.5L</h3>
                            <p class="stats-desc">
                                Pilgrims Served <br> by IRCTC Services
                            </p>
                        </div>
                    </li>
                    <li class="col-6 col-xl-3">
                        <div class="stats-item">
                            <h3 class="h1 stats-number">4.9</h3>
                            <p class="stats-desc">
                                <span class="star-rate-view star-rate-size-sm"><span class="star-value rate-50"></span></span>
                                <br>
                                <span>Rated on Google & IRCTC</span>
                            </p>
                        </div>
                    </li>
                    <li class="col-6 col-xl-3">
                        <div class="stats-item">
                            <h3 class="h1 stats-number">+99%</h3>
                            <p class="stats-desc">
                                Customer <br> Satisfaction Rate
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- /Featured -->
        <section class="trip-packages" style="margin-top: 50px; margin-bottom: 50px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="gtitle">
                            <h2><b>IRCTC Certified</b> Dham Yatra Helicopter Packages</h2>
                            <div class="middle-hr"></div>
                            <p>Book your spiritual journey with trust and ease through our exclusive IRCTC-endorsed helicopter tours to the divine Dhams of Uttarakhand.</p>
                        </div>
                    </div>

                   <!-- 1. 4 Dham -->
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{url('/destinations')}}" title="IRCTC 4 Dham Yatra">
                                    <img src="{{asset('frontend/assets/img/tours/char.jpeg')}}" width="775" height="375" alt="IRCTC 4 Dham Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC 4 Dham Yatra</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Points Covered:</b> Kedarnath, Badrinath, Gangotri, Yamunotri</li>
                                    <li><b>Duration:</b> 6 Days / 5 Nights</li>
                                    <li><b>Start Point:</b> Dehradun</li>
<li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Inclusions</b></p>
                                <ul>
                                    <li>Hotel Stay</li>
                                    <li>Meals</li>
                                    <li>Helicopter Transfers</li>
                                    <li>Local Transport</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting From</p>
                                    <span class="kp-new">₹ 45,000 /-</span>
                                </div>
                                <div class="kPack-btm2">
                                    <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                    <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. 2 Dham (Kedarnath, Badrinath) -->
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{url('/destinations')}}" title="IRCTC 2 Dham Yatra">
                                    <img src="{{asset('frontend/assets/img/tours/2dham.jpeg')}}" width="775" height="375" alt="IRCTC 2 Dham Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC 2 Dham Yatra</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Points Covered:</b> Kedarnath, Badrinath</li>
                                    <li><b>Duration:</b> 3 Days / 2 Nights</li>
                                    <li><b>Start Point:</b> Dehradun</li>
                                        <li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Inclusions</b></p>
                                <ul>
                                    <li>Hotel Stay</li>
                                    <li>Meals</li>
                                    <li>Helicopter Transfers</li>
                                    <li>Local Transport</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting From</p>
                                    <span class="kp-new">₹ 25,000 /-</span>
                                </div>
                                <div class="kPack-btm2">
                                    <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                    <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. 2 Dham (Gangotri, Yamunotri) -->
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{url('/destinations')}}" title="IRCTC 2 Dham Yatra">
                                    <img src="{{asset('frontend/assets/img/tours/gyo.jpeg')}}" width="775" height="375" alt="IRCTC 2 Dham Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC 2 Dham Yatra</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Points Covered:</b> Gangotri, Yamunotri</li>
                                    <li><b>Duration:</b> 3 Days / 2 Nights</li>
                                    <li><b>Start Point:</b> Dehradun</li>
<li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Inclusions</b></p>
                                <ul>
                                    <li>Hotel Stay</li>
                                    <li>Meals</li>
                                    <li>Helicopter Transfers</li>
                                    <li>Local Transport</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting From</p>
                                    <span class="kp-new">₹ 22,000 /-</span>
                                </div>
                                <div class="kPack-btm2">
                                    <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                    <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. 3 Dham (Kedarnath, Badrinath, Gangotri) -->
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{url('/destinations')}}" title="IRCTC 3 Dham Yatra">
                                    <img src="{{asset('frontend/assets/img/tours/gangotri-kedarnath-badrinath.png')}}" width="775" height="375" alt="IRCTC 3 Dham Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC 3 Dham Yatra</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Points Covered:</b> Kedarnath, Badrinath, Gangotri</li>
                                    <li><b>Duration:</b> 5 Days / 4 Nights</li>
                                    <li><b>Start Point:</b> Dehradun</li>
<li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Inclusions</b></p>
                                <ul>
                                    <li>Hotel Stay</li>
                                    <li>Meals</li>
                                    <li>Helicopter Transfers</li>
                                    <li>Local Transport</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting From</p>
                                    <span class="kp-new">₹ 35,000 /-</span>
                                </div>
                                <div class="kPack-btm2">
                                    <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                    <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. 3 Dham (Kedarnath, Badrinath, Yamunotri) -->
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{url('/destinations')}}" title="IRCTC 3 Dham Yatra">
                                    <img src="{{asset('frontend/assets/img/tours/kby.jpg')}}" width="775" height="375" alt="IRCTC 3 Dham Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC 3 Dham Yatra</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Points Covered:</b> Kedarnath, Badrinath, Yamunotri</li>
                                    <li><b>Duration:</b> 5 Days / 4 Nights</li>
                                    <li><b>Start Point:</b> Dehradun</li>
<li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Inclusions</b></p>
                                <ul>
                                    <li>Hotel Stay</li>
                                    <li>Meals</li>
                                    <li>Helicopter Transfers</li>
                                    <li>Local Transport</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting From</p>
                                    <span class="kp-new">₹ 33,000 /-</span>
                                </div>
                                <div class="kPack-btm2">
                                    <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                    <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. 3 Dham (Gangotri, Yamunotri, Kedarnath) -->
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{url('/destinations')}}" title="IRCTC 3 Dham Yatra">
                                    <img src="{{asset('frontend/assets/img/tours/3dham-yg-b.jpeg')}}" width="775" height="375" alt="IRCTC 3 Dham Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC 3 Dham Yatra</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Points Covered:</b> Gangotri, Yamunotri, Kedarnath</li>
                                    <li><b>Duration:</b> 5 Days / 4 Nights</li>
                                    <li><b>Start Point:</b> Dehradun</li>
<li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Inclusions</b></p>
                                <ul>
                                    <li>Hotel Stay</li>
                                    <li>Meals</li>
                                    <li>Helicopter Transfers</li>
                                    <li>Local Transport</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting From</p>
                                    <span class="kp-new">₹ 33,000 /-</span>
                                </div>
                                <div class="kPack-btm2">
                                    <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                    <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 7. 3 Dham (Gangotri, Yamunotri, Badrinath) -->
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{url('/destinations')}}" title="IRCTC 3 Dham Yatra">
                                    <img src="{{asset('frontend/assets/img/tours/teen-dham.jpg')}}" width="775" height="375" alt="IRCTC 3 Dham Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC 3 Dham Yatra</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Points Covered:</b> Gangotri, Yamunotri, Badrinath</li>
                                    <li><b>Duration:</b> 5 Days / 4 Nights</li>
                                    <li><b>Start Point:</b> Dehradun</li>
<li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Inclusions</b></p>
                                <ul>
                                    <li>Hotel Stay</li>
                                    <li>Meals</li>
                                    <li>Helicopter Transfers</li>
                                    <li>Local Transport</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting From</p>
                                    <span class="kp-new">₹ 33,000 /-</span>
                                </div>
                                <div class="kPack-btm2">
                                    <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                    <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 8. 1 Dham (Any One) -->
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{url('/destinations')}}" title="IRCTC 1 Dham Yatra">
                                    <img src="{{asset('frontend/assets/img/tours/char-dham-yatra-1598202094.jpg')}}" width="775" height="375" alt="IRCTC 1 Dham Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC 1 Dham Yatra</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Points Covered:</b> Kedarnath / Badrinath / Gangotri / Yamunotri</li>
                                    <li><b>Duration:</b> 2 Days / 1 Night</li>
                                    <li><b>Start Point:</b> Dehradun</li>
<li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Inclusions</b></p>
                                <ul>
                                    <li>Hotel Stay</li>
                                    <li>Meals</li>
                                    <li>Helicopter Ride</li>
                                    <li>Local Assistance</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting From</p>
                                    <span class="kp-new">₹ 15,000 /-</span>
                                </div>
                                <div class="kPack-btm2">
                                    <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                    <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>


        <section class="trip-packages">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="gtitle">
                        <h2><b>Exclusive Deals</b> Helicopter Tours</h2>
                        <div class="middle-hr"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{ url('/contact') }}" title="IRCTC - Badrinath Yatra By Helicopter">
                                    <img src="{{asset('frontend/assets/img/tours/badhrinath.jpg')}}" width="775" height="375" alt="Badrinath Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC - Badrinath Yatra By Helicopter</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Starting Point: </b>Dehradun</li>
                                    <li><b>Duration: </b>2 Days / 1 Night</li>
                                    <li><b>Points Covered: </b>Badrinath</li>
                                    <li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Tour Inclusions</b></p>
                                <ul>
                                    <li>Hotel</li>
                                    <li>Meals</li>
                                    <li>Transport</li>
                                    <li>Sightseeing</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting Price Per Adult</p>
                                    <span class="kp-old">₹ 20,000</span>
                                    <span class="kp-new">₹ 15,000 / -</span>
                                </div>
                                <div class="kPack-btm2">
                                    <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                    <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{ url('/contact') }}" title="IRCTC - Kedarnath Yatra By Helicopter">
                                    <img src="{{asset('frontend/assets/img/tours/kedarnath.jpg')}}" width="775" height="375" alt="Kedarnath Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC - Kedarnath Yatra By Helicopter</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Starting Point: </b>Dehradun</li>
                                    <li><b>Duration: </b>2 Days / 1 Night</li>
                                    <li><b>Points Covered: </b>Kedarnath</li>
                                    <li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Tour Inclusions</b></p>
                                <ul>
                                    <li>Hotel</li>
                                    <li>Meals</li>
                                    <li>Transport</li>
                                    <li>Sightseeing</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting Price Per Adult</p>
                                    <span class="kp-old">₹ 20,000</span>
                                    <span class="kp-new">₹ 15,000 / -</span>
                                </div>
                                <div class="kPack-btm2">
                                <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{ url('/contact') }}" title="IRCTC - Gangotri Yatra By Helicopter">
                                    <img src="{{asset('frontend/assets/img/tours/gangotri.jpg')}}" width="775" height="375" alt="Gangotri Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC - Gangotri Yatra By Helicopter</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Starting Point: </b>Dehradun</li>
                                    <li><b>Duration: </b>2 Days / 1 Night</li>
                                    <li><b>Points Covered: </b>Gangotri</li>
                                    <li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Tour Inclusions</b></p>
                                <ul>
                                    <li>Hotel</li>
                                    <li>Meals</li>
                                    <li>Transport</li>
                                    <li>Sightseeing</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting Price Per Adult</p>
                                    <span class="kp-old">₹ 20,000</span>
                                    <span class="kp-new">₹ 15,000 / -</span>
                                </div>
                                <div class="kPack-btm2">
                                <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="kPack">
                            <div class="kPack-thumb">
                                <a href="{{ url('/contact') }}" title="IRCTC - Yamunotri Yatra By Helicopter">
                                    <img src="{{asset('frontend/assets/img/tours/yamunotri.webp')}}" width="775" height="375" alt="Yamunotri Yatra">
                                </a>
                            </div>
                            <div class="kPack1">
                                <h3>IRCTC - Yamunotri Yatra By Helicopter</h3>
                            </div>
                            <div class="kPack2">
                                <ul>
                                    <li><b>Starting Point: </b>Dehradun</li>
                                    <li><b>Duration: </b>2 Days / 1 Night</li>
                                    <li><b>Points Covered: </b>Yamunotri</li>
                                    <li><b>VIP Darshan</b></li>
                                </ul>
                            </div>
                            <div class="kPack3">
                                <p><b>Tour Inclusions</b></p>
                                <ul>
                                    <li>Hotel</li>
                                    <li>Meals</li>
                                    <li>Transport</li>
                                    <li>Sightseeing</li>
                                </ul>
                            </div>
                            <div class="kPack-btm">
                                <div class="kPack-btm1">
                                    <p>Starting Price Per Adult</p>
                                    <span class="kp-old">₹ 20,000</span>
                                    <span class="kp-new">₹ 15,000 / -</span>
                                </div>
                                <div class="kPack-btm2">
                                <a href="{{ url('/contact') }}" class="modal-link">Send Query</a>
                                <a href="https://wa.me/919672832691" target="_blank">Call Us</a>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                </div>
            </div>
        </section>

        <!-- About -->
        <section class="p-top-90 p-bottom-90 bg-gray-gradient">
            <div class="container">
                <div class="row g-0">
                    <div class="col-12 col-xl-6 order-1 order-xl-0">
                        <!-- Image -->
                        <div class="pe-xl-5">
                            <div class="image-info image-info-right image-info-vertical">
                                <div class="vertical-title">
                                    <small class="ls-2">
                                        <strong class="text-primary fw-semibold">Since 1993</strong> - <strong class="text-body fw-semibold">31 Years</strong> of Trusted Service
                                    </small>
                                </div>
                                <div class="image-center">
                                    <img src="{{asset('frontend/assets/img/tours/p1.jpeg')}}" srcset="./frontend/assets/img/tours/p1.jpeg 2x" class="rounded w-100" alt="Char Dham Helicopter Service">
                                </div>
                                <div class="info-top-right">
                                    <div class="vertical-award rounded shadow-sm">
                                        <div class="award-content">
                                            <img src="{{asset('frontend/assets/img/logo.png')}}" srcset="./frontend/assets/img/logo.png 2x" class="w-100" alt="IRCTC Logo">
                                        </div>
                                        <div class="award-footer">
                                            <small>IRCTC Helicopter Yatra</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Image -->
                    </div>
                    <div class="col-12 col-xl-6 order-0 order-xl-1">
                        <!-- Content -->
                        <div class="mb-5 mb-xl-0">
                            <div class="block-title">
                                <small class="sub-title">About Us</small>
                                <h2 class="h1 title">Char Dham Yatra by Helicopter – Powered by IRCTC</h2>
                            </div>
                            <p>
                                Experience divine comfort and trusted service with <strong>IRCTC's official Char Dham Yatra by Helicopter</strong>. Designed for convenience, speed, and spiritual fulfillment, this yatra connects you to the sacred shrines of Yamunotri, Gangotri, Kedarnath, and Badrinath — all via luxurious helicopter services.
                            </p>
                            <p>
                                Backed by <strong>IRCTC’s legacy of reliability</strong> and customer satisfaction, we ensure a seamless journey with curated packages, VIP darshan, and top-notch safety standards.
                            </p>
                            <ul class="strength-list row g-0 pt-2">
                                <li class="col-12 col-md-6">
                                    <div class="strength-item">
                                        <span class="strength-icon">
                                            <i class="hicon hicon-150 hicon-confirmation-instant"></i>
                                        </span>
                                        <strong class="strength-title">IRCTC-Verified Travel Packages</strong>
                                    </div>
                                </li>
                                <li class="col-12 col-md-6">
                                    <div class="strength-item">
                                        <span class="strength-icon">
                                            <i class="hicon hicon-150 hicon-menu-price-display"></i>
                                        </span>
                                        <strong class="strength-title">Transparent Pricing, No Hidden Costs</strong>
                                    </div>
                                </li>
                                <li class="col-12 col-md-6">
                                    <div class="strength-item">
                                        <span class="strength-icon">
                                            <i class="hicon hicon-150 hicon-pay-on-checkin"></i>
                                        </span>
                                        <strong class="strength-title">Helicopter Access to All Four Dhams</strong>
                                    </div>
                                </li>
                                <li class="col-12 col-md-6">
                                    <div class="strength-item">
                                        <span class="strength-icon">
                                            <i class="hicon hicon-150 hicon-agoda-price-guarante"></i>
                                        </span>
                                        <strong class="strength-title">IRCTC Trust & Safety Standards</strong>
                                    </div>
                                </li>
                            </ul>
                            <div class="pt-3">
                                <a href="{{ url('/about') }}" class="btn btn-primary btn-uppercase mnw-180">
                                    <span>Read more</span>
                                    <i class="hicon hicon-flights-one-ways"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /Content -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /About -->

        <!-- Tour types -->
        <section class="p-top-90 p-bottom-90 bg-gray-gradient">
            <div class="container">
                <!-- Types -->
                <div class="row g-3 g-xl-4">
                    <div class="col-12 col-xl-3 col-md-6">
                        <!-- Title -->
                        <div class="info-card shadow-sm rounded h-100 active">
                            <div class="block-title">
                                <small class="sub-title card-title">IRCTC Tours</small>
                                <h2 class="h1 title card-title lh-xs">Travel with Trust</h2>
                            </div>
                            <p class="card-desc">Discover India with official IRCTC tours designed for convenience, comfort, and safety.</p>
                            <div class="card-desc mt-3">
                                Need <a href="{{ url('/contact') }}" class="link-light"><abbr title="Go to contact page" class="fw-semibold">assistance</abbr></a>? We're here to help.
                            </div>
                        </div>
                        <!-- /Title -->
                    </div>
                    <div class="col-12 col-xl-3 col-md-6">
                        <a href="{{ url('/about') }}" class="info-card hover-effect shadow-sm rounded h-100">
                            <div class="card-icon">
                                <i class="hicon hicon-family-with-teens"></i>
                            </div>
                            <h3 class="h4 card-title">IRCTC Group Tours</h3>
                            <p class="card-desc">Join government-approved group tours with certified guides and curated rail itineraries.</p>
                            <span class="card-link">
                                <span>Call Us</span>
                                <i class="hicon hicon-flights-one-ways"></i>
                            </span>
                        </a>
                    </div>
                    <div class="col-12 col-xl-3 col-md-6">
                        <a href="{{ url('/about') }}" class="info-card hover-effect shadow-sm rounded h-100">
                            <div class="card-icon">
                                <i class="hicon hicon-regular-travel-protection"></i>
                            </div>
                            <h3 class="h4 card-title">IRCTC Private Rail Tours</h3>
                            <p class="card-desc">Experience privacy and comfort with exclusive IRCTC rail packages customized for families and couples.</p>
                            <span class="card-link">
                                <span>Call Us</span>
                                <i class="hicon hicon-flights-one-ways"></i>
                            </span>
                        </a>
                    </div>
                    <div class="col-12 col-xl-3 col-md-6">
                        <a href="{{ url('/contact') }}" class="info-card hover-effect shadow-sm rounded h-100">
                            <div class="card-icon">
                                <i class="hicon hicon-tours"></i>
                            </div>
                            <h3 class="h4 card-title">Custom IRCTC Itineraries</h3>
                            <p class="card-desc">Plan your journey with tailor-made IRCTC tours that match your schedule, interests, and budget.</p>
                            <span class="card-link">
                                <span>Contact Us</span>
                                <i class="hicon hicon-flights-one-ways"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <!-- /Types -->
            </div>
        </section>
        <!-- /Tour types -->

        <!-- Why -->
        <section class="p-top-90 p-bottom-90 bg-gray-gradient">
            <div class="container">
                <div class="row g-0">
                    <div class="col-12 col-xl-6 order-1 order-xl-0">
                        <!-- Image -->
                        <div class="pe-xl-5">
                            <div class="image-info image-info-left image-info-right">
                                <div class="image-center">
                                    <img src="{{asset('frontend/assets/img/tours/p1.jpeg')}}" srcset="./frontend/assets/img/tours/p1.jpeg 2x" class="rounded w-100" alt="IRCTC travel">
                                </div>
                                <div class="info-top-right">
                                    <div class="vertical-review rounded shadow-sm">
                                        <div class="review-content">
                                            <h3 class="review-score">4.9</h3>
                                            <span class="star-rate-view star-rate-size-sm"><span class="star-value rate-50"></span></span>
                                            <small class="review-total"><strong>3200+</strong> reviews</small>
                                            <!-- <small class="review-label ">IRCTC Verified</small> -->
                                        </div>
                                        <div class="review-footer">
                                            <small>IRCTC Verified</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-bottom-left">
                                    <div class="vertical-experience rounded shadow-sm">
                                        <h3 class="experience-year">20+</h3>
                                        <small class="experience-title">Years with IRCTC</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Image -->
                    </div>
                    <div class="col-12 col-xl-6 order-0 order-xl-1">
                        <!-- Content -->
                        <div class="mb-5">
                            <div class="block-title">
                                <small class="sub-title">IRCTC Certified</small>
                                <h2 class="h1 title">Why Choose Our IRCTC Tours</h2>
                            </div>
                            <p>
                                As an IRCTC-affiliated travel provider, we offer secure, government-recognized tours with unmatched convenience and reliability.
                            </p>
                            <div class="accordion accordion-flush accordion-why mb-4" id="acdWhy">
                                <div class="accordion-item bg-transparent">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acdContent1" aria-expanded="false" aria-controls="acdContent1">
                                            <i class="hicon hicon-bold hicon-positive"></i>
                                            <span>Official IRCTC Partner</span>
                                        </button>
                                    </h2>
                                    <div id="acdContent1" class="accordion-collapse collapse" data-bs-parent="#acdWhy">
                                        <div class="accordion-body">
                                            We operate as an official IRCTC tourism partner, offering reliable and authentic travel services endorsed by Indian Railways.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item bg-transparent">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acdContent2" aria-expanded="false" aria-controls="acdContent2">
                                            <i class="hicon hicon-bold hicon-positive"></i>
                                            <span>Expertise in Rail Tour Packages</span>
                                        </button>
                                    </h2>
                                    <div id="acdContent2" class="accordion-collapse collapse" data-bs-parent="#acdWhy">
                                        <div class="accordion-body">
                                            Our experience in railway-based tourism ensures smooth logistics, quality accommodation, and enriching sightseeing options.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item bg-transparent">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acdContent3" aria-expanded="false" aria-controls="acdContent3">
                                            <i class="hicon hicon-bold hicon-positive"></i>
                                            <span>Customizable IRCTC Packages</span>
                                        </button>
                                    </h2>
                                    <div id="acdContent3" class="accordion-collapse collapse" data-bs-parent="#acdWhy">
                                        <div class="accordion-body">
                                            From luxury trains to pilgrimage circuits, you can choose and personalize IRCTC packages that suit your needs.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item bg-transparent">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acdContent4" aria-expanded="false" aria-controls="acdContent4">
                                            <i class="hicon hicon-bold hicon-positive"></i>
                                            <span>Affordable Government Prices</span>
                                        </button>
                                    </h2>
                                    <div id="acdContent4" class="accordion-collapse collapse" data-bs-parent="#acdWhy">
                                        <div class="accordion-body">
                                            Get the best deals directly from IRCTC — with transparent pricing, no middlemen, and quality guaranteed.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('/contact') }}" class="btn btn-primary btn-uppercase mnw-180">
                                <span>Explore IRCTC Tours</span>
                                <i class="hicon hicon-flights-one-ways"></i>
                            </a>
                        </div>
                        <!-- /Content -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /Why -->

       <!-- Categories -->
        <section class="p-top-90 p-bottom-90 bg-gray-gradient">
            <div class="container">
                <!-- Title -->
                <div class="d-xl-flex align-items-xl-center pb-4">
                    <div class="block-title me-auto">
                        <small class="sub-title">IRCTC Tour Categories</small>
                        <h2 class="h1 title">Explore with IRCTC</h2>
                    </div>
                    <div class="fw-normal text-secondary mt-3">
                        Need help planning? <a href="{{ url('/contact') }}"><abbr title="Contact IRCTC support" class="fw-semibold">Get in touch</abbr></a>
                    </div>
                </div>
                <!-- /Title -->
                <!-- Category list -->
                <div class="row g-3">
                    <div class="col-12 col-xxl-3 col-xl-4 col-md-6">
                        <a href="{{ url('/contact') }}" class="mini-card card-hover hover-effect shadow-sm rounded">
                            <span class="card-icon">
                                <i class="hicon hicon-train"></i>
                            </span>
                            <div class="card-content">
                                <h3 class="h5 card-title">Bharat Gaurav Train Tours</h3>
                                <small class="card-desc">52 packages</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-xxl-3 col-xl-4 col-md-6">
                        <a href="{{ url('/contact') }}" class="mini-card card-hover hover-effect shadow-sm rounded">
                            <span class="card-icon">
                                <i class="hicon hicon-flight-takeoff"></i>
                            </span>
                            <div class="card-content">
                                <h3 class="h5 card-title">IRCTC Flight Packages</h3>
                                <small class="card-desc">78 packages</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-xxl-3 col-xl-4 col-md-6">
                        <a href="{{ url('/contact') }}" class="mini-card card-hover hover-effect shadow-sm rounded">
                            <span class="card-icon">
                                <i class="hicon hicon-hindu-temple"></i>
                            </span>
                            <div class="card-content">
                                <h3 class="h5 card-title">Pilgrimage Tours</h3>
                                <small class="card-desc">119 tours</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-xxl-3 col-xl-4 col-md-6">
                        <a href="{{ url('/contact') }}" class="mini-card card-hover hover-effect shadow-sm rounded">
                            <span class="card-icon">
                                <i class="hicon hicon-map-travel"></i>
                            </span>
                            <div class="card-content">
                                <h3 class="h5 card-title">All India IRCTC Tours</h3>
                                <small class="card-desc">94 tours</small>
                            </div>
                        </a>
                    </div>
                    <!-- Add more IRCTC-specific categories here if needed -->
                </div>
                <!-- /Category list -->
            </div>
        </section>

        <!-- /Categories -->

       <!-- Booking -->
        <section class="p-top-110 p-bottom-110 bg-dark-blue">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-12 col-xl-8">
                        <div class="text-center">
                            <div class="block-title">
                                <small class="sub-title text-light">IRCTC Travel</small>
                                <h2 class="h1 title text-white">Book Your IRCTC Journey Today</h2>
                            </div>
                            <div class="d-md-inline-flex align-items-md-center">
                                <a href="https://wa.me/919672832691" target="_blank" class="btn btn-primary btn-uppercase mnw-180 me-2 ms-2 mt-4">
                                    <i class="hicon hicon hicon-bold hicon-train"></i>
                                    <span>Book IRCTC Tours</span>
                                </a>
                                <a href="{{ url('/contact') }}" class="btn btn-outline-light btn-uppercase mnw-180 me-2 ms-2 mt-4">
                                    <i class="hicon hicon hicon-email-envelope"></i>
                                    <span>Contact IRCTC</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- /Booking -->

        <!-- Testimonials -->
        <section class="p-top-90 p-bottom-90 bg-gray-gradient">
            <div class="container">
                <div class="testimonials-slider-1 splide mb-5">
                    <!-- Title -->
                    <div class="d-xl-flex align-items-xl-center mb-3">
                        <div class="block-title me-auto">
                            <small class="sub-title">Genuine Reviews</small>
                            <h2 class="h1 title">What our travelers say</h2>
                        </div>
                        <div class="d-lg-flex align-items-lg mt-3">
                            <div class="d-md-flex align-items-md-center me-md-4">
                                <div class="extra-info me-4">
                                    <strong>+95K</strong>
                                    <span>Successful Bookings</span>
                                </div>
                                <div class="extra-info me-4">
                                    <strong>4.9</strong>
                                    <span class="fw-medium text-secondary">
                                        <span class="star-rate-view star-rate-size-sm"><span class="star-value rate-50"></span></span>
                                        <span>(+85K reviews)</span>
                                    </span>
                                </div>
                            </div>
                            <div class="splide__arrows splide__arrows__right">
                                <button class="splide__arrow splide__arrow--prev me-2">
                                    <i class="hicon hicon-edge-arrow-left"></i>
                                </button>
                                <button class="splide__arrow splide__arrow--next">
                                    <i class="hicon hicon-edge-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /Title -->
                    <!-- Reviews -->
                    <div class="splide__track pt-2 pb-2">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <div class="testimonial-box shadow-sm rounded mb-1 hover-effect">
                                    <span class="testimonial-icon">
                                        <i class="hicon hicon-message-right"></i>
                                    </span>
                                    <div class="testimonial-client">
                                        <img src="assets/img/avatars/a1.jpg" srcset="./assets/img/avatars/a1@2x.jpg 2x" alt="">
                                        <div class="name">
                                            <h3 class="h5 mb-0">Ankit Sharma</h3>
                                            <span>Bhopal, India</span>
                                        </div>
                                    </div>
                                    <div class="testimonial-content">
                                        <blockquote class="testimonial-review">
                                            Booking the Chardham Yatra through <strong>IRCTC</strong> was the best decision! Everything from the helicopter arrangements to the accommodation was flawless. Highly recommended for a divine experience!
                                        </blockquote>
                                        <div class="testimonial-star">
                                            <span class="star-rate-view star-rate-size-sm"><span class="star-value rate-45"></span></span>
                                            <span class="testimonial-date rounded-1">Jun 25 24</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="testimonial-box shadow-sm rounded mb-1 hover-effect">
                                    <span class="testimonial-icon">
                                        <i class="hicon hicon-message-right"></i>
                                    </span>
                                    <div class="testimonial-client">
                                        <img src="assets/img/avatars/a2.jpg" srcset="./assets/img/avatars/a2@2x.jpg 2x" alt="">
                                        <div>
                                            <h3 class="h5 mb-0">Sudeepa Chatarjee</h3>
                                            <span>Kolkata, India</span>
                                        </div>
                                    </div>
                                    <div class="testimonial-content">
                                        <blockquote class="testimonial-review">
                                            The spiritual journey was made stress-free by <strong>IRCTC’s</strong> Chardham Yatra by Helicopter. Their expert planning and smooth coordination made this a once-in-a-lifetime experience.
                                        </blockquote>
                                        <div class="testimonial-star">
                                            <span class="star-rate-view star-rate-size-sm"><span class="star-value rate-45"></span></span>
                                            <span class="testimonial-date rounded-1">Jun 28 24</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="testimonial-box shadow-sm rounded mb-1 hover-effect">
                                    <span class="testimonial-icon">
                                        <i class="hicon hicon-message-right"></i>
                                    </span>
                                    <div class="testimonial-client">
                                        <img src="assets/img/avatars/a3.jpg" srcset="./assets/img/avatars/a3@2x.jpg 2x" alt="">
                                        <div>
                                            <h3 class="h5 mb-0">Tanmay Shah</h3>
                                            <span>Gujurat, India</span>
                                        </div>
                                    </div>
                                    <div class="testimonial-content">
                                        <blockquote class="testimonial-review">
                                            I was initially nervous, but <strong>IRCTC</strong> took care of every detail of our Chardham Yatra. From check-ins to temple visits, everything was seamless. A must for spiritual travelers!
                                        </blockquote>
                                        <div class="testimonial-star">
                                            <span class="star-rate-view star-rate-size-sm"><span class="star-value rate-45"></span></span>
                                            <span class="testimonial-date rounded-1">Jun 28 24</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="testimonial-box shadow-sm rounded mb-1 hover-effect">
                                    <span class="testimonial-icon">
                                        <i class="hicon hicon-message-right"></i>
                                    </span>
                                    <div class="testimonial-client">
                                        <img src="assets/img/avatars/a4.jpg" srcset="./assets/img/avatars/a4@2x.jpg 2x" alt="">
                                        <div>
                                            <h3 class="h5 mb-0">Shankar Rao</h3>
                                            <span>Vishakapatanam, Indian</span>
                                        </div>
                                    </div>
                                    <div class="testimonial-content">
                                        <blockquote class="testimonial-review">
                                            I can’t thank <strong>IRCTC</strong> enough for their outstanding arrangements. The helicopter ride, the food, the stay — everything exceeded our expectations. A true spiritual luxury!
                                        </blockquote>
                                        <div class="testimonial-star">
                                            <span class="star-rate-view star-rate-size-sm"><span class="star-value rate-45"></span></span>
                                            <span class="testimonial-date rounded-1">Jun 28 24</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="testimonial-box shadow-sm rounded mb-1 hover-effect">
                                    <span class="testimonial-icon">
                                        <i class="hicon hicon-message-right"></i>
                                    </span>
                                    <div class="testimonial-client">
                                        <img src="assets/img/avatars/a3.jpg" srcset="./assets/img/avatars/a3@2x.jpg 2x" alt="">
                                        <div>
                                            <h3 class="h5 mb-0">Priya Mehta</h3>
                                            <span>Mumbai, India</span>
                                        </div>
                                    </div>
                                    <div class="testimonial-content">
                                        <blockquote class="testimonial-review">
                                            IRCTC's Chardham Yatra by Helicopter is the perfect way to explore Uttarakhand’s sacred shrines. Hassle-free and beautifully managed. Would definitely recommend to family and friends!
                                        </blockquote>
                                        <div class="testimonial-star">
                                            <span class="star-rate-view star-rate-size-sm"><span class="star-value rate-45"></span></span>
                                            <span class="testimonial-date rounded-1">Jun 28 24</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /Reviews -->
                </div>
            </div>
        </section>

        <!-- /testimonials -->

       

   @endsection



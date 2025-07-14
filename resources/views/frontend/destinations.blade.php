@extends('frontend.layouts.app')
@section('content')
 <!-- Title -->
        <section class="hero">
            <div class="hero-bg">
                <img src="{{asset('frontend/assets/img/tours/bg.jpg')}}" srcset="./frontend/assets/img/tours/bg.jpg 2x"  alt="">
            </div>
            <div class="bg-content container">
                <div class="hero-page-title">
                    <span class="hero-sub-title">Destination</span>
                    <h1 class="display-4 hero-title">
                        Destinations
                    </h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">destinations</li>
                    </ol>
                </nav>
            </div>
        </section>
        <!-- /Title -->
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
       

@endsection
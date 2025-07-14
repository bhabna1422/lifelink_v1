				<!-- main-header -->
				<div class="main-header side-header sticky nav nav-item">
					<div class=" main-container container-fluid">
						<div class="main-header-left ">
							<div class="responsive-logo">
								<a href="{{url('index')}}" class="header-logo">
								    EZRA
								</a>
							</div>
							<div class="app-sidebar__toggle" data-bs-toggle="sidebar">
								<a class="open-toggle" href="javascript:void(0);"><i class="header-icon fe fe-align-left" ></i></a>
								<a class="close-toggle" href="javascript:void(0);"><i class="header-icon fe fe-x"></i></a>
							</div>
							<div class="logo-horizontal">
								<a href="{{url('index')}}" class="header-logo">
									<img src="{{asset('assets/img/brand/logo.png')}}" class="mobile-logo logo-1" alt="logo">
									<img src="{{asset('assets/img/brand/logo-white.png')}}" class="mobile-logo dark-logo-1" alt="logo">
								</a>
							</div>
						
						</div>
						<div class="main-header-right">
							<button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon fe fe-more-vertical "></span>
							</button>
							<div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
								<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
									<ul class="nav nav-item header-icons navbar-nav-right ms-auto">
									
										<li class="dropdown main-profile-menu nav nav-item nav-link ps-lg-2">
											<a class="new nav-link profile-user d-flex" href="" data-bs-toggle="dropdown"><img alt="" src="{{asset('assets/img/faces/2.jpg')}}" class=""></a>
											<div class="dropdown-menu">
												<div class="menu-header-content p-3 border-bottom">
													<div class="d-flex wd-100p">
														<div class="main-img-user"><img alt="" src="{{asset('assets/img/faces/2.jpg')}}" class=""></div>
														<div class="ms-3 my-auto">
															<h6 class="tx-15 font-weight-semibold mb-0">Super Admin</h6>
														</div>
													</div>
												</div>
											
												<form method="POST" action="{{ url('superadmin/logout') }}">
													@csrf
													<button type="submit"  class="dropdown-item"><i class="far fa-arrow-alt-circle-left"></i>Logout</button>
												</form>

												<!-- <a class="dropdown-item" href="{{url('logout')}}"><i class="far fa-arrow-alt-circle-left"></i> Sign Out</a> -->
											</div>
										</li>
									</ul>
								</div>
                                <!--place for switcher icon-->
							</div>
						</div>
					</div>
				</div>
				<!-- /main-header -->

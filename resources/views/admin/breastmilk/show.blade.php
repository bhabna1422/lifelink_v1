@extends('admin.layouts.app')

    @section('styles')

		<!--- Internal Select2 css-->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE Breast milk</span>
						</div>
						<div class="justify-content-center mt-2">
                          
							<ol class="breadcrumb">
                            
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE Breast milk</li>
                                <li class="breadcrumb-item tx-15"><a href="{{ route('breastmilk.index') }}"
                                    class="btn btn-info text-white">Manage Breast milk</a></li>
							</ol>
						</div>
					</div>
					<!-- /breadcrumb -->
                   

                      <!-- Row -->
                      <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <!-- <div>
                                        <h6 class="main-content-label mb-1">File export Datatables</h6>
                                        <p class="text-muted card-sub-title">Exporting data from a table can often be a key part of a complex application. The Buttons extension for DataTables provides three plug-ins that provide overlapping functionality for data export:</p>
                                    </div> -->

                                    
                                    @if (session()->has('success'))
                                    <div class="alert alert-success" id="Message">
                                        {{ session()->get('success') }}
                                    </div>
                                    @endif

                                    @if ($errors->has('danger'))
                                    <div class="alert alert-danger" id="Message">
                                        {{ $errors->first('danger') }}
                                    </div>
                                    @endif
                                    <!-- resources/views/users/show.blade.php -->

                                   
                                    <h3>Request Details</h3>

                                    <ul class="list-group">

                                        <li class="list-group-item"><strong>Name:</strong> {{ $breastmilk->name }}</li>
                                        <li class="list-group-item"><strong>Requeter name:</strong> {{ $breastmilk->requester->name ?? "na" }}</li>
                                        <li class="list-group-item"><strong>Phone:</strong> {{ $breastmilk->phone }}</li>
                                        <li class="list-group-item"><strong>Location:</strong> {{ $breastmilk->location }}</li>
                                        <li class="list-group-item"><strong>Milk Quantity:</strong> {{ $breastmilk->milk_quantity }} ml</li>
                                        <li class="list-group-item"><strong>Milk Type:</strong> {{ $breastmilk->milk_type }}</li>
                                        <li class="list-group-item"><strong>Milk For:</strong> {{ $breastmilk->milk_for == 1 ? 'Donation' : 'Personal Use' }}</li>
                                    </ul>
                                
                                    <a href="{{ route('breastmilk.index') }}" class="btn btn-secondary mt-3">Back</a>
                                        
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->
                    
                    

							
					</div>
					

                    
					

                    @endsection

                    @section('modal')
                  

                    @endsection

    @section('scripts')

		<!-- Form-layouts js -->
		<script src="{{asset('assets/js/form-layouts.js')}}"></script>

		<!--Internal  Select2 js -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>



    @endsection

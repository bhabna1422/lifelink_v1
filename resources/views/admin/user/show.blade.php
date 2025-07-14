@extends('admin.layouts.app')

    @section('styles')

		<!--- Internal Select2 css-->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE Users</span>
						</div>
						<div class="justify-content-center mt-2">
                          
							<ol class="breadcrumb">
                            
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE Users</li>
                                <li class="breadcrumb-item tx-15"><a href="{{ route('users.index') }}"
                                    class="btn btn-info text-white">Manage Users</a></li>
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

                                <h4>User Details</h4>

                                <p><strong>Name:</strong> {{ $user->name }}</p>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                                <p><strong>DOB:</strong> {{ $user->dob }}</p>
                                <p><strong>Gender:</strong> {{ $user->gender }}</p>
                                <p><strong>Blood Group:</strong> {{ $user->blood_group }}</p>
                                <p><strong>Location:</strong> {{ $user->location }}</p>
                                <p><strong>Coordinate:</strong> {{ $user->coordinate }}</p>
                                <p><strong>Admin message:</strong> {{ $user->admin_message }}</p>
                                <p><strong>Delete status:</strong> {{ $user->delete_status }}</p>

                                <p><strong>Donor:</strong> {{ $user->is_donor ? 'Yes' : 'No' }}</p>
                                <p><strong>Ambulance Provider:</strong> {{ $user->is_ambulance_provider ? 'Yes' : 'No' }}</p>
                                <p><strong>Milk Donor:</strong> {{ $user->is_milk_donor ? 'Yes' : 'No' }}</p>
                                <p><strong>is deleted:</strong> {{ $user->is_deleting ? 'Yes' : 'No' }}</p>

                                <p><strong>Created At:</strong> {{ $user->created_at }}</p>
                                <p><strong>Updated At:</strong> {{ $user->updated_at }}</p>


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

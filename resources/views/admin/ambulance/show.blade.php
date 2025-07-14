@extends('admin.layouts.app')

    @section('styles')

		<!--- Internal Select2 css-->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE ambulance</span>
						</div>
						<div class="justify-content-center mt-2">
                          
							<ol class="breadcrumb">
                            
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE ambulance</li>
                                <li class="breadcrumb-item tx-15"><a href="{{ route('ambulances.index') }}"
                                    class="btn btn-info text-white">Manage ambulance</a></li>
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

                                   
                                                <h4>Ambulance Details</h4>
                                            
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Name</th>
                                                        <td>{{ $ambulance->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID</th>
                                                        <td>{{ $ambulance->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone</th>
                                                        <td>{{ $ambulance->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Group</th>
                                                        <td>{{ $ambulance->group }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td>{{ $ambulance->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Landmark</th>
                                                        <td>{{ $ambulance->landmark }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Creator</th>
                                                        <td>{{ $ambulance->creator }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Reg Number</th>
                                                        <td>{{ $ambulance->reg_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>OTP Session ID</th>
                                                        <td>{{ $ambulance->otp_session_id ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>OTP</th>
                                                        <td>{{ $ambulance->otp ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Is Verified</th>
                                                        <td>{{ $ambulance->is_verified ? 'Yes' : 'No' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Created At</th>
                                                        <td>{{ $ambulance->created_at->format('d M Y, h:i A') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Updated At</th>
                                                        <td>{{ $ambulance->updated_at->format('d M Y, h:i A') }}</td>
                                                    </tr>
                                                </table>
                                    
                                                <a href="{{ route('ambulances.index') }}" class="btn btn-secondary mt-3">Back to List</a>
                                            </div>
                                        
                                    

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

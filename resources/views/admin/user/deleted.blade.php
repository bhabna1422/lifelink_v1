@extends('admin.layouts.app')

    @section('styles')

		<!--- Internal Select2 css-->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE Deleted Users</span>
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
                                    {{-- <form method="GET" action="{{ route('users.deleted') }}" class="mb-4">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <h5 class="mb-2">Basic Information</h5>
                                            </div>
                                            <div class="col-md-2 mb-2"><input type="text" name="id" class="form-control" placeholder="User ID" value="{{ request('id') }}"></div>
                                            <div class="col-md-2 mb-2"><input type="text" name="name" class="form-control" placeholder="Name" value="{{ request('name') }}"></div>
                                            <div class="col-md-2 mb-2"><input type="text" name="email" class="form-control" placeholder="Email" value="{{ request('email') }}"></div>
                                            <div class="col-md-2 mb-2"><input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ request('phone') }}"></div>
                                            <div class="col-md-2 mb-2"><input type="text" name="blood_group" class="form-control" placeholder="Blood Group" value="{{ request('blood_group') }}"></div>
                                            <div class="col-md-2 mb-2"><input type="text" name="location" class="form-control" placeholder="Location" value="{{ request('location') }}"></div>
                                            <div class="col-md-2 mb-2"><input type="text" name="coordinate" class="form-control" placeholder="Coordinate" value="{{ request('coordinate') }}"></div>
                                            <div class="col-md-2 mb-2">
                                                <select name="gender" class="form-control">
                                                    <option value="">Gender</option>
                                                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                    <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-2"><input type="text" name="admin_message" class="form-control" placeholder="Admin Message" value="{{ request('admin_message') }}"></div>
                                            <div class="col-md-2 mb-2"><input type="text" name="delete_status" class="form-control" placeholder="Delete Status" value="{{ request('delete_status') }}"></div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <h6 class="mb-2">Date of Birth Range</h6>
                                                <div class="row">
                                                    <div class="col-md-6 mb-2"><input type="date" name="dob_from" class="form-control" placeholder="DOB From" value="{{ request('dob_from') }}"></div>
                                                    <div class="col-md-6 mb-2"><input type="date" name="dob_to" class="form-control" placeholder="DOB To" value="{{ request('dob_to') }}"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="mb-2">Account Created Range</h6>
                                                <div class="row">
                                                    <div class="col-md-6 mb-2"><input type="date" name="created_from" class="form-control" placeholder="Created From" value="{{ request('created_from') }}"></div>
                                                    <div class="col-md-6 mb-2"><input type="date" name="created_to" class="form-control" placeholder="Created To" value="{{ request('created_to') }}"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="mb-2">Last Updated Range</h6>
                                                <div class="row">
                                                    <div class="col-md-6 mb-2"><input type="date" name="updated_from" class="form-control" placeholder="Updated From" value="{{ request('updated_from') }}"></div>
                                                    <div class="col-md-6 mb-2"><input type="date" name="updated_to" class="form-control" placeholder="Updated To" value="{{ request('updated_to') }}"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <h5 class="mb-2">Roles & Flags</h5>
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <select name="is_donor" class="form-control">
                                                    <option value="">Donor?</option>
                                                    <option value="1" {{ request('is_donor') == '1' ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ request('is_donor') === '0' ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <select name="is_milk_donor" class="form-control">
                                                    <option value="">Milk Donor?</option>
                                                    <option value="1" {{ request('is_milk_donor') == '1' ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ request('is_milk_donor') === '0' ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <select name="is_ambulance_provider" class="form-control">
                                                    <option value="">Ambulance?</option>
                                                    <option value="1" {{ request('is_ambulance_provider') == '1' ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ request('is_ambulance_provider') === '0' ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <select name="is_deleting" class="form-control">
                                                    <option value="">Is Deleting?</option>
                                                    <option value="1" {{ request('is_deleting') == '1' ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ request('is_deleting') === '0' ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-md-12 d-flex gap-3">
                                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                                <a href="{{ route('users.deleted') }}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </form> --}}

                                    <div class="table-responsive ">
                                        <table id="file-datatable" class="table table-bordered ">
                                           
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Reason</th>
                                                        <th>Location</th>
                                                        <th>is Ambulance Provide</th>
                                                        <th>Deleted At</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $i => $user)
                                                        <tr>
                                                           
                                                                <td>{{ $i + 1 }}</td>
                                                                
                                                                <td>
                                                                    <a href="{{ route('users.show', $user->id) }}">
                                                                        {{ $user->name }}
                                                                    </a>
                                                                </td>
                                                                
                                                                <td>
                                                                    <a href="{{ route('users.show', $user->id) }}">
                                                                        {{ $user->email }}
                                                                    </a>
                                                                </td>
                                                                
                                                                <td>
                                                                    <a href="{{ route('users.show', $user->id) }}">
                                                                        {{ $user->admin_message }}
                                                                    </a>
                                                                </td>
                                                                
                                                                <td>
                                                                    <a href="{{ route('users.show', $user->id) }}">
                                                                        {{ $user->location }}
                                                                    </a>
                                                                </td>
                                                                
                                                                <td>
                                                                    <a href="{{ route('users.show', $user->id) }}">
                                                                        {{ $user->is_ambulance_provider ? 'Yes' : 'No' }}
                                                                    </a>
                                                                </td>
                                                                
                                                                <td>
                                                                    <a href="{{ route('users.show', $user->id) }}">
                                                                        {{ $user->updated_at->format('d M Y h:i A') }}
                                                                    </a>
                                                                </td>
                                                           
                                                            <td>
                                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">View</a>
                                                                {{-- <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                                                               
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                        
                                            
                                        </table>
                                      
                                        

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

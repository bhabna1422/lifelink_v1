@extends('admin.layouts.app')

    @section('styles')

		<!--- Internal Select2 css-->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE Blood</span>
						</div>
						<div class="justify-content-center mt-2">
							<ol class="breadcrumb">
                            
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE Blood</li>
                                <li class="breadcrumb-item tx-15"><a href="{{ route('bloods.create') }}"
                                    class="btn btn-info text-white">Add Bloood</a></li>
							</ol>
						</div>
					</div>
					<!-- /breadcrumb -->
                   
							
					
                      <!-- Row -->
                      <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                   
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
                                    <form method="GET" action="{{ route('bloods.index') }}" class="mb-4">
                                        <div class="row g-3 align-items-end">
                                            <div class="col-md-2">
                                                <label>Name</label>
                                                <input type="text" name="name" value="{{ request('name') }}" class="form-control">
                                            </div>
                                    
                                            <div class="col-md-2">
                                                <label>Blood Group</label>
                                                <input type="text" name="blood_group" value="{{ request('blood_group') }}" class="form-control">
                                            </div>
                                    
                                            <div class="col-md-2">
                                                <label>Phone</label>
                                                <input type="text" name="phone" value="{{ request('phone') }}" class="form-control">
                                            </div>
                                    
                                            <div class="col-md-2">
                                                <label>Is Verified</label>
                                                <select name="is_verified" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="1" {{ request('is_verified') === '1' ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ request('is_verified') === '0' ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                    
                                            <div class="col-md-2">
                                                <label>From Date</label>
                                                <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control">
                                            </div>
                                    
                                            <div class="col-md-2">
                                                <label>To Date</label>
                                                <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
                                            </div>
                                    
                                            <div class="col-md-12 mt-2 d-flex gap-2">
                                                <button type="submit" class="btn btn-primary">Apply</button>
                                                <a href="{{ route('bloods.index') }}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    <div class="table-responsive ">
                                        <table id="file-datatable" class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>OTP Session ID</th>
                                                    <th>Is Verified</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                                @foreach($bloodRequests as $index => $request)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>

                                                        <td>
                                                            <a href="{{ route('bloods.show', $request->id) }}">
                                                                {{ $request->name }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('bloods.show', $request->id) }}">
                                                                {{ \Illuminate\Support\Str::limit($request->otp_session_id, 10, '...') }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('bloods.show', $request->id) }}">
                                                                {{ $request->is_verified ? 'Yes' : 'No' }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('bloods.show', $request->id) }}">
                                                                {{ $request->created_at }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('bloods.show', $request->id) }}">
                                                                {{ $request->updated_at }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('bloods.show', $request->id) }}" class="btn btn-sm btn-primary">View</a>
                                                            <a href="{{ route('bloods.edit', $request->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="{{ route('bloods.destroy', $request->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this request?')">Delete</button>
                                                            </form>
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

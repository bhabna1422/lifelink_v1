@extends('admin.layouts.app')

    @section('styles')

		<!--- Internal Select2 css-->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<style>
    div#file-datatable_paginate {
    display: none;
}
span.relative.z-0.inline-flex.shadow-sm.rounded-md {
    display: none;
}
div#file-datatable_info {
    display: none;
}
</style>
    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE donor</span>
						</div>
						<div class="justify-content-center mt-2">
							<ol class="breadcrumb">
                            
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE donor</li>
                                <li class="breadcrumb-item tx-15"><a href="{{ route('donors.create') }}"
                                    class="btn btn-info text-white">Add donor</a></li>
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
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
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
                                    <form method="GET" action="{{ route('donors.index') }}" class="mb-4">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" name="donor" class="form-control" placeholder="Donor Name" value="{{ request('donor') }}">
                                            </div>

                                            <div class="col-md-3">
                                                <input type="text" name="blood_request" class="form-control" placeholder="Blood Request" value="{{ request('blood_request') }}">
                                            </div>

                                            <div class="col-md-2">
                                                <select name="is_verified" class="form-control">
                                                    <option value="">Is Verified</option>
                                                    <option value="1" {{ request('is_verified') == '1' ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ request('is_verified') == '0' ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                            </div>

                                            <div class="col-md-2">
                                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                            </div>

                                            <div class="col-md-2 mt-3 d-flex">
                                                <button type="submit" class="btn btn-primary mr-2">Apply</button>
                                                <a href="{{ route('donors.index') }}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="file-datatable">
                                           
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Donor Id</th>
                                                        <th>Blood Id</th>
                                                        <th>Is Verified</th>
                                                        <th>Created At</th>
                                                        <th>Updated At</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                               <tbody>
                                                    @foreach($donors as $index => $donor)
                                                    <tr>
                                                        <td><a href="{{ route('donors.show', $donor->id) }}">{{ $index + 1 }}</a></td>
                                                        <td><a href="{{ route('donors.show', $donor->id) }}">{{ $donor->user->name ?? 'N/A' }}</a></td>
                                                        <td><a href="{{ route('donors.show', $donor->id) }}">{{ $donor->blood->name ?? 'N/A' }}</a></td>
                                                        <td><a href="{{ route('donors.show', $donor->id) }}">{{ $donor->is_verified ? 'Yes' : 'No' }}</a></td>
                                                        <td><a href="{{ route('donors.show', $donor->id) }}">{{ $donor->created_at ?? 'N/A' }}</a></td>
                                                        <td><a href="{{ route('donors.show', $donor->id) }}">{{ $donor->updated_at ?? 'N/A' }}</a></td>
                                                        <td>
                                                            <a href="{{ route('donors.show', $donor->id) }}" class="btn btn-info btn-sm">View</a>
                                                            <a href="{{ route('donors.edit', $donor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                            <form action="{{ route('donors.destroy', $donor->id) }}" method="POST" style="display:inline;">
                                                                @csrf @method('DELETE')
                                                                <button onclick="return confirm('Delete this donor request?')" class="btn btn-danger btn-sm">Delete</button>
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

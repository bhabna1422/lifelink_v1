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
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE milkdonor</span>
						</div>
						<div class="justify-content-center mt-2">
							<ol class="breadcrumb">
                            
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE milkdonor</li>
                                <li class="breadcrumb-item tx-15"><a href="{{ route('milkdonors.create') }}"
                                    class="btn btn-info text-white">Add milkdonor</a></li>
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
                                    <form method="GET" action="{{ route('milkdonors.index') }}" class="mb-4">
    <div class="row">
        <!-- Donor Filter -->
        <!-- Donor Name Search -->
<div class="col-md-3">
    <label>Donor Name</label>
    <input type="text" name="donor_id" class="form-control" placeholder="Enter Donor Name" value="{{ request('donor_id') }}">
</div>

<!-- Breast Milk Name Search -->
<div class="col-md-3">
    <label>Breast Milk Name</label>
    <input type="text" name="breast_milk_id" class="form-control" placeholder="Enter Breast Milk Name" value="{{ request('breast_milk_id') }}">
</div>


        <!-- Verified -->
        <div class="col-md-2">
            <label>Is Verified</label>
            <select name="is_verified" class="form-control">
                <option value="">-- All --</option>
                <option value="1" {{ request('is_verified') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ request('is_verified') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- From Date -->
        <div class="col-md-2">
            <label>From Date</label>
            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>

        <!-- To Date -->
        <div class="col-md-2">
            <label>To Date</label>
            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>

        <!-- Buttons -->
        <div class="col-md-2 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary w-100">Apply</button>
            <a href="{{ route('milkdonors.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </div>
</form>


                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="file-datatable">
                                           
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Donor Id</th>
                                                        <th>Breast milk Id</th>
                                                        <th>Is Verified</th>
                                                        <th>Created At</th>
                                                        <th>Updated At</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                               <tbody>
                                                    @foreach($milkdonors as $index => $donor)
                                                    <tr>
                                                        <td><a href="{{ route('milkdonors.show', $donor->id) }}">{{ $index + 1 }}</a></td>
                                                        <td><a href="{{ route('milkdonors.show', $donor->id) }}">{{ $donor->donor->name ?? 'N/A' }}</a></td>
                                                        <td><a href="{{ route('milkdonors.show', $donor->id) }}">{{ $donor->breastMilk->name ?? 'N/A' }}</a></td>
                                                        <td><a href="{{ route('milkdonors.show', $donor->id) }}">{{ $donor->is_verified ? 'Yes' : 'No' }}</a></td>
                                                        <td><a href="{{ route('milkdonors.show', $donor->id) }}">{{ $donor->created_at ?? 'N/A' }}</a></td>
                                                        <td><a href="{{ route('milkdonors.show', $donor->id) }}">{{ $donor->updated_at ?? 'N/A' }}</a></td>
                                                        <td>
                                                            <a href="{{ route('milkdonors.show', $donor->id) }}" class="btn btn-info btn-sm">View</a>
                                                            <a href="{{ route('milkdonors.edit', $donor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                            <form action="{{ route('milkdonors.destroy', $donor->id) }}" method="POST" style="display:inline;">
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

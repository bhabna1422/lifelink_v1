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
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE breastmilk</span>
						</div>
						<div class="justify-content-center mt-2">
							<ol class="breadcrumb">
                            
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE breastmilk</li>
                                <li class="breadcrumb-item tx-15"><a href="{{ route('breastmilk.create') }}"
                                    class="btn btn-info text-white">Add breastmilk</a></li>
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
                                    <form method="GET" action="{{ route('breastmilk.index') }}" class="mb-4">
                                        <div class="row">
                                            <div class="col-md-2"><input type="text" name="requester" class="form-control" placeholder="Requester" value="{{ request('requester') }}"></div>
                                            <div class="col-md-2"><input type="text" name="name" class="form-control" placeholder="Name" value="{{ request('name') }}"></div>
                                            <div class="col-md-2"><input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ request('phone') }}"></div>
                                            <div class="col-md-2"><input type="text" name="location" class="form-control" placeholder="Location" value="{{ request('location') }}"></div>
                                            <div class="col-md-2"><input type="text" name="milk_quantity" class="form-control" placeholder="Quantity" value="{{ request('milk_quantity') }}"></div>
                                            <div class="col-md-2"><input type="text" name="milk_type" class="form-control" placeholder="Milk Type" value="{{ request('milk_type') }}"></div>

                                            <div class="col-md-2 mt-3">
                                                <select name="milk_for" class="form-control">
                                                    <option value="">Milk For</option>
                                                    <option value="1" {{ request('milk_for') == '1' ? 'selected' : '' }}>Donation</option>
                                                    <option value="0" {{ request('milk_for') == '0' ? 'selected' : '' }}>Personal Use</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2  mt-3"><input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}"></div>
                                            <div class="col-md-2  mt-3"><input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}"></div>

                                            <div class="col-md-2  mt-3 d-flex">
                                                <button type="submit" class="btn btn-primary mr-2" style="margin-right:10px">Apply</button>
                                                <a href="{{ route('breastmilk.index') }}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="file-datatable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Requester</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Location</th>
                                                    <th>Milk Quantity</th>
                                                    <th>Milk Type</th>
                                                    <th>Milk For</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($records as $key => $data)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>

                                                        <td>
                                                            <a href="{{ route('breastmilk.show', $data->id) }}">
                                                                {{ optional($data->requester)->name ?? '-' }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('breastmilk.show', $data->id) }}">
                                                                {{ $data->name }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('breastmilk.show', $data->id) }}">
                                                                {{ $data->phone }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('breastmilk.show', $data->id) }}">
                                                                {{ $data->location }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('breastmilk.show', $data->id) }}">
                                                                {{ $data->milk_quantity }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('breastmilk.show', $data->id) }}">
                                                                {{ $data->milk_type }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('breastmilk.show', $data->id) }}">
                                                                {{ $data->milk_for == 1 ? 'Donation' : 'Personal Use' }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('breastmilk.show', $data->id) }}" class="btn btn-info btn-sm">View</a>
                                                            <a href="{{ route('breastmilk.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                            <form action="{{ route('breastmilk.destroy', $data->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this request?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm">Delete</button>
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

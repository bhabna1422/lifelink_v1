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
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE Ambulance</span>
						</div>
						<div class="justify-content-center mt-2">
							<ol class="breadcrumb">
                            
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE Ambulance</li>
                                <li class="breadcrumb-item tx-15"><a href="{{ route('ambulances.create') }}"
                                    class="btn btn-info text-white">Add Ambulance</a></li>
							</ol>
						</div>
					</div>
					<!-- /breadcrumb -->
                    
                   

                      <!-- Row -->
                      <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card">
                                <div class="card-body">
                                    {{-- Flash Messages --}}
                                    @if (session()->has('success'))
                                        <div class="alert alert-success" id="Message">{{ session()->get('success') }}</div>
                                    @endif
                                    @if ($errors->has('danger'))
                                        <div class="alert alert-danger" id="Message">{{ $errors->first('danger') }}</div>
                                    @endif
                    
                                    {{-- Filter Form --}}
                                    <form method="GET" action="{{ route('ambulances.index') }}" class="mb-4">
                                        <div class="row g-3 align-items-end">
                                            <div class="col-md-2">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ request('name') }}">
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label">ID</label>
                                                <input type="text" name="id" class="form-control" value="{{ request('id') }}">
                                            </div>
                                            <div class="col-md-2" >
                                                <label class="form-label">Is Verified</label>
                                                <select name="is_verified" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="1" {{ request('is_verified') == '1' ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ request('is_verified') == '0' ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Ambulance Group</label>
                                                <select name="group" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="1" {{ request('group') == '1' ? 'selected' : '' }}>Basic</option>
                                                    <option value="2" {{ request('group') == '2' ? 'selected' : '' }}>Cardiac</option>
                                                    <option value="3" {{ request('group') == '3' ? 'selected' : '' }}>Infectious Patient</option>
                                                </select>

                                            </div>

<div class="col-md-3">
    <label class="form-label">Address</label>
    <input type="text" name="address" class="form-control" placeholder="Search Address" value="{{ request('address') }}">
</div>

                                            <div class="col-md-2">
                                                <label class="form-label">OTP Session ID</label>
                                                <input type="text" name="otp_session_id" class="form-control" value="{{ request('otp_session_id') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Creator</label>
                                                <input type="text" name="creator" class="form-control" value="{{ request('creator') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Reg Number</label>
                                                <input type="text" name="reg_number" class="form-control" value="{{ request('reg_number') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Created From</label>
                                                <input type="date" name="created_from" class="form-control" value="{{ request('created_from') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Created To</label>
                                                <input type="date" name="created_to" class="form-control" value="{{ request('created_to') }}">
                                            </div>
                                            <div class="col-md-3 d-flex gap-2">
                                                <button type="submit" class="btn btn-success mt-4">Apply</button>
                                                <a href="{{ route('ambulances.index') }}" class="btn btn-secondary mt-4">Reset</a>
                                            </div>
                                        </div>
                                    </form>
                    
                                    {{-- Table --}}
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>ID</th>
                                                    <th>Updated At</th>
                                                    <th>Created At</th>
                                                    <th>Is Verified</th>
                                                    <th>Group</th>
                                                    <th>Address</th>
                                                    <th>Creator</th>
                                                    <th>Reg Number</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                                @forelse($ambulances as $ambulance)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('ambulances.show', $ambulance->id) }}">
                                                                {{ $loop->iteration + ($ambulances->currentPage() - 1) * $ambulances->perPage() }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('ambulances.show', $ambulance->id) }}">
                                                                {{ $ambulance->name }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('ambulances.show', $ambulance->id) }}">
                                                                {{ $ambulance->id }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('ambulances.show', $ambulance->id) }}">
                                                                {{ $ambulance->updated_at }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('ambulances.show', $ambulance->id) }}">
                                                                {{ $ambulance->created_at }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('ambulances.show', $ambulance->id) }}">
                                                                {{ $ambulance->is_verified ? 'Yes' : 'No' }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $groupNames = [1 => 'Basic', 2 => 'Cardiac', 3 => 'Infectious Patient'];
                                                            @endphp
                                                            {{ $groupNames[$ambulance->group] ?? 'N/A' }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('ambulances.show', $ambulance->id) }}">
                                                                {{ $ambulance->address ?? 'N/A' }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('ambulances.show', $ambulance->id) }}">
                                                                {{ $ambulance->user->name ?? 'N/A' }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('ambulances.show', $ambulance->id) }}">
                                                                {{ $ambulance->reg_number }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('ambulances.show', $ambulance->id) }}" class="btn btn-sm btn-primary">View</a>
                                                            <a href="{{ route('ambulances.edit', $ambulance->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="{{ route('ambulances.destroy', $ambulance->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this request?')">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center">No ambulance records found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>

                                        </table>
                    
                                        {{-- Pagination --}}
                                        <div class="d-flex justify-content-center">
                                            {{ $ambulances->links() }}
                                        </div>
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

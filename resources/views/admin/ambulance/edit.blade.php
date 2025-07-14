
@extends('admin.layouts.app')

@section('styles')
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <span class="main-content-title mg-b-0 mg-b-lg-1">Add Ambulance</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Ambulance</li>
            <li class="breadcrumb-item tx-15"><a href="{{ route('ambulances.index') }}" class="btn btn-info text-white">Manage Ambulance</a></li>
        </ol>
    </div>
</div>
<!-- /breadcrumb -->
@if (session('success'))
    <div class="alert alert-success" id="Message">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-12 col-sm-12">
        <form method="POST" action="{{ route('ambulances.update', $ambulance->id) }}">
            @csrf
            @method('PUT')
            <div class="card mt-3">
                <div class="card-body pt-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name', $ambulance->name) }}">
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $ambulance->phone) }}">
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Group</label>
                            <input type="text" name="group" class="form-control" value="{{ old('group', $ambulance->group) }}">
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $ambulance->address) }}">
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Landmark</label>
                            <input type="text" name="landmark" class="form-control" value="{{ old('landmark', $ambulance->landmark) }}">
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Creator</label>
                            <input type="text" name="creator" class="form-control" value="{{ old('creator', $ambulance->creator) }}">
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Reg Number</label>
                            <input type="text" name="reg_number" class="form-control" value="{{ old('reg_number', $ambulance->reg_number) }}">
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>OTP Session ID</label>
                            <input type="text" name="otp_session_id" class="form-control" value="{{ old('otp_session_id', $ambulance->otp_session_id) }}">
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>OTP</label>
                            <input type="text" name="otp" class="form-control" value="{{ old('otp', $ambulance->otp) }}">
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Is Verified</label>
                            <select name="is_verified" class="form-control">
                                <option value="1" {{ old('is_verified', $ambulance->is_verified) == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('is_verified', $ambulance->is_verified) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
            <a href="{{ route('ambulances.index') }}" class="btn btn-secondary mt-3">Back</a>
        </form>
        
        
    </div>
</div>
@endsection
@section('scripts')
<!-- Include SweetAlert JS -->





@endsection

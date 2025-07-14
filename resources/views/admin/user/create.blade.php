
@extends('admin.layouts.app')

@section('styles')
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <span class="main-content-title mg-b-0 mg-b-lg-1">Add Users</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Users</li>
            <li class="breadcrumb-item tx-15"><a href="{{ route('users.index') }}" class="btn btn-info text-white">Manage Users</a></li>
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
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div id="show_doc_item">
                <div class="card">
                    <div class="card-body pt-0 pt-4">
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
        
                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
        
                            <!-- Password -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
        
                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                            </div>
        
                            <!-- Date of Birth -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>DOB</label>
                                    <input type="date" name="dob" class="form-control">
                                </div>
                            </div>
        
                            <!-- Gender -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
        
                            <!-- Blood Group -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Blood Group</label>
                                    <input type="text" name="blood_group" class="form-control">
                                </div>
                            </div>
        
                            <!-- FCM Token -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>FCM Token</label>
                                    <input type="text" name="fcm_token" class="form-control">
                                </div>
                            </div>
        
                            <!-- Location -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" name="location" class="form-control">
                                </div>
                            </div>
        
                            <!-- Coordinate -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Coordinate</label>
                                    <input type="text" name="coordinate" class="form-control">
                                </div>
                            </div>
        
                            <!-- Is Donor -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Is Donor</label>
                                    <select name="is_donor" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
        
                            <!-- Is Milk Donor -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Is Milk Donor</label>
                                    <select name="is_milk_donor" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
        
                            <!-- Is Ambulance Provider -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Is Ambulance Provider</label>
                                    <select name="is_ambulance_provider" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
        
        
       
                
    </div>
</div>
@endsection
@section('scripts')
<!-- Include SweetAlert JS -->





@endsection


@extends('admin.layouts.app')

@section('styles')
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <span class="main-content-title mg-b-0 mg-b-lg-1">Add bloods</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add bloods</li>
            <li class="breadcrumb-item tx-15"><a href="{{ route('bloods.index') }}" class="btn btn-info text-white">Manage bloods</a></li>
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
        <form method="POST" action="">
            @csrf
            <div class="card mt-3">
                <div class="card-body pt-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Requester</label>
                            <select name="requester_id" class="form-control" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Blood Group</label>
                            <input type="text" name="blood_group" class="form-control" required>
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>DOB</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Gender</label>
                            <input type="text" name="gender" class="form-control" required>
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Expires At</label>
                            <input type="datetime-local" name="expires_at" class="form-control" required>
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="requested">Requested</option>
                                <option value="approved">Approved</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
            <a href="{{ route('bloods.index') }}" class="btn btn-secondary mt-3">Back</a>
             
        </form>
        
        
        
        
       
                
    </div>
</div>
@endsection
@section('scripts')
<!-- Include SweetAlert JS -->





@endsection

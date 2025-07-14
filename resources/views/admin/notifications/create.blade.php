
@extends('admin.layouts.app')

@section('styles')
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <span class="main-content-title mg-b-0 mg-b-lg-1">Add notifications</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add notifications</li>
            <li class="breadcrumb-item tx-15"><a href="{{ route('notifications.index') }}" class="btn btn-info text-white">Manage notifications</a></li>
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
        <form method="POST" action="{{ route('notifications.store') }}">
            @csrf
    
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
    
            <div class="form-group mt-3">
                <label>Message</label>
                <textarea name="message" class="form-control" rows="4" required></textarea>
            </div>
    
            <div class="form-group mt-3">
                <label>Type</label>
                <input type="text" name="type" class="form-control" value="Requested">
            </div>
    
            <div class="form-group mt-3">
                <label>Initiator (User)</label>
                <select name="initiater_id" class="form-control">
                    <option value="">-- Select User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} (ID: {{ $user->id }})</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group mt-3">
                <label>Blood Request</label>
                <select name="blood_req_id" class="form-control">
                    <option value="">-- Select Blood Request --</option>
                    @foreach($bloodRequests as $blood)
                        <option value="{{ $blood->id }}">{{ $blood->name }} (ID: {{ $blood->id }})</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group mt-3">
                <label>Ambulance Request</label>
                <select name="ambulance_req_id" class="form-control">
                    <option value="">-- Select Ambulance --</option>
                    @foreach($ambulances as $ambulance)
                        <option value="{{ $ambulance->id }}">{{ $ambulance->name }} (ID: {{ $ambulance->id }})</option>
                    @endforeach
                </select>
            </div>
    
            <button type="submit" class="btn btn-success mt-4">Submit</button>
        </form>
       
                
    </div>
</div>
@endsection
@section('scripts')
<!-- Include SweetAlert JS -->

 <!-- Add Select2 -->
 {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script> --}}
 
 <script>
     document.addEventListener("DOMContentLoaded", function () {
         $('.select2').select2({
             placeholder: "Search for a user",
             allowClear: true
         });
     });
 </script>



@endsection

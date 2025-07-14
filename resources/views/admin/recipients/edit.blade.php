
@extends('admin.layouts.app')

@section('styles')
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <span class="main-content-title mg-b-0 mg-b-lg-1">Edit recipients</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit recipients</li>
            <li class="breadcrumb-item tx-15"><a href="{{ route('recipients.index') }}" class="btn btn-info text-white">Manage recipients</a></li>
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
       <form method="POST" action="{{ route('recipients.update', $recipient->id) }}">
    @csrf
    @method('PUT') <!-- Method Spoofing for PUT -->

    <div id="show_doc_item">
        <div class="card">
            <div class="card-body pt-0 pt-4">
                <div class="row">
                    <!-- Push ID -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Push ID</label>
                            <input type="text" name="push_id" class="form-control" value="{{ old('push_id', $recipient->push_id) }}" required>
                        </div>
                    </div>

                    <!-- User ID (Dropdown) -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>User</label>
                            <select name="user_id" class="form-control select2" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $recipient->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Update</button>
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

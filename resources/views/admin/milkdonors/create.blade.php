
@extends('admin.layouts.app')

@section('styles')
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <span class="main-content-title mg-b-0 mg-b-lg-1">Add Milk donor</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add milk donor</li>
            <li class="breadcrumb-item tx-15"><a href="{{ route('donors.index') }}" class="btn btn-info text-white">Manage milk donor</a></li>
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
        <form method="POST" action="{{ route('milkdonors.store') }}">
    @csrf
    <div class="card mt-3">
        <div class="card-body">
            <!-- Donor -->
            <div class="mb-3">
                <label for="donor_id">User (Donor)</label>
                <select name="donor_id" id="donor_id" class="form-control" required>
                    <option value="">Select Donor</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->phone }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Breast Milk -->
            <div class="mb-3">
                <label for="breast_milk_id">Breast Milk Request</label>
                <select name="breast_milk_id" id="breast_milk_id" class="form-control" required>
                    <option value="">Select Breast Milk Request</option>
                    @foreach($milks as $milk)
                        <option value="{{ $milk->id }}">{{ $milk->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Save</button>
        </div>
    </div>
</form>

        
    </div>
</div>
@endsection
@section('scripts')
<!-- Include SweetAlert JS -->





@endsection


@extends('admin.layouts.app')

@section('styles')
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <span class="main-content-title mg-b-0 mg-b-lg-1">Update milk donor</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update milk donor</li>
            <li class="breadcrumb-item tx-15"><a href="{{ route('milkdonors.index') }}" class="btn btn-info text-white">Manage milk donor</a></li>
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
    <form method="POST" action="{{ route('milkdonors.update', $donor->id) }}">
    @csrf
    @method('PUT')

    <div class="card mt-3">
        <div class="card-body">
            <div class="mb-3">
                <label>User (Donor)</label>
                <select name="donor_id" class="form-control" required>
                    <option value="">Select Donor</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('donor_id', $donor->donor_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->phone }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Breast Milk</label>
                <select name="breast_milk_id" class="form-control" required>
                    <option value="">Select Breast Milk</option>
                    @foreach($bloods as $blood)
                        <option value="{{ $blood->id }}" {{ old('breast_milk_id', $donor->breast_milk_id) == $blood->id ? 'selected' : '' }}>
                            {{ $blood->name }} ({{ $blood->milk_quantity }} ml)
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Is Verified</label>
                <select name="is_verified" class="form-control" required>
                    <option value="1" {{ $donor->is_verified ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$donor->is_verified ? 'selected' : '' }}>No</option>
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

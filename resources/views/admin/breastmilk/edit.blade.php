
@extends('admin.layouts.app')

@section('styles')
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Breastmilk</span>
    </div>
    <div class="justify-content-center mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Breastmilk</li>
            <li class="breadcrumb-item tx-15"><a href="{{ route('breastmilk.index') }}" class="btn btn-info text-white">Manage Breastmilk</a></li>
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
       <form action="{{ route('breastmilk.update', $breastmilk->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group mt-2">
        <label>Requester (User)</label>
        <select name="requester_id" class="form-control" required>
            <option value="">-- Select User --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $breastmilk->requester_id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-2">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $breastmilk->name) }}" required>
    </div>

    <div class="form-group mt-2">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $breastmilk->phone) }}" required>
    </div>

    <div class="form-group mt-2">
        <label>Location</label>
        <input type="text" name="location" class="form-control" value="{{ old('location', $breastmilk->location) }}" required>
    </div>

    <div class="form-group mt-2">
        <label>Milk Quantity (ml)</label>
        <input type="number" name="milk_quantity" class="form-control" value="{{ old('milk_quantity', $breastmilk->milk_quantity) }}" required>
    </div>

    <div class="form-group mt-2">
        <label>Milk Type</label>
        <input type="text" name="milk_type" class="form-control" value="{{ old('milk_type', $breastmilk->milk_type) }}" required>
    </div>

    <div class="form-group mt-2">
        <label>Milk For</label>
        <select name="milk_for" class="form-control" required>
            <option value="1" {{ $breastmilk->milk_for == 1 ? 'selected' : '' }}>Donation</option>
            <option value="2" {{ $breastmilk->milk_for == 2 ? 'selected' : '' }}>Personal Use</option>
        </select>
    </div>

    <button class="btn btn-success mt-3">Update</button>
</form>

                
    </div>
</div>
@endsection
@section('scripts')
<!-- Include SweetAlert JS -->





@endsection

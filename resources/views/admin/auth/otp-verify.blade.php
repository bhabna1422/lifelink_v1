
@extends('admin.layouts.app')

@section('styles')
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection
@section('content')
<div class="container mt-5">
    <h4>Verify OTP & Set New Password</h4>

    <form method="POST" action="{{ route('admin.otp.verify.submit', $admin->id) }}">
        @csrf
        <div class="mb-3">
            <label>OTP</label>
            <input type="text" name="otp" class="form-control" required>
            @error('otp') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Reset Password</button>
    </form>
</div>
@endsection


@extends('admin.layouts.app')

@section('styles')
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection
@section('content')
<div class="container mt-5">
    <h4>Forgot Password</h4>
    @if(session('status')) <div class="alert alert-success">{{ session('status') }}</div> @endif

    <form method="POST" action="{{ route('admin.forgot.handle') }}">
        @csrf
        <div class="mb-3">
            <label for="identity">Email or Phone</label>
            <input type="text" class="form-control" name="identity" required>
            @error('identity') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Send Reset Link / OTP</button>
    </form>
</div>
@endsection

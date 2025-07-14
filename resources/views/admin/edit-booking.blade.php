@extends('admin.layouts.app')

    @section('styles')

		<!--- Internal Select2 css-->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE BOOKINGS</span>
						</div>
						<div class="justify-content-center mt-2">
							<ol class="breadcrumb">
                            
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE BOOKINGS</li>
							</ol>
						</div>
					</div>
					<!-- /breadcrumb -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session()->has('success'))
                    <div class="alert alert-success"  id="Message">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if ($errors->has('danger'))
                    <div class="alert alert-danger" id="Message">
                        {{ $errors->first('danger') }}
                    </div>
                    @endif
                    <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label>Booking ID</label>
                                <input type="text" name="booking_id" value="{{ $booking->booking_id }}" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $booking->name }}" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>Travel Date</label>
                                <input type="date" name="travel_date" value="{{ $booking->travel_date }}" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>Travel From</label>
                                <input type="text" name="travel_from" value="{{ $booking->travel_from }}" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>Travel To</label>
                                <input type="text" name="travel_to" value="{{ $booking->travel_to }}" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label>Booking Status</label>
                                <select name="booking_status" class="form-control" required>
                                    <option value="pending" {{ $booking->booking_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $booking->booking_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $booking->booking_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Payment Status</label>
                                <select name="payment_status" class="form-control" required>
                                    <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $booking->payment_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $booking->payment_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary">Update Booking</button>
                            </div>
                        </div>
                    </form>

					</div>
					

                    
					

                    @endsection

                    @section('modal')
                  

                    @endsection

    @section('scripts')

		<!-- Form-layouts js -->
		<script src="{{asset('assets/js/form-layouts.js')}}"></script>

		<!--Internal  Select2 js -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>



    @endsection

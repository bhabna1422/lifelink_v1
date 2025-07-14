@extends('superadmin.layouts.app')

    @section('styles')

		<!--- Internal Select2 css-->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						  <span class="main-content-title mg-b-0 mg-b-lg-1">Doctor Registration</span>
						</div>
						<div class="justify-content-center mt-2">
							<ol class="breadcrumb">
                            <a href="{{url('superadmin/doctorlist')}}" class="btn btn-primary btn-style">Doctor List</a>

								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE Doctors</li>
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
                        {{ $errors->first('error') }}
                    </div>
                    @endif
                  <form action="{{ url('superadmin/savedoctor') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- row -->
                        <div class="row">
                            <div class="col-lg-12 col-md-">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="unique_code">Unique Code</label>
                                                    <input type="text" class="form-control" id="unique_code" name="unique_code" placeholder="Enter Unique Code" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name of Doctor</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Doctor Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_no">Contact Number</label>
                                                    <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact Number" required pattern="\d{10}" title="Please enter a valid 10-digit contact number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" required>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="main-content-label mg-b-5">Accompany Information</div>
                                        <div id="show_item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="accompany_unique_code">Unique Code</label>
                                                        <input type="text" class="form-control" name="accompany_unique_code[]" id="accompany_unique_code" placeholder="Enter unique code" >
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="accompany_name">Accompany Name</label>
                                                        <input type="text" class="form-control" name="accompany_name[]" id="accompany_name" placeholder="Enter Accompany name">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mt-4">
                                                        <button type="button" class="btn btn-primary add_item_btn" id="addInput">Add More</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
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
<script>
    $(document).ready(function() {
        $("#addInput").click(function() {
            $("#show_item").append(`
            <div class="row input-wrapper">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="accompany_unique_code">Unique Code</label>
                        <input type="text" class="form-control" name="accompany_unique_code[]" placeholder="Enter unique code" >
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="accompany_name">Accompany Name</label>
                        <input type="text" class="form-control" name="accompany_name[]" placeholder="Enter Accompany name"  >
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mt-4">
                        <button type="button" class="btn btn-danger removeInput">Remove</button>
                    </div>
                </div>
            </div>`);
        });

        $(document).on('click', '.removeInput', function() {
            $(this).closest('.input-wrapper').remove();
        });
    });
</script>



    @endsection

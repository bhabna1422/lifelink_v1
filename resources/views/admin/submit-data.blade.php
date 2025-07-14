@extends('admin.layouts.app')

    @section('styles')

		<!--- Internal Select2 css-->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						  <span class="main-content-title mg-b-0 mg-b-lg-1">Submit Data</span>
						</div>
						{{-- <div class="justify-content-center mt-2">
							<ol class="breadcrumb">
                            <a href="{{url('superadmin/adminlist')}}" class="btn btn-primary btn-style">Admin List</a>

								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE ADMIN</li>
							</ol>
						</div> --}}
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
                  @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ url('admin/save-user-data') }}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="row">
                        <!-- Date Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                        </div>

                        <!-- Unique Code Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unique_code">Unique Code</label>
                                <input type="text" class="form-control" name="unique_code" value="{{ request('unique_code') }}" readonly>
                            </div>
                        </div>

                        <!-- Name Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ request('name') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6" style="display:none">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ref Id</label>
                                <input type="hidden" class="form-control" name="ref_id" value="{{ request('ref_id') }}" readonly>
                            </div>
                        </div> 
                        <div class="col-md-6" style="display:none">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type</label>
                                <input type="hidden" class="form-control" name="type" value="{{ request('type') }}" readonly>
                            </div>
                        </div>
                      

                       <!-- Conditional Rendering for Meal Options -->
<!-- Conditional Rendering for Meal Options -->
@if(request('type') === 'doctor')
    <!-- Meal Options for Doctor -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="meal">Meal Options</label><br>

            <!-- Breakfast Option -->
            @if(!in_array('breakfast', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="breakfast" autocomplete="off"> Breakfast
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Breakfast (Already Selected)
                </label>
            @endif

            <!-- Lunch Option -->
            @if(!in_array('lunch', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="lunch" autocomplete="off"> Lunch
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Lunch (Already Selected)
                </label>
            @endif

            <!-- Dinner Option -->
            @if(!in_array('dinner', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="dinner" autocomplete="off"> Dinner
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Dinner (Already Selected)
                </label>
            @endif

            <!-- Delegate Kit Option -->
            @if(!in_array('kit', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="kit" autocomplete="off"> Delegate Kit
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                   Delegate Kit (Already Selected)
                </label>
            @endif
        </div>
    </div>

@elseif(request('type') === 'accompany')
    <!-- Meal Options for Accompany -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="meal">Meal Options</label><br>

            <!-- Breakfast Option -->
            @if(!in_array('breakfast', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="breakfast" autocomplete="off"> Breakfast
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Breakfast (Already Selected)
                </label>
            @endif

            <!-- Lunch Option -->
            @if(!in_array('lunch', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="lunch" autocomplete="off"> Lunch
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Lunch (Already Selected)
                </label>
            @endif

            <!-- Dinner Option -->
            @if(!in_array('dinner', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="dinner" autocomplete="off"> Dinner
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Dinner (Already Selected)
                </label>
            @endif
        </div>
    </div>

@elseif(request('type') === 'Faculty')
    <!-- Meal Options for Faculty -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="meal">Meal Options</label><br>

            <!-- Breakfast Option -->
            @if(!in_array('breakfast', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="breakfast" autocomplete="off"> Breakfast
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Breakfast (Already Selected)
                </label>
            @endif

            <!-- Lunch Option -->
            @if(!in_array('lunch', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="lunch" autocomplete="off"> Lunch
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Lunch (Already Selected)
                </label>
            @endif

            <!-- Dinner Option -->
            @if(!in_array('dinner', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="dinner" autocomplete="off"> Dinner
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Dinner (Already Selected)
                </label>
            @endif

            <!-- Delegate Kit Option -->
            @if(!in_array('kit', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="kit" autocomplete="off"> Delegate Kit
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                   Delegate Kit (Already Selected)
                </label>
            @endif
        </div>
    </div>

@elseif(request('type') === 'IPCA_staff')
    <!-- Meal Options for IPCA Staff -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="meal">Meal Options</label><br>

            <!-- Breakfast Option -->
            @if(!in_array('breakfast', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="breakfast" autocomplete="off"> Breakfast
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Breakfast (Already Selected)
                </label>
            @endif

            <!-- Lunch Option -->
            @if(!in_array('lunch', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="lunch" autocomplete="off"> Lunch
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Lunch (Already Selected)
                </label>
            @endif

            <!-- Dinner Option -->
            @if(!in_array('dinner', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="dinner" autocomplete="off"> Dinner
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Dinner (Already Selected)
                </label>
            @endif

          
        </div>
    </div>

@elseif(request('type') === 'pharma_staff')
    <!-- Meal Options for Pharma Staff -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="meal">Meal Options</label><br>

            <!-- Breakfast Option -->
            @if(!in_array('breakfast', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="breakfast" autocomplete="off"> Breakfast
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Breakfast (Already Selected)
                </label>
            @endif

            <!-- Lunch Option -->
            @if(!in_array('lunch', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="lunch" autocomplete="off"> Lunch
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Lunch (Already Selected)
                </label>
            @endif

            <!-- Dinner Option -->
            @if(!in_array('dinner', $selectedMeals ?? []))
                <label class="btn btn-primary">
                    <input type="radio" name="meal" value="dinner" autocomplete="off"> Dinner
                </label>
            @else
                <label class="btn btn-secondary disabled" style="background-color: #d9534f; color: white;">
                    Dinner (Already Selected)
                </label>
            @endif
        </div>
    </div>
@endif




                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
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



    @endsection

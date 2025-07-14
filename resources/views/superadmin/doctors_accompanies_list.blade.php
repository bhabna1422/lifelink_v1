@extends('superadmin.layouts.app')

@section('styles')

    <!-- Data table css -->
    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css')}}"  rel="stylesheet">
    <link href="{{asset('assets/plugins/datatable/responsive.bootstrap5.css')}}" rel="stylesheet" />

    <!-- INTERNAL Select2 css -->
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />

@endsection

@section('content')
     <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                      <span class="main-content-title mg-b-0 mg-b-lg-1">List of Doctors and Accompanies with Meals</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        
                     
                    </div>
                </div>
                <!-- /breadcrumb -->
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <!-- <div>
                                        <h6 class="main-content-label mb-1">File export Datatables</h6>
                                        <p class="text-muted card-sub-title">Exporting data from a table can often be a key part of a complex application. The Buttons extension for DataTables provides three plug-ins that provide overlapping functionality for data export:</p>
                                    </div> -->
                                    <div class="table-responsive  export-table">
                                       <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
    <thead>
        <tr>
            <th>#</th>
            <th>Unique Code</th>
            <th>Name</th>
            <th>Date</th>
            <th>Breakfast</th>
            <th>Lunch</th>
            <th>Dinner</th>
            <th>Delegate Kit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($doctorlists as $index => $doctor)
            <!-- Display Doctor Info -->
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $doctor->unique_code }}</td>
                <td>{{ $doctor->name }}</td>
                <td>
                    @if($doctor->meals->isNotEmpty())
                         <!--Assuming all meals are on the same date -->
                        {{ $doctor->meals->first()->date }}
                    @else
                        <p>Not Scanned Yet</p>
                    @endif
                    
                </td>
                <td>
                    <!-- Check if Breakfast is present -->
                    @if($doctor->meals->where('meal', 'breakfast')->isNotEmpty())
                        <button class="btn btn-primary">Breakfast</button>
                    @endif
                </td>
                <td>
                    <!-- Check if Lunch is present -->
                    @if($doctor->meals->where('meal', 'lunch')->isNotEmpty())
                        <button class="btn btn-primary">Lunch</button>
                    @endif
                </td>
                <td>
                    <!-- Check if Dinner is present -->
                    @if($doctor->meals->where('meal', 'dinner')->isNotEmpty())
                        <button class="btn btn-primary">Dinner</button>
                    @endif
                </td>
                <td>
                    <!-- Display Delegate Kit only for doctors -->
                 @if($doctor->meals->where('meal', 'kit')->isNotEmpty())
        <button class="btn btn-primary">Delegate Kit</button>
    @endif
                </td>
            </tr>

            <!-- Display Accompany Info -->
            @foreach($doctor->accompanies as $accompany)
                <tr>
                    <td>{{ $index + 1 }}.1</td>
                    <td>{{ $accompany->unique_code }}</td>
                    <td>{{ $accompany->name }}</td>
                    <td>
                        @if($accompany->meals->isNotEmpty())
                            <!-- Assuming all meals are on the same date -->
                            {{ $accompany->meals->first()->date }}
                        @else
                            <p>Not Scanned Yet</p>
                        @endif
                    </td>
                    <td>
                        <!-- Check if Breakfast is present -->
                        @if($accompany->meals->where('meal', 'breakfast')->isNotEmpty())
                            <button class="btn btn-primary">Breakfast</button>
                        @endif
                    </td>
                    <td>
                        <!-- Check if Lunch is present -->
                        @if($accompany->meals->where('meal', 'lunch')->isNotEmpty())
                            <button class="btn btn-primary">Lunch</button>
                        @endif
                    </td>
                    <td>
                        <!-- Check if Dinner is present -->
                        @if($accompany->meals->where('meal', 'dinner')->isNotEmpty())
                            <button class="btn btn-primary">Dinner</button>
                        @endif
                    </td>
                    <td>
                        <!-- Accompanies should not have delegate kits -->
                        <p>N/A</p>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



@endsection
@section('scripts')

    <!-- Internal Data tables -->
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/js/table-data.js')}}"></script>

    <!-- INTERNAL Select2 js -->
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    function confirmDeactivation(doctorId) {
        if (confirm("Are you sure you want to deactivate this doctor?")) {
            window.location.href = "{{ url('superadmin/dltdoctor') }}/" + doctorId;
        }
    }
</script>

@endsection


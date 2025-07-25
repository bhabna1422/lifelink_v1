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
                      <span class="main-content-title mg-b-0 mg-b-lg-1">List of Staffs</span>
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
            <th>Meal</th>
        </tr>
    </thead>
    <tbody>
        @php $counter = 1; @endphp <!-- Initialize a counter -->
        
        @foreach($meals as $meal)
            <tr>
                <td>{{ $counter }}</td> <!-- Display the counter -->
                <td>{{ $meal->unique_code }}</td> <!-- Display the unique code -->
                <td>{{ $meal->name }}</td> <!-- Display the name -->
                <td>{{ $meal->date }}</td> <!-- Display the date -->
                <td>{{ ucfirst($meal->meal) }}</td> <!-- Display the meal, capitalizing the first letter -->
            </tr>
            @php $counter++; @endphp <!-- Increment the counter -->
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


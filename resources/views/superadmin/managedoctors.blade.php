@extends('superadmin.layouts.app')

@section('styles')

    <!-- Data table css -->
    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css')}}"  rel="stylesheet">
    <link href="{{asset('assets/plugins/datatable/responsive.bootstrap5.css')}}" rel="stylesheet" />

    <!-- INTERNAL Select2 css -->
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<style>
    .media-group {
    display: flex;
    align-items: center;
    flex-grow: 1;
}
.media-md {
    width: 2.375rem;
    height: 2.375rem;
    font-size: .7916666667rem;
}
.media-middle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.media-circle {
    border-radius: 50rem;
}
.media-group .media+.media-text {
    margin-left: .625rem;
}
.media-text {
    display: flex;
    flex-direction: column;
}
.media img {
    border-radius: inherit;
}
</style>
@endsection

@section('content')

                <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                      <span class="main-content-title mg-b-0 mg-b-lg-1">Doctor List</span>
                    </div>
                    <div class="justify-content-center mt-2">
                        
                        <ol class="breadcrumb">
                            {{-- <a href="{{url('superadmin/addadmin')}}" class="btn btn-primary btn-style">Add Admin</a> --}}
                            <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Doctor List</li>
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

                  

                    <!-- Row -->
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
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">Unique Code</th>
                                                    <th class="border-bottom-0">Name</th>
                                                    <th class="border-bottom-0">Doctor QR</th>
                                                    <th class="border-bottom-0"> Number</th>
                                                     <th class="border-bottom-0">Email</th>
                                                    <th class="border-bottom-0">State</th>
                                                    <th class="border-bottom-0">Accompany</th>
                                                   
                                                    <th class="border-bottom-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($doctorlists as $index => $doctor)
                                            
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $doctor->unique_code}}</td>
                                                   <td>{{ $doctor->name}}</td>
                                                    <td>
                                                        @if($doctor->qr_code_path && file_exists(public_path($doctor->qr_code_path)))
                                                            <!-- Display the QR code image -->
                                                            <img src="{{ asset($doctor->qr_code_path) }}" alt="QR Code" width="100" height="100">
                                                            
                                                            <!-- Link to download the QR code -->
                                                            <br>
                                                            <a href="{{ asset($doctor->qr_code_path) }}" download="{{ $doctor->unique_code }}_qr_code" class="btn btn-primary mt-2">
                                                                Download QR Code
                                                            </a>
                                                        @else
                                                            <!-- Show nothing if there's no QR code -->
                                                            <p>No QR Code</p>
                                                        @endif
                                                    </td>
                                                   <td>{{ $doctor->contact_no}}</td>
                                                    <td>{{ $doctor->email}}</td>
                                                   <td>{{ $doctor->state}}</td>
                                                   <td>
                                                        @if($doctor->accompanies->isNotEmpty())
                                                        <ul>
                                                        @foreach($doctor->accompanies as $accompany)
                                                            <li>{{ $accompany->name }} ({{ $accompany->unique_code}})</li>
                                                            @if($accompany->qr_code_path && file_exists(public_path($accompany->qr_code_path)))
                                                                <!-- Display the QR code image -->
                                                                <img src="{{ asset($accompany->qr_code_path) }}" alt="QR Code" width="100" height="100">
                                                                
                                                                <!-- Link to download the QR code -->
                                                                <br>
                                                                <a href="{{ asset($accompany->qr_code_path) }}" download="{{ $accompany->unique_code }}_qr_code" class="btn btn-primary mt-2">
                                                                    Download QR Code
                                                                </a>
                                                            @else
                                                                <!-- Show nothing if there's no QR code -->
                                                                <p>No QR Code</p>
                                                            @endif

                                                        @endforeach
                                                        </ul>
                                                        @else
                                                            <p>No Accompany Details Available</p>
                                                        @endif
                                                   </td>
                                                    <td>
                                                       
                                                      <a href="javascript:void(0)" onclick="confirmDeactivation({{ $doctor->id }})" class="btn btn-primary">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                </tr>
                                             
                                                @endforeach
                                            </tbody>
                                         
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->

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

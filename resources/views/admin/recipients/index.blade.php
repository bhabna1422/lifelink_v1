@extends('admin.layouts.app')

    @section('styles')

		<!--- Internal Select2 css-->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						  <span class="main-content-title mg-b-0 mg-b-lg-1">MANAGE recipients</span>
						</div>
						<div class="justify-content-center mt-2">
							<ol class="breadcrumb">
                            
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">MANAGE recipients</li>
                                <li class="breadcrumb-item tx-15"><a href="{{ route('recipients.create') }}"
                                    class="btn btn-info text-white">Add Recipients</a></li>
							</ol>
						</div>
					</div>
					<!-- /breadcrumb -->
                
                

                      <!-- Row -->
                      <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <!-- <div>
                                        <h6 class="main-content-label mb-1">File export Datatables</h6>
                                        <p class="text-muted card-sub-title">Exporting data from a table can often be a key part of a complex application. The Buttons extension for DataTables provides three plug-ins that provide overlapping functionality for data export:</p>
                                    </div> -->

                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    @if (session()->has('success'))
                                    <div class="alert alert-success" id="Message">
                                        {{ session()->get('success') }}
                                    </div>
                                    @endif

                                    @if ($errors->has('danger'))
                                    <div class="alert alert-danger" id="Message">
                                        {{ $errors->first('danger') }}
                                    </div>
                                    @endif
                                    <form method="GET" action="{{ route('recipients.index') }}" class="mb-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Push ID</label>
                                                    <input type="text" name="push_id" class="form-control" value="{{ request('push_id') }}">
                                                </div>
                                                <div class="col-md-3">
                                                <label>User</label>
                                                <select name="user_id" class="form-control">
                                                    <option value="">-- Select User --</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }} ({{ $user->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>From Date</label>
                                                <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label>To Date</label>
                                                <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary">Apply</button>
                                            <a href="{{ route('recipients.index') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </form>

                                   <div class="table-responsive">
                                        <table id="file-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User Name</th>
                                                    <th>Push ID</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recipients as $index => $recipient)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('recipients.show', $recipient->id) }}">
                                                                {{ $index + 1 }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('recipients.show', $recipient->id) }}">
                                                                {{ optional($recipient->user)->name ?? 'N/A' }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('recipients.show', $recipient->id) }}">
                                                                {{ \Illuminate\Support\Str::limit($recipient->push_id, 10, '...') }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('recipients.show', $recipient->id) }}">
                                                                {{ $recipient->created_at }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('recipients.show', $recipient->id) }}">
                                                                {{ $recipient->updated_at }}
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('recipients.show', $recipient->id) }}" class="btn btn-sm btn-primary">View</a>
                                                            <a href="{{ route('recipients.edit', $recipient->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="{{ route('recipients.destroy', $recipient->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                            </form>
                                                        </td>
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

                    @section('modal')
                  

                    @endsection

    @section('scripts')

		<!-- Form-layouts js -->
		<script src="{{asset('assets/js/form-layouts.js')}}"></script>

		<!--Internal  Select2 js -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>



    @endsection

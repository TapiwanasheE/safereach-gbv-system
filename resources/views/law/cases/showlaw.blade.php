@extends('layouts.lawmaster')

@section('page-css')

@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ti ti-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="ti ti-alert-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Page Header -->
            <div class="card bg-warning-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Case Details</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('law-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('law-cases.index') }}">Cases</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $case->case_number }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <a href="{{ route('law-cases.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left"></i> Back to Cases
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Main Case Information -->
                <div class="col-lg-8">
                    <div class="card">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0 text-white"><i class="ti ti-shield"></i> Law Enforcement Case Information</h5>
        </div>
        <form class="form-horizontal">
            <div class="form-body">
                <div class="card-body">
                    <h5 class="card-title mb-0">Case Details</h5>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label text col-md-3">Name:</label>
                                <div class="col-md-9">
                                    @if($case->anonymous)
                                        <span class="badge bg-warning"><i class="ti ti-eye-off"></i> Anonymous Reporter</span>
                                        <small class="d-block text-muted">Identity protected</small>
                                    @else
                                        <p class="mb-0">{{ $case->user->name ?? 'Unknown' }}</p>
                                        <small class="text-muted">{{ $case->user->email ?? '' }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label text-end col-md-3">Case Number:</label>
                                <div class="col-md-9">
                                    <p>{{ $case->case_number }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label text col-md-3">Date Reported:</label>
                                <div class="col-md-9">
                                    <p>{{ $case->date_reported }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label text-end col-md-3">Location:</label>
                                <div class="col-md-9">
                                    <p>{{ $case->location }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label text col-md-3">Case Status:</label>
                                <div class="col-md-9">
                                    <p>{{ $case->status }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label text-end col-md-3">Case Stage:</label>
                                <div class="col-md-9">
                                    <p>{{ $case->stage }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <hr class="m-0" />
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="form-label text col-md-3">Description:</label>
                                    {{--                                    <div class="col-md-3">--}}
                                    {{--                                    </div>--}}
                                    <div class="col-md-9">
                                        <p>
                                            {{ $case->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                </div>
            </div>
        </form>
                    </div>
                </div>

                <!-- Sidebar - Assignment & Actions -->
                <div class="col-lg-4">
                    <!-- Case Assignment -->
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0 text-white"><i class="ti ti-user-check"></i> Case Assignment</h6>
                        </div>
                        <div class="card-body">
                            @if($case->assignedStaff)
                                <div class="alert alert-success">
                                    <h6 class="fw-bold">Currently Assigned To:</h6>
                                    <p class="mb-0">{{ $case->assignedStaff->name }}</p>
                                    <small class="text-muted">{{ $case->assignedStaff->role->name }}</small>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="ti ti-alert-circle"></i> This case is not assigned yet
                                </div>
                            @endif

                            <form action="{{ route('law-cases-assign', $case->id) }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="assigned_user_id" class="fw-bold">Assign/Reassign to:</label>
                                    <select name="assigned_user_id" id="assigned_user_id" class="form-select" required>
                                        <option value="">-- Select Staff Member --</option>
                                        @foreach($assignableUsers as $user)
                                            <option value="{{ $user->id }}" {{ $case->assigned_staff_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->role->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="ti ti-check"></i> Assign Case
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Stage Progression Actions -->
                    @if($case->status !== 'Closed')
                    <div class="card mt-3">
                        <div class="card-header bg-warning text-white">
                            <h6 class="mb-0 text-white"><i class="ti ti-arrow-right"></i> Stage Progression</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3">Choose the next action for this case:</p>

                            <!-- Push to Medical Button -->
                            <button type="button" class="btn btn-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#pushToMedicalModal">
                                <i class="ti ti-heartbeat"></i> Push to Medical
                            </button>

                            <!-- Push to Counseling Button -->
                            <button type="button" class="btn btn-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#pushToCounselingModal">
                                <i class="ti ti-user-heart"></i> Push to Counseling
                            </button>

                            <!-- Close Case Button -->
                            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#closeCaseModal">
                                <i class="ti ti-check-circle"></i> Close Case
                            </button>
                        </div>
                    </div>
                    @else
                    <div class="card mt-3 border-success">
                        <div class="card-body text-center">
                            <i class="ti ti-check-circle text-success" style="font-size: 3rem;"></i>
                            <h6 class="text-success mt-2">Case Closed</h6>
                            <p class="text-muted small mb-0">This case has been resolved</p>
                        </div>
                    </div>
                    @endif

                    <!-- Quick Stats -->
                    <div class="card mt-3">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0 text-white"><i class="ti ti-info-circle"></i> Quick Stats</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="ti ti-calendar"></i> <strong>Created:</strong><br>
                                    <small>{{ $case->created_at->format('M d, Y h:i A') }}</small>
                                </li>
                                <li class="mb-2">
                                    <i class="ti ti-clock"></i> <strong>Last Updated:</strong><br>
                                    <small>{{ $case->updated_at->format('M d, Y h:i A') }}</small>
                                </li>
                                <li>
                                    <i class="ti ti-eye"></i> <strong>Visibility:</strong><br>
                                    <small>
                                        @if($case->anonymous)
                                            <span class="badge bg-warning">Anonymous</span>
                                        @else
                                            <span class="badge bg-success">Identified</span>
                                        @endif
                                    </small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Push to Medical Modal -->
    <div class="modal fade" id="pushToMedicalModal" tabindex="-1" aria-labelledby="pushToMedicalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('cases.push-to-medical', $case->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white" id="pushToMedicalModalLabel">
                            <i class="ti ti-heartbeat"></i> Push Case to Medical
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="medical_staff_id" class="form-label fw-bold">Assign to Medical Staff:</label>
                            <select name="assigned_staff_id" id="medical_staff_id" class="form-select" required>
                                <option value="">-- Select Medical Staff --</option>
                                @foreach($assignableUsers->where('role.name', 'Medical') as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="medical_notes" class="form-label">Notes (Optional):</label>
                            <textarea name="notes" id="medical_notes" class="form-control" rows="3" placeholder="Add any relevant notes for the medical team..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-arrow-right"></i> Push to Medical
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Push to Counseling Modal -->
    <div class="modal fade" id="pushToCounselingModal" tabindex="-1" aria-labelledby="pushToCounselingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('cases.push-to-counseling', $case->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title text-white" id="pushToCounselingModalLabel">
                            <i class="ti ti-user-heart"></i> Push Case to Counseling
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="counseling_staff_id" class="form-label fw-bold">Assign to Counselor:</label>
                            <select name="assigned_staff_id" id="counseling_staff_id" class="form-select" required>
                                <option value="">-- Select Counselor --</option>
                                @foreach($assignableUsers->where('role.name', 'Counselor') as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="counseling_notes" class="form-label">Notes (Optional):</label>
                            <textarea name="notes" id="counseling_notes" class="form-control" rows="3" placeholder="Add any relevant notes for the counseling team..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info">
                            <i class="ti ti-arrow-right"></i> Push to Counseling
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Close Case Modal -->
    <div class="modal fade" id="closeCaseModal" tabindex="-1" aria-labelledby="closeCaseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('cases.close', $case->id) }}" method="POST">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title text-white" id="closeCaseModalLabel">
                            <i class="ti ti-check-circle"></i> Close Case
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="ti ti-alert-circle"></i>
                            <strong>Warning:</strong> This action will mark the case as closed. Please provide closing notes.
                        </div>
                        <div class="mb-3">
                            <label for="closing_notes" class="form-label fw-bold">Closing Notes: *</label>
                            <textarea name="closing_notes" id="closing_notes" class="form-control" rows="4" required placeholder="Provide detailed closing notes about how the case was resolved (minimum 10 characters)..."></textarea>
                            <small class="text-muted">Required - Minimum 10 characters</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-check"></i> Close Case
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')

@endsection

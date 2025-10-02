@extends('layouts.master')

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
                                        <a class="text-muted text-decoration-none" href="{{ route('sa-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('sa-cases-index') }}">All Cases</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $case->case_number }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <a href="{{ route('sa-cases-index') }}" class="btn btn-outline-secondary">
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
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-file-description"></i> Case Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="fw-bold text-muted">Reporter:</label>
                                    @if($case->anonymous)
                                        <p><span class="badge bg-warning"><i class="ti ti-eye-off"></i> Anonymous Reporter</span></p>
                                        <small class="text-muted">Identity protected by system</small>
                                    @else
                                        <p class="mb-0 fs-4">{{ $case->user->name ?? 'Unknown' }}</p>
                                        <small class="text-muted">{{ $case->user->email ?? '' }}</small>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold text-muted">Case Number:</label>
                                    <p class="fs-4 text-primary fw-bold">{{ $case->case_number }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="fw-bold text-muted">Date Reported:</label>
                                    <p>{{ \Carbon\Carbon::parse($case->date_reported)->format('F d, Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold text-muted">Location:</label>
                                    <p>{{ $case->location ?? 'Not specified' }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="fw-bold text-muted">Case Type:</label>
                                    <p><span class="badge bg-danger">{{ $case->type }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold text-muted">Current Status:</label>
                                    <p>
                                        @if($case->status == 'Reported')
                                            <span class="badge bg-info">{{ $case->status }}</span>
                                        @elseif(in_array($case->status, ['In Progress', 'Under Review']))
                                            <span class="badge bg-warning">{{ $case->status }}</span>
                                        @elseif(in_array($case->status, ['Resolved', 'Closed']))
                                            <span class="badge bg-success">{{ $case->status }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $case->status }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="fw-bold text-muted">Current Stage:</label>
                                    <p>
                                        @if($case->stage == 'Law Enforcement')
                                            <span class="badge bg-danger-subtle text-danger"><i class="ti ti-shield"></i> {{ $case->stage }}</span>
                                        @elseif($case->stage == 'Medical')
                                            <span class="badge bg-primary-subtle text-primary"><i class="ti ti-medical-cross"></i> {{ $case->stage }}</span>
                                        @elseif($case->stage == 'Counselor')
                                            <span class="badge bg-info-subtle text-info"><i class="ti ti-users"></i> {{ $case->stage }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $case->stage ?? 'Not Assigned' }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <label class="fw-bold text-muted">Case Description:</label>
                                    <div class="p-3 bg-light rounded">
                                        <p class="mb-0">{{ $case->description }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($case->medical_review || $case->counseling_notes)
                            <hr>
                            <h6 class="fw-semibold mb-3">Professional Reviews</h6>

                            @if($case->medical_review)
                            <div class="alert alert-primary">
                                <h6 class="fw-bold"><i class="ti ti-medical-cross"></i> Medical Review</h6>
                                <p class="mb-0">{{ $case->medical_review }}</p>
                                @if($case->medical_findings)
                                <hr>
                                <strong>Findings:</strong>
                                <p class="mb-0">{{ $case->medical_findings }}</p>
                                @endif
                            </div>
                            @endif

                            @if($case->counseling_notes)
                            <div class="alert alert-info">
                                <h6 class="fw-bold"><i class="ti ti-users"></i> Counseling Notes</h6>
                                <p class="mb-0">{{ $case->counseling_notes }}</p>
                                @if($case->counseling_sessions)
                                <hr>
                                <strong>Sessions Completed:</strong> {{ $case->counseling_sessions }}
                                @endif
                            </div>
                            @endif
                            @endif
                        </div>
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
@endsection

@section('page-js')
@endsection

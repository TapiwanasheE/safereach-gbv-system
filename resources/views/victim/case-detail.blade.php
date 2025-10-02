@extends('layouts.victimmaster')

@section('page-css')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Case Details</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('vic-dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('vic-my-cases') }}">My Cases</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">Case #{{ $case->case_number }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3">
                            <div class="text-center mb-n5">
                                <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="modernize-img" class="img-fluid mb-n4" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Case Status Card -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="round-40 rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center">
                                        <i class="ti ti-file fs-6 text-primary"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold text-muted">Case Number</h6>
                                    <h4 class="mb-0 fw-bold">{{ $case->case_number }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="round-40 rounded-circle bg-info-subtle d-flex align-items-center justify-content-center">
                                        <i class="ti ti-check fs-6 text-info"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold text-muted">Status</h6>
                                    <h4 class="mb-0 fw-bold">
                                        @if($case->status == 'Reported')
                                            <span class="badge bg-info">{{ $case->status }}</span>
                                        @elseif($case->status == 'In Progress')
                                            <span class="badge bg-warning">{{ $case->status }}</span>
                                        @elseif($case->status == 'Resolved')
                                            <span class="badge bg-success">{{ $case->status }}</span>
                                        @elseif($case->status == 'Closed')
                                            <span class="badge bg-secondary">{{ $case->status }}</span>
                                        @else
                                            <span class="badge bg-primary">{{ $case->status }}</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="round-40 rounded-circle bg-warning-subtle d-flex align-items-center justify-content-center">
                                        <i class="ti ti-route fs-6 text-warning"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold text-muted">Current Stage</h6>
                                    <h4 class="mb-0 fw-bold">
                                        <span class="badge bg-primary-subtle text-primary">{{ $case->stage ?? 'Initial' }}</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Case Information Card -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="ti ti-info-circle me-2"></i>Case Information
                    </h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Type of Violence:</label>
                                <p class="mb-0">
                                    <span class="badge bg-danger-subtle text-danger fs-3">{{ $case->type }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Date Reported:</label>
                                <p class="mb-0">{{ \Carbon\Carbon::parse($case->date_reported)->format('F d, Y') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Location:</label>
                                <p class="mb-0">{{ $case->location }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Report Type:</label>
                                <p class="mb-0">
                                    @if($case->anonymous)
                                        <span class="badge bg-warning">
                                            <i class="ti ti-eye-off"></i> Anonymous Report
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="ti ti-eye"></i> Identified Report
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Description:</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0">{{ $case->description }}</p>
                                </div>
                            </div>
                        </div>

                        @if($case->assignedStaff)
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Assigned To:</label>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="round-40 rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center">
                                            <i class="ti ti-user fs-6 text-primary"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-semibold">{{ $case->assignedStaff->name }}</p>
                                        <small class="text-muted">{{ $case->assignedStaff->role->name ?? 'Staff' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Medical Review (if available) -->
            @if($case->medical_review || $case->medical_findings)
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="ti ti-medical-cross me-2 text-success"></i>Medical Review
                    </h4>

                    @if($case->medical_review)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Medical Report:</label>
                        <div class="p-3 bg-success-subtle rounded">
                            <p class="mb-0">{{ $case->medical_review }}</p>
                        </div>
                    </div>
                    @endif

                    @if($case->medical_findings)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Medical Findings:</label>
                        <div class="p-3 bg-success-subtle rounded">
                            <p class="mb-0">{{ $case->medical_findings }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Counseling Notes (if available) -->
            @if($case->counseling_notes)
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="ti ti-heart-handshake me-2 text-info"></i>Counseling Summary
                    </h4>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Counseling Notes:</label>
                        <div class="p-3 bg-info-subtle rounded">
                            <p class="mb-0">{{ $case->counseling_notes }}</p>
                        </div>
                    </div>

                    @if($case->counseling_sessions)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Number of Sessions:</label>
                        <p class="mb-0">
                            <span class="badge bg-info fs-3">{{ $case->counseling_sessions }} Session(s)</span>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Case History -->
            @if($case->caseHistories && $case->caseHistories->count() > 0)
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="ti ti-history me-2"></i>Case History
                    </h4>

                    <div class="timeline-widget mb-0">
                        @foreach($case->caseHistories as $history)
                        <div class="timeline-item d-flex position-relative overflow-hidden mb-3">
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ti ti-arrow-right text-primary"></i>
                                </span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 ms-3">
                                <p class="mb-1 fw-semibold">{{ $history->action_description }}</p>
                                @if($history->from_stage && $history->to_stage)
                                <p class="mb-1">
                                    <span class="badge bg-secondary-subtle text-secondary">{{ $history->from_stage }}</span>
                                    <i class="ti ti-arrow-right mx-1"></i>
                                    <span class="badge bg-primary-subtle text-primary">{{ $history->to_stage }}</span>
                                </p>
                                @endif
                                <p class="mb-0 text-muted">
                                    <small>{{ $history->created_at->format('M d, Y h:i A') }}</small>
                                    @if($history->user)
                                    <small> by {{ $history->user->name }}</small>
                                    @endif
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="card mt-3 bg-light">
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <a href="{{ route('vic-my-cases') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left me-2"></i>Back to My Cases
                        </a>

                        @if($case->status != 'Closed' && $case->status != 'Resolved')
                        <a href="{{ route('vic-create-case') }}" class="btn btn-info">
                            <i class="ti ti-plus me-2"></i>Report Another Case
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Support Information -->
            <div class="card mt-3 bg-danger-subtle">
                <div class="card-body">
                    <h5 class="card-title text-danger">
                        <i class="ti ti-alert-circle me-2"></i>Need Immediate Help?
                    </h5>
                    <p class="mb-2">If you're in immediate danger, please contact emergency services:</p>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-0"><i class="ti ti-phone me-2"></i><strong>Police Emergency:</strong> 999</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-0"><i class="ti ti-medical-cross me-2"></i><strong>Medical Emergency:</strong> 112</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-0"><i class="ti ti-heart-handshake me-2"></i><strong>GBV Helpline:</strong> 0800-123-456</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection


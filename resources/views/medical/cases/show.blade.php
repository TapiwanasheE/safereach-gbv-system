@extends('layouts.medicalmaster')

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
            <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Medical Case Review</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('med-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('med-cases') }}">Cases</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $case->case_number }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <a href="{{ route('med-cases') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left"></i> Back to Cases
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Case Details Card -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white"><i class="ti ti-file-text"></i> Case Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Patient:</label>
                            @if($case->anonymous)
                                <div>
                                    <span class="badge bg-warning"><i class="ti ti-eye-off"></i> Anonymous Patient</span>
                                    <small class="d-block text-muted mt-1">Identity protected by system</small>
                                </div>
                            @else
                                <p class="mb-0">{{ $case->user->name ?? 'Unknown' }}</p>
                                <small class="text-muted">{{ $case->user->email ?? '' }}</small>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Case Number:</label>
                            <p class="mb-0">{{ $case->case_number }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Date Reported:</label>
                            <p class="mb-0">{{ $case->date_reported }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Location:</label>
                            <p class="mb-0">{{ $case->location ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Case Type:</label>
                            <p class="mb-0">{{ $case->type }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Case Status:</label>
                            <p class="mb-0">
                                @if($case->status == 'Closed')
                                    <span class="badge bg-success">{{ $case->status }}</span>
                                @elseif($case->status == 'Medical Review Done')
                                    <span class="badge bg-info">{{ $case->status }}</span>
                                @else
                                    <span class="badge bg-warning">{{ $case->status }}</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="fw-bold">Case Description:</label>
                            <p class="text-muted">{{ $case->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

<!-- Medical Review Form -->
@if($case->status != 'Medical Review Done')
<div class="card mt-3">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0 text-white"><i class="ti ti-medical-cross"></i> Submit Medical Review</h5>
    </div>
    <div class="card-body">
            <form method="POST" action="{{ route('medical-case-review', $case->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="medical_review" class="fw-bold">Medical Review Notes</label>
                            <textarea class="form-control" name="medical_review" id="medical_review" rows="4" required placeholder="Enter detailed medical review notes...">{{ old('medical_review', $case->medical_review) }}</textarea>
                            @error('medical_review')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="medical_findings" class="fw-bold">Medical Findings (Optional)</label>
                            <textarea class="form-control" name="medical_findings" id="medical_findings" rows="3" placeholder="Enter any specific medical findings...">{{ old('medical_findings', $case->medical_findings ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="ti ti-check"></i> Submit Medical Review
                </button>
            </form>
        </div>
    </div>
@else
    <div class="card mt-3">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0 text-white"><i class="ti ti-check-circle"></i> Medical Review Submitted</h5>
        </div>
        <div class="card-body">
        <div class="alert alert-success">
            <i class="ti ti-check-circle"></i> Medical review has been completed for this case.
        </div>
        <div class="mb-3">
            <label class="fw-bold">Medical Review Notes:</label>
            <p class="text-muted">{{ $case->medical_review }}</p>
        </div>
        @if($case->medical_findings)
        <div class="mb-3">
            <label class="fw-bold">Medical Findings:</label>
            <p class="text-muted">{{ $case->medical_findings }}</p>
        </div>
        @endif
    </div>
</div>
@endif

<!-- Stage Progression Actions for Medical -->
@if($case->status !== 'Closed' && $case->medical_review)
    <div class="card mt-3">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0 text-white"><i class="ti ti-arrow-right"></i> Next Action</h5>
        </div>
        <div class="card-body">
            <p class="text-muted">Medical review completed. Choose next action:</p>

            <!-- Push to Counseling Button -->
            <button type="button" class="btn btn-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#medicalPushToCounselingModal">
                <i class="ti ti-user-heart"></i> Push to Counseling
            </button>

            <!-- Close Case Button -->
            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#medicalCloseCaseModal">
                <i class="ti ti-check-circle"></i> Close Case
            </button>
        </div>
    </div>
@endif
        </div>
    </div>

<!-- Medical Push to Counseling Modal -->
<div class="modal fade" id="medicalPushToCounselingModal" tabindex="-1" aria-labelledby="medicalPushToCounselingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('medical.push-to-counseling', $case->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title text-white" id="medicalPushToCounselingModalLabel">
                        <i class="ti ti-user-heart"></i> Push Case to Counseling
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="medical_counseling_staff_id" class="form-label fw-bold">Assign to Counselor:</label>
                        <select name="assigned_staff_id" id="medical_counseling_staff_id" class="form-select" required>
                            <option value="">-- Select Counselor --</option>
                            @php
                                $counselors = \App\Models\User::whereHas('role', function($q) {
                                    $q->where('name', 'Counselor');
                                })->get();
                            @endphp
                            @foreach($counselors as $counselor)
                                <option value="{{ $counselor->id }}">{{ $counselor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="medical_counseling_notes" class="form-label">Notes (Optional):</label>
                        <textarea name="notes" id="medical_counseling_notes" class="form-control" rows="3" placeholder="Add any relevant notes for the counseling team..."></textarea>
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

<!-- Medical Close Case Modal -->
<div class="modal fade" id="medicalCloseCaseModal" tabindex="-1" aria-labelledby="medicalCloseCaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('medical.close-case', $case->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title text-white" id="medicalCloseCaseModalLabel">
                        <i class="ti ti-check-circle"></i> Close Case
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="ti ti-alert-circle"></i>
                        <strong>Warning:</strong> This action will mark the case as closed and notify Law Enforcement.
                    </div>
                    <div class="mb-3">
                        <label for="medical_closing_notes" class="form-label fw-bold">Closing Notes: *</label>
                        <textarea name="closing_notes" id="medical_closing_notes" class="form-control" rows="4" required placeholder="Provide detailed closing notes about the medical assessment and resolution (minimum 10 characters)..."></textarea>
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
<!-- start Form with view only -->
@endsection

@section('page-js')

@endsection

@extends('layouts.counsellormaster')

@section('page-css')
@endsection

@section('content')
<div class="card">
    <div class="card-header text-bg-primary">
        <h5 class="mb-0 text-white">Counseling Case Details</h5>
    </div>
    <form class="form-horizontal">
        <div class="form-body">
            <div class="card-body">
                <h5 class="card-title mb-0">Case Information</h5>
            </div>
            <hr class="m-0" />
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="form-label text col-md-3">Client:</label>
                            <div class="col-md-9">
                                @if($case->anonymous)
                                    <span class="badge bg-warning"><i class="ti ti-eye-off"></i> Anonymous Client</span>
                                    <small class="d-block text-muted mt-1">Identity protected by system</small>
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
                                <p>{{ \Carbon\Carbon::parse($case->date_reported)->format('F d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="form-label text-end col-md-3">Location:</label>
                            <div class="col-md-9">
                                <p>{{ $case->location ?? 'Not specified' }}</p>
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
                                <p><span class="badge bg-primary">{{ $case->status }}</span></p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="form-label text-end col-md-3">Case Stage:</label>
                            <div class="col-md-9">
                                <p><span class="badge bg-info">{{ $case->stage }}</span></p>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <hr class="m-0" />
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="form-label text col-md-2">Description:</label>
                            <div class="col-md-10">
                                <p>{{ $case->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($case->status != 'Counseling Done')
    <div class="card-header bg-success text-white mt-3">
        <h5 class="mb-0 text-white">Submit Counseling Notes</h5>
    </div>
    <div class="form-actions">
        <div class="card-body">
            <form method="POST" action="{{ route('counsel-submit-notes', $case->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="counseling_notes" class="fw-bold">Counseling Session Notes</label>
                            <textarea class="form-control" name="counseling_notes" id="counseling_notes" rows="5" required placeholder="Enter detailed counseling session notes...">{{ old('counseling_notes', $case->counseling_notes) }}</textarea>
                            @error('counseling_notes')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="counseling_sessions" class="fw-bold">Number of Sessions Conducted</label>
                            <input type="number" class="form-control" name="counseling_sessions" id="counseling_sessions" min="1" value="{{ old('counseling_sessions', $case->counseling_sessions ?? 1) }}" placeholder="Enter number of sessions">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="ti ti-check"></i> Submit Counseling Notes
                </button>
                <a href="{{ route('counsel-cases') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left"></i> Back to Cases
                </a>
            </form>
        </div>
    </div>
    @else
    <div class="card-header bg-info text-white mt-3">
        <h5 class="mb-0 text-white">Counseling Completed</h5>
    </div>
    <div class="card-body">
        <div class="alert alert-success">
            <i class="ti ti-check-circle"></i> Counseling sessions have been completed for this case.
        </div>
        <div class="mb-3">
            <label class="fw-bold">Counseling Session Notes:</label>
            <p class="text-muted">{{ $case->counseling_notes }}</p>
        </div>
        @if($case->counseling_sessions)
        <div class="mb-3">
            <label class="fw-bold">Number of Sessions:</label>
            <p class="text-muted">{{ $case->counseling_sessions }} session(s)</p>
        </div>
        @endif
        <a href="{{ route('counsel-cases') }}" class="btn btn-primary">
            <i class="ti ti-arrow-left"></i> Back to Cases
        </a>
    </div>
    @endif

    <!-- Stage Progression Actions for Counseling -->
    @if($case->status !== 'Closed' && $case->counseling_notes)
    <div class="card mt-3">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0 text-white"><i class="ti ti-check-circle"></i> Complete Case</h5>
        </div>
        <div class="card-body">
            <p class="text-muted">Counseling sessions completed. Ready to close the case?</p>

            <!-- Close Case Button -->
            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#counselingCloseCaseModal">
                <i class="ti ti-check-circle"></i> Close Case
            </button>
        </div>
    </div>
    @endif

</div>

<!-- Counseling Close Case Modal -->
<div class="modal fade" id="counselingCloseCaseModal" tabindex="-1" aria-labelledby="counselingCloseCaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('counseling.close-case', $case->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title text-white" id="counselingCloseCaseModalLabel">
                        <i class="ti ti-check-circle"></i> Close Case
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle"></i>
                        <strong>Info:</strong> This action will mark the case as closed and complete the counseling process.
                    </div>
                    <div class="mb-3">
                        <label for="counseling_closing_notes" class="form-label fw-bold">Final Assessment & Closing Notes: *</label>
                        <textarea name="closing_notes" id="counseling_closing_notes" class="form-control" rows="4" required placeholder="Provide final assessment and detailed closing notes about the counseling outcome (minimum 10 characters)..."></textarea>
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


@extends('layouts.medicalmaster')

@section('page-css')

@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="card bg-success-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Completed Medical Reviews</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('med-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Completed Reviews</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <a href="{{ route('med-dashboard') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="round-40 rounded-circle bg-success d-flex align-items-center justify-content-center">
                                        <i class="ti ti-file-check text-white fs-6"></i>
                                    </span>
                                </div>
                                <div>
                                    <h4 class="fw-semibold mb-0">{{ $cases->total() }} Completed Reviews</h4>
                                    <p class="text-muted mb-0">Medical examinations successfully completed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cases Table -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 text-white"><i class="ti ti-file-check"></i> Completed Medical Cases</h5>
                </div>
                <div class="card-body">
                    @if($cases->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-success">
                                    <tr>
                                        <th>Case Number</th>
                                        <th>Patient</th>
                                        <th>Case Type</th>
                                        <th>Date Reviewed</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cases as $case)
                                        <tr>
                                            <td><strong>{{ $case->case_number }}</strong></td>
                                            <td>
                                                @if($case->anonymous)
                                                    <span class="badge bg-warning">
                                                        <i class="ti ti-eye-off"></i> Anonymous Patient
                                                    </span>
                                                @else
                                                    {{ $case->user->name ?? 'N/A' }}
                                                @endif
                                            </td>
                                            <td>{{ $case->type }}</td>
                                            <td>{{ $case->updated_at->format('M d, Y') }}</td>
                                            <td>
                                                @if($case->status == 'Closed')
                                                    <span class="badge bg-success">Closed</span>
                                                @else
                                                    <span class="badge bg-info">Review Complete</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('med-case-show', $case->id) }}" class="btn btn-sm btn-success">
                                                    <i class="ti ti-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $cases->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="ti ti-file-x text-muted" style="font-size: 4rem;"></i>
                            <h5 class="text-muted mt-3">No Completed Reviews</h5>
                            <p class="text-muted">You haven't completed any medical reviews yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')

@endsection


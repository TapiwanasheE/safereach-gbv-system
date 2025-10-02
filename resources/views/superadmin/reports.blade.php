@extends('layouts.master')

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
                            <h4 class="fw-semibold mb-8">System Reports & Statistics</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('sa-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Reports</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <i class="ti ti-file-chart" style="font-size: 50px; opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Overall Statistics -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-clipboard-data"></i> Case Statistics</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2 class="fw-bold mb-0">{{ $totalCases }}</h2>
                                <span class="text-muted">Total Cases</span>
                            </div>

                            <h6 class="fw-semibold mt-4 mb-3">Cases by Type</h6>
                            @foreach($casesByType as $type)
                            <div class="d-flex justify-content-between mb-2">
                                <span><span class="badge bg-danger">{{ $type->type }}</span></span>
                                <strong>{{ $type->total }}</strong>
                            </div>
                            @endforeach

                            <h6 class="fw-semibold mt-4 mb-3">Cases by Status</h6>
                            @foreach($casesByStatus as $status)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $status->status }}</span>
                                <strong>{{ $status->total }}</strong>
                            </div>
                            @endforeach

                            <h6 class="fw-semibold mt-4 mb-3">Cases by Stage</h6>
                            @foreach($casesByStage as $stage)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $stage->stage }}</span>
                                <strong>{{ $stage->total }}</strong>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-users"></i> User Statistics</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2 class="fw-bold mb-0">{{ $totalUsers }}</h2>
                                <span class="text-muted">Total Users</span>
                            </div>

                            <h6 class="fw-semibold mt-4 mb-3">Users by Role</h6>
                            @foreach($usersByRole as $userRole)
                            <div class="d-flex justify-content-between mb-2">
                                <span>
                                    @if($userRole->role->name == 'Law Enforcement')
                                        <span class="badge bg-danger-subtle text-danger">{{ $userRole->role->name }}</span>
                                    @elseif($userRole->role->name == 'Medical')
                                        <span class="badge bg-primary-subtle text-primary">{{ $userRole->role->name }}</span>
                                    @elseif($userRole->role->name == 'Counselor')
                                        <span class="badge bg-info-subtle text-info">{{ $userRole->role->name }}</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary">{{ $userRole->role->name }}</span>
                                    @endif
                                </span>
                                <strong>{{ $userRole->total }}</strong>
                            </div>
                            @endforeach

                            <h6 class="fw-semibold mt-4 mb-3">Case Visibility</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span><span class="badge bg-warning">Anonymous</span></span>
                                <strong>{{ $anonymousCases }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span><span class="badge bg-success">Identified</span></span>
                                <strong>{{ $identifiedCases }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Cases -->
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0 text-white"><i class="ti ti-clock"></i> Recent Cases (Last 10)</h5>
                </div>
                <div class="card-body">
                    @if($recentCases->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Case Number</th>
                                    <th>Reporter</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Stage</th>
                                    <th>Assigned To</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentCases as $case)
                                <tr>
                                    <td><strong>{{ $case->case_number }}</strong></td>
                                    <td>
                                        @if($case->anonymous)
                                            <span class="badge bg-warning-subtle text-warning">Anonymous</span>
                                        @else
                                            {{ $case->user->name ?? 'Unknown' }}
                                        @endif
                                    </td>
                                    <td><span class="badge bg-danger">{{ $case->type }}</span></td>
                                    <td><span class="badge bg-info">{{ $case->status }}</span></td>
                                    <td>{{ $case->stage }}</td>
                                    <td>{{ $case->assignedStaff->name ?? 'Not Assigned' }}</td>
                                    <td>{{ $case->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-center text-muted py-3">No cases reported yet</p>
                    @endif
                </div>
            </div>

            <!-- Export Buttons -->
            <div class="card mt-4">
                <div class="card-body text-center">
                    <h5 class="mb-3">Export Reports</h5>
                    <button class="btn btn-primary me-2" onclick="window.print()">
                        <i class="ti ti-printer"></i> Print Report
                    </button>
                    <a href="{{ route('sa-dashboard') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-js')
@endsection


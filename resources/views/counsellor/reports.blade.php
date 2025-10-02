@extends('layouts.counsellormaster')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <!--  Breadcrumb -->
        <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Counseling Reports & Statistics</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('counsel-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Reports</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3 text-end">
                        <i class="ti ti-chart-bar fs-9 text-primary opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Statistics -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="round-40 rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center">
                                    <i class="ti ti-briefcase fs-6 text-primary"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-semibold text-muted">Total Cases</h6>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_cases'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="round-40 rounded-circle bg-warning-subtle d-flex align-items-center justify-content-center">
                                    <i class="ti ti-clock-hour-4 fs-6 text-warning"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-semibold text-muted">Pending Sessions</h6>
                                <h4 class="mb-0 fw-bold">{{ $stats['pending_sessions'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="round-40 rounded-circle bg-success-subtle d-flex align-items-center justify-content-center">
                                    <i class="ti ti-check fs-6 text-success"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-semibold text-muted">Completed</h6>
                                <h4 class="mb-0 fw-bold">{{ $stats['completed_sessions'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="round-40 rounded-circle bg-info-subtle d-flex align-items-center justify-content-center">
                                    <i class="ti ti-users fs-6 text-info"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-semibold text-muted">Total Sessions</h6>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_sessions'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cases by Type -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Cases by Violence Type</h5>

                        @if($casesByType->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <thead class="text-dark fs-4 bg-light">
                                    <tr>
                                        <th><h6 class="fw-semibold mb-0">Type</h6></th>
                                        <th><h6 class="fw-semibold mb-0">Count</h6></th>
                                        <th><h6 class="fw-semibold mb-0">Percentage</h6></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($casesByType as $item)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary">{{ $item->type }}</span>
                                        </td>
                                        <td><span class="fw-semibold">{{ $item->count }}</span></td>
                                        <td>
                                            @php
                                                $percentage = $stats['total_cases'] > 0 ? round(($item->count / $stats['total_cases']) * 100, 1) : 0;
                                            @endphp
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $percentage }}%</small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="ti ti-chart-pie fs-9 text-muted mb-3"></i>
                            <p class="text-muted">No data available</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Performance Summary</h5>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Completion Rate</span>
                                @php
                                    $completionRate = $stats['total_cases'] > 0 ? round(($stats['completed_sessions'] / $stats['total_cases']) * 100, 1) : 0;
                                @endphp
                                <span class="fw-bold">{{ $completionRate }}%</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $completionRate }}%"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Pending Rate</span>
                                @php
                                    $pendingRate = $stats['total_cases'] > 0 ? round(($stats['pending_sessions'] / $stats['total_cases']) * 100, 1) : 0;
                                @endphp
                                <span class="fw-bold">{{ $pendingRate }}%</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $pendingRate }}%"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Closed Cases</span>
                                @php
                                    $closedRate = $stats['total_cases'] > 0 ? round(($stats['closed_cases'] / $stats['total_cases']) * 100, 1) : 0;
                                @endphp
                                <span class="fw-bold">{{ $closedRate }}%</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $closedRate }}%"></div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-4">
                            <i class="ti ti-info-circle me-2"></i>
                            <strong>Average Sessions:</strong>
                            {{ $stats['completed_sessions'] > 0 ? round($stats['total_sessions'] / $stats['completed_sessions'], 1) : 0 }} per client
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Cases -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Recent Counseling Cases</h5>

                @if($recentCases->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead class="text-dark fs-4 bg-light">
                            <tr>
                                <th><h6 class="fw-semibold mb-0">Case ID</h6></th>
                                <th><h6 class="fw-semibold mb-0">Client</h6></th>
                                <th><h6 class="fw-semibold mb-0">Type</h6></th>
                                <th><h6 class="fw-semibold mb-0">Sessions</h6></th>
                                <th><h6 class="fw-semibold mb-0">Status</h6></th>
                                <th><h6 class="fw-semibold mb-0">Date</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentCases as $case)
                            <tr>
                                <td><span class="badge bg-primary-subtle text-primary">#{{ $case->id }}</span></td>
                                <td>
                                    @if($case->anonymous)
                                        <span class="text-warning">Anonymous Client</span>
                                    @else
                                        {{ $case->user->name ?? 'N/A' }}
                                    @endif
                                </td>
                                <td><span class="badge bg-info-subtle text-info">{{ $case->type }}</span></td>
                                <td>{{ $case->counseling_sessions ?? 0 }}</td>
                                <td>
                                    @if($case->status == 'Closed')
                                        <span class="badge bg-success">Closed</span>
                                    @elseif($case->counseling_notes)
                                        <span class="badge bg-info">Completed</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $case->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="ti ti-folder-off fs-9 text-muted mb-3"></i>
                    <p class="text-muted">No recent cases</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


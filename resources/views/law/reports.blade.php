@extends('layouts.lawmaster')

@section('page-css')

@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Management Reports</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('law-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Reports</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <a href="{{ route('law-dashboard') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Overall Statistics -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="round-40 rounded-circle bg-primary d-flex align-items-center justify-content-center">
                                        <i class="ti ti-briefcase text-white fs-6"></i>
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $stats['total_cases'] }}</h5>
                                    <small class="text-muted">Total Cases</small>
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
                                    <span class="round-40 rounded-circle bg-warning d-flex align-items-center justify-content-center">
                                        <i class="ti ti-loader text-white fs-6"></i>
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $stats['pending_cases'] }}</h5>
                                    <small class="text-muted">Pending</small>
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
                                    <span class="round-40 rounded-circle bg-info d-flex align-items-center justify-content-center">
                                        <i class="ti ti-user-check text-white fs-6"></i>
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $stats['assigned_cases'] }}</h5>
                                    <small class="text-muted">Assigned</small>
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
                                    <span class="round-40 rounded-circle bg-success d-flex align-items-center justify-content-center">
                                        <i class="ti ti-file-check text-white fs-6"></i>
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $stats['closed_cases'] }}</h5>
                                    <small class="text-muted">Closed</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Cases by Type -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-chart-bar"></i> Cases by Type of Violence</h5>
                        </div>
                        <div class="card-body">
                            @if($casesByType->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th class="text-end">Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($casesByType as $type)
                                                <tr>
                                                    <td>{{ $type->type }}</td>
                                                    <td class="text-end">
                                                        <span class="badge bg-primary">{{ $type->count }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center py-3">No data available</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Cases by Status -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-chart-pie"></i> Cases by Status</h5>
                        </div>
                        <div class="card-body">
                            @if($casesByStatus->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th class="text-end">Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($casesByStatus as $status)
                                                <tr>
                                                    <td>{{ $status->status }}</td>
                                                    <td class="text-end">
                                                        <span class="badge
                                                            @if($status->status == 'Closed') bg-success
                                                            @elseif($status->status == 'Reported') bg-warning
                                                            @else bg-info
                                                            @endif">
                                                            {{ $status->count }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center py-3">No data available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff Assignment Statistics -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-users"></i> Case Assignment Distribution</h5>
                        </div>
                        <div class="card-body">
                            @if($assignmentStats->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-success">
                                            <tr>
                                                <th>Staff Member</th>
                                                <th>Role</th>
                                                <th>Email</th>
                                                <th class="text-end">Assigned Cases</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($assignmentStats as $stat)
                                                <tr>
                                                    <td>{{ $stat['staff']->name }}</td>
                                                    <td>
                                                        <span class="badge bg-info">{{ $stat['staff']->role->name }}</span>
                                                    </td>
                                                    <td>{{ $stat['staff']->email }}</td>
                                                    <td class="text-end">
                                                        <span class="badge bg-success">{{ $stat['count'] }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <p class="text-muted">No assignments recorded yet</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Cases -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-clock"></i> Recent Cases (Last 10)</h5>
                        </div>
                        <div class="card-body">
                            @if($recentCases->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-warning">
                                            <tr>
                                                <th>Case Number</th>
                                                <th>Reporter</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Assigned To</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentCases as $case)
                                                <tr>
                                                    <td><strong>{{ $case->case_number }}</strong></td>
                                                    <td>
                                                        @if($case->anonymous)
                                                            <span class="badge bg-warning">Anonymous</span>
                                                        @else
                                                            {{ $case->user->name ?? 'N/A' }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $case->type }}</td>
                                                    <td>
                                                        <span class="badge
                                                            @if($case->status == 'Closed') bg-success
                                                            @elseif($case->status == 'Reported') bg-warning
                                                            @else bg-info
                                                            @endif">
                                                            {{ $case->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($case->assignedStaff)
                                                            {{ $case->assignedStaff->name }}
                                                        @else
                                                            <span class="text-muted">Unassigned</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $case->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('law-cases-show', $case->id) }}" class="btn btn-sm btn-info">
                                                            <i class="ti ti-eye"></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <p class="text-muted">No recent cases</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Anonymous Cases Stats -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="round-40 rounded-circle bg-warning d-flex align-items-center justify-content-center">
                                        <i class="ti ti-eye-off text-white fs-6"></i>
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $stats['anonymous_cases'] }} Anonymous Cases</h5>
                                    <p class="text-muted mb-0">Cases reported anonymously for victim protection</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')

@endsection


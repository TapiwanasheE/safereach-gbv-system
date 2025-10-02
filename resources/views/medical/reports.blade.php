@extends('layouts.medicalmaster')

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
                            <h4 class="fw-semibold mb-8">Medical Reports & Statistics</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('med-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Reports</li>
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
                                    <h5 class="mb-0">{{ $stats['pending_reviews'] }}</h5>
                                    <small class="text-muted">Pending Reviews</small>
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
                                        <i class="ti ti-check text-white fs-6"></i>
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $stats['completed_reviews'] }}</h5>
                                    <small class="text-muted">Completed</small>
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
                            <h5 class="mb-0 text-white"><i class="ti ti-chart-bar"></i> Cases by Type</h5>
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

                <!-- Recent Cases -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-clock"></i> Recent Cases</h5>
                        </div>
                        <div class="card-body">
                            @if($recentCases->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-borderless table-sm">
                                        <thead>
                                            <tr>
                                                <th>Case Number</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentCases as $case)
                                                <tr>
                                                    <td><strong>{{ $case->case_number }}</strong></td>
                                                    <td>{{ $case->type }}</td>
                                                    <td>{{ $case->created_at->format('M d') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center py-3">No recent cases</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Summary -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-chart-line"></i> Performance Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="fw-semibold">Review Completion Rate</h6>
                                    @php
                                        $completionRate = $stats['total_cases'] > 0 ? round(($stats['completed_reviews'] / $stats['total_cases']) * 100, 1) : 0;
                                    @endphp
                                    <div class="progress" style="height: 25px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $completionRate }}%;" aria-valuenow="{{ $completionRate }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $completionRate }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-semibold">Case Closure Rate</h6>
                                    @php
                                        $closureRate = $stats['completed_reviews'] > 0 ? round(($stats['closed_cases'] / $stats['completed_reviews']) * 100, 1) : 0;
                                    @endphp
                                    <div class="progress" style="height: 25px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $closureRate }}%;" aria-valuenow="{{ $closureRate }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $closureRate }}%
                                        </div>
                                    </div>
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


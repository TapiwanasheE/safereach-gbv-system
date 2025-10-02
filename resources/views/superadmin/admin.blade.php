@extends('layouts.master')

@section('page-css')
@endsection

@section('content')

    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- System Overview -->
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card bg-primary-subtle shadow-none">
                        <div class="card-body">
                            <h4 class="fw-semibold">👋 Welcome, Super Admin!</h4>
                            <p class="mb-0">Manage your GBV Case Management System. Monitor cases, users, and system performance.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card bg-success-subtle shadow-none">
                        <div class="card-body text-center">
                            <h2 class="fw-bold mb-0">{{ $totalUsers }}</h2>
                            <p class="mb-0">Total System Users</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Case Statistics -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-warning-subtle text-warning rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-clipboard fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title fw-bold">{{ $totalCases }}</h4>
                                        <h6 class="card-subtitle mb-0">Total Cases</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3 text-bg-light">
                                <div class="progress-bar text-bg-warning" role="progressbar" style="width: 100%; height: 6px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-info-subtle text-info rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-alert-circle fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title fw-bold">{{ $reportedCases }}</h4>
                                        <h6 class="card-subtitle mb-0">Newly Reported</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3 text-bg-light">
                                <div class="progress-bar text-bg-info" role="progressbar" style="width: {{ $totalCases > 0 ? ($reportedCases / $totalCases * 100) : 0 }}%; height: 6px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-primary-subtle text-primary rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-loader fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title fw-bold">{{ $inProgressCases }}</h4>
                                        <h6 class="card-subtitle mb-0">In Progress</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3 text-bg-light">
                                <div class="progress-bar text-bg-primary" role="progressbar" style="width: {{ $totalCases > 0 ? ($inProgressCases / $totalCases * 100) : 0 }}%; height: 6px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-success-subtle text-success rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-check-circle fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title fw-bold">{{ $resolvedCases }}</h4>
                                        <h6 class="card-subtitle mb-0">Resolved</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3 text-bg-light">
                                <div class="progress-bar text-bg-success" role="progressbar" style="width: {{ $totalCases > 0 ? ($resolvedCases / $totalCases * 100) : 0 }}%; height: 6px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff Overview -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-danger-subtle text-danger rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-shield fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title fw-bold">{{ $lawEnforcementCount }}</h4>
                                        <h6 class="card-subtitle mb-0">Law Enforcement</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-primary-subtle text-primary rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-medical-cross fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title fw-bold">{{ $medicalCount }}</h4>
                                        <h6 class="card-subtitle mb-0">Medical Staff</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-info-subtle text-info rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-users fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title fw-bold">{{ $counselorCount }}</h4>
                                        <h6 class="card-subtitle mb-0">Counselors</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-secondary-subtle text-secondary rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-user fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title fw-bold">{{ $totalVictims }}</h4>
                                        <h6 class="card-subtitle mb-0">Registered Victims</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-3">Quick Actions</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('sa-users') }}" class="btn btn-primary w-100 mb-2">
                                        <i class="ti ti-users"></i> Manage Users
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('sa-cases-index') }}" class="btn btn-info w-100 mb-2">
                                        <i class="ti ti-clipboard-list"></i> View All Cases
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('sa-dashboard') }}" class="btn btn-success w-100 mb-2">
                                        <i class="ti ti-refresh"></i> Refresh Dashboard
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="#" class="btn btn-warning w-100 mb-2">
                                        <i class="ti ti-file-chart"></i> Generate Reports
                                    </a>
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

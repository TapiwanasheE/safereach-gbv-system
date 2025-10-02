@extends('layouts.lawmaster')

@section('page-css')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Welcome Section -->
            <div class="card bg-danger-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body">
                    <h4 class="fw-semibold">👮 Welcome, Law Enforcement Officer!</h4>
                    <p class="mb-0">Manage and assign GBV cases to appropriate staff members.</p>
                </div>
            </div>

            <!-- Statistics Row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-warning-subtle text-warning rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-basket fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title">{{ $totalCases }}</h4>
                                        <h6 class="card-subtitle mb-0">Total Cases</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3 text-bg-light">
                                <div class="progress-bar text-bg-warning" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-primary-subtle text-primary rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-chart-pie fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title">{{ $pendingCases }}</h4>
                                        <h6 class="card-subtitle mb-0">Pending Cases</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3 text-bg-light">
                                <div class="progress-bar text-bg-primary" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="bg-danger-subtle text-danger rounded d-flex align-items-center p-8 justify-content-center">
                                        <i class="ti ti-user-plus fs-8"></i>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center justify-content-end text-end">
                                    <div>
                                        <h4 class="card-title">{{ $assignedCases }}</h4>
                                        <h6 class="card-subtitle mb-0">Assigned Cases</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3 text-bg-light">
                                <div class="progress-bar text-bg-danger" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card bg-warning-subtle">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-3">Quick Actions</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('law-cases.index') }}" class="btn btn-warning w-100 mb-2">
                                        <i class="ti ti-clipboard-list"></i> View All Cases
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('law-dashboard') }}" class="btn btn-outline-warning w-100 mb-2">
                                        <i class="ti ti-refresh"></i> Refresh Dashboard
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('law-cases.index') }}" class="btn btn-outline-dark w-100 mb-2">
                                        <i class="ti ti-user-check"></i> Assign Cases
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Important Information -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-3">
                                <i class="ti ti-info-circle text-warning"></i> Case Management Guidelines
                            </h5>
                            <ul class="mb-0">
                                <li class="mb-2">Review all reported cases promptly and assign to appropriate staff</li>
                                <li class="mb-2">Assign medical cases to Medical staff for review and examination</li>
                                <li class="mb-2">Assign counseling cases to Counselors for victim support</li>
                                <li class="mb-2">Maintain case confidentiality, especially for anonymous reports</li>
                                <li>Update case status as investigations progress</li>
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

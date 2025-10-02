@extends('layouts.counsellormaster')

@section('page-css')
@endsection

@section('content')

    <div class="body-wrapper">
        <div class="container-fluid">
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
                                        <h4 class="card-title">{{ $assignedCases }}</h4>
                                        <h6 class="card-subtitle mb-0">Assigned Counseling
                                            Cases</h6>
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
                                        <h6 class="card-subtitle mb-0">Pending Sessions</h6>
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
                                        <h4 class="card-title">{{ $completedCases }}</h4>
                                        <h6 class="card-subtitle mb-0">Completed Sessions</h6>
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
                    <div class="card bg-info-subtle">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-3">Quick Actions</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('counsel-cases') }}" class="btn btn-info mb-3 w-100">
                                        <i class="ti ti-clipboard-list"></i> View All Cases
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('counsel-dashboard') }}" class="btn btn-outline-info mb-3 w-100">
                                        <i class="ti ti-refresh"></i> Refresh Dashboard
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
                                <i class="ti ti-info-circle text-info"></i> Counseling Session Guidelines
                            </h5>
                            <ul class="mb-0">
                                <li class="mb-2">Establish trust and create a safe environment for clients to share</li>
                                <li class="mb-2">Respect client confidentiality, especially for anonymous cases</li>
                                <li class="mb-2">Document session notes thoroughly after each counseling session</li>
                                <li class="mb-2">Use trauma-informed care approaches for all GBV survivors</li>
                                <li class="mb-2">Track the number of sessions and client progress consistently</li>
                                <li>Refer to specialized services when necessary (psychiatric care, legal aid)</li>
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

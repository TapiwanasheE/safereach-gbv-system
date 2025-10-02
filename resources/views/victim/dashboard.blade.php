@extends('layouts.victimmaster')

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
                                        <h4 class="card-title">{{ $totalCases }}</h4>
                                        <h6 class="card-subtitle mb-0">My Cases</h6>
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
                                        <h4 class="card-title">{{ $resolvedCases }}</h4>
                                        <h6 class="card-subtitle mb-0">Resolved Cases</h6>
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
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Quick Actions</h4>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('vic-create-case') }}" class="btn btn-primary w-100 py-3">
                                        <i class="ti ti-plus fs-6"></i>
                                        <br>
                                        <span class="mt-2 d-block">Report New Case</span>
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('vic-my-cases') }}" class="btn btn-info w-100 py-3">
                                        <i class="ti ti-file fs-6"></i>
                                        <br>
                                        <span class="mt-2 d-block">View My Cases</span>
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="#" class="btn btn-success w-100 py-3">
                                        <i class="ti ti-help fs-6"></i>
                                        <br>
                                        <span class="mt-2 d-block">Get Help & Support</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emergency Contacts -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card bg-danger-subtle">
                        <div class="card-body">
                            <h4 class="card-title text-danger mb-3">
                                <i class="ti ti-alert-circle"></i> Emergency Contacts
                            </h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-danger text-white rounded-circle p-3 me-3">
                                            <i class="ti ti-phone fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Police Emergency</h6>
                                            <p class="mb-0 text-danger fw-bold">999</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-danger text-white rounded-circle p-3 me-3">
                                            <i class="ti ti-medical-cross fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Medical Emergency</h6>
                                            <p class="mb-0 text-danger fw-bold">112</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-danger text-white rounded-circle p-3 me-3">
                                            <i class="ti ti-heart-handshake fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">GBV Helpline</h6>
                                            <p class="mb-0 text-danger fw-bold">0800-123-456</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Card -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card bg-info-subtle">
                        <div class="card-body">
                            <h5 class="card-title text-info">
                                <i class="ti ti-info-circle"></i> Important Information
                            </h5>
                            <p class="mb-2"><strong>Confidentiality:</strong> All your information is kept strictly confidential.</p>
                            <p class="mb-2"><strong>Support Available:</strong> We provide medical, legal, and counseling support.</p>
                            <p class="mb-0"><strong>24/7 Access:</strong> You can report cases and seek help anytime.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-js')
@endsection

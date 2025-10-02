@extends('layouts.victimmaster')

@section('page-css')
<style>
    .resource-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
    }
    .resource-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .resource-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        font-size: 28px;
    }
</style>
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="card bg-success-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-4">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-2 text-success">
                                <i class="ti ti-book-2"></i> GBV Support Resources
                            </h4>
                            <p class="mb-3 text-dark">Access helpful information, resources, and support materials</p>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('vic-dashboard') }}">
                                            <i class="ti ti-home fs-4"></i> Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Resources</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3">
                            <div class="text-center mb-n5">
                                <img src="../assets/images/breadcrumb/ChatBc.png" alt="modernize-img" class="img-fluid mb-n4" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resource Categories -->
            <div class="row">
                <!-- Understanding GBV -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card resource-card shadow-sm">
                        <div class="card-body p-4">
                            <div class="resource-icon bg-primary-subtle text-primary mb-3">
                                <i class="ti ti-info-circle"></i>
                            </div>
                            <h5 class="card-title">Understanding GBV</h5>
                            <p class="text-muted">Learn about different types of gender-based violence and how to recognize them.</p>
                            <a href="#" class="btn btn-primary btn-sm">Read More <i class="ti ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Legal Rights -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card resource-card shadow-sm">
                        <div class="card-body p-4">
                            <div class="resource-icon bg-success-subtle text-success mb-3">
                                <i class="ti ti-scale"></i>
                            </div>
                            <h5 class="card-title">Your Legal Rights</h5>
                            <p class="text-muted">Understand your legal rights and protections under the law.</p>
                            <a href="#" class="btn btn-success btn-sm">Read More <i class="ti ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Safety Planning -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card resource-card shadow-sm">
                        <div class="card-body p-4">
                            <div class="resource-icon bg-warning-subtle text-warning mb-3">
                                <i class="ti ti-shield-check"></i>
                            </div>
                            <h5 class="card-title">Safety Planning</h5>
                            <p class="text-muted">Create a personal safety plan to protect yourself and your loved ones.</p>
                            <a href="#" class="btn btn-warning btn-sm">Read More <i class="ti ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Counseling Support -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card resource-card shadow-sm">
                        <div class="card-body p-4">
                            <div class="resource-icon bg-info-subtle text-info mb-3">
                                <i class="ti ti-heart-handshake"></i>
                            </div>
                            <h5 class="card-title">Counseling Support</h5>
                            <p class="text-muted">Access mental health resources and counseling services.</p>
                            <a href="#" class="btn btn-info btn-sm">Read More <i class="ti ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Medical Assistance -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card resource-card shadow-sm">
                        <div class="card-body p-4">
                            <div class="resource-icon bg-danger-subtle text-danger mb-3">
                                <i class="ti ti-medical-cross"></i>
                            </div>
                            <h5 class="card-title">Medical Assistance</h5>
                            <p class="text-muted">Information about medical care and support services available.</p>
                            <a href="#" class="btn btn-danger btn-sm">Read More <i class="ti ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Community Resources -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card resource-card shadow-sm">
                        <div class="card-body p-4">
                            <div class="resource-icon bg-purple-subtle text-purple mb-3">
                                <i class="ti ti-users"></i>
                            </div>
                            <h5 class="card-title">Community Resources</h5>
                            <p class="text-muted">Connect with local support groups and community organizations.</p>
                            <a href="#" class="btn btn-secondary btn-sm">Read More <i class="ti ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emergency Contacts -->
            <div class="card shadow-sm border-0 bg-danger-subtle mt-4">
                <div class="card-body p-4">
                    <h4 class="text-danger mb-3">
                        <i class="ti ti-emergency-bed"></i> Emergency Contacts
                    </h4>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card bg-white border-0">
                                <div class="card-body text-center p-3">
                                    <i class="ti ti-phone fs-7 text-danger mb-2"></i>
                                    <h6>Police Emergency</h6>
                                    <a href="tel:999" class="btn btn-danger btn-sm">Call 999</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-white border-0">
                                <div class="card-body text-center p-3">
                                    <i class="ti ti-medical-cross fs-7 text-danger mb-2"></i>
                                    <h6>Medical Emergency</h6>
                                    <a href="tel:112" class="btn btn-danger btn-sm">Call 112</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-white border-0">
                                <div class="card-body text-center p-3">
                                    <i class="ti ti-heart-handshake fs-7 text-danger mb-2"></i>
                                    <h6>GBV Helpline</h6>
                                    <a href="tel:0800123456" class="btn btn-danger btn-sm">Call 0800-123-456</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-white border-0">
                                <div class="card-body text-center p-3">
                                    <i class="ti ti-message-circle fs-7 text-danger mb-2"></i>
                                    <h6>Crisis Text Line</h6>
                                    <a href="sms:741741" class="btn btn-danger btn-sm">Text 741741</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Materials -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white">
                        <i class="ti ti-download"></i> Downloadable Resources
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <i class="ti ti-file-text text-primary me-2"></i>
                                <strong>GBV Information Booklet</strong>
                                <small class="d-block text-muted">Comprehensive guide on GBV types and support</small>
                            </div>
                            <span class="badge bg-primary-subtle text-primary">PDF</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <i class="ti ti-file-text text-success me-2"></i>
                                <strong>Safety Planning Guide</strong>
                                <small class="d-block text-muted">Step-by-step safety planning checklist</small>
                            </div>
                            <span class="badge bg-success-subtle text-success">PDF</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <i class="ti ti-file-text text-warning me-2"></i>
                                <strong>Legal Rights Handbook</strong>
                                <small class="d-block text-muted">Know your rights under the law</small>
                            </div>
                            <span class="badge bg-warning-subtle text-warning">PDF</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <i class="ti ti-file-text text-info me-2"></i>
                                <strong>Support Services Directory</strong>
                                <small class="d-block text-muted">List of local support organizations</small>
                            </div>
                            <span class="badge bg-info-subtle text-info">PDF</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection


@extends('layouts.victimmaster')

@section('page-css')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Victim</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('vic-dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Create Case</li>
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

    <div class="col-12">
        <!-- start Person Info -->
        <div class="card">
            <div class="card-header text-bg-primary">
                <h4 class="mb-0 text-white">Report Your Case Here</h4>
            </div>
            <form action="{{ route('vic-case-store') }}" method="POST">
                @csrf
                <div>
                    <div class="card-body">
                        <h4 class="card-title">Case Info</h4>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 has-success">
                                    <label class="form-label">Case Type</label>
                                    <select name="type" id="type" class="form-select" required>
                                        <option value="">Select Option</option>
                                        <option value="Physical Violence">Physical Violence</option>
                                        <option value="Sexual Violence">Sexual Violence</option>
                                        <option value="Emotional or Psychological Violence">Emotional or Psychological Violence</option>
                                        <option value="Economic or Financial Violence">Economic or Financial Violence</option>
                                        <option value="Cultural or Social Violence">Cultural or Social Violence</option>
                                        <option value="Digital or Online Violence">Digital or Online Violence</option>
                                    </select>
                                    <small class="form-control-feedback">
                                        Select case type
                                    </small>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" required/>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" id="location" class="form-control" />
                                </div>
                                <small class="form-control-feedback">
                                    Optional
                                </small>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Anonymously</label>
                                    <div class="form-check py-1">
                                        <input type="checkbox" name="anonymous" id="anonymous" value="1" class="form-check-input">
                                        <label class="form-check-label" for="anonymous">
                                            Report Anonymously
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="ti ti-info-circle"></i> Your identity will be kept confidential
                                    </small>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Text area</label>
                                        <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="form-actions">
                        <div class="card-body border-top">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                            <button type="button" class="btn bg-danger-subtle text-danger ms-6">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- end Person Info -->
    </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection

@extends('layouts.lawmaster')

@section('page-css')

@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ti ti-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="ti ti-alert-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Page Header -->
            <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">User Settings</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('law-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Profile Information -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-user"></i> Profile Information</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('law-update-profile') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Role</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->role->name }}" disabled>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy"></i> Update Profile
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-lock"></i> Change Password</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('law-change-password') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="current_password" class="form-label fw-bold">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="new_password" class="form-label fw-bold">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" required minlength="8">
                                    <small class="text-muted">Minimum 8 characters</small>
                                </div>

                                <div class="mb-3">
                                    <label for="new_password_confirmation" class="form-label fw-bold">Confirm New Password</label>
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                </div>

                                <button type="submit" class="btn btn-warning text-white">
                                    <i class="ti ti-key"></i> Change Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-info-circle"></i> Account Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Account Created:</strong> {{ auth()->user()->created_at->format('M d, Y h:i A') }}</p>
                                    <p><strong>Last Updated:</strong> {{ auth()->user()->updated_at->format('M d, Y h:i A') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>User ID:</strong> {{ auth()->user()->id }}</p>
                                    <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
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


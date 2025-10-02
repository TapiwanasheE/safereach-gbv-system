@extends('layouts.counsellormaster')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <!--  Breadcrumb -->
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">User Settings</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('counsel-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Settings</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3 text-end">
                        <i class="ti ti-settings fs-9 text-info opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ti ti-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ti ti-alert-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <!-- Profile Update Card -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">
                            <i class="ti ti-user-edit me-2"></i>Update Profile
                        </h5>

                        <form action="{{ route('counsel-update-profile') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Role</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->role->name ?? 'N/A' }}" disabled>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-2"></i>Save Changes
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">
                            <i class="ti ti-lock me-2"></i>Change Password
                        </h5>

                        <form action="{{ route('counsel-change-password') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-semibold">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                       id="current_password" name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label fw-semibold">New Password</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                       id="new_password" name="new_password" required>
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Must be at least 8 characters</small>
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                                <input type="password" class="form-control"
                                       id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-key me-2"></i>Change Password
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">
                            <i class="ti ti-info-circle me-2"></i>Account Information
                        </h5>

                        <div class="mb-3">
                            <small class="text-muted d-block">Account Created</small>
                            <strong>{{ auth()->user()->created_at->format('F d, Y') }}</strong>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block">Last Updated</small>
                            <strong>{{ auth()->user()->updated_at->format('F d, Y h:i A') }}</strong>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block">User ID</small>
                            <strong>#{{ auth()->user()->id }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


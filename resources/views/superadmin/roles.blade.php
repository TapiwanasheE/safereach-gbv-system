@extends('layouts.master')

@section('page-css')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Role Management</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('sa-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <i class="ti ti-shield-lock" style="font-size: 50px; opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Roles Overview -->
            <div class="row">
                @foreach($roles as $role)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header
                            @if($role->name == 'Super User') bg-danger
                            @elseif($role->name == 'Law Enforcement') bg-warning
                            @elseif($role->name == 'Medical') bg-primary
                            @elseif($role->name == 'Counselor') bg-info
                            @elseif($role->name == 'Victim') bg-secondary
                            @else bg-dark
                            @endif text-white">
                            <h5 class="mb-0 text-white">
                                <i class="ti ti-user-check"></i> {{ $role->name }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Active Users:</span>
                                <h3 class="mb-0">{{ $role->users_count }}</h3>
                            </div>

                            <hr>

                            <h6 class="fw-semibold mb-3">Permissions:</h6>
                            <ul class="list-unstyled">
                                @if($role->name == 'Super User')
                                    <li><i class="ti ti-check text-success"></i> Full System Access</li>
                                    <li><i class="ti ti-check text-success"></i> Manage Users</li>
                                    <li><i class="ti ti-check text-success"></i> View All Cases</li>
                                    <li><i class="ti ti-check text-success"></i> Generate Reports</li>
                                    <li><i class="ti ti-check text-success"></i> System Settings</li>
                                @elseif($role->name == 'Law Enforcement')
                                    <li><i class="ti ti-check text-success"></i> View Cases</li>
                                    <li><i class="ti ti-check text-success"></i> Assign Cases</li>
                                    <li><i class="ti ti-check text-success"></i> Update Case Status</li>
                                    <li><i class="ti ti-check text-success"></i> View Reports</li>
                                @elseif($role->name == 'Medical')
                                    <li><i class="ti ti-check text-success"></i> View Assigned Cases</li>
                                    <li><i class="ti ti-check text-success"></i> Submit Medical Reviews</li>
                                    <li><i class="ti ti-check text-success"></i> Add Medical Findings</li>
                                    <li><i class="ti ti-check text-success"></i> Update Case Stage</li>
                                @elseif($role->name == 'Counselor')
                                    <li><i class="ti ti-check text-success"></i> View Assigned Cases</li>
                                    <li><i class="ti ti-check text-success"></i> Submit Counseling Notes</li>
                                    <li><i class="ti ti-check text-success"></i> Track Sessions</li>
                                    <li><i class="ti ti-check text-success"></i> Update Case Stage</li>
                                @elseif($role->name == 'Victim')
                                    <li><i class="ti ti-check text-success"></i> Report Cases</li>
                                    <li><i class="ti ti-check text-success"></i> View Own Cases</li>
                                    <li><i class="ti ti-check text-success"></i> Anonymous Reporting</li>
                                    <li><i class="ti ti-check text-success"></i> Access Resources</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Role Statistics -->
            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 text-white"><i class="ti ti-chart-bar"></i> Role Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Active Users</th>
                                    <th>Access Level</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td><strong>{{ $role->name }}</strong></td>
                                    <td><span class="badge bg-primary">{{ $role->users_count }} user(s)</span></td>
                                    <td>
                                        @if($role->name == 'Super User')
                                            <span class="badge bg-danger">Administrator</span>
                                        @elseif(in_array($role->name, ['Law Enforcement', 'Medical', 'Counselor']))
                                            <span class="badge bg-warning">Staff</span>
                                        @else
                                            <span class="badge bg-secondary">User</span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-success">Active</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-js')
@endsection


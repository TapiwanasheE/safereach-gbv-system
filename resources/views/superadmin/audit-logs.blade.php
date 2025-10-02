@extends('layouts.master')

@section('page-css')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="card bg-secondary-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Audit Logs & Activity</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('sa-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Audit Logs</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <i class="ti ti-history" style="font-size: 50px; opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Activity -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0 text-white"><i class="ti ti-users"></i> Recent User Activity</h5>
                </div>
                <div class="card-body">
                    @if($recentUsers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Last Updated</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                <span class="fw-bold">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                            <span class="ms-2">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->role->name == 'Super User')
                                            <span class="badge bg-danger">{{ $user->role->name }}</span>
                                        @elseif($user->role->name == 'Law Enforcement')
                                            <span class="badge bg-warning">{{ $user->role->name }}</span>
                                        @elseif($user->role->name == 'Medical')
                                            <span class="badge bg-primary">{{ $user->role->name }}</span>
                                        @elseif($user->role->name == 'Counselor')
                                            <span class="badge bg-info">{{ $user->role->name }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $user->role->name }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $user->updated_at->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td><span class="badge bg-success">Active</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-center text-muted py-3">No user activity recorded</p>
                    @endif
                </div>
            </div>

            <!-- Case Activity -->
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0 text-white"><i class="ti ti-clipboard-text"></i> Recent Case Activity</h5>
                </div>
                <div class="card-body">
                    @if($recentCases->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Case Number</th>
                                    <th>Type</th>
                                    <th>Reporter</th>
                                    <th>Status</th>
                                    <th>Stage</th>
                                    <th>Assigned To</th>
                                    <th>Last Modified</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentCases as $case)
                                <tr>
                                    <td><strong>{{ $case->case_number }}</strong></td>
                                    <td><span class="badge bg-danger">{{ $case->type }}</span></td>
                                    <td>
                                        @if($case->anonymous)
                                            <span class="badge bg-warning">Anonymous</span>
                                        @else
                                            {{ $case->user->name ?? 'Unknown' }}
                                        @endif
                                    </td>
                                    <td><span class="badge bg-info">{{ $case->status }}</span></td>
                                    <td>{{ $case->stage ?? 'Not Assigned' }}</td>
                                    <td>{{ $case->assignedStaff->name ?? 'Unassigned' }}</td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $case->updated_at->diffForHumans() }}
                                        </small>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-center text-muted py-3">No case activity recorded</p>
                    @endif
                </div>
            </div>

            <!-- Activity Summary -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-primary-subtle">
                        <div class="card-body text-center">
                            <i class="ti ti-user-check" style="font-size: 40px;"></i>
                            <h3 class="mt-2 mb-0">{{ $recentUsers->count() }}</h3>
                            <p class="mb-0">Active Users (Last 20)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning-subtle">
                        <div class="card-body text-center">
                            <i class="ti ti-clipboard-check" style="font-size: 40px;"></i>
                            <h3 class="mt-2 mb-0">{{ $recentCases->count() }}</h3>
                            <p class="mb-0">Modified Cases (Last 20)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success-subtle">
                        <div class="card-body text-center">
                            <i class="ti ti-clock" style="font-size: 40px;"></i>
                            <h3 class="mt-2 mb-0">{{ now()->format('H:i') }}</h3>
                            <p class="mb-0">System Time</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-js')
@endsection


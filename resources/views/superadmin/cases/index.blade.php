@extends('layouts.master')

@section('page-css')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="card bg-warning-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">All GBV Cases</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('sa-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">All Cases</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <i class="ti ti-clipboard-list" style="font-size: 50px; opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-info-subtle">
                        <div class="card-body text-center">
                            <h3 class="fw-bold mb-0">{{ $cases->count() }}</h3>
                            <p class="mb-0">Total Cases</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning-subtle">
                        <div class="card-body text-center">
                            <h3 class="fw-bold mb-0">{{ $cases->where('status', 'Reported')->count() }}</h3>
                            <p class="mb-0">New Reports</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-primary-subtle">
                        <div class="card-body text-center">
                            <h3 class="fw-bold mb-0">{{ $cases->whereIn('status', ['In Progress', 'Under Review'])->count() }}</h3>
                            <p class="mb-0">In Progress</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success-subtle">
                        <div class="card-body text-center">
                            <h3 class="fw-bold mb-0">{{ $cases->whereIn('status', ['Resolved', 'Closed'])->count() }}</h3>
                            <p class="mb-0">Resolved</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cases Table -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-3">Case Management</h5>

                    @if($cases->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4 bg-light">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Case Number</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Reporter</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Type</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Date Reported</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Stage</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Assigned To</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cases as $case)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="fs-4 fw-semibold mb-0 text-warning">{{ $case->case_number }}</p>
                                                <span class="fs-2 text-muted">{{ $case->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($case->anonymous)
                                            <span class="badge bg-warning-subtle text-warning border border-warning">
                                                <i class="ti ti-eye-off"></i> Anonymous
                                            </span>
                                        @else
                                            <div>
                                                <p class="mb-0 fw-semibold fs-4">{{ $case->user->name ?? 'Unknown' }}</p>
                                                <span class="fs-2 text-muted">{{ $case->user->email ?? '' }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-danger-subtle text-danger border border-danger">{{ $case->type }}</span>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($case->date_reported)->format('M d, Y') }}</p>
                                    </td>
                                    <td>
                                        @if($case->status == 'Reported')
                                            <span class="badge bg-info"><i class="ti ti-alert-circle"></i> {{ $case->status }}</span>
                                        @elseif(in_array($case->status, ['In Progress', 'Under Review']))
                                            <span class="badge bg-warning"><i class="ti ti-loader"></i> {{ $case->status }}</span>
                                        @elseif(in_array($case->status, ['Resolved', 'Closed']))
                                            <span class="badge bg-success"><i class="ti ti-check"></i> {{ $case->status }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $case->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($case->stage == 'Law Enforcement')
                                            <span class="badge bg-danger-subtle text-danger">{{ $case->stage }}</span>
                                        @elseif($case->stage == 'Medical')
                                            <span class="badge bg-primary-subtle text-primary">{{ $case->stage }}</span>
                                        @elseif($case->stage == 'Counselor')
                                            <span class="badge bg-info-subtle text-info">{{ $case->stage }}</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary">{{ $case->stage ?? 'Not Assigned' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($case->assignedStaff)
                                            <div>
                                                <p class="mb-0 fw-semibold">{{ $case->assignedStaff->name }}</p>
                                                <small class="text-muted">{{ $case->assignedStaff->role->name }}</small>
                                            </div>
                                        @else
                                            <span class="text-muted">Not Assigned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('sa-cases-show', $case->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ti ti-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="ti ti-clipboard-off" style="font-size: 80px; opacity: 0.3;"></i>
                        <h4 class="mt-3 text-muted">No Cases Reported Yet</h4>
                        <p class="text-muted">Cases will appear here once victims report them.</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-js')
@endsection

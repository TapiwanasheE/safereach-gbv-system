@extends('layouts.counsellormaster')

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
                            <h4 class="fw-semibold mb-8">Counseling Cases</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('counsel-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">My Cases</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <i class="ti ti-users" style="font-size: 50px; opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cases Table -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-3">Assigned Counseling Cases</h5>
                    
                    @if($cases->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4 bg-light">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Case Number</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Client</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Case Type</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Date Reported</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Sessions</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
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
                                                <p class="fs-4 fw-semibold mb-0 text-info">{{ $case->case_number }}</p>
                                                <span class="fs-2 text-muted">{{ $case->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($case->anonymous)
                                            <span class="badge bg-warning-subtle text-warning border border-warning">
                                                <i class="ti ti-eye-off"></i> Anonymous Client
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
                                        @if($case->counseling_sessions)
                                            <span class="badge bg-info-subtle text-info">
                                                <i class="ti ti-calendar-check"></i> {{ $case->counseling_sessions }} session(s)
                                            </span>
                                        @else
                                            <span class="text-muted">No sessions yet</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($case->status == 'Counseling Done')
                                            <span class="badge bg-success"><i class="ti ti-check"></i> Sessions Completed</span>
                                        @else
                                            <span class="badge bg-warning"><i class="ti ti-clock"></i> In Progress</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('counsel-case-show', $case->id) }}" class="btn btn-sm btn-info">
                                            <i class="ti ti-eye"></i> View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="ti ti-mood-empty" style="font-size: 80px; opacity: 0.3;"></i>
                        <h4 class="mt-3 text-muted">No Cases Assigned</h4>
                        <p class="text-muted">You currently have no counseling cases assigned to you.</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-js')

@endsection

@extends('layouts.lawmaster')

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
                            <h4 class="fw-semibold mb-8">Pending Cases</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('law-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Pending Cases</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <a href="{{ route('law-dashboard') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <span class="round-40 rounded-circle bg-warning d-flex align-items-center justify-content-center">
                                        <i class="ti ti-loader text-white fs-6"></i>
                                    </span>
                                </div>
                                <div>
                                    <h4 class="fw-semibold mb-0">{{ $cases->total() }} Pending Cases</h4>
                                    <p class="text-muted mb-0">Cases awaiting investigation or action</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cases Table -->
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0 text-white"><i class="ti ti-loader"></i> Pending Cases List</h5>
                </div>
                <div class="card-body">
                    @if($cases->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-warning">
                                    <tr>
                                        <th>Case Number</th>
                                        <th>Reporter</th>
                                        <th>Type of Violence</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Assigned To</th>
                                        <th>Date Reported</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cases as $case)
                                        <tr>
                                            <td><strong>{{ $case->case_number }}</strong></td>
                                            <td>
                                                @if($case->anonymous)
                                                    <span class="badge bg-warning">
                                                        <i class="ti ti-eye-off"></i> Anonymous Reporter
                                                    </span>
                                                @else
                                                    {{ $case->user->name ?? 'N/A' }}
                                                @endif
                                            </td>
                                            <td>{{ $case->type }}</td>
                                            <td>{{ $case->location }}</td>
                                            <td>
                                                <span class="badge bg-warning">{{ $case->status }}</span>
                                            </td>
                                            <td>
                                                @if($case->assignedStaff)
                                                    {{ $case->assignedStaff->name }}
                                                    <small class="text-muted">({{ $case->assignedStaff->role->name }})</small>
                                                @else
                                                    <span class="badge bg-secondary">Unassigned</span>
                                                @endif
                                            </td>
                                            <td>{{ $case->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('law-cases-show', $case->id) }}" class="btn btn-sm btn-info">
                                                    <i class="ti ti-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $cases->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="ti ti-clipboard-check text-muted" style="font-size: 4rem;"></i>
                            <h5 class="text-muted mt-3">No Pending Cases</h5>
                            <p class="text-muted">All cases have been resolved or are in other stages.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')

@endsection


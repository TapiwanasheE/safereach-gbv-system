@extends('layouts.counsellormaster')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <!--  Breadcrumb -->
        <div class="card bg-success-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Completed Counseling Sessions</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('counsel-dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Completed Sessions</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3 text-end">
                        <span class="badge bg-success fs-6">{{ $cases->total() }} Completed</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="round-40 rounded-circle bg-success-subtle d-flex align-items-center justify-content-center">
                                    <i class="ti ti-check fs-6 text-success"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-semibold">Completed Sessions</h6>
                                <h4 class="mb-0 fw-bold">{{ $cases->total() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Cases Table -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">Completed Counseling History</h5>
                </div>

                @if($cases->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead class="text-dark fs-4 bg-light">
                            <tr>
                                <th><h6 class="fw-semibold mb-0">Case ID</h6></th>
                                <th><h6 class="fw-semibold mb-0">Client Name</h6></th>
                                <th><h6 class="fw-semibold mb-0">Type</h6></th>
                                <th><h6 class="fw-semibold mb-0">Sessions</h6></th>
                                <th><h6 class="fw-semibold mb-0">Status</h6></th>
                                <th><h6 class="fw-semibold mb-0">Completed Date</h6></th>
                                <th><h6 class="fw-semibold mb-0">Actions</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cases as $case)
                            <tr>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">#{{ $case->id }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="ti ti-user-circle fs-7 {{ $case->anonymous ? 'text-warning' : 'text-primary' }}"></i>
                                        </div>
                                        <div>
                                            @if($case->anonymous)
                                                <h6 class="mb-0 fw-semibold">Anonymous Client</h6>
                                                <span class="badge bg-warning-subtle text-warning mt-1">Anonymous</span>
                                            @else
                                                <h6 class="mb-0">{{ $case->user->name ?? 'N/A' }}</h6>
                                                <span class="fs-2 text-muted">{{ $case->user->email ?? 'N/A' }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info">{{ $case->type }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $case->counseling_sessions ?? 1 }} Session(s)</span>
                                </td>
                                <td>
                                    @if($case->status == 'Closed')
                                        <span class="badge bg-success">Closed</span>
                                    @else
                                        <span class="badge bg-info">Counseling Done</span>
                                    @endif
                                </td>
                                <td>{{ $case->updated_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('counsel-case-show', $case->id) }}" class="btn btn-info btn-sm">
                                        <i class="ti ti-eye"></i> View Details
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $cases->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <i class="ti ti-folder-off fs-9 text-muted mb-3"></i>
                    <h5 class="text-muted">No completed counseling sessions yet</h5>
                    <p class="text-muted">Completed sessions will appear here.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


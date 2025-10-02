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
                            <h4 class="fw-semibold mb-8">My Cases</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('vic-dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">My Cases</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3">
                            <div class="text-center mb-n5">
                                <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="modernize-img" class="img-fluid mb-n4" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-3 justify-content-between align-items-center">
                        <h4 class="card-title">All My Reported Cases</h4>
                        <a href="{{ route('vic-create-case') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i> Report New Case
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>Case Number</th>
                                    <th>Type</th>
                                    <th>Date Reported</th>
                                    <th>Status</th>
                                    <th>Stage</th>
                                    <th>Report Type</th>
                                    <th>Assigned To</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cases as $case)
                                    <tr>
                                        <td><strong>{{ $case->case_number }}</strong></td>
                                        <td>{{ $case->type }}</td>
                                        <td>{{ \Carbon\Carbon::parse($case->date_reported)->format('M d, Y') }}</td>
                                        <td>
                                            @if($case->status == 'Reported')
                                                <span class="badge bg-info">{{ $case->status }}</span>
                                            @elseif($case->status == 'In Progress')
                                                <span class="badge bg-warning">{{ $case->status }}</span>
                                            @elseif($case->status == 'Resolved')
                                                <span class="badge bg-success">{{ $case->status }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $case->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary">{{ $case->stage ?? 'Not Assigned' }}</span>
                                        </td>
                                        <td>
                                            @if($case->anonymous)
                                                <span class="badge bg-warning">
                                                    <i class="ti ti-eye-off"></i> Anonymous
                                                </span>
                                            @else
                                                <span class="badge bg-success">
                                                    <i class="ti ti-eye"></i> Identified
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($case->assignedStaff)
                                                {{ $case->assignedStaff->name }}
                                                <br><small class="text-muted">{{ $case->assignedStaff->role->name }}</small>
                                            @else
                                                <span class="text-muted">Not Assigned</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('vic-case-detail', $case->id) }}" class="btn btn-sm btn-primary">
                                                <i class="ti ti-eye"></i> View Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <p class="text-muted">You haven't reported any cases yet.</p>
                                            <a href="{{ route('vic-create-case') }}" class="btn btn-primary">Report Your First Case</a>
                                        </td>
                                    </tr>
                                @endforelse
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


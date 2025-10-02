@extends('layouts.lawmaster')

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
                            <h4 class="fw-semibold mb-8">Law Enforcement Cases</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('law-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Cases</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <i class="ti ti-shield" style="font-size: 50px; opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cases Table -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-3">All Law Enforcement Cases</h5>

                    @if($cases->count() > 0)
                    <div class="table-responsive mb-4 border rounded-1">
        <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
            <tr>
                <th>
                    <h6 class="fs-4 fw-semibold mb-0">Case Number</h6>
                </th>
                <th>
                    <h6 class="fs-4 fw-semibold mb-0">Name</h6>
                </th>
                <th>
                    <h6 class="fs-4 fw-semibold mb-0">Case Type</h6>
                </th>
                <th>
                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                </th>
                <th>
                    <h6 class="fs-4 fw-semibold mb-0">Stage</h6>
                </th>
                <th>
                    <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($cases as $case)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            {{--                            <img src="../assets/images/profile/user-3.jpg" class="rounded-circle" width="40" height="40" />--}}
                            <div class="ms-3">
                                <p class="fs-4 fw-normal mb-0">{{ $case->case_number }}</p>
                                {{--                                <span class="fw-normal">{{ $case->role->name }}</span>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($case->anonymous)
                            <span class="badge bg-warning"><i class="ti ti-eye-off"></i> Anonymous</span>
                        @else
                            <p class="mb-0 fw-normal fs-4">{{ $case->user->name ?? 'Unknown' }}</p>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-danger">{{ $case->type }}</span>
                    </td>
                    <td>
                        <span class="badge bg-success-subtle text-success">{{ $case->status }}</span>
                    </td>
                    <td>
                        <span class="badge bg-primary-subtle text-primary">{{ $case->stage }}</span>
                    </td>
                    <td>
                        <a href="{{ route('law-cases-show', $case->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="ti ti-clipboard-off" style="font-size: 80px; opacity: 0.3;"></i>
                        <h4 class="mt-3 text-muted">No Cases in Law Enforcement Stage</h4>
                        <p class="text-muted">Cases will appear here when they are in the Law Enforcement stage.</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-js')

@endsection

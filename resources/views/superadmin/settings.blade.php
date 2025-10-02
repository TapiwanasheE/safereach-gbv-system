@extends('layouts.master')

@section('page-css')
@endsection

@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="card bg-primary-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">System Settings</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('sa-dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3 text-end">
                            <i class="ti ti-settings" style="font-size: 50px; opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- System Information -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-info-circle"></i> System Information</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">System Name:</td>
                                    <td>Safe Reach GBV Case Management</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Version:</td>
                                    <td>1.0.0</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Environment:</td>
                                    <td><span class="badge bg-success">{{ config('app.env') }}</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Laravel Version:</td>
                                    <td>{{ app()->version() }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">PHP Version:</td>
                                    <td>{{ phpversion() }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Timezone:</td>
                                    <td>{{ config('app.timezone') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Application Settings -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-adjustments"></i> Application Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="fw-bold">Anonymous Reporting</label>
                                <p class="mb-0"><span class="badge bg-success">Enabled</span></p>
                                <small class="text-muted">Victims can report cases anonymously</small>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="fw-bold">Case Assignment</label>
                                <p class="mb-0"><span class="badge bg-success">Enabled</span></p>
                                <small class="text-muted">Cases can be assigned to staff members</small>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="fw-bold">Email Notifications</label>
                                <p class="mb-0"><span class="badge bg-warning">Pending Setup</span></p>
                                <small class="text-muted">Configure SMTP settings to enable</small>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="fw-bold">System Maintenance</label>
                                <p class="mb-0"><span class="badge bg-info">Normal Operations</span></p>
                                <small class="text-muted">All systems operational</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-shield-lock"></i> Security Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="fw-bold">Password Requirements</label>
                                <ul class="mb-0">
                                    <li>Minimum 6 characters</li>
                                    <li>Must be confirmed</li>
                                </ul>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="fw-bold">Role-Based Access Control</label>
                                <p class="mb-0"><span class="badge bg-success">Active</span></p>
                                <small class="text-muted">5 roles configured</small>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="fw-bold">Data Protection</label>
                                <p class="mb-0"><span class="badge bg-success">Enabled</span></p>
                                <small class="text-muted">Anonymous cases identity protected</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Database Settings -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0 text-white"><i class="ti ti-database"></i> Database Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="fw-bold">Database Connection</label>
                                <p class="mb-0"><span class="badge bg-success">Connected</span></p>
                                <small class="text-muted">{{ config('database.default') }}</small>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="fw-bold">Total Records</label>
                                <ul class="mb-0">
                                    <li>Users: <strong>{{ \App\Models\User::count() }}</strong></li>
                                    <li>Cases: <strong>{{ \App\Models\gbv_case::count() }}</strong></li>
                                    <li>Roles: <strong>{{ \App\Models\Role::count() }}</strong></li>
                                </ul>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="fw-bold">Last Backup</label>
                                <p class="mb-0 text-muted">No automated backups configured</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white"><i class="ti ti-bolt"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100 mb-2" onclick="clearCache()">
                                <i class="ti ti-refresh"></i> Clear Cache
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('sa-reports') }}" class="btn btn-outline-success w-100 mb-2">
                                <i class="ti ti-file-chart"></i> View Reports
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('sa-audit-logs') }}" class="btn btn-outline-warning w-100 mb-2">
                                <i class="ti ti-history"></i> View Audit Logs
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('sa-dashboard') }}" class="btn btn-outline-secondary w-100 mb-2">
                                <i class="ti ti-home"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-js')
<script>
function clearCache() {
    alert('Cache clearing would be implemented here via AJAX call to server');
}
</script>
@endsection


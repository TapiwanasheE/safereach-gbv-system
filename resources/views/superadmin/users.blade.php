@extends('layouts.master')

@section('page-css')
@endsection

@section('content')
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ti ti-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="ti ti-alert-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h6 class="mb-2">Please fix the following errors:</h6>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title fw-semibold mb-0">System Staff Management</h5>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal">
                            <i class="ti ti-plus"></i> Add New User
                        </a>
                    </div>

                    @if($users->count() > 0)
                    <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                    <tr>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">User</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Role</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                        </th>
                        <th>
                            <h6 class="fs-4 fw-semibold mb-0">Action</h6>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <span class="fw-bold">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div class="ms-3">
                                    <h6 class="fs-4 fw-semibold mb-0">{{ $user->name }}</h6>
                                    <span class="fw-normal text-muted">{{ $user->role->name }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 fw-normal fs-4">{{ $user->email }}</p>
                        </td>
                        <td>
                            @if($user->role->name == 'Law Enforcement')
                                <span class="badge bg-danger-subtle text-danger">{{ $user->role->name }}</span>
                            @elseif($user->role->name == 'Medical')
                                <span class="badge bg-primary-subtle text-primary">{{ $user->role->name }}</span>
                            @elseif($user->role->name == 'Counselor')
                                <span class="badge bg-info-subtle text-info">{{ $user->role->name }}</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">{{ $user->role->name }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $user->id }}">
                                <i class="ti ti-edit"></i> Edit
                            </button>
                            <form action="{{ route('sa-user-destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="ti ti-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Edit User Modals -->
            @foreach($users as $user)
            <div id="edit-modal-{{ $user->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit User - {{ $user->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="ps-3 pr-3" action="{{ route('sa-user-update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="edit_name_{{ $user->id }}">Name</label>
                                    <input class="form-control" type="text" name="name" id="edit_name_{{ $user->id }}" required value="{{ $user->name }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit_email_{{ $user->id }}">Email address</label>
                                    <input class="form-control" type="email" name="email" id="edit_email_{{ $user->id }}" required value="{{ $user->email }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit_password_{{ $user->id }}">Password (leave blank to keep current)</label>
                                    <input class="form-control" type="password" name="password" id="edit_password_{{ $user->id }}" placeholder="Enter new password" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit_password_confirmation_{{ $user->id }}">Confirm Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" id="edit_password_confirmation_{{ $user->id }}" placeholder="Confirm new password" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit_role_id_{{ $user->id }}">Role</label>
                                    <select name="role_id" id="edit_role_id_{{ $user->id }}" class="form-select" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 text-center">
                                    <button class="btn bg-success text-white" type="submit">
                                        <i class="ti ti-check"></i> Update User
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

                    @else
                    <div class="text-center py-5">
                        <i class="ti ti-user-off" style="font-size: 80px; opacity: 0.3;"></i>
                        <h4 class="mt-3 text-muted">No Staff Members Yet</h4>
                        <p class="text-muted">Click "Add New User" to create your first staff member.</p>
                    </div>
                    @endif
                </div>
            </div>

    <!-- Ward Items modal -->
    <div id="newuserModal" class="modal fade" role="dialog">
        <div class="z-depth-right-5 m-b-15 m-t-30">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="container">
                        <h1>Create New User</h1>

                        <form action="" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select name="role_id" id="role_id" class="form-control" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Create User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Ward Items modal-->



    <!-- Signup modal content -->
    <div id="signup-modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <a href="../main/index.html" class="text-success">
                                <span>
                                  <img src="../assets/images/logos/gbv image.png" class="me-3 img-fluid" alt="modernize-img" width="120" height="40" />
                                </span>
                        </a>
                    </div>

                    <form class="ps-3 pr-3" action="{{ route('sa-user-store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username">Name</label>
                            <input class="form-control" type="text" name="name" id="name" required="" placeholder="Michael Zenaty" />
                        </div>

                        <div class="mb-3">
                            <label for="emailaddress">Email address</label>
                            <input class="form-control" type="email" name="email" id="email" required="" placeholder="john@deo.com" />
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password" />
                        </div>

                        <div class="mb-3">
                            <label for="password">Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation" required="" id="password_confirmation" placeholder="Confirm password" />
                        </div>

                        <div class="mb-3">
                            <label for="role_id">Role</label>
                            <select name="role_id" id="role_id" class="select2 form-control" required>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn bg-info-subtle text-info " type="submit">
                               Add User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection


@section('page-js')
    <script>
        function openEditWardItemModal(type) {
            $('#editidItem').val($(type).attr('data-id'))
            $('#editnameItem').val($(type).attr('data-name'))
            $('#editstatusItem').val($(type).attr('data-status'))
            $('#editwarditemModal').modal('show');


        }
    </script>

    <script src="../assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="../assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="../assets/js/forms/select2.init.js"></script>
@endsection

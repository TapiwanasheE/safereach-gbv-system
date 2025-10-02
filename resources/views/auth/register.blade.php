@extends('layouts.app')

@section('page-css')

@endsection

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div id="main-wrapper" class="auth-customizer-none">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
        <div class="position-relative z-index-5">
            <div class="row">
                <div class="col-xl-7 col-xxl-8">
                    <a href="../main/index.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                        <img src="../assets/images/logos/dark-logo.svg" class="dark-logo" alt="Logo-Dark" />
                        <img src="../assets/images/logos/light-logo.svg" class="light-logo" alt="Logo-light" />
                    </a>
                    <div class="d-none d-xl-flex align-items-center justify-content-center h-n80">
                        <img src="../assets/images/backgrounds/login-security.svg" alt="modernize-img" class="img-fluid" width="500">
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-4">
                    <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                        <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 px-4">
                            <h2 class="mb-1 fs-7 fw-bolder">Welcome to Safe Reach (GBV)</h2>
                            <p class="mb-7">Your Dashboard</p>
                            <div class="row">
                                <div class="col-6 mb-2 mb-sm-0">
                                    <a class="btn text-dark border fw-normal d-flex align-items-center justify-content-center rounded-2 py-8" href="javascript:void(0)" role="button">
                                        <img src="../assets/images/svgs/google-icon.svg" alt="modernize-img" class="img-fluid me-2" width="18" height="18">
                                        <span class="flex-shrink-0">with Google</span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a class="btn text-dark border fw-normal d-flex align-items-center justify-content-center rounded-2 py-8" href="javascript:void(0)" role="button">
                                        <img src="../assets/images/svgs/facebook-icon.svg" alt="modernize-img" class="img-fluid me-2" width="18" height="18">
                                        <span class="flex-shrink-0">with FB</span>
                                    </a>
                                </div>
                            </div>
                            <div class="position-relative text-center my-4">
                                <p class="mb-0 fs-4 px-3 d-inline-block bg-body text-dark z-index-5 position-relative">or sign
                                    Up
                                    with</p>
                                <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" aria-describedby="textHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign Up</button>
{{--                                <a href="../main/authentication-login.html" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign Up</a>--}}
                                <div class="d-flex align-items-center">
                                    <p class="fs-4 mb-0 text-dark">Already have an Account?</p>
                                    <a class="text-primary fw-medium ms-2" href="{{ route('login') }}">Sign In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



{{--    <div class="container">--}}
{{--        <h2>Register</h2>--}}

{{--        <form method="POST" action="{{ route('custom.register') }}">--}}
{{--            @csrf--}}

{{--            <div class="form-group">--}}
{{--                <label for="name">Name</label>--}}
{{--                <input type="text" name="name" class="form-control" required>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="email">Email</label>--}}
{{--                <input type="email" name="email" class="form-control" required>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="password">Password</label>--}}
{{--                <input type="password" name="password" class="form-control" required>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="password_confirmation">Confirm Password</label>--}}
{{--                <input type="password" name="password_confirmation" class="form-control" required>--}}
{{--            </div>--}}

{{--            <button type="submit" class="btn btn-primary">Register</button>--}}
{{--        </form>--}}
{{--    </div>--}}
@endsection

@section('page-js')
@endsection

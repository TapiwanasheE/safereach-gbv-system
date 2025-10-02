@extends('layouts.app')

@section('page-css')

@endsection

@section('content')
  <div id="main-wrapper" class="auth-customizer-none">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
      <div class="position-relative z-index-5">
        <div class="row">
          <div class="col-xl-7 col-xxl-8">
            <a href="../main/index.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
              <img src="../assets/images/logos/gbv image.png" class="dark-logo" alt="Logo-Dark" width="100" height="60" />
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
                    in
                    with</p>
                  <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                </div>
                  <form method="POST" action="{{ route('login') }}">
                      @csrf <!-- Adds CSRF token for security -->

                      <div class="mb-3">
                          <label for="username" class="form-label">Username</label>
{{--                          <input type="email" class="form-control" id="username" name="email" aria-describedby="emailHelp" required>--}}
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                          @error('email')
                          <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                          @enderror

                      </div>

                      <div class="mb-4">
                          <label for="password" class="form-label">Password</label>
{{--                          <input type="password" class="form-control" id="password" name="password" required>--}}
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                          @error('password')
                          <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                          @enderror
                      </div>

                      <div class="d-flex align-items-center justify-content-between mb-4">
                          <div class="form-check">
                              <input class="form-check-input primary" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                              <label class="form-check-label text-dark fs-3" for="remember">
                                  Remember this Device
                              </label>
                          </div>
                          <a class="text-primary fw-medium fs-3" href="#">Forgot Password?</a>
                      </div>

                      <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</button>

                      <div class="d-flex align-items-center justify-content-center">
                          <p class="fs-4 mb-0 fw-medium">New to SafeReach?</p>
                          <a class="text-primary fw-medium ms-2" href="{{ route('register') }}">Create an account</a>
                      </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

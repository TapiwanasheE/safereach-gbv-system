{{--<!-- <!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1"> -->--}}

{{--    <!-- CSRF Token -->--}}
{{--    <!-- <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title> -->--}}

{{--    <!-- Fonts -->--}}
{{--    <!-- <link rel="dns-prefetch" href="//fonts.bunny.net">--}}
{{--    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> -->--}}

{{--<!----}}
{{--</head>--}}
{{--<body>--}}
{{--    <div id="app">--}}
{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <!-- <ul class="navbar-nav me-auto"> -->--}}

{{--                    <!-- </ul> -->--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <!-- <ul class="navbar-nav ms-auto"> -->--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        <!-- @guest--}}
{{--                            @if (Route::has('login'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }}--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

{{--        <main class="py-4">--}}
{{--            @yield('content')--}}
{{--        </main>--}}
{{--    </div>--}}
{{--</body>--}}
{{--</html> -->--}}

<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png')}}" />

  <!-- Core Css -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css')}}" />

  <title>Safe Reach (GBV)</title>

    @yield('page-css')

    <style>

        .hidden {
            display: none;
        }
        @media print{
            .no-print {
                visibility: hidden;
                display: none;
            }
            .yes-print {
                visibility: visible;
                display:block;
            }
        }
        .wrap-text {
            white-space: normal;
        }
        .table.table-sm td, .table.table-sm th {
            padding: 0.9rem 0.39rem;

        }

        /*
        code to make the table responsive by wrapping the text
        */

        td{
            white-space: normal;
        }

        .header-navbar .navbar-wrapper .navbar-logo .mobile-menu {
            position: absolute;
            right: .001rem;
            top: calc(50% - 0.51rem);
            border-radius: 50%;
            padding: .3125rem .5625rem;
            font-size: 1.25rem;
        }

        .modal-xl{
            max-width: 80% !important;
        }

        .modal-md {
            max-width: 600px;
        }

        #spinner-div {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            text-align: center;
            vertical-align: middle;
            background-color: rgba(255, 255, 255, 0.5);
            z-index: 2;
        }
        #spinner {
            position: relative;
            top: 40% !important;
            left: 0;
        }
    </style>

</head>
<body>




    <div class="main-body">
        <div class="">
            <div class="page-body">
                <!-- Toast Notification HTML -->
                <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                    <div class="toast" id="flashToast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="background-color: {{ session('success') ? '#28a745' : '#dc3545' }}; color: white; padding: 15px; border-radius: 5px; min-width: 250px;">
                        <div class="toast-header" style="display: flex; justify-content: space-between; background: rgba(255, 255, 255, 0.2); color: white;">
                            <strong class="mr-auto">{{ session('success') ? 'Success' : 'Error' }}</strong>
                            <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ session('success') ?? session('error') }}
                        </div>
                    </div>
                </div>
                <!-- Page Content -->
                @yield('content')
                @yield('modals')
                <!-- Page Content -->
            </div>
        </div>
    </div>

</body>





@yield('page-js')

<!-- Import Js Files -->
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js')}}"></script>
  <script src="{{ asset('assets/js/theme/app.init.js')}}"></script>
  <script src="{{ asset('assets/js/theme/theme.js')}}"></script>
  <script src="{{ asset('assets/js/theme/app.min.js')}}"></script>

  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success') || session('error'))
        $('#flashToast').toast('show');
        @endif
    });
</script>

</html>

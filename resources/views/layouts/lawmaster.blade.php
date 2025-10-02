<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}"/>.

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}"/>

    <title>Safe Reach (GBV) - Law Enforcement</title>
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}"/>

    @yield('page-css')
</head>

<body>
<div class="toast toast-onload align-items-center text-bg-primary border-0" role="alert" aria-live="assertive"
     aria-atomic="true">
    <div class="toast-body hstack align-items-start gap-6">
        <i class="ti ti-alert-circle fs-6"></i>
        <div>
            <h5 class="text-white fs-3 mb-1">Welcome to Safe Reach (GBV)</h5>
        </div>
        <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
                aria-label="Close"></button>
    </div>
</div>

<div id="main-wrapper">
    <!-- Sidebar Start -->
    <aside class="left-sidebar with-vertical">
        <div><!-- ---------------------------------- -->
            <!-- Start Vertical Layout Sidebar -->
            <!-- ---------------------------------- -->
            <div class="brand-logo d-flex align-items-center justify-content-between">
                {{--                <h3>GBV</h3>--}}
                <a href="{{ route('law-dashboard') }}" class="text-nowrap logo-img">
                    <img src="{{ asset('assets/images/logos/gbv image.png') }}" class="dark-logo" alt="Logo-Dark" width="150" height="70" />
                    <img src="{{ asset('assets/images/logos/light-logo.svg') }}" class="light-logo" alt="Logo-light"/>
                </a>
                <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                    <i class="ti ti-x"></i>
                </a>
            </div>

            <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                <ul id="sidebarnav">
                    <!-- ---------------------------------- -->
                    <!-- Home -->
                    <!-- ---------------------------------- -->
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <!-- ---------------------------------- -->
                    <!-- Dashboard -->
                    <!-- ---------------------------------- -->
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('law-dashboard') }}"  aria-expanded="false">
                <span>
                  <i class="ti ti-home"></i>
                </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Case Management</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('law-cases.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-file"></i>
                </span>
                            <span class="hide-menu">New Cases</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('law-pending-cases') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-loader"></i>
                </span>
                            <span class="hide-menu">Pending Cases</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('law-solved-cases') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-file-check"></i>
                </span>
                            <span class="hide-menu">Solved Cases</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Reports</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('law-reports') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-clipboard-check"></i>
                </span>
                            <span class="hide-menu">Management Reports</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Configurations</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('law-settings') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                            <span class="hide-menu">User Settings</span>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- ---------------------------------- -->
            <!-- Start Vertical Layout Sidebar -->
            <!-- ---------------------------------- -->
        </div>
    </aside>
    <!--  Sidebar End -->
    <div class="page-wrapper">
        <!--  Header Start -->
        <header class="topbar">
            <div class="with-vertical"><!-- ---------------------------------- -->
                <!-- Start Vertical Layout Header -->
                <!-- ---------------------------------- -->
                <header class="navbar navbar-expand-lg p-0">
                    <ul class="navbar-nav">
                        <li class="nav-item nav-icon-hover-bg rounded-circle ms-n2">
                            <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item nav-icon-hover-bg rounded-circle d-none d-lg-flex">
                            <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal"
                               data-bs-target="#exampleModal">
                                <i class="ti ti-search"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <div class="d-flex align-items-center justify-content-between">

                            <ul class="navbar-nav quick-links d-none d-lg-flex align-items-center">


                                <!-- ------------------------------- -->
                                <!-- start profile Dropdown -->
                                <!-- ------------------------------- -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="user-profile-img">
                                                <img src="{{ asset('assets/images/profile/user-1.jpg') }}" class="rounded-circle" width="35"
                                                     height="35" alt="modernize-img"/>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                         aria-labelledby="drop1">
                                        <div class="profile-dropdown position-relative" data-simplebar>
                                            <div class="py-3 px-7 pb-0">
                                                <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                            </div>
                                            <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                                <img src="{{ asset('assets/images/profile/user-1.jpg') }}" class="rounded-circle" width="80"
                                                     height="80" alt="modernize-img"/>
                                                <div class="ms-3">
                                                    <h5 class="mb-1 fs-3">{{ Auth::user()->name }}</h5>
                                                    <span class="mb-1 d-block">{{ Auth::user()->role->name }}</span>
                                                    <p class="mb-0 d-flex align-items-center gap-2">
                                                        <i class="ti ti-mail fs-4"></i> {{ Auth::user()->email }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="message-body">
                                                <a href="#"
                                                   class="py-8 px-7 mt-8 d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                              <img src="{{ asset('assets/images/svgs/icon-account.svg') }}" alt="modernize-img" width="24"
                                   height="24"/>
                            </span>
                                                    <div class="w-100 ps-3">
                                                        <h6 class="mb-1 fs-3 fw-semibold lh-base">My Profile</h6>
                                                        <span class="fs-2 d-block text-body-secondary">Account Settings</span>
                                                    </div>
                                                </a>
                                                <div class="d-grid py-4 px-7 pt-8">
                                                    <form action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-primary">Log
                                                            Out</button>
                                                    </form>
                                                </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- ------------------------------- -->
                                <!-- end profile Dropdown -->
                                <!-- ------------------------------- -->
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
        </header>

        <!-- ---------------------------------- -->
        <!-- End Vertical Layout Header -->
        <!-- ---------------------------------- -->

        <div class="page-body">
            <!-- Toast Notification HTML -->
            <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                <div class="toast" id="flashToast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="background-color: {{ session('success') ? '#28a745' : '#dc3545' }}; color: white; padding: 15px; border-radius: 5px; min-width: 250px;">
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
            <div class="body-wrapper">
                <div class="container-fluid">
            <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Law Enforcement</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('law-dashboard') }}">Home</a>
                                    </li>
{{--                                    <li class="breadcrumb-item" aria-current="page"></li>--}}
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
            @yield('content')
            @yield('modals')
                </div>
            </div>
            <!-- Page Content -->
        </div>

        @yield('page-js')
        <script>
            function handleColorTheme(e) {
                document.documentElement.setAttribute("data-color-theme", e);
            }
        </script>
        <button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
                type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
            <i class="icon ti ti-settings fs-7"></i>
        </button>

        <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample"
             aria-labelledby="offcanvasExampleLabel">
            <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
                    Settings
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body h-n80" data-simplebar>
                <h6 class="fw-semibold fs-4 mb-2">Theme</h6>

                <div class="d-flex flex-row gap-3 customizer-box" role="group">
                    <input type="radio" class="btn-check light-layout" name="theme-layout" id="light-layout"
                           autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary rounded-2" for="light-layout">
                        <i class="icon ti ti-brightness-up fs-7 me-2"></i>Light
                    </label>

                    <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout"
                           autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary rounded-2" for="dark-layout">
                        <i class="icon ti ti-moon fs-7 me-2"></i>Dark
                    </label>
                </div>

                <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
                <div class="d-flex flex-row gap-3 customizer-box" role="group">
                    <input type="radio" class="btn-check" name="direction-l" id="ltr-layout" autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary" for="ltr-layout">
                        <i class="icon ti ti-text-direction-ltr fs-7 me-2"></i>LTR
                    </label>

                    <input type="radio" class="btn-check" name="direction-l" id="rtl-layout" autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary" for="rtl-layout">
                        <i class="icon ti ti-text-direction-rtl fs-7 me-2"></i>RTL
                    </label>
                </div>

                <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>

                <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
                    <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme" autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                           onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip"
                           data-bs-placement="top" data-bs-title="BLUE_THEME">
                        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                            <i class="ti ti-check text-white d-flex icon fs-5"></i>
                        </div>
                    </label>

                    <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme" autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                           onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip"
                           data-bs-placement="top" data-bs-title="AQUA_THEME">
                        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                            <i class="ti ti-check text-white d-flex icon fs-5"></i>
                        </div>
                    </label>

                    <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme" autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                           onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip"
                           data-bs-placement="top" data-bs-title="PURPLE_THEME">
                        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                            <i class="ti ti-check text-white d-flex icon fs-5"></i>
                        </div>
                    </label>

                    <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout"
                           autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                           onclick="handleColorTheme('Green_Theme')" for="green-theme-layout" data-bs-toggle="tooltip"
                           data-bs-placement="top" data-bs-title="GREEN_THEME">
                        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                            <i class="ti ti-check text-white d-flex icon fs-5"></i>
                        </div>
                    </label>

                    <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout"
                           autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                           onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-toggle="tooltip"
                           data-bs-placement="top" data-bs-title="CYAN_THEME">
                        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                            <i class="ti ti-check text-white d-flex icon fs-5"></i>
                        </div>
                    </label>

                    <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout"
                           autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
                           onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout" data-bs-toggle="tooltip"
                           data-bs-placement="top" data-bs-title="ORANGE_THEME">
                        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
                            <i class="ti ti-check text-white d-flex icon fs-5"></i>
                        </div>
                    </label>
                </div>

                <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
                <div class="d-flex flex-row gap-3 customizer-box" role="group">
                    <div>
                        <input type="radio" class="btn-check" name="page-layout" id="vertical-layout" autocomplete="off"/>
                        <label class="btn p-9 btn-outline-primary" for="vertical-layout">
                            <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Vertical
                        </label>
                    </div>
                    <div>
                        <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout" autocomplete="off"/>
                        <label class="btn p-9 btn-outline-primary" for="horizontal-layout">
                            <i class="icon ti ti-layout-navbar fs-7 me-2"></i>Horizontal
                        </label>
                    </div>
                </div>

                <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>

                <div class="d-flex flex-row gap-3 customizer-box" role="group">
                    <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary" for="boxed-layout">
                        <i class="icon ti ti-layout-distribute-vertical fs-7 me-2"></i>Boxed
                    </label>

                    <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary" for="full-layout">
                        <i class="icon ti ti-layout-distribute-horizontal fs-7 me-2"></i>Full
                    </label>
                </div>

                <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
                <div class="d-flex flex-row gap-3 customizer-box" role="group">
                    <a href="javascript:void(0)" class="fullsidebar">
                        <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar" autocomplete="off"/>
                        <label class="btn p-9 btn-outline-primary" for="full-sidebar">
                            <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Full
                        </label>
                    </a>
                    <div>
                        <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar" autocomplete="off"/>
                        <label class="btn p-9 btn-outline-primary" for="mini-sidebar">
                            <i class="icon ti ti-layout-sidebar fs-7 me-2"></i>Collapse
                        </label>
                    </div>
                </div>

                <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>

                <div class="d-flex flex-row gap-3 customizer-box" role="group">
                    <input type="radio" class="btn-check" name="card-layout" id="card-with-border" autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary" for="card-with-border">
                        <i class="icon ti ti-border-outer fs-7 me-2"></i>Border
                    </label>

                    <input type="radio" class="btn-check" name="card-layout" id="card-without-border" autocomplete="off"/>
                    <label class="btn p-9 btn-outline-primary" for="card-without-border">
                        <i class="icon ti ti-border-none fs-7 me-2"></i>Shadow
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!--  Search Bar -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content rounded-1">
                <div class="modal-header border-bottom">
                    <input type="search" class="form-control fs-3" placeholder="Search here" id="search"/>
                    <a href="javascript:void(0)" data-bs-dismiss="modal" class="lh-1">
                        <i class="ti ti-x fs-5 ms-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="dark-transparent sidebartoggler"></div>
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <!-- Import Js Files -->
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.init.js') }}"></script>
    <script src="{{ asset('assets/js/theme/theme.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme/sidebarmenu.js') }}"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/dashboard.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success') || session('error'))
            $('#flashToast').toast('show');
            @endif
        });
    </script>
</div>
</body>
</html>

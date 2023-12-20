<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Holdings, Construction Company, Shipping, Logistics, Ship Building" name="keywords">
    <meta content="Premium Infinite Ventures" property="og:title">
    <meta content="Holdings, Construction Company, Shipping, Logistics, Ship Building" property="og:description">
    <meta content="login_css/images/present.png" property="og:image">
    <meta content="https://app.pivi.com.ph:8035/" property="og:url">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LOAN MS</title>
    <link rel="shortcut icon">
   
    <link rel="stylesheet" href="{{ asset('body_css/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('body_css/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('body_css/vendors/css/vendor.bundle.base.css') }}">
   
    @yield('css_header')

    <link rel="stylesheet" href="{{ asset('body_css/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('body_css/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('body_css/js/select.dataTables.min.css') }}">
   
    <link rel="stylesheet" href="{{ asset('body_css/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('body_css/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
   
    <link rel="stylesheet" href="{{ asset('body_css/css/vertical-layout-light/style.css') }}">
   
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{asset('assets/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{asset('assets/fonts.css')}}" rel="stylesheet" type="text/css">

    <script src="{{asset('assets/jquery-3.6.0.min.js')}}"></script>
    
    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{ asset('login_css/images/loader.gif') }}") 50% 50% no-repeat white;
            opacity: .8;
            background-size: 120px 120px;
        }

    </style>
</head>

<body>
    <div id="loader" style="display:none;" class="loader">
    </div>

    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href=""> <img src="{{ URL::asset('/images/company_image.png') }}" onerror="this.src='{{ URL::asset('/images/no_image.png') }}';" style="height:auto;max-height:60px" class="mr-2 ml-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img src="{{ URL::asset('/images/company_image.png') }}" onerror="this.src='{{ URL::asset('/images/no_image.png') }}';" style="height:auto" alt="logo" /></a>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img class="rounded-circle" style='width:34px;height:34px;' src='{{ URL::asset('/images/no_image.png') }}' onerror="this.src='{{ URL::asset('/images/no_image.png') }}';">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="logout(); show();">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/account-setting') }}" onclick='show()'>
                            <i class="ti-user menu-icon"></i>
                            <span class="menu-title">{{auth()->user()->name}}</span>   
                        </a>
                    </li>
                    <li class="nav-item">
                        <hr>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" onclick='show()'>
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" onclick='show()'>
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Payments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" onclick='show()'>
                            <i class="ti-calendar menu-icon"></i>
                            <span class="menu-title">Loans</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" onclick='show()'>
                            <i class="ti-user menu-icon"></i>
                            <span class="menu-title">Borrowers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" onclick='show()'>
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" onclick='show()'>
                            <i class="icon-cog menu-icon"></i>
                            <span class="menu-title">Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
        

            @yield('content')

    </div>

    </div>

    <script type='text/javascript'>
        function show() {
            document.getElementById("loader").style.display = "block";
        }

        function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    </script>

    <script src="{{ asset('body_css/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('body_css/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('body_css/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('body_css/js/dashboard.js') }}"></script>
    <script src="{{ asset('body_css/js/select2.js') }}"></script>


    <script src="{{ asset('body_css/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('body_css/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('body_css/vendors/jquery.repeater/jquery.repeater.min.js') }}"></script>

    <script src="{{ asset('body_css/js/dataTables.select.min.js') }}"></script>

    <script src="{{ asset('body_css/js/off-canvas.js') }}"></script>
    <script src="{{ asset('body_css/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('body_css/js/template.js') }}"></script>
    <script src="{{ asset('body_css/js/settings.js') }}"></script>
    <script src="{{ asset('body_css/js/todolist.js') }}"></script>

    <script src="{{ asset('body_css/js/tabs.js') }}"></script>
    <script src="{{ asset('body_css/js/form-repeater.js') }}"></script>
    <script src="{{ asset('body_css/vendors/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{ asset('body_css/vendors/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('body_css/vendors/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('body_css/js/inputmask.js') }}"></script>


    @yield('footer')

    </div>
</body>

</html>

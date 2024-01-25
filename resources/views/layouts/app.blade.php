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

    @include('layouts.navigation');

    @include('sweetalert::alert')

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

    <!--begin::Webpack-->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--end::Webpack-->

    @yield('footer')
    </div>
</body>

</html>

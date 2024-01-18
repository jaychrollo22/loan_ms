<div class="container-scroller" id="app">
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
                    <a class="nav-link" href="{{ url('/payments') }}" onclick='show()'>
                        <i class="icon-layout menu-icon"></i>
                        <span class="menu-title">Payments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/loans') }}" onclick='show()'>
                        <i class="ti-calendar menu-icon"></i>
                        <span class="menu-title">Loans</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('borrowers') }}" onclick='show()'>
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
                    <a class="nav-link" data-toggle="collapse" href="#biometrics" aria-expanded="false" aria-controls="ui-basic">
                        <i class="icon-cog menu-icon"></i>
                        <span class="menu-title">Settings</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="biometrics">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/loan-types') }}">Loan Types</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/loan-terms') }}">Loan Terms</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/loan-interests') }}">Loan Interests</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/users') }}">Users</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/groupings/main') }}">Groupings</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/companies/main') }}">Companies</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    

        @yield('content')

</div>

</div>
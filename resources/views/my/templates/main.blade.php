@php
    Carbon\Carbon::setlocale(config('app.locale'));
@endphp
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Centro de operaciones para Vatmex. CTA's y Staff solamente">
        <meta name="author" content="Gustavo Valdez">
        <title>Dashboard | Vatmex Ops</title>
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/vendors/css/forms/selects/selectivity-full.min.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/vendors/css/calendars/fullcalendar.min.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/vendors/css/calendars/daygrid.min.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/vendors/css/calendars/timegrid.min.css">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/css/bootstrap-extended.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/css/colors.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/css/components.css">
        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/css/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/fonts/mobiriseicons/24px/mobirise/style.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/vendors/css/charts/morris.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/fonts/simple-line-icons/style.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/css/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/css/pages/page-users.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/css/plugins/forms/selectivity/selectivity.css">
        <link rel="stylesheet" type="text/css" href="/dashboard/app-assets/css/plugins/calendars/fullcalendar.css">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="/dashboard/assets/css/style.css">
        <!-- END: Custom CSS-->

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body class="vertical-layout vertical-compact-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-shadow navbar-brand-center">
            <div class="navbar-wrapper">
                <div class="navbar-header">
                    <ul class="nav navbar-nav flex-row">
                        <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                        <li class="nav-item"><a class="navbar-brand" href="{{ route('home') }}"><img class="brand-logo" alt="modern admin logo" src="/images/logo.png">
                            </a></li>
                        <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                    </ul>
                </div>
                <div class="navbar-container content">
                    <div class="collapse navbar-collapse" id="navbar-mobile">
                        <ul class="nav navbar-nav mr-auto float-left">
                                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('home') }}"><i class="ficon ft-globe"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav float-right">
                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <span class="mr-1 user-name text-bold-700">{{ Auth::user()->name }}</span>
                                    <span class="avatar avatar-online">
                                        <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar"><i></i>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('auth.logout') }}"><i class="ft-power"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="app-content content" style="margin-left: 0px">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2">
                        <h3 class="content-header-title mb-0">@yield('title')</h3>
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                @yield('breadcrumbs')
                            </div>
                        </div>
                    </div>
                    @yield('controls')
                </div>
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        <!-- BEGIN: Footer-->
        <footer class="footer footer-static footer-light navbar-border navbar-shadow" style="margin-left: 0;">
            <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2022 <a class="text-bold-800 grey darken-2" href="https://1.envato.market/modern_admin" target="_blank">Vatmex</a></span><span class="float-md-right d-none d-lg-block">Hecho con <a href="https://www.youtube.com/watch?v=OL_vF2Potfk">Honk</a> por el Ganso</i><span id="scroll-top"></span></span></p>
        </footer>
        <!-- END: Footer-->


        <!-- BEGIN: Vendor JS-->
        <script src="/dashboard/app-assets/vendors/js/vendors.min.js"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="/dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/charts/chart.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/charts/raphael-min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/charts/morris.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"></script>
        <script src="/dashboard/app-assets/vendors/js/forms/select/selectivity-full.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/ui/headroom.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/extensions/moment.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/extensions/fullcalendar.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/extensions/daygrid.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/extensions/timegrid.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/extensions/interactions.min.js"></script>
        <script src="/dashboard/app-assets/vendors/js/editors/tinymce/tinymce.min.js"></script>
        <script src="/dashboard/app-assets/data/jvector/visitor-data.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="/dashboard/app-assets/js/core/app-menu.js"></script>
        <script src="/dashboard/app-assets/js/core/app.js"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        <script src="/dashboard/app-assets/js/scripts/pages/dashboard-sales.js"></script>
        @yield('page-js')
        <!-- END: Page JS-->
    </body>
</html>

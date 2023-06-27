<!DOCTYPE html>
<html lang="en">
    <x-head/>
    <body>
        <!-- Body Inner -->
        <div class="body-inner">
            <x-navbar type="dark"/>
            <!-- Page title -->
            <section id="page-title" class="text-light" data-bg-parallax="/images/parallax/{{ rand(1, 2) }}.jpg">
                <div class="container">
                    <div class="page-title">
                        <h1>@yield('title')</h1>
                    </div>
                    <div class="breadcrumb">
                        @yield('breadcrumbs')
                    </div>
                </div>
            </section>
            <!-- end: Page title -->
            <!-- Page Menu -->
            @hasSection('page-menu')
            <div class="page-menu menu-lines">
                <div class="container">
                    <nav>
                        @yield('page-menu')
                    </nav>
                    <div id="pageMenu-trigger">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
            </div>
            @endif
            <!-- end: Page Menu -->
            <!-- Modal -->
            @hasSection('modal')
                @yield('modal')
            @endif
            <!-- end: Modal -->
            <!-- Content -->
            <section id="page-content">
                <div class="container">
                    @yield('content')
                </div>
            </section>
            <!-- end: Content -->
            <!-- Footer -->
            <x-footer/>
            <!-- end: Footer -->
        </div>
        <!-- end: Body Inner -->
        <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
        <!--Plugins-->
        <script src="/js/jquery.js"></script>
        <script src="/js/plugins.js"></script>

        <!--Template functions-->
        <script src="/js/functions.js"></script>
        <script src='/plugins/moment/moment.min.js'></script>
        <script src='/plugins/fullcalendar/fullcalendar.min.js'></script>

        <!-- Plugin files-->
        <script src="/plugins/metafizzy/infinite-scroll.min.js"></script>
        <script src='/plugins/datatables/datatables.min.js'></script>

        @yield('page-js')
    </body>
</html>

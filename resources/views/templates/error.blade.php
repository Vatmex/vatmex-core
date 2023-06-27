<!DOCTYPE html>
<html lang="en">
    <x-head/>
    <body>
        <div class="body-inner">
            <x-navbar type="light"/>
            <!-- Content -->
            <section class="m-t-80 p-b-150">
                <div class="container">
                    @yield('content')
                </div>
            </section>
            <!-- Content -->
            <x-footer/>
        </div>
        <!-- Scroll top -->
        <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
        <!--Plugins-->
        <script src="js/jquery.js"></script>
        <script src="js/plugins.js"></script>
        <!--Template functions-->
        <script src="js/functions.js"></script>
    </body>
</html>

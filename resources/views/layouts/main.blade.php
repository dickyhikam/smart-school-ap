<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.title-meta')

    @include('partials.head-css')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        @include('partials.topbar')

        @include('partials.sidenav')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">

            @yield('content')

            @include('partials.footer')

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- @include('partials.customizer') -->

    @include('partials.footer-scripts')

    <!-- Apex Chart js -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Projects Analytics Dashboard App js -->
    <script src="assets/js/pages/dashboard.js"></script>

    @yield('javascript_custom')

</body>

</html>
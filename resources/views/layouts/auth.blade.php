<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.title-meta')

    @include('partials.head-css')
</head>

<body>

    <div class="auth-bg d-flex min-vh-100">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xxl-4 col-lg-5 col-md-6">

                <a href="index.php" class="auth-brand d-flex justify-content-center mb-2">
                    <img src="assets/images/logo-dark.png" alt="dark logo" height="26" class="logo-dark">
                    <img src="assets/images/logo.png" alt="logo light" height="26" class="logo-light">
                </a>

                <br>

                @yield('content')

                <p class="mt-4 text-center mb-0">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> ©
                </p>
            </div>
        </div>
    </div>

    @include('partials.footer-scripts')

</body>

</html>
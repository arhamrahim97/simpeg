<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/welcome/favicon/favicon.ico" type="image/x-icon" />

    <!-- Map CSS -->
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="/assets/welcome/css/libs.bundle.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/assets/welcome/css/theme.bundle.css" />
    <!-- Fonts and icons -->
    <script src="/assets/dashboard/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands", "simple-line-icons"
                ],
                urls: ['/assets/dashboard/css/fonts.min.css']
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });

    </script>
    @stack('style')

    <!-- Title -->
    <title>@yield('title')</title>
</head>

<body>


    <!-- NAVBAR -->
    @include('components.welcome.navbar')

    @yield('content')
    <!-- SHAPE -->
    <div class="position-relative mt-10">
        <div class="shape shape-bottom shape-fluid-x text-gray-200">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="currentColor" /></svg> </div>
    </div>

    <!-- FOOTER -->
    <footer class="py-8 py-md-11 bg-gray-200">
        <div class="container">
            <div class="row text-center align-items-center">
                <div class="col-12 col-md-12 col-lg-12">

                    <!-- Brand -->
                    <!-- <img src="/assets/welcome/img/brand.svg" alt="..." class="footer-brand img-fluid mb-2"> -->
                    <p class="text-primary"><b>@yield('title')</b></p>

                    <!-- Text -->
                    <p class="text-gray-700 mb-2">
                        SIMPEG Dinas Pendidikan Kota Palu
                    </p>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </footer>

    <!-- JAVASCRIPT -->
    <script src="/assets/dashboard/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/dashboard/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

    <!-- Vendor JS -->
    <script src="/assets/welcome/js/vendor.bundle.js"></script>

    <!-- Theme JS -->
    <script src="/assets/welcome/js/theme.bundle.js"></script>
    @stack('script')

</body>

</html>

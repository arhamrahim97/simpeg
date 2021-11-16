<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />    
    <link rel="icon" href="/assets/welcome/favicon/favicon.ico" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="/assets/dashboard/css/theme.bundle.css" /> --}}

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

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/dashboard/css/atlantis.css">


    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="/assets/dashboard/css/demo.css">
    <link rel="stylesheet" href="/assets/dashboard/css/toastr.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
    <style>
        .dropdown-item {
            margin-left: 0 !important;
        }

    </style>

    @stack('style')
</head>

<body>

    <div class="wrapper fullheight-side">
        <!-- Logo Header -->
        <div class="logo-header position-fixed" data-background-color="blue">

            <a href="index.html" class="logo">
                <h3 class="navbar-brand fw-bold text-light mt-1">SIMPEG</h3>
                {{-- <img src="/assets/dashboard/img/logo.svg" alt="navbar brand" class="navbar-brand"> --}}
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->
        <!-- Sidebar -->

        @if ((Auth::user()->role == 'Guru') || (Auth::user()->role == 'Pegawai'))
        @include('components.dashboard.guru_pegawai.sidebar')
        @else
        @if ((Auth::user()->role == 'Admin'))
        @include('components.dashboard.admin.sidebar')
        @elseif (Auth::user()->role == "Tim Penilai")
        @include('components.dashboard.tim_penilai.sidebar')
        @elseif (Auth::user()->role == "Admin Kepegawaian")
        @include('components.dashboard.admin_kepegawaian.sidebar')
        @elseif (Auth::user()->role == "KASUBAG Kepegawaian dan Umum")
        @include('components.dashboard.kasubag.sidebar')
        @elseif (Auth::user()->role == "Sekretaris")
        @include('components.dashboard.sekretaris.sidebar')
        @elseif (Auth::user()->role == "Kepala Dinas")
        @include('components.dashboard.kepala_dinas.sidebar')
        @endif
        @endif

        @include('components.dashboard.navbarHeader')
        <!-- End Navbar -->

        <div class="main-panel full-height">
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">@yield('title')</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">@yield('title')</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Isi Konten -->
                    <div class="page-category">
                        @yield('content')
                    </div>

                </div>
            </div>
        </div>

        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="/assets/dashboard/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/dashboard/js/core/popper.min.js"></script>
    <script src="/assets/dashboard/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="/assets/dashboard/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="/assets/dashboard/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="/assets/dashboard/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Moment JS -->
    <script src="/assets/dashboard/js/plugin/moment/moment.min.js"></script>

    <!-- Chart JS -->
    <script src="/assets/dashboard/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="/assets/dashboard/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="/assets/dashboard/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="/assets/dashboard/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="/assets/dashboard/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- Bootstrap Toggle -->
    <script src="/assets/dashboard/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="/assets/dashboard/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="/assets/dashboard/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Google Maps Plugin -->
    <script src="/assets/dashboard/js/plugin/gmaps/gmaps.js"></script>

    <!-- Dropzone -->
    <script src="/assets/dashboard/js/plugin/dropzone/dropzone.min.js"></script>

    <!-- Fullcalendar -->
    <script src="/assets/dashboard/js/plugin/fullcalendar/fullcalendar.min.js"></script>

    <!-- DateTimePicker -->
    <script src="/assets/dashboard/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

    <!-- Bootstrap Tagsinput -->
    <script src="/assets/dashboard/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

    <!-- Bootstrap Wizard -->
    <script src="/assets/dashboard/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

    <!-- jQuery Validation -->
    <script src="/assets/dashboard/js/plugin/jquery.validate/jquery.validate.min.js"></script>

    <!-- Summernote -->
    <script src="/assets/dashboard/js/plugin/summernote/summernote-bs4.min.js"></script>

    <!-- Select2 -->
    <script src="/assets/dashboard/js/plugin/select2/select2.full.min.js"></script>

    <!-- Sweet Alert -->
    <script src="/assets/dashboard/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Jquery Mask -->
    <script src="/assets/dashboard/js/plugin/jquery.mask/jquery.mask.min.js"></script>

    <!-- Owl Carousel -->
    <script src="/assets/dashboard/js/plugin/owl-carousel/owl.carousel.min.js"></script>

    <!-- Magnific Popup -->
    <script src="/assets/dashboard/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Atlantis JS -->
    <script src="/assets/dashboard/js/atlantis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#lineChart').sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#177dff',
            fillColor: 'rgba(23, 125, 255, 0.14)'
        });

        $('#lineChart2').sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#f3545d',
            fillColor: 'rgba(243, 84, 93, .14)'
        });

        $('#lineChart3').sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#ffa534',
            fillColor: 'rgba(255, 165, 52, .14)'
        });

    </script>
    <script src="/assets/dashboard/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    @stack('script')
</body>

</html>

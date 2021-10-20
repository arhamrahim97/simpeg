<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Lengkapi Data </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/dashboard/img/icon.ico" type="image/x-icon" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts and icons -->
    <script src="/assets/dashboard/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['/assets/dashboard/css/fonts.min.css']
            },
            active: function() {
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

	<style>
		.select2-container {
    width: 100% !important;
}
	</style>
</head>

<body>
    <div class="wrapper mt-5">
		<div class="container-fluid">				
			<div class="row justify-content-md-center">
				<div class="col-md-9">
					@yield('content')											
				</div>
			</div>											
		</div>																			
	</div>
    <!--   Core JS Files   -->
    <script src="/assets/dashboard/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/dashboard/js/core/popper.min.js"></script>
    <script src="/assets/dashboard/js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="/assets/dashboard/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="/assets/dashboard/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <!-- Moment JS -->
    <script src="/assets/dashboard/js/plugin/moment/moment.min.js"></script>
    <!-- Bootstrap Toggle -->
    <script src="/assets/dashboard/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="/assets/dashboard/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- DateTimePicker -->
    <script src="/assets/dashboard/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
    <!-- Select2 -->
    <script src="/assets/dashboard/js/plugin/select2/select2.full.min.js"></script>
    <!-- Sweet Alert -->
    <script src="/assets/dashboard/js/plugin/sweetalert/sweetalert.min.js"></script>
	 <!-- Jquery Mask -->
	 <script src="/assets/dashboard/js/plugin/jquery.mask/jquery.mask.min.js"></script>
    <!-- Bootstrap Wizard -->
    <script src="/assets/dashboard/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>
    <!-- jQuery Validation -->
    <script src="/assets/dashboard/js/plugin/jquery.validate/jquery.validate.min.js"></script>
    <!-- Atlantis JS -->
    <script src="/assets/dashboard/js/atlantis.min.js"></script>
    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="/assets/dashboard/js/setting-demo2.js"></script>
    <script src="/assets/dashboard/js/toastr.min.js"></script>
    {!! Toastr::message() !!}    

	@yield('script')

    <script>
		$(document).ready(function() {
			// jenis_asn1(sel)		
		});
					
		$('select').select2({
			theme: "bootstrap"
		})				
				
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="/assets/dashboard/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="/assets/dashboard/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/assets/dashboard/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/dashboard/css/atlantis.css">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn pt-5 pb-3">
			<h3 class="text-center">Login</h3>			
			@if (session()->has('loginError'))
			<div class="alert alert-danger">				
				<h5><i class="icon fas fa-times"></i> Error !</h5>
				{{ session('loginError') }}
			</div>
			@endif
			<form action="/login" method="POST" autocomplete="off"> 
				@csrf
				<div class="login-form">
					<div class="form-group">
						<label for="username" class="placeholder"><b>Username</b></label>
						<input id="username" name="username" type="text" class="form-control" autofocus required>
					</div>
					<div class="form-group">
						<label for="password" class="placeholder"><b>Password</b></label>					
						<div class="position-relative">
							<input id="password" name="password" type="password" class="form-control" required>
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="form-group form-action-d-flex mb-3 text-center align-items-center" style="display: inline; float: right">		
						<button type="submit" href="#" class="btn btn-primary text-center mt-3 mt-sm-0 fw-bold">Sign In</button>
					</div>				
				</div>
			</form>
		</div>
	</div>
	<script src="/assets/dashboard/js/core/jquery.3.2.1.min.js"></script>
	<script src="/assets/dashboard/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="/assets/dashboard/js/core/popper.min.js"></script>
	<script src="/assets/dashboard/js/core/bootstrap.min.js"></script>
	<script src="/assets/dashboard/js/atlantis.min.js"></script>
</body>
</html>
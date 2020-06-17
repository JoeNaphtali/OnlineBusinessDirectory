<html lang="en">

    <head>

		<title>Deals | FindUs</title>
        <meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
		<!-- Bootstrap core CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- JQuery -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap tooltips -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<!-- Local Stylesheet -->
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<!-- Local Script -->
		<script type="text/javascript" src="../js/script.js"></script>

	</head>

	<body>

		<!-- Navigation Bar -->

		<nav class="navbar navbar-light navbar-expand-lg bg-faded justify-content-center static-top">
			<a href="../index.php" class="navbar-brand d-flex w-50 mr-auto">FindUs</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse w-100" id="navbar">
				<ul class="navbar-nav w-100 justify-content-center">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../businesses/index.php">Businesses</a>
					</li>
					<li class="nav-item current">
						<a class="nav-link" href="../deals/index.php">Deals</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../events/index.php">Events</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../blog/index.php">Blog</a>
					</li>
				</ul>
				<div class="nav navbar-nav ml-auto w-100 justify-content-end">
					<a class="btn btn-addlisting" href="#">Add Listing</a>
					<a class="btn btn-login" href="../login/index.php">Login</a>
				</div>
			</div>
		</nav>

		<!-- /.Navigation Bar -->

		<!-- Login Form -->

		<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered login-modal" role="document">
				<div class="modal-content">
					<div class="modal-body bg-white">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<form class="p-4" action="../includes/login.inc.php" method="post">
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" type="email" name="email" required>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" type="password" name="password" required>
							</div>
							<div class="form-group">
								<a href="#">Forgot your password?</a>
							</div>
							<div class="form-group">
								<button class="btn btn-block btn-submit" type="submit" name="login-submit">Login</button>
							</div>
							<div class="form-group">
								<small>By logging in, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</small>
							</div>
							<div class="form-group text-center">
								Or continue with:
							</div>
							<div class="form-group text-center">
								<a href="#"><i class="fab fa-facebook fa-2x"></i></a>
								<a href="#"><i class="fab fa-google fa-2x"></i></a>
								<a href="#"><i class="fab fa-twitter fa-2x"></i></a>
							</div>
							<div class="form-group">
								New to FindUs? <a href="#" id="register-link">Register</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- /.Login Form -->

		<!-- Registration Form -->

		<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered registration-modal modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body bg-white">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<form class="p-4" action="../includes/register.inc.php" method="post">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>First Name</label>
									<input class="form-control" type="text" name="firstname" required>
								</div>
								<div class="form-group col-md-6">
									<label>Last Name</label>
									<input class="form-control" type="text" name="firstname" required>
								</div>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" type="email" name="email" required>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Password</label>
									<input class="form-control" type="password" name="password" required>
								</div>
								<div class="form-group col-md-6">
									<label for="exampleInputPassword1">Repeat Password</label>
									<input class="form-control" type="password" name="password" required>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">ZIP Code</label>
								<input class="form-control" type="text" name="zip" required>
							</div>
							<div class="form-group">
								<button class="btn btn-block btn-submit" type="submit" name="register-submit">Register</button>
							</div>
							<div class="form-group">
								<small>By registering, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</small>
							</div>
							<div class="form-group text-center">
								Or continue with:
							</div>
							<div class="form-group text-center">
								<a href="#"><i class="fab fa-facebook fa-2x"></i></a>
								<a href="#"><i class="fab fa-google fa-2x"></i></a>
								<a href="#"><i class="fab fa-twitter fa-2x"></i></a>
							</div>
							<div class="form-group">
								Already on FindUs? <a href="#" id="login-link">Login</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- /.Registration Form -->

	</body>

</html>
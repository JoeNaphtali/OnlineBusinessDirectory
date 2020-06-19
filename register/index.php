<html lang="en">

    <head>

		<title>Register | FindUs</title>
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
					<li class="nav-item">
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
					<a class="btn btn-login" href="login/index.php">Login</a>
				</div>
			</div>
		</nav>

		<!-- /.Navigation Bar -->

        <!-- Registration Form -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="registration-form col-lg-8 bg-light px-0 shadow">
                    <form class="p-4 bg-white" action="../includes/register.inc.php" method="post">
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
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" name="zip" required>
                            </div>
                        </div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Password</label>
								<input class="form-control" type="password" name="password" required>
							</div>
                            <div class="form-group col-md-6">
                                <label>Repeat Password</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
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
							Already on FindUs? <a href="../login/index.php">Login</a>
						</div>
					</form>
                </div>
            </div>
        </div>

		<!-- /.Registration Form -->
		
		<!-- Footer

		<div class="pt-5 pb-5 footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-xs-12 footer-section about-company">
						<h2>FindUs</h2>
						<p class="pr-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac ante mollis quam tristique convallis </p>
						<p class="footer-social-icons"><a href="#"><i class="fab fa-facebook fa-2x"></i></a>
						<a href="#"><i class="fab fa-twitter fa-2x"></i></a>
						<a href="#"><i class="fab fa-instagram fa-2x"></i></a>
						<a href="#"><i class="fab fa-linkedin fa-2x"></i></a>
						<a href="#"><i class="fab fa-google fa-2x"></i></a>
						</p>
					</div>
					<div class="col-lg-3 col-xs-12 footer-section links">
						<h4 class="mt-lg-0 mt-sm-3">Links</h4>
						<ul class="m-0 p-0">
							<li><a href="#">About FindUs</a></li>
							<li><a href="#">Contact us</a></li>
							<li><a href="#">Content Guidelines</a></li>
							<li><a href="#">Terms of Service</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</div>
					<div class="col-lg-4 col-xs-12 footer-section location">
						<h4 class="mt-lg-0 mt-sm-4">Sign up for our newsletter</h4>
						<form>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" type="email" name="email" required>
							</div>
							<div class="form-group">
								<button class="btn btn-block btn-submit" type="submit" name="newsletter-submit">Sign up</button>
							</div>
						</form>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col copyright">
					<p class=""><small>© Joseph Wamulume, 2020. All Rights Reserved.</small></p>
					</div>
				</div>
			</div>
		</div>

		/.Footer -->

	</body>

</html>
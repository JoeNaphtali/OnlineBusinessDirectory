<html lang="en">

    <head>

		<title>Events | FindUs</title>
        <meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">
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
		<script type="text/javascript" src="../js/main.js"></script>

	</head>

	<body>

		<!-- Main Navigation -->

		<nav class="navbar navbar-light solid-navbar navbar-expand-lg justify-content-center fixed-top" data-aos="fade-down">
			<a href="index.php" class="navbar-brand d-flex w-50 mr-auto js-scroll-trigger">FindUs</a>
			<button class="navbar-toggler hamburger-icon" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse w-100" id="navbar">
				<ul class="navbar-nav w-100 justify-content-center">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="../categories/index.php">Categories</a>
					</li>
					<li class="nav-item current">
						<a class="nav-link js-scroll-trigger" href="index.php">Events</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="../blog/index.php">Blog</a>
					</li>
				</ul>
				<div class="nav navbar-nav ml-auto w-100 justify-content-end">
					<a class="btn btn-addlisting" href="#"><i class="fa fa-plus-circle fa-fw"></i> Add Listing</a>
					<a class="btn btn-login" href="login/index.php"><i class="fa fa-sign-in-alt fa-fw"></i> Login</a>
				</div>
			</div>
		</nav>

		<!-- /.Main Navigation -->

		<!-- Content -->

		<div class="container content-container">
			
			<div class="row section-title-row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Find events near you</h2>
						<p>Festivals, conferences, sporting events and more!</p>
					</div>
				</div>
			</div>

			<!-- Events search form -->
			<div class="events-search-form shadow">
				<form>
					<div class="form-row">
						<div class="form-group input col-lg-3">
							<input class="form-control" placeholder="Event name">
						</div>
						<div class="form-group input col-lg-3">
							<input class="form-control" placeholder="Location">
						</div>
						<div class="form-group input col-lg-4">
							<select class="form-control" name="" id="">
								<option value="">All Categories</option>
								<option value="">Hotels</option>
								<option value="">Restaurant</option>
								<option value="">Eat &amp; Drink</option>
								<option value="">Events</option>
								<option value="">Fitness</option>
								<option value="">Others</option>
							</select>
						</div>
						<div class="form-group col-lg-2">
							<button class="btn" style="width: 100%; background-color:#FF6F01; color:#fff;">
								Search
							</button>
						</div>
					</div>
				</form>
			</div>	
			
			<div class="row">
				<div class="col-lg-12">
					<div style="margin-bottom: 23px;">
						<h2>Upcoming Events</h2>
					</div>
					<div class="row">
						<div class="col-lg-4 col-md-4">
							<div class="card mb-4 event-item shadow">
								<div class="event-item-pic set-bg" data-setbg="../img/concert.jpg">
									<div class="event-category category">
										<a href="#"><i class="fa fa-music fa-fw stroke-transparent"></i> Music</a>
									</div>
									<div class="event-item-details">
										<h2 class="card-title">Event Title</h2>
										<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> 14320 Keenes Mill Rd. Cottondale, Alabama(AL)</div>
										<div></div>
									</div>
									<div class="bookmark">
										<a href="#"><i class="fa fa-bookmark stroke-transparent"></i></a>
									</div>
								</div>
								<div class="card-footer event-item-footer text-muted">
									<i class="fa fa-calendar-alt fa-fw"></i>
									<span> 22nd July, 2020</span>
									<i class="fa fa-users"></i>
									<span> 39</span>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="card mb-4 event-item shadow">
								<div class="event-item-pic set-bg" data-setbg="../img/lunch.jpg">
									<div class="event-category category">
										<a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food</a>
									</div>
									<div class="event-item-details">
										<h2 class="card-title">Event Title</h2>
										<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> 14320 Keenes Mill Rd. Cottondale, Alabama(AL)</div>
										<div></div>
									</div>
									<div class="bookmark">
										<a href="#"><i class="fa fa-bookmark stroke-transparent"></i></a>
									</div>
								</div>
								<div class="card-footer event-item-footer text-muted">
									<i class="fa fa-calendar-alt fa-fw"></i>
									<span> 22nd July, 2020</span>
									<i class="fa fa-users"></i>
									<span> 39</span>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="card mb-4 event-item shadow">
								<div class="event-item-pic set-bg" data-setbg="../img/sport.jpg">
									<div class="event-category category">
										<a href="#"><i class="fa fa-futbol fa-fw stroke-transparent"></i> Sport</a>
									</div>
									<div class="event-item-details">
										<h2 class="card-title">Event Title</h2>
										<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> 14320 Keenes Mill Rd. Cottondale, Alabama(AL)</div>
										<div></div>
									</div>
									<div class="bookmark">
										<a href="#"><i class="fa fa-bookmark stroke-transparent"></i></a>
									</div>
								</div>
								<div class="card-footer event-item-footer text-muted">
									<i class="fa fa-calendar-alt fa-fw"></i>
									<span> 22nd July, 2020</span>
									<i class="fa fa-users"></i>
									<span> 39</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- Content -->

		<!-- Footer -->

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

		<!-- /.Footer -->

	</body>

</html>
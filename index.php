<html lang="en">

    <head>

		<title>Home | FindUs</title>
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
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Local Script -->
		<script type="text/javascript" src="js/script.js"></script>

	</head>

	<body>

		<!-- Main Navigation -->

		<nav class="navbar main-navbar navbar-light navbar-expand-lg bg-faded justify-content-center static-top">
			<!-- Navbar Logo -->
			<a href="index.php" class="navbar-brand d-flex w-50 mr-auto">FindUs</a>
			<!-- Search Button -->
			<button class="navbar-toggler search-icon" type="button" data-toggle="collapse" data-target="#search-bar">
				<span class="fa fa-search"></span>
			</button>
			<!-- Hamburger Menu Button -->
			<button class="navbar-toggler hamburger-icon" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!-- Navbar Search Form -->
			<div class="search-collapse collapse w-100" id="search-bar">
				<form>
					<div class="form-row">
						<div class="form-group col-md-5">
							<div class="input-group">
								<span class="input-group-prepend">
									<div class="input-group-text bg-white border-right-0">
										<i class="fa fa-search"></i>
									</div>
								</span>
								<input class="form-control border-left-0 border-right-0" type="search" placeholder="What are you looking for?"/>
							</div>
						</div>
						<div class="form-group col-md-5">
							<div class="input-group">
								<span class="input-group-prepend">
									<div class="input-group-text bg-white border-right-0">
										<i class="fa fa-map-marker-alt"></i>
									</div>
								</span>
								<input class="form-control border-left-0" type="search" placeholder="Where? Province, City, Town ..."/>
							</div>
						</div>
						<div class="form-group col-md-2">
							<button class="btn btn-search">Search</button>
						</div>								
					</div>
				</form>
			</div>
			<!-- Navigation Menu -->
			<div class="navbar-collapse collapse w-100" id="navbar">
				<ul class="navbar-nav w-100 justify-content-center">
					<li class="nav-item current">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="categories/index.php">Categories</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="promotions/index.php">Promotions</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="events/index.php">Events</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="blog/index.php">Blog</a>
					</li>
				</ul>
				<div class="nav navbar-nav ml-auto w-100 justify-content-end">
					<a class="btn btn-addlisting" href="#">Add Listing</a>
					<a class="btn btn-login" href="login/index.php">Login</a>
				</div>
			</div>
		</nav>

		<!-- /.Main Navigation -->

		<!-- Header -->

		<header class="masthead">
			<div class="container h-100">
				<div class="row h-100 align-items-center">
				<div class="col-12 text-center">
					<!-- Header Search Form -->
					<form>
						<div class="form-row shadow">
							<div class="form-group col-md-5">
								<div class="input-group">
									<span class="input-group-prepend">
										<div class="input-group-text bg-white border-right-0">
										<i class="fa fa-search"></i>
										</div>
									</span>
									<input class="form-control border-left-0 border-right-0" type="search" placeholder="What are you looking for?"/>
								</div>
							</div>
							<div class="form-group col-md-5">
								<div class="input-group">
									<span class="input-group-prepend">
										<div class="input-group-text bg-white border-right-0">
										<i class="fa fa-map-marker-alt"></i>
										</div>
									</span>
									<input class="form-control border-left-0" type="search" placeholder="Where? Province, City, Town ..."/>
								</div>
							</div>
							<div class="form-group col-md-2">
								<button class="btn btn-search">Search</button>
							</div>								
						</div>
					</form>
				</div>
				</div>
			</div>
		</header>

		<!-- /.Header -->

		<!-- Content -->

		<!-- Top Businesses Tabs Panel -->
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="page-section col-lg-10 bg-white p-3">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title text-center">
								<h2>Top Businesses and Services</h2>
								<p>The best businesses and services recommended by your fellow FindUs users</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="top-businesses-tab">
								<!-- Tabs -->
								<ul class="nav nav-tabs flex-column flex-sm-row" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
											<span class="fa fa-utensils"></span>
											Restaurants
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
											<span class="fa fa-shopping-cart"></span>
											Shopping
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
											<span class="fa fa-bed"></span>
											Hotels & Travel
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
											<span class="fa fa-spa"></span>
											Salon, Barber & Spa
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">
											<span class="fa fa-home"></span>
											Home Services
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">
											<span class="fa fa-car-side"></span>
											Car Hire
										</a>
									</li>
								</ul>
							</div>
							<!-- Tab Content -->
							<div class="tab-content">
								<!-- First Tab -->
								<div class="tab-pane active" id="tabs-1" role="tabpanel">
									<div class="row">
										<div class="col-lg-4 col-md-6">
											<div class="listing-item">
												<div class="listing-item-pic set-bg" data-setbg="img/listing/list-1.jpg">
													<img src="img/listing/food.png" alt="">
												</div>
												<div class="listing-item-text">
													<div class="listing-item-text-inside">
														<a href="#">
														Chinese Sausage Restaurant
														</a>
														<div class="listing-item-text-rating">
															<div class="listing-item-text-rating-star">
																<span class="fa fa-star"></span>
																<span class="fa fa-star"></span>
																<span class="fa fa-star"></span>
																<span class="fa fa-star"></span>
																<span class="fa fa-star"></span>
															</div>
															<div class="open-closed">Open Now</div>
														</div>
														<ul style="padding-bottom: 20px;">
															<li><span class="fa fa-map-marker-alt"></span> 236 Littleton St. New
																Philadelphia, Ohio, United States</li>
															<li><span class="fa fa-phone"></span> (+12) 345-678-910</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>							
								</div>
								<!-- Second Tab -->
								<div class="tab-pane" id="tabs-2" role="tabpanel">
									<div class="row">
										<div class="col-lg-4 col-md-6">

										</div>
									</div>
								</div>
								<!-- Third Tab -->
								<div class="tab-pane" id="tabs-3" role="tabpanel">
									<div class="row">
										<div class="col-lg-4 col-md-6">

										</div>
									</div>
								</div>
								<!-- Fourth Tab -->
								<div class="tab-pane" id="tabs-4" role="tabpanel">
									<div class="row">
										<div class="col-lg-4 col-md-6">

										</div>
									</div>
								</div>
								<!-- Fifth Tab -->
								<div class="tab-pane" id="tabs-5" role="tabpanel">
									<div class="row">
										<div class="col-lg-4 col-md-6">

										</div>
									</div>
								</div>
								<!-- Sixth Tab -->
								<div class="tab-pane" id="tabs-6" role="tabpanel">
									<div class="row">
										<div class="col-lg-4 col-md-6">

										</div>
									</div>
								</div>							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	
		<!-- Latest Reviews -->

		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="page-section col-lg-10 bg-white p-3 shadow">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title text-center">
								<h2>Latest Reviews</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		

		<!-- Latest Articles -->

		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="page-section col-lg-10 bg-white p-3 shadow">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title text-center">
								<h2>Latest Articles</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- /.Content -->

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
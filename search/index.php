<html lang="en">

    <head>

        <title>Search | FindUs</title>
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
        <!-- Leaflet.js CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>
        <!-- Local Stylesheet -->
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<!-- Local Script -->
        <script type="text/javascript" src="../js/main.js"></script>
        <!-- Leaflet.js Script -->
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>

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
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="../events/index.php">Events</a>
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

		<div class="margin-top-62">
			<div class="row no-gutters">
				<div class="col-lg-6 search-column">
					<div class="search-form shadow-sm">
						<form>
							<div class="form-row">
								<div class="form-group col-md-6">
									<input type="text" class="form-control" placeholder="What are you looking for?">
								</div>
								<div class="form-group col-md-6">
									<input type="text" class="form-control" placeholder="Location">
								</div>
							</div>
							<div class="form-group">
								<span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
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
							<div class="form-group">
								<button class="btn btn-search">Search</button>
							</div>
							<div class="dropdown-panel distance-radius">
								<a href="#" class="dropdown-panel-toggle">Distance Radius <i class="fa fa-chevron-down"></i></a>
								<div class="dropdown-panel-content">
									<div class="form-group">
										<span>Distance Radius</span>
										<input disabled class="distanceRangeInput" type="range" name="distanceRangeInput" id="distanceRangeInput" value="50" min="1" max="100" oninput="distanceRangeOutput.value = distanceRangeInput.value">
										<output name="distanceRangeOutput" id="distanceRangeOutput">50</output>
									</div>
									<label for="enableDistanceRadius">Enable</label>
									<input id="enableDistanceRadius" type="checkbox">
								</div>
							</div>
						</form>
					</div>
					<div class="row sort-by">
						<div class="col-md-8">
							<div class="layout-switcher">
								<a href="" class=""><i class="fa fa-th"></i></a>
								<a href="" class="active"><i class="fa fa-align-justify"></i></a>
							</div>
						</div>
						<div class="col-md-4 sort-listing">
							<span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
							<select class="" name="" id="">
								<option value="">Top Rated</option>
								<option value="">Most Reviews</option>
								<option value="">Most Views</option>
								<option value="">Newest Listings</option>
								<option value="">Old Listings</option>
							</select>
						</div>
					</div>
					<div class="search-text">
						<span>Showing results for 'food'</span>
					</div>
					<div class="listings">
						<!-- List View -->
						<div class="row no-gutters listing-item-horizontal shadow-sm">
							<div class="col-md-5">
								<div class="listing-item-pic set-bg" data-setbg="../img/listing/list-1.jpg">
									<div class="listing-category category">
										<a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food & Drinks</a>
									</div>
									<div class="listing-badge open">
										Open
									</div>
									<div class="bookmark">
										<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
									</div>
								</div>
							</div>
							<div class="listing-details listing-details-horizontal col-md-7">
								<a href="../listing/index.php"><h2 class="card-title">Burger House</h2></a>
								<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> Plot No. 1086, Off Simon Mwansa Kapwepwe Rd</div>
								<div><i class="fa fa-phone fa-fw"></i> +260 975 944 213</div>
								<hr>
								<div class="listing-rating text-muted">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-alt"></i>
									<span> (1 review)</span>
								</div>
							</div>
						</div>
						<!-- /List View -->
						<!-- Grid View
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="card mb-4 listing-item listing-item-small shadow">
									<div class="listing-item-pic set-bg" data-setbg="../img/listing/list-1.jpg">
										<div class="listing-details">
											<h2 class="card-title">Burger House</h2>
											<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> 14320 Keenes Mill Rd. Cottondale, Alabama(AL)</div>
											<div><i class="fa fa-phone fa-fw"></i> (+12) 345-678-910</div>
										</div>
										<div class="listing-category category">
											<a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food & Drinks</a>
										</div>
										<div class="listing-badge open">
											Open
										</div>
										<div class="bookmark">
											<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
										</div>
									</div>
									<div class="card-footer listing-rating text-muted">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-alt"></i>
										<span> (1 review)</span>
									</div>
								</div>
							</div>
						</div>
						/.Grid View -->
					</div>
				</div>
				<div class="col-lg-6 map-column">
					<div id="map-id"></div>
				</div>
			</div>
		</div>

		<!-- /.Content -->

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

		<script>
			
		var mymap = L.map('map-id').setView([-15.386283, 28.399378], 17);
		var marker = L.marker([-15.386283, 28.399378]).addTo(mymap);

		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
		}).addTo(mymap);

		</script>

<script type="text/javascript" src="js/aos.js"></script><script>
	AOS.init();
	</script>

	</body>

</html>
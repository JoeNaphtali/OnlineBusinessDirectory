<?php
    // Start Session
	session_start();
	
	// Database Connection
	include "../includes/dbh.inc.php";
	
	// If the user is logged in, store session varibles 
	if (isset($_SESSION['login'])) {
		$user_id = $_SESSION['user_id'];
		// Retrieve user from 'user' table
		$results = mysqli_query($conn, "SELECT * FROM user WHERE id = $user_id");
		$row = mysqli_fetch_array($results);

		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$email = $row['email'];
		$profile_picture_status = $row['profile_picture_status'];
	}
?>

<html lang="en">

    <head>

        <title>Listing | FindUs</title>
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
		<!-- Bar filler -->
		<script src="../js/jquery.barfiller.js"></script>

	</head>

	<body>

		<!-- Main Navigation -->

		<?php include '../includes/clearnavbar.inc.php' ?>

		<!-- /.Main Navigation -->

		<!-- Listing Section Begin -->
		<section class="listing-hero set-bg" data-setbg="../img/listing/details/listing-hero.jpg">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="listing-hero-option">
							<div class="listing-hero-icon">
								<img src="img/listing/details/ld-icon.png" alt="">
							</div>
							<div class="listing-hero-text">
								<h2>
									Burger House
									<span class="category">
										<a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food & Drinks</a>
									</span>
								</h2>
								<div class="listing-hero-widget">
									<div class="listing-hero-widget-rating listing-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-alt"></i>
									</div>
									<div>1 Review</div>
									<!--
									<div class="listing-hero-widget-date">
										<span>
											<i class="fa fa-calendar-alt fa-fw"></i> 20th August, 2020
										</span>
									</div>		
									-->						
								</div>
								<p><i class="fa fa-map-marker-alt fa-fw"></i> Plot No. 1086, Off Simon Mwansa Kapwepwe Rd</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="listing-hero-btns">						
							<a href="#" class="btn btn-share"><i class="fa fa-share-alt"></i> Share</a>
							<a href="#" class="btn btn-bookmark"><i class="fa fa-heart"></i> Bookmark</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Listing Section End -->

		<!-- Content -->

        <div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="listing-overview margin-bottom-30">
						<div class="row blog-section-title-row">
							<div class="col-lg-12">
								<div class="section-title">
									<h2>Overview</h2>
								</div>
							</div>
						</div>
						<p>Ut euismod ultricies sollicitudin. Curabitur sed dapibus nulla. Nulla eget iaculis lectus. 
						Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend. Morbi varius, nulla sit amet 
						rutrum elementum, est elit finibus tellus, ut tristique elit risus at metus.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla 
						finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, 
						et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. 
						Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</p>
						<div class="listing-links-container">		
							<ul class="social-links">
								<li>
									<a href="#" target="_blank" class="social-links-fb text-decoration-none"><i class="fab fa-facebook-square"></i> Facebook</a>
								</li>
								<li>
									<a href="#" target="_blank" class="social-links-yt text-decoration-none"><i class="fab fa-youtube"></i> YouTube</a>
								</li>
								<li>
									<a href="#" target="_blank" class="social-links-ig text-decoration-none"><i class="fab fa-instagram"></i> Instagram</a>
								</li>
								<li>
									<a href="#" target="_blank" class="social-links-tt text-decoration-none"><i class="fab fa-twitter"></i> Twitter</a>
								</li>
							</ul>
							<div class="clearfix"></div>				
						</div>
					</div>
					<div class="listing-amenities">
						<div class="row blog-section-title-row">
							<div class="col-lg-12">
								<div class="section-title">
									<h2>Amenities</h2>
								</div>
							</div>
						</div>
						<ul class="list-style-none">
							<li><i class="fa fa-check-square"></i>Air Conditioning</li>
							<li><i class="fa fa-check-square"></i>Pet Friendly</li>
							<li><i class="fa fa-check-square"></i>Free Parking</li>
							<li><i class="fa fa-check-square"></i>Wi-Fi</li>
							<li><i class="fa fa-check-square"></i>Vegan</li>
						</ul>
					</div>
					<div class="listing-pricing">
						<div class="row blog-section-title-row">
							<div class="col-lg-12">
								<div class="section-title">
									<h2>Pricing</h2>
								</div>
							</div>
						</div>
						<div class="pricing-list-container margin-bottom-40">
							<div class="pricing-category">
								<h4>Food</h4>
								<ul>
									<li>
										<h5>Classic Burger (K45)</h5>
										<p>Beef, Salad, Mayonnaise, Spicey Relish, Cheese</p>
										<a href="#" class="btn btn-primary text-decoration-none"><i class="fa fa-cart-plus"></i></a>
									</li>
								</ul>
								<ul>
									<li>
										<h5>Cheddar Burger (K55)</h5>
										<p>Cheddar Cheese, Lettuce, Tomato, Onion, Dill Pickles</p>
										<a href="#" class="btn btn-primary text-decoration-none"><i class="fa fa-cart-plus"></i></a>
									</li>
								</ul>
							</div>
							<div class="pricing-category">
								<h4>Drinks & Refreshments</h4>
								<ul>
									<li>
										<h5>Frozen Shake (K15)</h5>
										<p>Condimentum, Eratid, Facilisis, Malesuada</p>
										<a href="#" class="btn btn-primary text-decoration-none"><i class="fa fa-cart-plus"></i></a>
									</li>
								</ul>
								<ul>
									<li>
										<h5>Orange Juice (K25)</h5>
										<p>Justo, Felis, Congue, Sapien</p>
										<a href="#" class="btn btn-primary text-decoration-none"><i class="fa fa-cart-plus"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="listing-location margin-bottom-40">
						<div class="row blog-section-title-row">
							<div class="col-lg-12">
								<div class="section-title">
									<h2>Location</h2>
								</div>
							</div>
						</div>
						<div id="listing-map"></div>
					</div>
					<div class="listing-rating margin-bottom-40">
						<div class="row blog-section-title-row">
							<div class="col-lg-12">
								<div class="section-title">
									<h2>Rating</h2>
								</div>
							</div>
						</div>
						<div class="listing-rating-overview">
							<div class="row">
								<div class="col-md-4 text-center">
									<span class="numerical-rating margin-bottom-10">4.5</span>
									<div class="listing-rating margin-bottom-10">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-alt"></i>
									</div>
									<span class="total-ratings text-muted"><i class="fa fa-user fa-fw"></i> 7,882 total</span>
								</div>
								<div class="col-md-8">
									<ul class="rating-bars listing-rating list-style-none margin-bottom-0">
										<li class="margin-bottom-10">
											<i class="fa fa-star fa-fw"></i> 5
											<span class="progress">
												<span class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">5,353</span>
											</span>
										</li>
										<li class="margin-bottom-10">
											<i class="fa fa-star fa-fw"></i> 4
											<span class="progress">
												<span class="progress-bar bg-success" role="progressbar" style="width: 47%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">1,511</span>
											</span>
										</li>
										<li class="margin-bottom-10">
											<i class="fa fa-star fa-fw"></i> 3
											<span class="progress">
												<span class="progress-bar bg-success" role="progressbar" style="width: 17%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">431</span>
											</span>
										</li>
										<li class="margin-bottom-10">
											<i class="fa fa-star fa-fw"></i> 2
											<span class="progress">
												<span class="progress-bar bg-success" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">161</span>
											</span>
										</li>
										<li>
											<i class="fa fa-star fa-fw"></i> 1
											<span class="progress">
												<span class="progress-bar bg-success" role="progressbar" style="width: 15%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">426</span>
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card contact-information margin-bottom-30">
						<div class="card-header">
							<h4 class="margin-bottom-0">Contant Information</h4>
						</div>
						<div class="card-body">
							<ul class="list-style-none margin-bottom-0">
								<li>
									<i class="fa fa-external-link-alt fa-fw"></i>
									<a href="#" class="text-decoration-none"> www.burgerhouse.com</a>
								</li>
								<li>
									<i class="fa fa-phone fa-fw"></i>
									<a href="tel:+260 975 944 213" class="text-decoration-none"> +260 975 944 213</a>
								</li>
								<li class="border-none">
									<i class="fa fa-envelope fa-fw"></i>
									<a href="mailto:enquiries@burgerhouse.com" class="text-decoration-none"> enquiries@burgerhouse.com</a>
								</li>
							</ul>
						</div>
					</div>
					<!--
					<div class="margin-bottom-30">
						<button class="btn btn-primary width-100">Make Booking</button>
					</div>
					-->
					<div class="card listing-opening-hours margin-bottom-30">
						<div class="card-header">
							<h4 class="margin-bottom-0 text-center">Opening Hours</h4>
						</div>
						<div class="card-body">
							<div class="listing-badge open">
								Open
							</div>
							<ul class="list-style-none">
								<li>
									<span class="day">Monday</span>
									<span class="time">09:00 AM - 05:00 PM</span>
								</li>
								<li>
									<span class="day">Tuesday</span>
									<span class="time">09:00 AM - 05:00 PM</span>
								</li>
								<li>
									<span class="day">Wednesday</span>
									<span class="time">09:00 AM - 05:00 PM</span>
								</li>
								<li>
									<span class="day">Thursday</span>
									<span class="time">09:00 AM - 05:00 PM</span>
								</li>
								<li>
									<span class="day">Friday</span>
									<span class="time">09:00 AM - 05:00 PM</span>
								</li>
								<li>
									<span class="day">Saturday</span>
									<span class="time">Closed</span>
								</li>
								<li>
									<span class="day">Sunday</span>
									<span class="time">Closed</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8">
					<div class="leave-review margin-bottom-40">
						<div class="row blog-section-title-row">
							<div class="col-lg-12">
								<div class="section-title">
									<h2>Leave a review</h2>
								</div>
							</div>
						</div>
						<div class="review-form">
							<form>
								<div class="listing-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="form-group">
									<textarea class="form-control" placeholder="We thank you for your feedback...."></textarea>
								</div>
								<button class="btn btn-primary form-control">Submit</button>
							</form>
						</div>
					</div>
					<!--
					<div class="enquiry margin-bottom-40">
						<div class="row blog-section-title-row">
							<div class="col-lg-12">
								<div class="section-title">
									<h2>Get in touch</h2>
								</div>
							</div>
						</div>
						<div class="enquiry-form">
							<form>
								<div class="form-group">
									<textarea class="form-control" placeholder="Your message...."></textarea>
								</div>
								<button class="btn btn-primary form-control">Submit</button>
							</form>
						</div>
					</div>
					-->
					<div class="listing-reviews">
						<div class="row blog-section-title-row">
							<div class="col-lg-12">
								<div class="section-title">
									<h2>Reviews (1)</h2>
								</div>
							</div>
						</div>
						<div>
							<ul class="comment-list">
								<li class="comment">
									<div class="vcard bio">
										<img src="../img/user-profile-avatar.jpg" alt="Image">
									</div>
									<div class="comment-body">
										<h3>Joseph Wamulume</h3>
										<div class="meta">July 7, 2020 at 5:21pm</div>
										<div class="listing-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-half-alt"></i>
										</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
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
			
		var listing_map = L.map('listing-map').setView([-15.386283, 28.399378], 18);
		var listing_marker = L.marker([-15.386283, 28.399378]).addTo(listing_map);

		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
		}).addTo(listing_map);

		</script>

	</body>

</html>
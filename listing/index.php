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

		<?php 

            // Check if lisiting id exists in URL
			if(isset($_GET['l_id'])){
				// Get listing id from URL and store it in the listing_id variable
                $listing_id = $_GET['l_id'];
            }
                    
            // Select listing from the 'listing' table
            $results = mysqli_query($conn, "SELECT * FROM listing WHERE id=$listing_id");
			$row = mysqli_fetch_array($results);
			
			// Get latitude and longitude of listing
			$latitude = $row["latitude"];
			$longtitude = $row["longtitude"];
						
		?>

		<!-- Listing Hero Section -->
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
									<?php echo $row["listing_name"];?>
									<span class="category">
										<?php
										// Store category id in category_id variable
										$category_id = $row["category_id"];
										// Select catergory from 'listing_category' table that matches the category_id variable 
										$results_category = mysqli_query($conn, "SELECT * FROM listing_category WHERE id = $category_id"); 
										$row_category = mysqli_fetch_array($results_category);
										// Display relevant category badge for the selected listing category
										if ($row_category["category"] == "Food & Drinks") {
											echo "<a href='#'><i class='fa fa-utensils fa-fw stroke-transparent'></i> Food & Drinks</a>";
										}
										else if ($row_category["category"] == "Shopping") {
											echo "<a href='#'><i class='fa fa-shopping-cart fa-fw stroke-transparent'></i> Shopping</a>";
										}
										else if ($row_category["category"] == "Accomodation & Travel") {
											echo "<a href='#'><i class='fa fa-bed fa-fw stroke-transparent'></i> Accomodation & Travel</a>";
										}
										else if ($row_category["category"] == "Salon, Barber & Spa") {
											echo "<a href='#'><i class='fa fa-spa fa-fw stroke-transparent'></i> Salon, Barber & Spa</a>";
										}
										else if ($row_category["category"] == "Home Services") {
											echo "<a href='#'><i class='fa fa-home fa-fw stroke-transparent'></i> Home Services</a>";
										}
										else if ($row_category["category"] == "Car Services") {
											echo "<a href='#'><i class='fa fa-car-side fa-fw stroke-transparent'></i> Car Services</a>";
										}
										?>
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
								<p><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $row["listing_address"];?></p>
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
		<!-- /.Listing Hero Section -->

		<!-- Content -->

        <div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="listing-overview margin-bottom-30">
						<div class="row blog-section-title-row">
							<div class="col-lg-12">
								<div class="section-title">
									<h2>Description</h2>
								</div>
							</div>
						</div>
						<?php echo $row["overview"];?>
						<div class="listing-links-container">		
							<ul class="social-links">
								<?php 
								if ($row["facebook"] != "") {
									$facebook_link = $row["facebook"];
									echo "<li><a href='https://$facebook_link' target='_blank' class='social-links-fb text-decoration-none'><i class='fab fa-facebook-square'></i> Facebook</a></li>";
								}
								if ($row["instagram"] != "") {
									$instagram_link = $row["instagram"];
									echo "<li><a href='https://$instagram_link' target='_blank' class='social-links-ig text-decoration-none'><i class='fab fa-instagram'></i> Instagram</a></li>";
								}
								if ($row["twitter"] != "") {
									$twitter_link = $row["twitter"];
									echo "<li><a href='https://$twitter_link' target='_blank' class='social-links-tt text-decoration-none'><i class='fab fa-twitter'></i> Twitter</a></li>";
								}
								?>
								<!--<li>
									<a href="#" target="_blank" class="social-links-yt text-decoration-none"><i class="fab fa-youtube"></i> YouTube</a>
								</li>
								<li>
									<a href="#" target="_blank" class="social-links-ig text-decoration-none"><i class="fab fa-instagram"></i> Instagram</a>
								</li>
								<li>
									<a href="#" target="_blank" class="social-links-tt text-decoration-none"><i class="fab fa-twitter"></i> Twitter</a>
								</li>-->
							</ul>
							<div class="clearfix"></div>				
						</div>
					</div>
					<?php 
						$results_amenity = mysqli_query($conn, "SELECT * FROM amenity WHERE listing_id = $listing_id");
						if (mysqli_num_rows($results_amenity) > 0) {
							echo "
							<div class='listing-amenities'>
								<div class='row blog-section-title-row'>
									<div class='col-lg-12'>
										<div class='section-title'>
											<h2>Amenities</h2>
										</div>
									</div>
								</div>
								<ul class='list-style-none'>
							";
							while ($row_amenity = mysqli_fetch_array($results_amenity)) {
								$amenity = $row_amenity['amenity'];
								echo "<li><i class='fa fa-check-square'></i>$amenity</li>";
							}
							echo "</ul>
							</div>";
						}
					?>
					<!--<div class="listing-pricing">
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
					</div>-->
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
								<?php 
								if ($row["website"] != "") {
									$website_link = $row["website"];
									echo "<li><i class='fa fa-external-link-alt fa-fw'></i><a href='https://$website_link' class='text-decoration-none'> $website_link</a></li>";
								}
								?>
								<li>
									<i class="fa fa-phone fa-fw"></i>
									<?php 
									$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
									$row_phone = mysqli_fetch_array($results_phone)
									?>
									<a href="tel:<?php echo $row_phone['phone_number']; ?>" class="text-decoration-none"> <?php echo $row_phone['phone_number']; ?></a>
								</li>
								<?php 
								if ($row["email"] != "") {
									$email_link = $row["email"];
									echo "<li class='border-none'><i class='fa fa-envelope fa-fw'></i><a href='mailto:$email_link' class='text-decoration-none'> $email_link</a></li>";
								}
								?>
							</ul>
						</div>
					</div>
					<!--
					<div class="margin-bottom-30">
						<button class="btn btn-primary width-100">Make Booking</button>
					</div>
					-->
					<?php
					// Set timezone
					date_default_timezone_set("Africa/Lusaka"); 
					// Returns the current date time
					$now   = new DateTime(); 
					// Returns the current day in string format
					$day = $now->format('D');
					// Select the opening and closing hours for the current day
					$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = '$day'");
					// Check if the query return any results
					if (mysqli_num_rows($results_opening_hours)>0) {
						$row_opening_hours = mysqli_fetch_array($results_opening_hours);
						// Covert the opening time string from the database to a DateTime format and store it in the 'opening_time' variable		
						$openingtime = new DateTime(date('H:i:s',strtotime($row_opening_hours['opening_time'])));
						// Covert the closing time string from the database to a DateTime format and store it in the 'closing_time' variable
						$closingtime = new DateTime(date('H:i:s',strtotime($row_opening_hours['closing_time'])));
						// Check if the current time falls between the opening and closing times
						if($now >= $openingtime && $now <= $closingtime){
							// If the current time is between opening and closing times, display the opening hours card with the 'Open' badge
							echo "
							<div class='card listing-opening-hours margin-bottom-30'>
								<div class='card-header'>
									<h4 class='margin-bottom-0 text-center'>Opening Hours</h4>
								</div>
								<div class='card-body'>
									<div class='listing-badge open'>
										Open
									</div>
									<ul class='list-style-none'>
							";
							// Monday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Mon'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$mon_open = $row_opening_hours['opening_time'];
								$mon_close = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Monday</span>
									<span class='time'>$mon_open - $mon_close</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Monday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Monday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Mon'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Monday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Monday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Tuesday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Tue'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Tuesday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Tuesday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Wednesday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Wed'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Wednesday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Wednesday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Thursday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Thu'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Thursday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Thursday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Friday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Fri'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Friday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Friday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Saturday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Sat'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Saturday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Saturday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Sunday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Sun'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Sunday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Sunday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
						} else {
							// If the current time is not between opening and closing times, display the opening hours card with the 'Closed' badge
							echo "
							<div class='card listing-opening-hours margin-bottom-30'>
								<div class='card-header'>
									<h4 class='margin-bottom-0 text-center'>Opening Hours</h4>
								</div>
								<div class='card-body'>
									<div class='listing-badge closed'>
										Closed
									</div>
									<ul class='list-style-none'>
							";
							// Monday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Mon'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Monday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Monday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Tuesday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Tue'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Tuesday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Tuesday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Wednesday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Wed'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Wednesday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Wednesday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Thursday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Thu'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Thursday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Thursday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Friday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Fri'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Friday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Friday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Saturday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Sat'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Saturday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Saturday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
							// Sunday
							$results_opening_hours = mysqli_query($conn, "SELECT * FROM opening_hours WHERE listing_id = $listing_id AND weekday = 'Sun'");
							$row_opening_hours = mysqli_fetch_array($results_opening_hours);
							if ($row_opening_hours['openclose_status'] == 1) {
								$openingtime = $row_opening_hours['opening_time'];
								$closingtime = $row_opening_hours['closing_time'];
								echo "
								<li>
									<span class='day'>Sunday</span>
									<span class='time'>$openingtime - $closingtime</span>
								</li>
								";
							}
							else {
								echo "
								<li>
									<span class='day'>Sunday</span>
									<span class='time'>Closed</span>
								</li>
								";
							}
						}
						echo "</ul></div></div>";
					}
					?>					
					<!--<div class="card listing-opening-hours margin-bottom-30">
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
					</div>-->
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

		var longtitude  = '<?php echo $longtitude;?>';
		var latitude  = '<?php echo $latitude;?>';
			
		var listing_map = L.map('listing-map').setView([latitude, longtitude], 18);
		var listing_marker = L.marker([latitude, longtitude]).addTo(listing_map);

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
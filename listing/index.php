<?php
    // Start Session
	session_start();
	
	// Database Connection and Bookmarking Script
	include "../includes/bookmark.inc.php";

	// Script to track link clicks
	include "../includes/clicks.inc.php";

	// Device detection script
	require_once "../includes/mobile_detect/Mobile_Detect.php";
	$detect = new Mobile_Detect;

	// If the user is logged in, store session varibles 
	if (isset($_SESSION['login'])) {

		$user_id = $_SESSION['user_id'];

		// Retrieve user details from 'user' table
		$results = mysqli_query($conn, "SELECT * FROM user WHERE id = $user_id");
		$row = mysqli_fetch_array($results);

		// Store user details in relevant variables
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$email = $row['email'];
		$profile_picture_status = $row['profile_picture_status'];

	}

	//'visits' function to store information about the current visit (i.e. day, device type...)
	function visit($day, $conn, $listing_id) {
		mysqli_query($conn, "UPDATE analytics SET $day = $day + 1 WHERE listing_id=$listing_id");
		mysqli_query($conn, "UPDATE analytics SET visits = visits + 1 WHERE listing_id=$listing_id");
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
		<!-- RateYo CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<!-- RateYo JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

	</head>

	<body>

	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0" nonce="KtPkcmM3"></script>

		<!-- Main Navigation -->

		<?php include '../includes/clearnavbar.inc.php' ?>

		<!-- /.Main Navigation -->

		<!-- Modals -->

		<div class="modal fade" id="login-prompt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title">Please log in</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						You must <a href="login/index.php">log in</a> in order to add a listing.
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="login-prompt-bookmark" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title">Please log in</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						You must <a href="login/index.php">log in</a> in order to bookmark a listing.
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal-share fade" id="share-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title">Share</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row justify-content-center">
							<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" data-href="https://developers.facebook.com/docs/plugins/" class="text-center margin-right"><i class="fab fa-facebook-square"></i>Facebook</a>
							<a href="#" class="text-center margin-right"><i class="fab fa-twitter-square"></i>Twitter</a>
							<a href="#" class="text-center margin-right"><i class="fab fa-whatsapp-square"></i>WhatsApp</a>
							<a href="#" class="text-center"><i class="fab fa-reddit-square"></i>Reddit</a>
						</div>
					</div>
					<div class="modal-footer">
                		<div class="row">
							<div class="input-group">
								<input id="page-link" type="text" class="form-control">
								<div class="input-group-append">
									<button class="btn" type="button" onclick="copyToClipboard()"><i class="fa fa-copy"></i></button>
									<span id="custom-tooltip">copied!</sapn>
								</div>
								<textarea class=visuallyhidden id="box"></textarea>
							</div>
						</div>
            		</div>
				</div>
			</div>
		</div>

		<!-- /. Modals -->

		<?php
			// Set timezone
			date_default_timezone_set("Africa/Lusaka"); 
			// Get the current date time
			$now   = new DateTime(); 
			// Get the current day in string format
			$day = $now->format('D');

            // Check if lisiting id exists in URL
			if(isset($_GET['l_id'])){
				// Get listing id from URL and store it in the listing_id variable
                $listing_id = $_GET['l_id'];
            }
			else {
				// Return user to home page, if the listing page was not accessed by clicking on a particular listing
				header("Location: ../index.php");
			}
			
			// Call the 'visits' function to store information about the current visit (i.e. day, device type...)
			visit($day, $conn, $listing_id);

			// Check the type of device the user is using
			if ( $detect->isMobile() ) {
				mysqli_query($conn, "UPDATE analytics SET mobile = mobile + 1 WHERE listing_id=$listing_id");
			}
			else {
				mysqli_query($conn, "UPDATE analytics SET computer = computer + 1 WHERE listing_id=$listing_id");
			}
                    
            // Select listing from the 'listing' table
            $results = mysqli_query($conn, "SELECT * FROM listing WHERE id=$listing_id");
			$row = mysqli_fetch_array($results);

			// Retrieve the email address of the owner of the listing in order to send email notification of new reviews
			$owner_id = $row["owner_id"];
			$owner_results = mysqli_query($conn, "SELECT * FROM user WHERE id=$owner_id");
			$owner_row = mysqli_fetch_array($owner_results);
			$owner_email = $owner_row["email"];
			
			// Get latitude and longitude of listing
			$latitude = $row["latitude"];
			$longtitude = $row["longtitude"];					
		?>

		<!-- Listing Hero Section -->
		<section class="listing-hero set-bg-dark set-bg" data-setbgdark="../img/listing_pictures/listing_hero_<?php echo $row['id']; ?>.jpg">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="listing-hero-option">
							<div class="listing-hero-icon">
								<img src="img/listing/details/ld-icon.png" alt="">
							</div>
							<div class="listing-hero-text">
								<h2>
									<?php 
									$listing_name = $row["listing_name"];
									echo $listing_name;
									?>
									<span class="category">
										<?php
											// Store category id in category_id variable
											$category_id = $row["category_id"];
											// Select category from 'listing_category'
											$results_category = mysqli_query($conn, "SELECT * FROM listing_category WHERE id = $category_id"); 
											$row_category = mysqli_fetch_array($results_category);
											$category = $row_category["category"];
											echo "<span>$category</span>";
										?>
									</span>
								</h2>
								<div class="listing-hero-widget">
									<div class="listing-hero-widget-rating listing-rating">
										<?php 
											// Retrieve the number of review for the selected listing
											$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
											$number_of_reviews = mysqli_num_rows($reviews);
											if ($number_of_reviews > 0) {
												// Retrive the sum of all the ratings for the selected listing
												$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
												while ($row_sum = mysqli_fetch_array($rating_sum)) {
													// Find the average rating of the selected listing
													$sum = $row_sum['rating_sum'];
													$average = round($sum/$number_of_reviews, 1);
													$average = number_format($average, 1, '.', '');
												}
											}
											else {
												// Set the average rating to 0 if there are no reviews
												$average = 0;
											}
										?>
										<div class="read-only-rating" id="hero-rating" data-rateyo-star-width="20px" data-rateyo-read-only="true" data-rateyo-rating="<?php echo $average ?>"></div>
									</div>
									<?php if ($number_of_reviews < 0 || empty($number_of_reviews)):?>
									<div>
										No Reviews
									</div>
									<?php endif ?>
									<?php if ($number_of_reviews == 1): ?>
									<div><?php echo $number_of_reviews ?> Review</div>
									<?php endif ?>
									<?php if ($number_of_reviews > 1): ?>
									<div><?php echo $number_of_reviews ?> Reviews</div>
									<?php endif ?>
									<!--
									<div class="listing-hero-widget-date">
										<span>
											<i class="fa fa-calendar-alt fa-fw"></i> 20th August, 2020
										</span>
									</div>		
									-->						
								</div>
								<p><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $row["listing_address"].", ".$row['city_town'].", ".$row['province'];?></p>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="listing-hero-btns">						
							<span class="btn btn-share" data-toggle="modal" data-target="#share-modal"><i class="fa fa-share-alt"></i> Share</span>
							<?php if (isset($_SESSION['login'])): ?>
								<?php if (userBookmarked($row['id'])): ?>
								<span class="btn btn-bookmark active" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i><span class="bookmark-span"> Bookmark</span></span>
								<?php else: ?>
								<span class="btn btn-bookmark inactive" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i><span class="bookmark-span"> Bookmark</span></span>
								<?php endif ?>
							<?php else: ?>
								<span class="btn btn-bookmark-offline" data-toggle="modal" data-target="#login-prompt-bookmark"><i class="fa fa-heart stroke-transparent"></i><span class="bookmark-span"> Bookmark</span></span>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /.Listing Hero Section -->

		<div class="d-flex justify-content-center align-items-center position-relative">

			<div class="toast position-absolute" data-delay="5000">
				<div class="toast-body">
					Link copied to clipboard!
				</div>
			</div>

		</div>

		<!-- Content -->

        <div class="container">
			<div class="row">
				<div class="col-xl-8">
					<!-- Overview Section -->
					<div class="listing-overview margin-bottom-30">
						<div class="row">
							<div class="col-lg-12">
								<h3>Overview</h3>
							</div>
						</div>
						<div class="text-justify"><?php echo $row["overview"];?></div>
						<div class="listing-links-container">		
							<ul class="social-links">
								<?php
								// Display relevant social media links if the selected listing has any 
								if ($row["facebook"] != "") {
									$facebook_link = $row["facebook"];
									echo "<li><a href='https://$facebook_link' target='_blank' data-id='$listing_id' class='social-links-fb text-decoration-none'><i class='fab fa-facebook-square'></i> Facebook</a></li>";
								}
								if ($row["instagram"] != "") {
									$instagram_link = $row["instagram"];
									echo "<li><a href='https://$instagram_link' target='_blank' data-id='$listing_id' class='social-links-ig text-decoration-none'><i class='fab fa-instagram'></i> Instagram</a></li>";
								}
								if ($row["twitter"] != "") {
									$twitter_link = $row["twitter"];
									echo "<li><a href='https://$twitter_link' target='_blank' data-id='$listing_id' class='social-links-tt text-decoration-none'><i class='fab fa-twitter'></i> Twitter</a></li>";
								}
								?>
							</ul>
							<div class="clearfix"></div>				
						</div>
					</div>
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
					<!-- Location Section -->
					<div class="listing-location margin-bottom-40">
						<div class="row">
							<div class="col-lg-12">
								<h3>Location</h3>
							</div>
						</div>
						<div id="listing-map"></div>
					</div>
					<!-- Amenities Section -->
					<?php
						// Select all amenities that belong to the selected listing 
						$results_amenity = mysqli_query($conn, "SELECT * FROM amenity WHERE listing_id = $listing_id");
						// Check if the query returns any rows
						if (mysqli_num_rows($results_amenity) > 0) {
							// If the the query return row (amenities for this listing exist), display the 'Amenities' section
							echo "
							<div class='listing-amenities'>
								<div class='row'>
									<div class='col-lg-12'>
										<h3>Amenities</h3>
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
					<!-- Rating Section
					<div class="listing-rating margin-bottom-40">
						<div class="row">
							<div class="col-lg-12">
								<h3>Rating</h3>
							</div>
						</div>
						<div class="listing-rating-overview">
							<div class="row">
								<div class="col-md-4 text-center">
									<?php
									if ($number_of_reviews > 1) {
										while ($row_sum = mysqli_fetch_array($rating_sum)) {
											$sum = $row_sum['rating_sum'];
											$average = round($sum/$number_of_reviews, 1);
											$average = number_format($average, 1, '.', '');
											echo '<span class="numerical-rating margin-bottom-10">'.$average.'</span>';
										}
									}
									else {
										echo '<span class="margin-bottom-10">There are currently no ratings for this listing.</span>';
									}
									?>
									<div class="listing-rating margin-bottom-10">
										<div class="read-only-rating" data-rateyo-star-width="20px" data-rateyo-read-only="true" data-rateyo-rating="<?php echo $average ?>"></div>
									</div>
									<span class="total-ratings text-muted"><i class="fa fa-user fa-fw"></i> <?php echo $number_of_reviews ?></span>
								</div>
								<div class="col-md-8">
									<ul class="rating-bars listing-rating list-style-none margin-bottom-0">
										<li class="margin-bottom-10">
											<i class="fa fa-star fa-fw"></i> 5
											<span class="progress">
												<?php 
												$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id AND rating = 5");
												$five_star = mysqli_num_rows($reviews);
												$percentage = ($five_star/$number_of_reviews)*100;
												?>
												<span class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percentage ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $five_star ?></span>
											</span>
										</li>
										<li class="margin-bottom-10">
											<i class="fa fa-star fa-fw"></i> 4
											<span class="progress">
												<?php 
												$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id AND rating = 4");
												$four_star = mysqli_num_rows($reviews);
												$percentage = ($four_star/$number_of_reviews)*100;
												?>
												<span class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percentage ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $four_star ?></span>
											</span>
										</li>
										<li class="margin-bottom-10">
											<i class="fa fa-star fa-fw"></i> 3
											<span class="progress">
												<?php 
												$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id AND rating = 3");
												$three_star = mysqli_num_rows($reviews);
												$percentage = ($three_star/$number_of_reviews)*100;
												?>
												<span class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percentage ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $three_star ?></span>
											</span>
										</li>
										<li class="margin-bottom-10">
											<i class="fa fa-star fa-fw"></i> 2
											<span class="progress">
												<?php 
												$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id AND rating = 2");
												$two_star = mysqli_num_rows($reviews);
												$percentage = ($two_star/$number_of_reviews)*100;
												?>
												<span class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percentage ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $two_star ?></span>
											</span>
										</li>
										<li>
											<i class="fa fa-star fa-fw"></i> 1
											<span class="progress">
												<?php 
												$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id AND rating = 1");
												$one_star = mysqli_num_rows($reviews);
												$percentage = ($one_star/$number_of_reviews)*100;
												?>
												<span class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percentage ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $one_star ?></span>
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>-->
				</div>
				<div class="col-xl-4">
					<!-- Contact Information Card -->
					<div class="card contact-information margin-bottom-30">
						<div class="card-header">
							<h4 class="margin-bottom-0">Contact Information</h4>
						</div>
						<div class="card-body">
							<ul class="list-style-none margin-bottom-0">
								<?php 
								// Check if the listing contains a website link, and display the link if it exists
								if ($row["website"] != "") {
									$website_link = $row["website"];
									echo "<li><i class='fa fa-external-link-alt fa-fw'></i><a href='https://$website_link' data-id='$listing_id' target='_blank' class='website-link text-decoration-none'> $website_link</a></li>";
								}
								?>
								<li>
									<i class="fa fa-phone fa-fw"></i>
									<?php 
									// Select all phone numbers from the 'listing_phone_number' table that match the selected listing
									$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
									$row_phone = mysqli_fetch_array($results_phone)
									?>
									<a href="tel:<?php echo $row_phone['phone_number']; ?>" class="text-decoration-none"> <?php echo $row_phone['phone_number']; ?></a>
								</li>
								<?php 
								// Check if the listing contains an email address, and display the email address if it exists
								if ($row["email"] != "") {
									$email_link = $row["email"];
									echo "<li class='border-none'><i class='fa fa-envelope fa-fw'></i><a href='mailto:$email_link' class='text-decoration-none'> $email_link</a></li>";
								}
								?>
							</ul>
						</div>
					</div>
					<!-- Opening Hours Card -->
					<?php
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
										<h4 class='margin-bottom-0'>Opening Hours</h4>
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
										<h4 class='margin-bottom-0'>Opening Hours</h4>
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
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-8">
					<div class="leave-review margin-bottom-40">
						<div class="row">
							<div class="col-lg-12">
								<h3>Leave a review</h3>
							</div>
						</div>						
						<div class="review-form">
							<form method="POST" action="../includes/submitreview.inc.php">
								<div class="margin-bottom-10">Your Rating </div>
								<div class="listing-rating">
									<div id="read-write-rating" data-rateyo-full-star="true"></div>
								</div>
								<?php if (isset($_SESSION['login'])): ?>
								<div class="form-row" hidden>
								<?php else: ?>
								<div class="form-row">
								<?php endif ?>
				            		<div class="form-group col-md-6">
										<?php if (isset($_SESSION['login'])): ?>
										<input class="form-control" hidden value="<?php echo $first_name ?>" placeholder="First Name" type="text" name="first_name" required>
										<?php else: ?>
										<input class="form-control" placeholder="First Name" type="text" name="first_name" required>
										<?php endif ?>
									</div>
									<div class="form-group col-md-6">
										<?php if (isset($_SESSION['login'])): ?>
										<input class="form-control" hidden value="<?php echo $last_name ?>" placeholder="Last Name" type="text" name="last_name" required>
										<?php else: ?>
										<input class="form-control" placeholder="Last Name" type="text" name="last_name" required>
										<?php endif ?>
									</div>
								</div>
								<?php if (isset($_SESSION['login'])): ?>
								<div class="form-group" hidden>
								<?php else: ?>
								<div class="form-group">
								<?php endif ?>
									<?php if (isset($_SESSION['login'])): ?>
									<input class="form-control" hidden value="<?php echo $email ?>" placeholder="Email Address" type="email" name="email" required>
									<?php else: ?>
									<input class="form-control" placeholder="Email Address" type="email" name="email" required>
									<?php endif ?>
								</div>
								<div class="form-group">
									<input type="text" hidden value="<?php echo $listing_id ?>" id="listing-id" class="form-control" name="listing_id">
									<input type="text" hidden value="<?php echo $listing_name ?>" id="listing-name" class="form-control" name="listing_name">
									<input type="text" hidden value="<?php echo $owner_email ?>" id="owner-email" class="form-control" name="owner_email">
									<input type="text" hidden id="review-rating" class="form-control" name="rating">
									<textarea required class="form-control" rows="8" placeholder="We thank you for your feedback..." name="feedback"></textarea>
								</div>
								<button class="btn btn-primary form-control" id="submit-review" type="submit" name="submit-review">Submit</button>
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
					<?php
					// Select all the reviews from the 'review' table that belong to the selected listing
					$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
					$number_of_reviews = mysqli_num_rows($reviews);
					?>
					<div class="listing-reviews margin-bottom-50">
						<div class="row">
							<div class="col-lg-12">
								<h3>Reviews (<?php echo $number_of_reviews ?>)</h3>
							</div>
						</div>					
						<div>
							<?php if ($number_of_reviews < 1): ?>
							<span>There are no reviews for this listing yet. Be the first to submit a review!</span>
							<?php endif ?>
							<?php 
							while ($review_row = mysqli_fetch_array($reviews)) {
							?>
							<ul class="comment-list">
								<li class="comment" id="review_id_<?php echo $review_row['id'] ?>">
									<div class="vcard bio">
										<img src="../img/user-profile-avatar.jpg" alt="Image">
									</div>
									<div class="comment-body">
										<?php
										$author_fullname = $review_row['first_name'] . " " . $review_row['last_name'];
										?>
										<div class="row">
											<div class="col-sm-6">
												<h3><?php echo $author_fullname ?></h3>
												<?php
												$time = new DateTime($review_row['submission_date']);
												$date = $time->format('jS F');
												$year = $time->format('Y');
												$time = $time->format('H:i');
												?>
												<div class="meta"><?php echo $date ?>, <?php echo $year ?> at <?php echo $time ?></div>
											</div>
											<div class="col-sm-6">
												<div class="listing-rating">
													<div class="read-only-rating" id="feedback-rating" data-rateyo-star-width="20px" data-rateyo-read-only="true" data-rateyo-rating="<?php echo $review_row['rating'] ?>"></div>
												</div>
											</div>
										</div>
										<p><?php echo $review_row['feedback'] ?></p>
									</div>
								</li>
							</ul>
							<?php } ?>
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
						<h2 class="footer-brand">FindUs</h2>
						<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
						Aliquam vitae ante quis urna iaculis varius ac ac diam. Pellentesque nec leo dui. 
						Sed tincidunt interdum velit, sed sagittis purus molestie nec. Donec scelerisque enim congue, 
						ultricies mi ut, blandit mi. In sed nisl eu eros consequat placerat vel vitae ligula.</p>
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
					<div class="col-lg-4 col-xs-12 footer-section contact">
						<h4 class="mt-lg-0 mt-sm-4">Contact Us</h4>
						<ul class="m-0 p-0 list-style-none">
							<li><span>Plot No. 1086 Off Simon Mwansa Kapwepwe Rd</span></li>
							<li><span>Lusaka, Zambia</span></li>
							<li><span>Phone: +260 975 944 213, +260 975 944 213</span></li>
							<li><span>Email: <a href="mailto:josephwamulume@gmail" class="text-decoration-none">josephwamulume@gmail</a></span></li>
						</ul>
						<p class="footer-social-icons">
							<a href="#"><i class="fab fa-facebook fa-2x"></i></a>
							<a href="#"><i class="fab fa-twitter fa-2x"></i></a>
							<a href="#"><i class="fab fa-instagram fa-2x"></i></a>
						</p>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col copyright">
					<p class=""><span>© Joseph Wamulume, 2020. All Rights Reserved.</span></p>
					</div>
				</div>
			</div>
		</div>

		<!-- /.Footer -->

		<script>

			document.getElementById("page-link").value = window.location.href;

			function copyToClipboard() {
				/* Get the text field */
				var copyText = document.getElementById("page-link");
			
				/* Select the text field */
				copyText.select();
				copyText.setSelectionRange(0, 99999); /* For mobile devices */
			
				/* Copy the text inside the text field */
				document.execCommand("copy");
			
				/* Alert the copied text */
				$('.toast').toast('show')
			}
			
		</script>

		<script>

		var longtitude  = '<?php echo $longtitude;?>';
		var latitude  = '<?php echo $latitude;?>';
			
		var listing_map = L.map('listing-map').setView([latitude, longtitude], 18);
		var listing_marker = L.marker([latitude, longtitude]).addTo(listing_map);

		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 16,
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
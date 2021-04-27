<?php
    // Start Session
	session_start();
	
	// Database Connection and Bookmarking Script
	include "includes/bookmark.inc.php";
	
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
?>

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
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/aos.css">
		<!-- Local Script -->
		<script type="text/javascript" src="js/main.js"></script>
		<!-- Typed.js -->
		<script type="text/javascript" src="js/typed.js"></script>
		<!-- Animate On Scroll -->
		<script type="text/javascript" src="js/aos.js"></script>
		<!-- RateYo CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<!-- RateYo JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

	</head>

	<body>

		<!-- Main Navigation -->

		<nav class="navbar navbar-light clear-navbar navbar-expand fixed-top" data-aos="fade-down">
			<a href="index.php" class="navbar-brand js-scroll-trigger">FindUs</a>
			<div class="navbar-collapse collapse" id="navbar">
				<div class="nav navbar-nav ml-auto">
					<?php
					if (isset($_SESSION['login'])) {
						/*<div class="dropdown">
							<a class="btn-cart text-decoration-none" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
								<i class="fa fa-shopping-cart"></i>
								<span class="badge badge-danger badge-counter">3+</span>
							</a>
							<div class="dropdown-menu user-dropdown-menu" id="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">LOL</a>
							</div>
						</div>*/
						echo '<div class="navbar-buttons">
						<div class="dropdown"><a class="btn-myaccount dropdown-toggle text-decoration-none" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">';
						if ($profile_picture_status == true) {
							$filename = "img/profile_pictures/profile_picture_user_".$user_id."*";
							$fileinfo = glob($filename);
							$fileext = explode("_".$user_id.".", $fileinfo[0]);
							$fileactualext = $fileext[1];
							echo "<img class='img-profile rounded-circle' src='img/profile_pictures/profile_picture_user_".$user_id.".".$fileactualext."?".mt_rand()."'>";
						}
						else {
							echo "<img class='img-profile rounded-circle' src='img/profile_pictures/profile_picture_user_default.png'>";
						}
								
						echo '</a>
						<div class="dropdown-menu user-dropdown-menu" id="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="dashboard/index.php"><i class="fa fa-cog fa-fw"></i> Dashboard</a>
							<a class="dropdown-item" href="dashboard/mylistings.php"><i class="fa fa-layer-group fa-fw"></i> My Listings</a>
							<a class="dropdown-item" href="dashboard/myprofile.php"><i class="fa fa-user fa-fw"></i> My Profile</a>
							<form action="includes/logout.inc.php" method="post">
								<button class="dropdown-item" name="logout"><i class="fa fa-sign-out-alt fa-fw"></i> Log out</button>
							</form>
						</div>
					</div>
					</div>';
					}
					else {
						echo '<a class="btn btn-login" href="login/index.php"><i class="fa fa-sign-in-alt fa-fw"></i> Login</a>';
						echo '<a class="btn btn-login navbar-mobile-btn" href="login/index.php"><i class="fa fa-sign-in-alt"></i></a>';
					}
					?>
					<?php
					if (isset($_SESSION['login'])) {
						echo '<a class="btn btn-addlisting" href="dashboard/addlisting.php"><i class="fa fa-plus-circle fa-fw"></i> Add Listing</a>';
						echo '<a class="btn btn-addlisting navbar-mobile-btn" href="dashboard/addlisting.php"><i class="fa fa-plus-circle"></i></a>';
					}
					else {
						echo '<a class="btn btn-addlisting" data-toggle="modal" data-target="#login-prompt"><i class="fa fa-plus-circle fa-fw"></i> Add Listing</a>';
						echo '<a class="btn btn-addlisting navbar-mobile-btn" data-toggle="modal" data-target="#login-prompt" href="dashboard/addlisting.php"><i class="fa fa-plus-circle"></i></a>';
					}
					?>
				</div>
			</div>
		</nav>

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

		<!-- /. Modals -->

		<!-- Header -->

		<div class="main-search-container">
			<div class="main-search-inner">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h2>Find Nearby <span class="typed-words">Restaurants</span><span class="typed-cursor typed-cursor--blink"></span></h2>
							<h4>Explore top-rated attractions, activities and more!</h4>
							<div class="form-search-wrap p-2">
              					<form method="post" action="includes/search.inc.php">
                					<div class="row align-items-center">
										<div class="col-md-12 col-lg-4 no-sm-border border-right input">
											<input type="text" name="keyword_search" class="form-control" placeholder="What are you looking for?" required>
										</div>
										<div class="col-md-12 col-lg-3 no-sm-border border-right input">
											<div class="wrap-icon">
												<input type="text" name="location_search" class="form-control" placeholder="Location">
											</div>
										</div>
										<div class="col-md-12 col-lg-3 input">
											<div class="select-wrap">
												<span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
												<select class="form-control" name="listing_category[]" id="">
													<option selected value="">All Categories</option>
													<?php
													$results = mysqli_query($conn, "SELECT * FROM listing_category");
													while ($row = mysqli_fetch_array($results)) {
													?>
													<option value="<?php echo $row['id']; ?>"><?php echo $row['category']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2 text-right">
											<input type="submit" name="submit-search" class="btn text-white btn-primary" value="Search">
										</div>
                  					</div>
              					</form>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h5 class="highlighted-categories-headline">Or browse featured categories:</h5>
							<div class="category-tags">
								<a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food & Drinks</a>
								<a href="#"><i class="fa fa-shopping-cart fa-fw stroke-transparent"></i> Shopping</a>
								<a href="#"><i class="fa fa-bed fa-fw stroke-transparent"></i> Accomodation & Travel</a>
								<a href="#"><i class="fa fa-car-side fa-fw stroke-transparent"></i> Car Services</a>
							</div>	
						</div>								
					</div>
				</div>
			</div>
		</div>

		<!-- /.Header -->

		<!-- Content -->

		<!-- Top Businesses Tabs Panel -->
		<div class="container-fluid">
			<div class="row justify-content-center bg-white">
				<div class="col-lg-10 p-3">
					<div class="row section-title-row">
						<div class="col-lg-12">
							<div class="section-title">
								<h3>Top Businesses and Services</h3>
								<p>The best businesses and services recommended by your fellow FindUs users</p>
							</div>
						</div>
					</div>
					<div id="listing-nav" class="listing-nav-container">
						<ul class="listing-nav nav nav-tabs text-center" role="tablist">
							<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"><span class="fa fa-utensils"></span> Restaurants & Fast Food</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"><span class="fa fa-shopping-basket"></span> Shopping & Retail</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"><span class="fa fa-bed"></span> Lodging & Travel</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab"><span class="fa fa-theater-masks"></span> Art, Culture & Entertainment</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab"><span class="fa fa-home"></span> Real Estate</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab"><span class="fa fa-car-alt"></span> Auto Sales & Service</a></li>
						</ul>
					</div>
					<?php
					// Put category ID's into corresponding variables 
					$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Restaurants & Fast Food'");
					$row = mysqli_fetch_array($results);
					$restaurantsNightlifeId = $row['id'];
					
					$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Shopping & Retail'");
					$row = mysqli_fetch_array($results);
					$shoppingRetail = $row['id'];
					
					$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Lodging & Travel'");
					$row = mysqli_fetch_array($results);
					$lodgingTravelId = $row['id'];
					
					$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Art, Culture & Entertainment'");
					$row = mysqli_fetch_array($results);
					$artCultureEntertainmentId = $row['id'];
					
					$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Real Estate'");
					$row = mysqli_fetch_array($results);
					$realEstate = $row['id'];
					
					$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Auto Sales & Services'");
					$row = mysqli_fetch_array($results);
					$autoSalesServicesId = $row['id'];
					?>
					<div class="tab-content">
					<!-- Restaurants & Nightlife Tab -->
					<div class="tab-pane active" id="tabs-1" role="tabpanel">
						<div class="row">
							<?php
							// Select the top 6 listings under the 'Food & Drinks' category and sort them by their review rating
							$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $restaurantsNightlifeId");
							// Check if the query returns any rows
							if (mysqli_num_rows($results)==0) {
								// If the query returns no rows, display relevant error message
								echo "<p class='no-listings'>There are currently no listings for this category. Please select a different tab.</p>";
							}
							else {
								while ($row = mysqli_fetch_array($results)) {
									$listing_id = $row['id']; // Store listing id in listing_id variable															
							?>
							<div class="col-lg-4 col-md-6">
								<!-- Listing Item -->
								<div class="card mb-4 listing-item shadow">
									<div class="listing-item-pic set-bg" data-setbg="img/listing_pictures/listing_<?php echo $row['id']; ?>.jpg">
										<div class="listing-category category">
											<span>Restaurants & Fast Food</span>
										</div>
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
												// If the current time is between opening and closing times, display the 'Open' badge
												echo "<div class='listing-badge open'>Open</div>";
											} else {
												// If the current time is not between opening and closing times, display the 'Closed' badge
												echo "<div class='listing-badge closed'>Closed</div>";
											}
										}
										?>
										<div class="bookmark">
										<?php if (isset($_SESSION['login'])): ?>
											<?php if (userBookmarked($row['id'])): ?>
											<span class="bookmark-btn active" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php else: ?>
											<span class="bookmark-btn inactive" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php endif ?>
										<?php else: ?>
											<span data-toggle="modal" data-target="#login-prompt-bookmark"><i class="fa fa-heart stroke-transparent"></i></span>
										<?php endif ?>
										</div>
									</div>
									<div class="card-body listing-details">
										<a href="listing/index.php"><h2 class="card-title"><?php echo $row['listing_name']; ?></h2></a>
										<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $row['listing_address']; ?></div>
										<?php 
										$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
										$row_phone = mysqli_fetch_array($results_phone)
										?>
										<div><i class="fa fa-phone fa-fw"></i> <?php echo $row_phone['phone_number']; ?></div>
									</div>
									<div class="card-footer listing-rating text-muted">
										<?php 
										$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
										$number_of_reviews = mysqli_num_rows($reviews);
										if ($number_of_reviews > 0) {
											$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
											while ($row_sum = mysqli_fetch_array($rating_sum)) {
											$sum = $row_sum['rating_sum'];
											$average = round($sum/$number_of_reviews, 1);
											$average = number_format($average, 1, '.', '');
											}
										}
										else {
											$average = 0;
										}
										?>
										<div class="read-only-rating" data-rateyo-star-width="20px" data-rateyo-read-only="true" data-rateyo-rating="<?php echo $average ?>"></div>
										<?php if ($number_of_reviews < 0 || empty($number_of_reviews)):?>
										<span> (No reviews)</span>
										<?php endif ?>
										<?php if ($number_of_reviews == 1): ?>
										<span> (<?php echo $number_of_reviews ?> review)</span>
										<?php endif ?>
										<?php if ($number_of_reviews > 1): ?>
										<span> (<?php echo $number_of_reviews ?> reviews)</span>
										<?php endif ?>
										<a href="listing/index.php?l_id=<?php echo $row["id"];?>" class="stretched-link"></a>
									</div>
								</div>				
							</div>
							<?php }} ?>
						</div>							
					</div>
					<!-- Shopping Tab -->
					<div class="tab-pane" id="tabs-2" role="tabpanel">
						<div class="row">
							<?php
							// Select the top 6 listings under the 'Shopping' category and sort them by their review rating
							$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $shoppingRetail");
							// Check if the query returns any rows
							if (mysqli_num_rows($results)==0) {
								// If the query returns no rows, display relevant error message
								echo "<p>There are currently no listings for this category. Please select a different tab.</p>";
							}
							else {
								while ($row = mysqli_fetch_array($results)) {
									$listing_id = $row['id']; // Store listing id in listing_id variable															
							?>
							<div class="col-lg-4 col-md-6">
								<!-- Listing Item -->
								<div class="card mb-4 listing-item shadow">
									<div class="listing-item-pic set-bg" data-setbg="img/restaurant.jpg">
										<div class="listing-category category">
											<span></i> Shopping & Retail</span>
										</div>
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
												// If the current time is between opening and closing times, display the 'Open' badge
												echo "<div class='listing-badge open'>Open</div>";
											} else {
												// If the current time is not between opening and closing times, display the 'Closed' badge
												echo "<div class='listing-badge closed'>Closed</div>";
											}
										}
										?>
										<div class="bookmark">
										<?php if (isset($_SESSION['login'])): ?>
											<?php if (userBookmarked($row['id'])): ?>
											<span class="bookmark-btn active" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php else: ?>
											<span class="bookmark-btn inactive" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php endif ?>
										<?php else: ?>
											<span data-toggle="modal" data-target="#login-prompt-bookmark"><i class="fa fa-heart stroke-transparent"></i></span>
										<?php endif ?>
										</div>
									</div>
									<div class="card-body listing-details">
										<a href="listing/index.php"><h2 class="card-title"><?php echo $row['listing_name']; ?></h2></a>
										<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $row['listing_address']; ?></div>
										<?php 
										$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
										$row_phone = mysqli_fetch_array($results_phone)
										?>
										<div><i class="fa fa-phone fa-fw"></i> <?php echo $row_phone['phone_number']; ?></div>
									</div>
									<div class="card-footer listing-rating text-muted">
									<?php 
										$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
										$number_of_reviews = mysqli_num_rows($reviews);
										if ($number_of_reviews > 0) {
											$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
											while ($row_sum = mysqli_fetch_array($rating_sum)) {
											$sum = $row_sum['rating_sum'];
											$average = round($sum/$number_of_reviews, 1);
											$average = number_format($average, 1, '.', '');
											}
										}
										else {
											$average = 0;
										}
										?>
										<div class="read-only-rating" data-rateyo-star-width="20px" data-rateyo-read-only="true" data-rateyo-rating="<?php echo $average ?>"></div>
										<?php if ($number_of_reviews < 0 || empty($number_of_reviews)):?>
										<span> (No reviews)</span>
										<?php endif ?>
										<?php if ($number_of_reviews == 1): ?>
										<span> (<?php echo $number_of_reviews ?> review)</span>
										<?php endif ?>
										<?php if ($number_of_reviews > 1): ?>
										<span> (<?php echo $number_of_reviews ?> reviews)</span>
										<?php endif ?>
										<a href="listing/index.php?l_id=<?php echo $row["id"];?>" class="stretched-link"></a>
									</div>
								</div>	
							</div>
							<?php }} ?>
						</div>
					</div>
					<!-- Accomodation & Travel Tab -->
					<div class="tab-pane" id="tabs-3" role="tabpanel">
						<div class="row">
							<?php
							// Select the top 6 listings under the 'Accomodation & Travel' category and sort them by their review rating
							$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $lodgingTravelId");
							// Check if the query returns any rows
							if (mysqli_num_rows($results)==0) {
								// If the query returns no rows, display relevant error message
								echo "<p>There are currently no listings for this category. Please select a different tab.</p>";
							}
							else {
								while ($row = mysqli_fetch_array($results)) {
									$listing_id = $row['id']; // Store listing id in listing_id variable															
							?>
							<div class="col-lg-4 col-md-6">
								<!-- Listing Item -->
								<div class="card mb-4 listing-item shadow">
									<div class="listing-item-pic set-bg" data-setbg="img/restaurant.jpg">
										<div class="listing-category category">
											<span>Lodging & Travel</span>
										</div>
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
												// If the current time is between opening and closing times, display the 'Open' badge
												echo "<div class='listing-badge open'>Open</div>";
											} else {
												// If the current time is not between opening and closing times, display the 'Closed' badge
												echo "<div class='listing-badge closed'>Closed</div>";
											}
										}
										?>
										<div class="bookmark">
										<?php if (isset($_SESSION['login'])): ?>
											<?php if (userBookmarked($row['id'])): ?>
											<span class="bookmark-btn active" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php else: ?>
											<span class="bookmark-btn inactive" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php endif ?>
										<?php else: ?>
											<span data-toggle="modal" data-target="#login-prompt-bookmark"><i class="fa fa-heart stroke-transparent"></i></span>
										<?php endif ?>
										</div>
									</div>
									<div class="card-body listing-details">
										<a href="listing/index.php"><h2 class="card-title"><?php echo $row['listing_name']; ?></h2></a>
										<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $row['listing_address']; ?></div>
										<?php 
										$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
										$row_phone = mysqli_fetch_array($results_phone)
										?>
										<div><i class="fa fa-phone fa-fw"></i> <?php echo $row_phone['phone_number']; ?></div>
									</div>
									<div class="card-footer listing-rating text-muted">
									<?php 
										$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
										$number_of_reviews = mysqli_num_rows($reviews);
										if ($number_of_reviews > 0) {
											$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
											while ($row_sum = mysqli_fetch_array($rating_sum)) {
											$sum = $row_sum['rating_sum'];
											$average = round($sum/$number_of_reviews, 1);
											$average = number_format($average, 1, '.', '');
											}
										}
										else {
											$average = 0;
										}
										?>
										<div class="read-only-rating" data-rateyo-star-width="20px" data-rateyo-read-only="true" data-rateyo-rating="<?php echo $average ?>"></div>
										<?php if ($number_of_reviews < 0 || empty($number_of_reviews)):?>
										<span> (No reviews)</span>
										<?php endif ?>
										<?php if ($number_of_reviews == 1): ?>
										<span> (<?php echo $number_of_reviews ?> review)</span>
										<?php endif ?>
										<?php if ($number_of_reviews > 1): ?>
										<span> (<?php echo $number_of_reviews ?> reviews)</span>
										<?php endif ?>
										<a href="listing/index.php?l_id=<?php echo $row["id"];?>" class="stretched-link"></a>
									</div>
								</div>	
							</div>
							<?php }} ?>
						</div>
					</div>
					<!-- Salon, Barber & Spa Tab -->
					<div class="tab-pane" id="tabs-4" role="tabpanel">
						<div class="row">
							<?php
							// Select the top 6 listings under the 'Salon, Barber & Spa Tab' category and sort them by their review rating
							$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $artCultureEntertainmentId");
							// Check if the query returns any rows
							if (mysqli_num_rows($results)==0) {
								// If the query returns no rows, display relevant error message
								echo "<p>There are currently no listings for this category. Please select a different tab.</p>";
							}
							else {
								while ($row = mysqli_fetch_array($results)) {
									$listing_id = $row['id']; // Store listing id in listing_id variable															
							?>
							<div class="col-lg-4 col-md-6">
								<!-- Listing Item -->
								<div class="card mb-4 listing-item shadow">
									<div class="listing-item-pic set-bg" data-setbg="img/restaurant.jpg">
										<div class="listing-category category">
											<span>Art, Culture & Entertainment</span>
										</div>
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
												// If the current time is between opening and closing times, display the 'Open' badge
												echo "<div class='listing-badge open'>Open</div>";
											} else {
												// If the current time is not between opening and closing times, display the 'Closed' badge
												echo "<div class='listing-badge closed'>Closed</div>";
											}
										}
										?>
										<div class="bookmark">
										<?php if (isset($_SESSION['login'])): ?>
											<?php if (userBookmarked($row['id'])): ?>
											<span class="bookmark-btn active" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php else: ?>
											<span class="bookmark-btn inactive" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php endif ?>
										<?php else: ?>
											<span data-toggle="modal" data-target="#login-prompt-bookmark"><i class="fa fa-heart stroke-transparent"></i></span>
										<?php endif ?>
										</div>
									</div>
									<div class="card-body listing-details">
										<a href="listing/index.php"><h2 class="card-title"><?php echo $row['listing_name']; ?></h2></a>
										<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $row['listing_address']; ?></div>
										<?php 
										$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
										$row_phone = mysqli_fetch_array($results_phone)
										?>
										<div><i class="fa fa-phone fa-fw"></i> <?php echo $row_phone['phone_number']; ?></div>
									</div>
									<div class="card-footer listing-rating text-muted">
									<?php 
										$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
										$number_of_reviews = mysqli_num_rows($reviews);
										if ($number_of_reviews > 0) {
											$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
											while ($row_sum = mysqli_fetch_array($rating_sum)) {
											$sum = $row_sum['rating_sum'];
											$average = round($sum/$number_of_reviews, 1);
											$average = number_format($average, 1, '.', '');
											}
										}
										else {
											$average = 0;
										}
										?>
										<div class="read-only-rating" data-rateyo-star-width="20px" data-rateyo-read-only="true" data-rateyo-rating="<?php echo $average ?>"></div>
										<?php if ($number_of_reviews < 0 || empty($number_of_reviews)):?>
										<span> (No reviews)</span>
										<?php endif ?>
										<?php if ($number_of_reviews == 1): ?>
										<span> (<?php echo $number_of_reviews ?> review)</span>
										<?php endif ?>
										<?php if ($number_of_reviews > 1): ?>
										<span> (<?php echo $number_of_reviews ?> reviews)</span>
										<?php endif ?>
										<a href="listing/index.php?l_id=<?php echo $row["id"];?>" class="stretched-link"></a>
									</div>
								</div>	
							</div>
							<?php }} ?>
						</div>
					</div>
					<!-- Home Services Tab -->
					<div class="tab-pane" id="tabs-5" role="tabpanel">
						<div class="row">
							<?php
							// Select the top 6 listings under the 'Home Services' category and sort them by their review rating
							$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $realEstate");
							// Check if the query returns any rows
							if (mysqli_num_rows($results)==0) {
								// If the query returns no rows, display relevant error message
								echo "<p>There are currently no listings for this category. Please select a different tab.</p>";
							}
							else {
								while ($row = mysqli_fetch_array($results)) {
									$listing_id = $row['id']; // Store listing id in listing_id variable															
							?>
							<div class="col-lg-4 col-md-6">
								<!-- Listing Item -->
								<div class="card mb-4 listing-item shadow">
									<div class="listing-item-pic set-bg" data-setbg="img/restaurant.jpg">
										<div class="listing-category category">
											<span>Real Estate</span>
										</div>
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
												// If the current time is between opening and closing times, display the 'Open' badge
												echo "<div class='listing-badge open'>Open</div>";
											} else {
												// If the current time is not between opening and closing times, display the 'Closed' badge
												echo "<div class='listing-badge closed'>Closed</div>";
											}
										}
										?>
										<div class="bookmark">
										<?php if (isset($_SESSION['login'])): ?>
											<?php if (userBookmarked($row['id'])): ?>
											<span class="bookmark-btn active" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php else: ?>
											<span class="bookmark-btn inactive" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php endif ?>
										<?php else: ?>
											<span data-toggle="modal" data-target="#login-prompt-bookmark"><i class="fa fa-heart stroke-transparent"></i></span>
										<?php endif ?>
										</div>
									</div>
									<div class="card-body listing-details">
										<a href="listing/index.php"><h2 class="card-title"><?php echo $row['listing_name']; ?></h2></a>
										<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $row['listing_address']; ?></div>
										<?php 
										$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
										$row_phone = mysqli_fetch_array($results_phone)
										?>
										<div><i class="fa fa-phone fa-fw"></i> <?php echo $row_phone['phone_number']; ?></div>
									</div>
									<div class="card-footer listing-rating text-muted">
									<?php 
										$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
										$number_of_reviews = mysqli_num_rows($reviews);
										if ($number_of_reviews > 0) {
											$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
											while ($row_sum = mysqli_fetch_array($rating_sum)) {
											$sum = $row_sum['rating_sum'];
											$average = round($sum/$number_of_reviews, 1);
											$average = number_format($average, 1, '.', '');
											}
										}
										else {
											$average = 0;
										}
										?>
										<div class="read-only-rating" data-rateyo-star-width="20px" data-rateyo-read-only="true" data-rateyo-rating="<?php echo $average ?>"></div>
										<?php if ($number_of_reviews < 0 || empty($number_of_reviews)):?>
										<span> (No reviews)</span>
										<?php endif ?>
										<?php if ($number_of_reviews == 1): ?>
										<span> (<?php echo $number_of_reviews ?> review)</span>
										<?php endif ?>
										<?php if ($number_of_reviews > 1): ?>
										<span> (<?php echo $number_of_reviews ?> reviews)</span>
										<?php endif ?>
										<a href="listing/index.php?l_id=<?php echo $row["id"];?>" class="stretched-link"></a>
									</div>
								</div>	
							</div>
							<?php }} ?>
						</div>
					</div>
					<!-- Car Services Tab -->
					<div class="tab-pane" id="tabs-6" role="tabpanel">
						<div class="row">
							<?php
							// Select the top 6 listings under the 'Car Services' category and sort them by their review rating
							$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $autoSalesServicesId");
							// Check if the query returns any rows
							if (mysqli_num_rows($results)==0) {
								// If the query returns no rows, display relevant error message
								echo "<p>There are currently no listings for this category. Please select a different tab.</p>";
							}
							else {
								while ($row = mysqli_fetch_array($results)) {
									$listing_id = $row['id']; // Store listing id in listing_id variable															
							?>
							<div class="col-lg-4 col-md-6">
								<!-- Listing Item -->
								<div class="card mb-4 listing-item shadow">
									<div class="listing-item-pic set-bg" data-setbg="img/restaurant.jpg">
										<div class="listing-category category">
											<span>Auto Sales & Service</span>
										</div>
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
												// If the current time is between opening and closing times, display the 'Open' badge
												echo "<div class='listing-badge open'>Open</div>";
											} else {
												// If the current time is not between opening and closing times, display the 'Closed' badge
												echo "<div class='listing-badge closed'>Closed</div>";
											}
										}
										?>
										<div class="bookmark">
										<?php if (isset($_SESSION['login'])): ?>
											<?php if (userBookmarked($row['id'])): ?>
											<span class="bookmark-btn active" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php else: ?>
											<span class="bookmark-btn inactive" data-id="<?php echo $row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
											<?php endif ?>
										<?php else: ?>
											<span data-toggle="modal" data-target="#login-prompt-bookmark"><i class="fa fa-heart stroke-transparent"></i></span>
										<?php endif ?>
										</div>
									</div>
									<div class="card-body listing-details">
										<a href="listing/index.php"><h2 class="card-title"><?php echo $row['listing_name']; ?></h2></a>
										<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $row['listing_address']; ?></div>
										<?php 
										$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
										$row_phone = mysqli_fetch_array($results_phone)
										?>
										<div><i class="fa fa-phone fa-fw"></i> <?php echo $row_phone['phone_number']; ?></div>
									</div>
									<div class="card-footer listing-rating text-muted">
									<?php 
										$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
										$number_of_reviews = mysqli_num_rows($reviews);
										if ($number_of_reviews > 0) {
											$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
											while ($row_sum = mysqli_fetch_array($rating_sum)) {
											$sum = $row_sum['rating_sum'];
											$average = round($sum/$number_of_reviews, 1);
											$average = number_format($average, 1, '.', '');
											}
										}
										else {
											$average = 0;
										}
										?>
										<div class="read-only-rating" data-rateyo-star-width="20px" data-rateyo-read-only="true" data-rateyo-rating="<?php echo $average ?>"></div>
										<?php if ($number_of_reviews < 0 || empty($number_of_reviews)):?>
										<span> (No reviews)</span>
										<?php endif ?>
										<?php if ($number_of_reviews == 1): ?>
										<span> (<?php echo $number_of_reviews ?> review)</span>
										<?php endif ?>
										<?php if ($number_of_reviews > 1): ?>
										<span> (<?php echo $number_of_reviews ?> reviews)</span>
										<?php endif ?>
										<a href="listing/index.php?l_id=<?php echo $row["id"];?>" class="stretched-link"></a>
									</div>
								</div>	
							</div>
							<?php }} ?>
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

		/* Typed words */
    
		$(document).ready(function () {

		var typed = new Typed('.typed-words', {
		strings: ["Attractions"," Events"," Hotels", " Restaurants"],
		typeSpeed: 80,
		backSpeed: 80,
		backDelay: 4000,
		startDelay: 1000,
		loop: true,
		showCursor: true
		});

		});

		/*Animate on scroll */

		$(document).ready(function () {

		AOS.init();

		});

		</script>

	</body>

</html>
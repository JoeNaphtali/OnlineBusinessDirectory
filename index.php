<?php
    // Start Session
	session_start();
	
	// Database Connection
	include "includes/dbh.inc.php";
	
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

	</head>

	<body>

		<!-- Main Navigation -->

		<nav class="navbar navbar-light clear-navbar navbar-expand-lg fixed-top" data-aos="fade-down">
			<a href="index.php" class="navbar-brand d-flex w-50 mr-auto js-scroll-trigger">FindUs</a>
			<button class="navbar-toggler hamburger-icon" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php
				// Check if the session variable 'login' exists (if the user is logged in) 
				if (isset($_SESSION['login'])) {
						/*<div class='dropdown dropdown-mobile'>
							<a class='btn-cart text-decoration-none' id='navbarDropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' href='#'>
								<i class='fa fa-shopping-cart'></i>
								<span class='badge badge-danger badge-counter'>3+</span>
							</a>
							<div class='dropdown-menu user-dropdown-menu' id='dropdown-menu' aria-labelledby='navbarDropdown'>
							<a class='dropdown-item' href='#'>LOL</a>
							</div>
						</div>*/
					echo "<div class='navbar-mobile-buttons'>
					<div class='dropdown dropdown-mobile'>
						<a href='#' class='btn-myaccount dropdown-toggle text-decoration-none' id='navbarDropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' href='#'>";
						// Check if the user had a profile picture
						if ($profile_picture_status == true) {
							// If user has a profile picture, get the file path of the profile picture
							$filename = "img/profile_pictures/profile_picture_user_".$user_id."*";
							$fileinfo = glob($filename);
							$fileext = explode("_".$user_id.".", $fileinfo[0]);
							$fileactualext = $fileext[1];
							// Display profile button with user's profile picture
							echo "<img class='img-profile rounded-circle' src='img/profile_pictures/profile_picture_user_".$user_id.".".$fileactualext."?".mt_rand()."'>";
						}
						else {
							// Display profile button with default user image
							echo "<img class='img-profile rounded-circle' src='img/profile_pictures/profile_picture_user_default.png'>";
						}
						echo "</a><div class='dropdown-menu user-dropdown-menu' id='dropdown-menu' aria-labelledby='navbarDropdown'>
							<a class='dropdown-item' href='dashboard/index.php'><i class='fa fa-cog fa-fw'></i> Dashboard</a>
							<a class='dropdown-item' href='dashboard/mylistings.php'><i class='fa fa-layer-group fa-fw'></i> My Listings</a>
							<a class='dropdown-item' href='dashboard/myprofile.php'><i class='fa fa-user fa-fw'></i> My Profile</a>
							<form action='includes/logout.inc.php' method='post'>
								<button class='dropdown-item' name='logout'><i class='fa fa-sign-out-alt fa-fw'></i> Log out</button>
							</form>
						</div>
					</div>
				</div>";
				}
			?>
			<div class="navbar-collapse collapse w-100" id="navbar">
				<ul class="navbar-nav w-100 justify-content-center">
					<li class="nav-item current">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="directory/index.php">Directory</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="blog/index.php">Blog</a>
					</li>
				</ul>
				<div class="nav navbar-nav ml-auto w-100 justify-content-end">
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
						echo '<a class="btn btn-login" href="login/index.php"><i class="fa fa-sign-in-alt fa-fw"></i> Login</a>
						';
					}
					?>
					<?php
					if (isset($_SESSION['login'])) {
						echo '<a class="btn btn-addlisting" href="dashboard/addlisting.php"><i class="fa fa-plus-circle fa-fw"></i> Add Listing</a>';
					}
					else {
						echo '<a class="btn btn-addlisting" data-toggle="modal" data-target="#login-prompt"><i class="fa fa-plus-circle fa-fw"></i> Add Listing</a>
						';
					}
					?>
				</div>
			</div>
		</nav>

		<!-- /.Main Navigation -->

		<!-- Modal -->
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
						You must be <a href="login/index.php">logged in</a> in order to add a listing.
					</div>
				</div>
			</div>
		</div>

		<!-- Header -->

		<header class="masthead-home">
			<div class="container h-100">
				<div class="row h-100 align-items-center">
					<div class="col-12 text-center">
						<div class="text-center header-text">
							<h1 data-aos="fade-up">Find Nearby <span class="typed-words"></span></h1>
							<p data-aos="fade-up" class=" w-75 mx-auto">Explore top-rated attractions, activities and more!</p>
						</div>
						<!-- Header Search Form -->
						<div class="form-search-wrap p-2" data-aos="fade-up" data-aos-delay="200">
              				<form method="post">
                				<div class="row align-items-center">
									<div class="col-md-12 col-lg-4 no-sm-border border-right input">
										<input type="text" class="form-control" placeholder="What are you looking for?">
									</div>
									<div class="col-md-12 col-lg-3 no-sm-border border-right input">
										<div class="wrap-icon">
											<input type="text" class="form-control" placeholder="Location">
										</div>
									</div>
									<div class="col-md-12 col-lg-3 input">
										<div class="select-wrap">
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
									</div>
									<div class="col-md-12 col-lg-2 text-right">
										<input type="submit" class="btn text-white btn-primary" value="Search">
									</div>
                  				</div>
              				</form>
						</div>
						<!-- ./Header Search Form -->
						<div class="category-tags" data-aos="fade-up">
							<a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food & Drinks</a>
                            <a href="#"><i class="fa fa-shopping-cart fa-fw stroke-transparent"></i> Shopping</a>
                            <a href="#"><i class="fa fa-bed fa-fw stroke-transparent"></i> Accomodation & Travel</a>
                            <a href="#"><i class="fa fa-car-side fa-fw stroke-transparent"></i> Car Services</a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<!-- /.Header -->

		<!-- Content -->

		<!-- Top Businesses Tabs Panel -->
		<div class="container-fluid page-section-container">
			<div class="row justify-content-center bg-white">
				<div class="col-lg-10 p-3">
					<div class="row section-title-row">
						<div class="col-lg-12">
							<div class="section-title">
								<h2>Top Businesses and Services</h2>
								<p>The best businesses and services recommended by your fellow FindUs users</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="top-businesses-tab">
								<?php
									// Put category ID's into corresponding variables 
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Food & Drinks'");
									$row = mysqli_fetch_array($results);
									$foodDrinkId = $row['id'];
									
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Shopping'");
									$row = mysqli_fetch_array($results);
									$shoppingId = $row['id'];
									
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Accomodation & Travel'");
									$row = mysqli_fetch_array($results);
									$accomodationTravelId = $row['id'];
									
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Salon, Barber & Spa'");
									$row = mysqli_fetch_array($results);
									$salonBarberId = $row['id'];
									
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Home Services'");
									$row = mysqli_fetch_array($results);
									$homeServicesId = $row['id'];
									
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Car Services'");
									$row = mysqli_fetch_array($results);
									$carServicesId = $row['id'];
									
								?>
								<ul class="nav nav-tabs flex-column flex-sm-row" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
											<span class="fa fa-utensils"></span>
											Food & Drinks
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
											Accomodation & Travel
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
											Car Services
										</a>
									</li>
								</ul>
							</div>
							<div class="tab-content">
								<!-- Food & Drinks Tab -->
								<div class="tab-pane active" id="tabs-1" role="tabpanel">
									<div class="row">
										<?php
										// Select the top 6 listings under the 'Food & Drinks' category and sort them by their review rating
										$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $foodDrinkId");
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
												<div class="listing-item-pic set-bg" data-setbg="img/listing/list-1.jpg">
													<div class="listing-category category">
														<a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food & Drinks</a>
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
														<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
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
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-half-alt"></i>
													<span> (1 review)</span>
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
										$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $shoppingId");
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
												<div class="listing-item-pic set-bg" data-setbg="img/listing/list-1.jpg">
													<div class="listing-category category">
														<a href="#"><i class="fa fa-shopping-cart fa-fw stroke-transparent"></i> Shopping</a>
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
														<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
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
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-half-alt"></i>
													<span> (1 review)</span>
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
										$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $accomodationTravelId");
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
												<div class="listing-item-pic set-bg" data-setbg="img/listing/list-1.jpg">
													<div class="listing-category category">
														<a href="#"><i class="fa fa-bed fa-fw stroke-transparent"></i> Accomodation & Travel</a>
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
														<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
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
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-half-alt"></i>
													<span> (1 review)</span>
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
										$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $salonBarberId");
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
												<div class="listing-item-pic set-bg" data-setbg="img/listing/list-1.jpg">
													<div class="listing-category category">
														<a href="#"><i class="fa fa-spa fa-fw stroke-transparent"></i> Salon, Barber & Spa Tab</a>
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
														<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
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
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-half-alt"></i>
													<span> (1 review)</span>
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
										$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $homeServicesId");
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
												<div class="listing-item-pic set-bg" data-setbg="img/listing/list-1.jpg">
													<div class="listing-category category">
														<a href="#"><i class="fa fa-home fa-fw stroke-transparent"></i> Home Services</a>
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
														<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
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
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-half-alt"></i>
													<span> (1 review)</span>
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
										$results = mysqli_query($conn, "SELECT * FROM listing WHERE category_id = $carServicesId");
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
												<div class="listing-item-pic set-bg" data-setbg="img/listing/list-1.jpg">
													<div class="listing-category category">
														<a href="#"><i class="fa fa-car-side fa-fw stroke-transparent"></i> Car Services</a>
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
														<a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
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
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-half-alt"></i>
													<span> (1 review)</span>
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
			</div>
		</div>

		<!-- Latest News and Articles -->
		<div class="container-fluid page-section-container">
			<div class="row justify-content-center bg-white">
				<div class="col-lg-10 p-3">
					<div class="row section-title-row">
						<div class="col-lg-12">
							<div class="section-title">
								<h2>Latest News & Articles</h2>
								<p>Read the latest news, articles, tips and more from our blog</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div>
								<div class="row latest-blog-posts">
									<div class="col-lg-4 col-md-6">
										<div class="card mb-4 blog-item shadow">
											<div class="blog-item-pic set-bg" data-setbg="img/blog/blog-large.jpg">
												<div class="blog-item-date">
													<span class="month">Jul</span>
													<span class="day">05</span>
												</div>
												<div class="blog-item-category category">
													<a href="#"><i class="fa fa-folder-open fa-fw stroke-transparent"></i> Travel</a>
												</div>
												<div class="bookmark">
													<a href="#"><i class="fa fa-glasses stroke-transparent"></i></a>
												</div>
											</div>
											<div class="card-body">
												<h2 class="card-title">Post Title</h2>
												<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
												Reiciendis aliquid atque, nulla?</p>
												<a href="blog/post.php" class="read-more-link">Read More <i class="fa fa-angle-right"></i></a>
											</div>
											<div class="card-footer text-muted">
												By Joseph Wamulume
											</div>
										</div>
									</div>
								</div>
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
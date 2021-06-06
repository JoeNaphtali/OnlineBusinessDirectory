<?php
    // Start Session
	session_start();
	
	// Database Connection and Bookmarking Script
	include "../includes/bookmark.inc.php";
	
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
	
	if (!isset($_GET['keyword_search'])) {
		header("Location: ../index.php");
	}
?>

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
		<!-- Leaflet.js Script -->
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>
		<!-- Local Script -->
        <script type="text/javascript" src="../js/main.js"></script>
		<!-- RateYo CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<!-- RateYo JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

	</head>

	<body>

		<!-- Main Navigation -->

		<?php include '../includes/solidnavbar.inc.php' ?>

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

		<!-- Content -->

		<?php
		
		function reverse_mysqli_real_escape_string($str) {
			return strtr($str, [
				'\0'   => "\x00",
				'\n'   => "\n",
				'\r'   => "\r",
				'\\\\' => "\\",
				"\'"   => "'",
				'\"'   => '"',
				'\Z' => "\x1a"
			]);
		}

		?>

		<div class="container margin-bottom-30">
			<div class="fs-inner-container search-container"> 
				<section class="search">
					<!-- Search Form -->
					<div class="form-search-wrap p-2">
              			<form method="post" action="../includes/search.inc.php">
                			<div class="row align-items-center">
								<div class="col-md-12 col-lg-4 no-sm-border border-right input">
									<?php if (isset($_GET['keyword_search'])):?>
									<input type="text" class="form-control" name="keyword_search" value="<?php echo reverse_mysqli_real_escape_string(($_GET['keyword_search'])); ?>" placeholder="What are you looking for?">
									<?php else :?>
									<input type="text" class="form-control" name="keyword_search" placeholder="What are you looking for?">
									<?php endif ?>
								</div>
								<div class="col-md-12 col-lg-3 no-sm-border border-right input">
									<div class="wrap-icon">
										<?php if (isset($_GET['location_search'])):?>
										<input type="text" class="form-control" name="location_search" value="<?php echo reverse_mysqli_real_escape_string(($_GET['location_search'])); ?>" placeholder="Location">
										<?php else :?>
										<input type="text" class="form-control" name="location_search" placeholder="Location">
										<?php endif ?>
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
					<!-- ./Search Form -->
				</section>
				<section class="listings-container">
					<div class="sort-by padding-left-right-30">
						<div class="sort-listing">
							<span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
							<select class="" name="" id="">
								<option value="">Highest Rated</option>
								<option value="">Most Reviews</option>
								<option value="">Most Viewed</option>
								<option value="">Recently Added</option>
							</select>
						</div>
					</div>
					<?php

						
						if (!empty($_GET['keyword_search']) AND empty($_GET['location_search']) AND empty($_GET['listing_category'])) {
							$keyword_search = $_GET['keyword_search'];
							$sql = "SELECT * FROM listing WHERE listing_name LIKE '%$keyword_search%' OR keywords LIKE '%$keyword_search%'";
						}
						else if (!empty($_GET['keyword_search']) AND !empty($_GET['location_search']) AND empty($_GET['listing_category'])) {
							$keyword_search = $_GET['keyword_search'];
							$location_search = $_GET['location_search'];
							$sql = "SELECT * FROM listing WHERE listing_name LIKE '%$keyword_search%' OR keywords LIKE '%$keyword_search%' AND city_town LIKE '%$location_search%'";
						}
						else if (!empty($_GET['keyword_search']) AND empty($_GET['location_search']) AND !empty($_GET['listing_category'])) {
							$keyword_search = $_GET['keyword_search'];
							$listing_category = $_GET['listing_category'];
							$sql = "SELECT listing.* FROM listing INNER JOIN listing_category ON listing.category_id = listing_category.id WHERE listing_name LIKE '%$keyword_search%' OR keywords LIKE '%$keyword_search%' AND listing_category.id = $listing_category";
						}
						else if (!empty($_GET['keyword_search']) AND !empty($_GET['location_search']) AND !empty($_GET['listing_category'])) {
							$keyword_search = $_GET['keyword_search'];
							$location_search = $_GET['location_search'];
							$listing_category = $_GET['listing_category'];
							$sql = "SELECT listing.* FROM listing INNER JOIN listing_category ON listing.category_id = listing_category.id WHERE listing_name LIKE '%$keyword_search%' OR keywords LIKE '%$keyword_search%' AND city_town LIKE '%$location_search%' AND listing_category.id = $listing_category";
						}
						
						$result = mysqli_query($conn, $sql);
						$queryResults = mysqli_num_rows($result);

						$keyword_search = reverse_mysqli_real_escape_string($keyword_search);

						if ($queryResults == 0) {
							$str = '<div class="padding-left-right-30 margin-bottom-25 margin-top-15">
										There are no listings for "<?php echo $keyword_search?>"
						  			</div>';
							eval("?> $str <?php ");
						} else {
							$str = '<div class="padding-left-right-30 margin-bottom-25 margin-top-15">
										Showing results for "<?php echo $keyword_search ?>"
						  			</div>';
							eval("?> $str <?php ");
					?>
					<div class="listings padding-left-right-30">
						<div class="row">
							<?php
							while ($row = mysqli_fetch_assoc($result)) {
								$listing_id = $row['id']; // Store listing id in listing_id variable
							?>
							<div class="col-lg-4 col-lg-4">
								<div class="card mb-4 listing-item listing-item-small shadow position-relative">
									<div class="listing-item-pic set-bg set-bg-dark" data-setbgdark="../img/listing_pictures/listing_picture_<?php echo $row['id']; ?>.jpg">
										<div class="listing-details">
											<h2 class="card-title"><?php echo $row["listing_name"]; ?></h2>
											<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $row['listing_address']; ?></div>
											<?php 
												$results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
												$row_phone = mysqli_fetch_array($results_phone)
											?>
											<div><i class="fa fa-phone fa-fw"></i> <?php echo $row_phone['phone_number']; ?></div>
											<a href="../listing/index.php?l_id=<?php echo $row["id"];?>" class="stretched-link"></a>
										</div>
										<div class="listing-category category">
											<?php
											$category_id = $row["category_id"]; 
											$results_category = mysqli_query($conn, "SELECT * FROM listing_category WHERE id = $category_id"); 
											$row_category = mysqli_fetch_array($results_category)
											?>
											<span><?php echo $row_category["category"]; ?></span>
											<a href="../listing/index.php?l_id=<?php echo $row["id"];?>" class="stretched-link"></a>
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
											<span class="bookmark-btn-offline" data-toggle="modal" data-target="#login-prompt-bookmark"><i class="fa fa-heart stroke-transparent"></i></span>
										<?php endif ?>
										</div>
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
										<a href="../listing/index.php?l_id=<?php echo $row["id"];?>" class="stretched-link"></a>
									</div>
								</div>
							</div>
							<?php }
							} ?>
						</div>
					</div>
				</section>
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

		<!--/ .Footer -->

		<script>

		var search_map = L.map('map').setView([-15.386283, 28.399378], 17);
		var search_marker = L.marker([-15.386283, 28.399378]).addTo(search_map);

		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
		}).addTo(search_map);

		setInterval(function () {

		search_map.invalidateSize();

		}, 100);
		
		</script>

	</body>

</html>
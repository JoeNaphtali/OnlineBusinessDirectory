<!-- List View -->
<div class="row no-gutters listing-item-horizontal shadow-sm">
    <div class="col-xl-5">
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
    <div class="listing-details listing-details-horizontal col-xl-7">
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

<?php

if (isset($_POST['reset-password'])) {

    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    if (empty($password) || empty($password_repeat)) {
        header("Location: ../forgottenpwd/newpassword.php?emptyfields");
        exit();
    }
    else if ($password != $password_repeat) {
        header("Location: ../forgottenpwd/newpassword.php?newpasswordcheck");
        exit();
    }

    $current_date = date("U");

    require 'dbh.inc.php';

    $sql = "SELECT * FROM password_reset WHERE password_reset_selector=? AND password_reset_expires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $current_date);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$row = mysqli_fetch_assoc($result)) {
            echo "You need to re-submit your reset request.LOL";
            echo $validator;
            echo $selector;
            exit();
        }
        else {
            
            $token_bin = hex2bin($validator);
            $token_check = password_verify($token_bin, $row['password_reset_token']);

            if ($token_check === false) {
                echo "You need to re-submit your reset request.";
                exit();
            }
            else if ($token_check === true) {

                $token_email = $row['password_reset_email'];

                $sql = "SELECT * FROM user WHERE email=?;";

                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error!";
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $token_email);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);
            
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There was an error!";
                        exit();
                    }
                    else {
                        $sql = "UPDATE user SET user_password=? WHERE email=?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error!";
                            exit();
                        }
                        else {
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $token_email);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM password_reset WHERE password_reset_email=?;";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "There was an error!";
                                exit();
                            }
                            else {
                                mysqli_stmt_bind_param($stmt, "s", $token_email);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../login/index.php?password=updated");
                            }                    
                        }
                    }

                }


            }

        }
    }
}
else {

    header("Location: ../index.php");

}
?>

<div class="row">
						<div class="col-lg-12">
							<div class="top-businesses-tab">
								<?php
									// Put category ID's into corresponding variables 
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Restaurants & Nightlife'");
									$row = mysqli_fetch_array($results);
									$foodDrinkId = $row['id'];
									
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Shopping & Retail'");
									$row = mysqli_fetch_array($results);
									$shoppingId = $row['id'];
									
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Lodging & Travel'");
									$row = mysqli_fetch_array($results);
									$accomodationTravelId = $row['id'];
									
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Arts, Culture & Entertainment'");
									$row = mysqli_fetch_array($results);
									$salonBarberId = $row['id'];
									
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Real Estate'");
									$row = mysqli_fetch_array($results);
									$homeServicesId = $row['id'];
									
									$results = mysqli_query($conn, "SELECT * FROM listing_category WHERE category = 'Auto Sales & Service'");
									$row = mysqli_fetch_array($results);
									$carServicesId = $row['id'];
									
								?>
								<ul class="nav nav-tabs flex-column flex-sm-row" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
										<span class="fa fa-utensils"></span>
											Restaurants & Nightlife
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
										<span class="fa fa-shopping-basket"></span>
											Shopping & Retail
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
										<span class="fa fa-bed"></span>
											Lodging & Travel
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
										<span class="fa fa-theater-masks"></span>
											Arts, Culture & Entertainment
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">
										<span class="fa fa-home"></span>
											Real Estate
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">
										<span class="fa fa-car-alt"></span>
											Auto Sales & Service
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
											echo "<p class='no-listings'>There are currently no listings for this category. Please select a different tab.</p>";
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
														<span>Restaurants & Nightlife</span>
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
													<?php 
													$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
													$number_of_reviews = mysqli_num_rows($reviews);
													if ($number_of_reviews > 1) {
														$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
														while ($row_sum = mysqli_fetch_array($rating_sum)) {
														$sum = $row_sum['rating_sum'];
														$average = round($sum/$number_of_reviews, 1);
														$average = number_format($average, 1, '.', '');
														}
													}?>
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
												<?php 
													$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
													$number_of_reviews = mysqli_num_rows($reviews);
													if ($number_of_reviews > 1) {
														$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
														while ($row_sum = mysqli_fetch_array($rating_sum)) {
														$sum = $row_sum['rating_sum'];
														$average = round($sum/$number_of_reviews, 1);
														$average = number_format($average, 1, '.', '');
														}
													}?>
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
												<?php 
													$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
													$number_of_reviews = mysqli_num_rows($reviews);
													if ($number_of_reviews > 1) {
														$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
														while ($row_sum = mysqli_fetch_array($rating_sum)) {
														$sum = $row_sum['rating_sum'];
														$average = round($sum/$number_of_reviews, 1);
														$average = number_format($average, 1, '.', '');
														}
													}?>
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
												<div class="listing-item-pic set-bg" data-setbg="img/restaurant.jpg">
													<div class="listing-category category">
														<span>Salon, Barber & Spa</span>
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
												<?php 
													$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
													$number_of_reviews = mysqli_num_rows($reviews);
													if ($number_of_reviews > 1) {
														$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
														while ($row_sum = mysqli_fetch_array($rating_sum)) {
														$sum = $row_sum['rating_sum'];
														$average = round($sum/$number_of_reviews, 1);
														$average = number_format($average, 1, '.', '');
														}
													}?>
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
												<?php 
													$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
													$number_of_reviews = mysqli_num_rows($reviews);
													if ($number_of_reviews > 1) {
														$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
														while ($row_sum = mysqli_fetch_array($rating_sum)) {
														$sum = $row_sum['rating_sum'];
														$average = round($sum/$number_of_reviews, 1);
														$average = number_format($average, 1, '.', '');
														}
													}?>
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
												<?php 
													$reviews = mysqli_query($conn, "SELECT * FROM review WHERE listing_id=$listing_id");
													$number_of_reviews = mysqli_num_rows($reviews);
													if ($number_of_reviews > 1) {
														$rating_sum = mysqli_query($conn, "SELECT SUM(rating) as rating_sum FROM review WHERE listing_id = $listing_id");
														while ($row_sum = mysqli_fetch_array($rating_sum)) {
														$sum = $row_sum['rating_sum'];
														$average = round($sum/$number_of_reviews, 1);
														$average = number_format($average, 1, '.', '');
														}
													}?>
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
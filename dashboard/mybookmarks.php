<?php
  	// Start Session
	session_start();
	
	// Database Connection
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

	// If user is not logged in, return to home page
	if (!isset($_SESSION['login'])) {
		header("Location: ../index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>My Bookmarks | Find Us</title>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">

	<!-- Custom fonts for this template -->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<!-- RateYo CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <style>
      /* Listing Item */

      .listing-badge {
      float: left;
      position: absolute;
      transform: rotate(45deg);
      right: -64px;
      top: 22px;
      text-align: center;
      width: 200px;
      font-size: 12.5px;
      margin: 0;
      z-index: 109;
      color: #fff;
      font-weight: 500;
      line-height: 28px;
      }

      .listing-badge.open {
      background-color: #54ba1d;
      }

      .listing-badge.closed {
      background-color: #DB4437;
      }

      .listing-item-small .listing-details {
      position: absolute;
      left: 20px;
      bottom: 20px;
      color: #fff;
      padding-right: 70px;
      z-index: 50;
      }

      .card-footer .read-only-rating {
      float: left;
      margin-right: 5px;
      }

      .listing-item {
      overflow: hidden;
      transition: transform 0.4s;
      }

      .listing-item:hover {
      transform: translate(0px, -7px);
      }

      .listing-item-horizontal {
      overflow: hidden;
      border: solid #e7e4e4 1px;
      border-radius: 5px;
      margin-bottom: 30px;
      }

      .listing-item-pic {
      height: 265px;
      position: relative;
      }

      .listing-item-horizontal .listing-item-pic {
      height: 230px;
      position: relative;
      }

      .listing-item-small .listing-item-pic {
      height: 230px;
      position: relative;
      }

      .listing-details h2 {
      font-size: 24px;
      }

      .listing-details a {
      text-decoration: none;
      color: rgb(44, 44, 44);
      }

      .listing-details a:hover {
      color: #DB4437;
      }

      .listing-details-horizontal {
      background-color: #fff;
      z-index: 110;
      padding: 20px!important;
      }

      .listing-details .location {
      padding-bottom: 10px;
      }

      .stretched-link::after {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      z-index: 1;
      pointer-events: auto;
      content: "";
      background-color: rgba(0,0,0,0);
      }

      /* End of Listing Item */

      .category-tags {
      margin-top: 20px;
      }

      .category-tags a {
      background-color: rgba(255, 255, 255, 0.20);
      box-shadow: none;
      font-size: 15px;
      color: #fff;
      display: inline-block;
      padding: 6px 15px 3px;
      border-radius: 50px;
      margin-right: 6px;
      margin-bottom: 10px;
      text-decoration: none;
      }

      .category-tags a:hover {
      color: #fff;
      background: #811D5E;
      }

      .listing-category {
      position: absolute;
      left: 20px;
      bottom: 20px;
      }

      .listing-item-small .listing-category {
      position: absolute;
      left: 20px;
      top: 20px;
      z-index: 10;
      }

      .category span {
      box-shadow: none;
      font-size: 15px;
      color: #fff;
      display: inline-block;
      padding: 6px 15px 6px;
      border-radius: 50px;
      text-decoration: none;
      background-color: #811D5E;
      }

      .blog-item-category {
      position: absolute;
      left: 20px;
      bottom: 20px;
      }

      .bookmark {
      position: absolute;
      right: 20px;
      bottom: 20px;    
      z-index: 101;
      }

      .bookmark span {
      text-decoration: none;
      color: #fff;
      background-color: rgba(255, 255, 255, 0.25);
      padding: 6px 6px 6px 6px;
      border-radius: 50%;
      font-size: 15px;
      height: 40px;
      width: 40px;
      border-radius: 50%;
      line-height: 34px;
      text-align: center;
      display: inline-block;
      text-decoration: none;
      }

      .bookmark .active {
      background-color: #d13628;
      }

      .blog-tags span {
      font-weight: bold;
      margin-right: 5px;
      }

      .blog-tags a {
      font-size: 12px;
      color: #a8a8a8;
      font-weight: 700;
      display: inline-block;
      background: #f2f2f2;
      padding: 6px 12px 6px;
      border-radius: 50px;
      margin-right: 6px;
      margin-bottom: 10px;
      text-decoration: none;
      }

      .blog-tags a:hover {
      color: #fff;
      background: #811D5E;
      }

      /* End of Catergories, Tags and Bookmarks */
  </style>

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
				<div class="sidebar-brand-text mx-3">FindUs</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item">
				<a class="nav-link" href="index.php">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Listings
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link" href="addlisting.php">
				<i class="fas fa-fw fa-plus-circle"></i>
				<span>Add Listing</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="mylistings.php">
				<i class="fas fa-fw fa-layer-group"></i>
				<span>My Listings</span></a>
			</li>

			<li class="nav-item active">
				<a class="nav-link" href="mybookmarks.php">
				<i class="fas fa-fw fa-heart"></i>
				<span>Bookmarks</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Account
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link" href="myprofile.php">
				<i class="fas fa-fw fa-user-alt"></i>
				<span>My Profile</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="charts.html">
				<i class="fas fa-fw fa-sign-out-alt"></i>
				<span>Logout</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!-- Return to home -->
						<li class="nav-item mx-1">
							<a class="nav-link" href="../index.php">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">Back to home page</span><i class="fas fa-home fa-fw"></i>
							</a>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">My Bookmarks</h1>
						<div id="rateYo"></div>
					</div>

					<!-- Content Row -->
					<div class="row">
                        <?php 
						// Select all listing from the 'listings' that match the logged in user's id
						$results = mysqli_query($conn, "SELECT * FROM bookmark WHERE user__id = $user_id");
						if (mysqli_num_rows($results)==0) {
							echo "<p style='margin-left: 14px;'>There are currently no bookmarks for this account.";
						}
						else {
							while ($row = mysqli_fetch_array($results)) {
                                $listing_id = $row['listing_id'];
                                $listing_results = mysqli_query($conn, "SELECT * FROM listing WHERE id = $listing_id");	
                                $listing_row = mysqli_fetch_array($listing_results);													 
								?>
						<div class="col-lg-4 col-lg-4">
                            <div class="card mb-4 listing-item listing-item-small shadow position-relative">
                                <div class="listing-item-pic set-bg set-bg-dark" data-setbgdark="../img/listing_pictures/listing_picture_<?php echo $listing_row['id']; ?>.jpg">
                                    <div class="listing-details">
                                        <h2 class="card-title"><?php echo $listing_row["listing_name"]; ?></h2>
                                        <div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $listing_row['listing_address']; ?></div>
                                        <?php 
                                            $results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
                                            $row_phone = mysqli_fetch_array($results_phone)
                                        ?>
                                        <div><i class="fa fa-phone fa-fw"></i> <?php echo $row_phone['phone_number']; ?></div>
                                        <a href="../listing/index.php?l_id=<?php echo $listing_row["id"];?>" class="stretched-link"></a>
                                    </div>
                                    <div class="listing-category category">
                                        <?php
                                        $category_id = $listing_row["category_id"]; 
                                        $results_category = mysqli_query($conn, "SELECT * FROM listing_category WHERE id = $category_id"); 
                                        $row_category = mysqli_fetch_array($results_category)
                                        ?>
                                        <span><?php echo $row_category["category"]; ?></span>
                                        <a href="../listing/index.php?l_id=<?php echo $listing_row["id"];?>" class="stretched-link"></a>
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
                                        <?php if (userBookmarked($listing_row['id'])): ?>
                                        <span class="bookmark-btn active" data-id="<?php echo $listing_row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
                                        <?php else: ?>
                                        <span class="bookmark-btn inactive" data-id="<?php echo $listing_row['id']; ?>"><i class="fa fa-heart stroke-transparent"></i></span>
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
                                    <a href="../listing/index.php?l_id=<?php echo $listing_row["id"];?>" class="stretched-link"></a>
                                </div>
                            </div>
						</div>
                        <?php }} ?>
					</div>

				</div>
				<!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <!-- RateYo JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

  <!-- Set Background Image -->
  <script>
  	$('.set-bg').each(function () {
    	var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    $('.set-bg-dark').each(function () {
        var bg = $(this).data('setbgdark');
        $(this).css('background-image', 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + bg + ')');
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(window).scroll(function(){
        $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
    });

	$(function () {
 
		$(".read-only-rating").rateYo();

	});

    // if the user clicks the 'bookmark' button
    $('.bookmark-btn').on('click', function(){
      var listing_id = $(this).data('id');
      $clicked_btn = $(this);
      if ($clicked_btn.hasClass('inactive')) {
        action = 'bookmark';
      }
      else if ($clicked_btn.hasClass('active')) {
        action = 'removebookmark';
      }
      $.ajax({
        type: 'post',
        data: {
          'action': action,
          'listing_id': listing_id
        },
        success: function(data){ 
          var res = JSON.parse(JSON.stringify(data));     
          if (action == "bookmark") {
            $clicked_btn.removeClass('inactive');
            $clicked_btn.addClass('active');
          } else if(action == "removebookmark") {
            $clicked_btn.removeClass('active');
            $clicked_btn.addClass('inactive');
          }
  
          // Change button styling of the dislike button if user is reacting for the second time to an idea
          $clicked_btn.siblings('i.active').removeClass('active').addClass('inactive');
        }
      })
  
    });
  </script>

</body>

</html>

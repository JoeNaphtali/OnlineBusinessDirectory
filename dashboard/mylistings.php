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

	<title>My Listings | Find Us</title>

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

			<li class="nav-item active">
				<a class="nav-link" href="mylistings.php">
				<i class="fas fa-fw fa-layer-group"></i>
				<span>My Listings</span></a>
			</li>

			<li class="nav-item">
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
						<h1 class="h3 mb-0 text-gray-800">My Listings</h1>
						<div id="rateYo"></div>
					</div>

					<!-- Content Row -->
					<div class="row">

						<div class="col-md-12">
								<?php 
									// Select all listing from the 'listings' that match the logged in user's id
									$results = mysqli_query($conn, "SELECT * FROM listing WHERE owner_id = $user_id");
									if (mysqli_num_rows($results)==0) {
										echo "<p>There are no listings for this account. Click <a href='addlisting.php'>here<a/> to add a listing.</p>";
									}
									else {
										while ($row = mysqli_fetch_array($results)) {
											$listing_id = $row['id'];															 
								?>
								<div class="row no-gutters shadow listing-item-horizontal">
									<div class="col-lg-4">
										<div class="listing-item-pic set-bg" data-setbg="../img/listing_pictures/listing_picture_<?php echo $listing_id ?>.jpg">
										</div>
									</div>
									<div class="listing-details listing-details-horizontal col-lg-8">
										<div class="listing-details-horizontal-body">
											<a href="../listing/index.php"><h2 class="card-title"><?php echo $row['listing_name']; ?></h2></a>
											<div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> <?php echo $row['listing_address']; ?></div>
											<?php $results_phone = mysqli_query($conn, "SELECT * FROM listing_phone_number WHERE listing_id = $listing_id AND number_rank = 1"); 
												while ($row_phone = mysqli_fetch_array($results_phone)) {
											?>
											<div class="phone"><i class="fa fa-phone fa-fw"></i> <?php echo $row_phone['phone_number']; ?></div>
											<?php } ?>
											<div class="listing-item-buttons">
												<a class="btn btn-large btn-edit bg-success" href="editlisting.php?l_id=<?php echo $listing_id;?>">
													<i class="fa fa-pencil-alt fa-fw"></i> Edit
												</a>
												<a class="btn btn-large btn-delete bg-danger" href="../includes/deletelisting.inc.php?delete=<?php echo $listing_id; ?>">
													<i class="fa fa-trash-alt fa-fw"></i> Delete
												</a>
												<a class="btn btn-large btn-statistics bg-info" href="analytics.php?l_id=<?php echo $listing_id;?>">
													<i class="fa fa-chart-bar fa-fw"></i> Analytics
												</a>

												<a class="btn btn-small btn-edit bg-success" href="#">
													<i class="fa fa-pencil-alt fa-fw"></i>
												</a>
												<a class="btn btn-small btn-delete bg-danger" href="#">
													<i class="fa fa-trash-alt fa-fw"></i>
												</a>
												<a class="btn btn-small btn-statistics bg-info" href="#">
													<i class="fa fa-chart-bar fa-fw"></i>
												</a>
											</div>
										</div>
										<div class="listing-item-horizontal-footer text-muted">
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
											<div class="listing-views text-muted">
												<i class="fa fa-eye"></i>
												<?php
												$visits = mysqli_query($conn, "SELECT * FROM analytics WHERE listing_id=$listing_id");
												$row_visits = mysqli_fetch_array($visits);
												?>	
												<span><?php echo $row_visits['visits']; ?></span>									
											</div>
										</div>
									</div>
									
								</div>
								<?php }} ?>
						</div>

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

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(window).scroll(function(){
        $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
    });

	$(function () {
 
		$(".read-only-rating").rateYo();

	});
  </script>

</body>

</html>

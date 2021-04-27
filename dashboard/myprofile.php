<?php
    // Start Session
    session_start();
    
    // Database Connection
    include "../includes/dbh.inc.php";
    
    // If the user is logged in, store session varibles 
    if (isset($_SESSION['login'])) {
      $user_id = $_SESSION['user_id'];
    }

    // If user is not logged in, return to home page
    if (!isset($_SESSION['login'])) {
      header("Location: ../index.php");
	}
	
	$update = false;

	// If user clicked the edit button
	if (isset($_GET['edit'])) {
		$update = true;
	}

	$user_id = $_SESSION['user_id'];

	// Retrieve user from 'user' table
	$results = mysqli_query($conn, "SELECT * FROM user WHERE id = $user_id");
	$row = mysqli_fetch_array($results);
	
	$profile_picture_status = $row['profile_picture_status'];
	$email = $row['email'];
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>My Profile | Find Us</title>

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
			<li class="nav-item active">
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
						<h1 class="h3 mb-0 text-gray-800">My Profile</h1>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="section shadow margin-bottom-30">
								<form action="../includes/editprofile.inc.php" method="post">
									<?php 
										if (isset($_GET['update'])) {
											// Display success message if user details were saved successfully
											if ($_GET['update'] == "success") {

											}
										}
									?>
									<div class="form-group" hidden>
										<label>ID</label>
										<input class="form-control" name="id" value="<?php echo $row['id']; ?>">
									</div>
									<div class="form-group">
										<label>First Name</label>
										<?php if ($update == true): ?>
										<input class="form-control" name="first_name" required value="<?php echo $row['first_name']; ?>">
										<?php else: ?>
										<input class="form-control" name="first_name" required value="<?php echo $row['first_name']; ?>" disabled>
										<?php endif ?>
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<?php if ($update == true): ?>
										<input class="form-control" name="last_name" required value="<?php echo $row['last_name']; ?>">
										<?php else: ?>
										<input class="form-control" name="last_name" required value="<?php echo $row['last_name']; ?>" disabled>
										<?php endif ?>
									</div>
									<div class="form-group">
										<label>Email Address</label>
										<?php if ($update == true): ?>
										<input class="form-control" name="email" required value="<?php echo $row['email']; ?>">
										<?php else: ?>
										<input class="form-control" name="email" required value="<?php echo $row['email']; ?>" disabled>
										<?php endif ?>
									</div>
									<!--
									<div class="form-group" hidden>
										<label>Profile Picture Status</label>
										<input class="form-control" name="profile_picture_status" value="<?php echo $row['profile_picture_status']; ?>">
									</div>
									<div class="form-group">
										<label>Update Profile Picture (Optional)</label>
										<?php if ($update == true): ?>
										<input class="form-control-file" type="file" name="profile_picture" id="profile_picture">
										<?php else: ?>
										<input class="form-control-file" type="file" name="profile_picture" id="profile_picture" disabled>
										<?php endif ?>
										<div class="image-preview" id="imagePreview">
										<?php
										/*
										if ($profile_picture_status == true) {
											$filename = "../img/profile_pictures/profile_picture_user_".$user_id."*";
											$fileinfo = glob($filename);
											$fileext = explode("_".$user_id.".", $fileinfo[0]);
											$fileactualext = $fileext[1];
											echo "<img src='../img/profile_pictures/profile_picture_user_".$user_id.".".$fileactualext."?".mt_rand()."' alt='Image Preview' class='image-preview__image'>";
										}
										else {
											echo "<img src='../img/profile_pictures/profile_picture_user_default.png' alt='Image Preview' class='image-preview__image'>";
										}
										*/
										?>									
											<span class="image-preview__default-text"></span>
										</div>
									</div>
									-->
									<?php if ($update == true): ?>
									<button class="btn btn-warning" type="submit" name="save">Save</button>
									<a href="myprofile.php" class="btn btn-info" name="cancel">Cancel</a>
									<?php else: ?>
									<a href="myprofile.php?edit=<?php echo $user_id; ?>" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Edit</a>
									<?php endif ?>
								</form>
							</div>
						</div>
						<div class="col-md-6">
							<div class="section shadow margin-bottom-30">
								<form action="../includes/changepassword.inc.php" method="post">
									<div class="form-group" hidden>
										<label>ID</label>
										<input class="form-control" name="id" value="<?php echo $row['id']; ?>">
									</div>
									<div class="form-group" hidden>
										<label>Current Password</label>
										<input class="form-control" name="current_password" value="<?php echo $row['user_password']; ?>">
									</div>
									<div class="form-group">
										<label>Current Password</label>
										<input class="form-control" type="password" name="repeat_current_password" required>
									</div>
									<div class="form-group">
										<label>New Password</label>
										<input class="form-control" type="password" name="new_password" required>
									</div>
									<div class="form-group">
										<label>Confirm New Password</label>
										<input class="form-control" type="password" name="repeat_new_password" required>
									</div>
									<button class="btn btn-primary" type="submit" name="change-password"><i class="fa fa-edit fa-fw"></i> Change Password</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</div>
    		<!-- End of Main Content -->
		</div>
    	<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

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

		<script>
			
			const profilePicture = document.getElementById("profile_picture");
			const previewContainer = document.getElementById("imagePreview");
			const previewImage = previewContainer.querySelector(".image-preview__image");
			const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

			profilePicture.addEventListener("change", function() {
				const file = this.files[0];

				if (file) {
					const reader = new FileReader();
					previewDefaultText.style.display = "none";
					previewImage.style.display = "block";

					reader.addEventListener("load", function() {
						previewImage.setAttribute("src", this.result);
					});

					reader.readAsDataURL(file);
				}
				else {
					previewDefaultText.style.display = null;
					previewImage.style.display = null;
					previewImage.setAttribute("src", "");
				}
			});

		</script>	

</body>

</html>

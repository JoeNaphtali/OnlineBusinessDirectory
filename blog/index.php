<?php
    // Start Session
	session_start();
	
	// Database Connection
	include "../includes/dbh.inc.php";
	
	// If the user is logged in, store session varibles 
	if (isset($_SESSION['login'])) {
		$user_id = $_SESSION['user_id'];
		$profile_picture = $_SESSION['profile_picture'];
		$email = $_SESSION['email'];
		$first_name = $_SESSION['first_name'];
		$last_name = $_SESSION['last_name'];
  	}
?>

<html lang="en">

    <head>

		<title>Blog | FindUs</title>
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
		<link rel="stylesheet" type="text/css" href="../css/style.css">	
		<!-- Local Script -->
		<script type="text/javascript" src="../js/main.js"></script>

	</head>

	<body>

		<!-- Main Navigation -->

		<nav class="navbar navbar-light solid-navbar navbar-expand-lg fixed-top">
			<a href="../index.php" class="navbar-brand d-flex w-50 mr-auto js-scroll-trigger">FindUs</a>
			<button class="navbar-toggler hamburger-icon" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php 
				if (isset($_SESSION['login'])) {
					echo "<div class='navbar-mobile-buttons'>
					<div class='dropdown dropdown-mobile'>
						<a href='#' class='btn-myaccount dropdown-toggle text-decoration-none' id='navbarDropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' href='#'>";
						if ($profile_picture == true) {
							$filename = "../img/profile_pictures/profile_picture_user_".$user_id."*";
							$fileinfo = glob($filename);
							$fileext = explode("_".$user_id.".", $fileinfo[0]);
							$fileactualext = $fileext[1];
							echo "<img class='img-profile rounded-circle' src='../img/profile_pictures/profile_picture_user_".$user_id.".".$fileactualext."?".mt_rand()."'>";
						}
						else {
							echo "<img class='img-profile rounded-circle' src='../img/profile_pictures/profile_picture_user_default.png'>";
						}
						echo "</a><div class='dropdown-menu user-dropdown-menu' id='dropdown-menu' aria-labelledby='navbarDropdown'>
							<a class='dropdown-item' href='../dashboard/index.php'><i class='fa fa-cog fa-fw'></i> Dashboard</a>
							<a class='dropdown-item' href='../dashboard/mylistings.php'><i class='fa fa-layer-group fa-fw'></i> My Listings</a>
							<a class='dropdown-item' href='../dashboard/mylistings.php'><i class='fa fa-user fa-fw'></i> My Profile</a>
							<form action='../includes/logout.inc.php' method='post'>
								<button class='dropdown-item' name='logout'><i class='fa fa-sign-out-alt fa-fw'></i> Log out</button>
							</form>
						</div>
					</div>
				</div>";
				}
			?>
			<div class="navbar-collapse collapse w-100" id="navbar">
				<ul class="navbar-nav w-100 justify-content-center">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="../directory/index.php">Directory</a>
					</li>
					<li class="nav-item current">
						<a class="nav-link js-scroll-trigger" href="../blog/index.php">Blog</a>
					</li>
				</ul>
				<div class="nav navbar-nav ml-auto w-100 justify-content-end">
					<?php
					if (isset($_SESSION['login'])) {
						echo '<div class="navbar-buttons"><div class="dropdown no-arrow cart"><div class="dropdown"><a class="btn-myaccount dropdown-toggle text-decoration-none" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">';
						if ($profile_picture == true) {
							$filename = "../img/profile_pictures/profile_picture_user_".$user_id."*";
							$fileinfo = glob($filename);
							$fileext = explode("_".$user_id.".", $fileinfo[0]);
							$fileactualext = $fileext[1];
							echo "<img class='img-profile rounded-circle' src='../img/profile_pictures/profile_picture_user_".$user_id.".".$fileactualext."?".mt_rand()."'>";
						}
						else {
							echo "<img class='img-profile rounded-circle' src='../img/profile_pictures/profile_picture_user_default.png'>";
						}
								
						echo '</a>
						<div class="dropdown-menu user-dropdown-menu" id="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="../dashboard/index.php"><i class="fa fa-cog fa-fw"></i> Dashboard</a>
							<a class="dropdown-item" href="../dashboard/mylistings.php"><i class="fa fa-layer-group fa-fw"></i> My Listings</a>
							<a class="dropdown-item" href="../dashboard/mylistings.php"><i class="fa fa-user fa-fw"></i> My Profile</a>
							<form action="../includes/logout.inc.php" method="post">
								<button class="dropdown-item" name="logout"><i class="fa fa-sign-out-alt fa-fw"></i> Log out</button>
							</form>
						</div>
					</div>
					</div>';
					}
					else {
						echo '<a class="btn btn-login" href="../login/index.php"><i class="fa fa-sign-in-alt fa-fw"></i> Login</a>
						';
					}
					?>
					<?php
					if (isset($_SESSION['login'])) {
						echo '<a class="btn btn-addlisting" href="../dashboard/addlisting.php"><i class="fa fa-plus-circle fa-fw"></i> Add Listing</a>';
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

		<!-- Content -->

		<div class="container">
			<div class="row">
				<!-- Blog Entries Column -->
      			<div class="col-lg-8 blog-enteries-column">

					<div class="row blog-section-title-row">
						<div class="col-lg-12">
							<div class="section-title">
								<h2>Welcome to our blog</h2>
								<p>Read the latest news, articles, tips and more from talented authors</p>
							</div>
						</div>
					</div>

					<!-- Blog Post -->
					<div class="blog-item-large mb-4 card shadow" data-aos="flip-left">
						<div class="blog-item-large-pic set-bg" data-setbg="../img/blog/blog-large.jpg">
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
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
							<a href="post.php" class="read-more-link">Read More <i class="fa fa-angle-right"></i></a>
						</div>
						<div class="card-footer text-muted">
							by Joseph Wamulume
						</div>
					</div>

					<!-- Pagination -->
					<ul class="pagination justify-content-center mb-4">
						<li class="page-item">
							<a class="page-link" href="#">&larr; Older</a>
						</li>
						<li class="page-item disabled">
							<a class="page-link" href="#">Newer &rarr;</a>
						</li>
					</ul>

				</div>

				<!-- Sidebar Widgets Column -->
				<div class="col-lg-4 sidebar-widgets-column">

					<!-- Search Form -->
					<div class="card shadow search-widget">
						<form>
							<div class="card-body">
								<div class="input-group">
									<input type="search" class="form-control border-right-0" placeholder="Search">
									<span class="input-group-prepend">
										<button class="btn input-group-text bg-white border-left-0">
											<i class="fa fa-search"></i>
										</button>
									</span>
								</div>
							</div>
						</form>
					</div>

					<!-- Categories -->
					<div class="card shadow categories-widget">
						<h5 class="card-header">Categories</h5>
						<div class="card-body">
							<ul>
								<li>
									<a href="">Travel</a>
								</li>
								<li>
									<a href="">News</a>
								</li>
								<li>
									<a href="">Finance</a>
								</li>
								<li>
									<a href="">Music</a>	
								</li>
								<li>
									<a href="">Design</a>
								</li>
								<li>
									<a href="">Animals</a>
								</li>
							</ul>
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

	</body>

</html>
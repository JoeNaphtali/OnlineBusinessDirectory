        <nav class="navbar navbar-light clear-navbar navbar-expand-lg fixed-top" data-aos="fade-down">
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
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="../blog/index.php">Blog</a>
					</li>
				</ul>
				<div class="nav navbar-nav ml-auto w-100 justify-content-end">
					<?php
					if (isset($_SESSION['login'])) {
						echo '<div class="navbar-buttons"><div class="dropdown"><a class="btn-myaccount dropdown-toggle text-decoration-none" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">';
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
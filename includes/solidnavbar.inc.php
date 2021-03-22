<nav class="navbar navbar-light solid-navbar navbar-expand fixed-top" data-aos="fade-down">
			<a href="../index.php" class="navbar-brand js-scroll-trigger">FindUs</a>
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
							<a class="dropdown-item" href="../dashboard/myprofile.php"><i class="fa fa-user fa-fw"></i> My Profile</a>
							<form action="../includes/logout.inc.php" method="post">
								<button class="dropdown-item" name="logout"><i class="fa fa-sign-out-alt fa-fw"></i> Log out</button>
							</form>
						</div>
					</div>
					</div>';
					}
					else {
						echo '<a class="btn btn-login" href="../login/index.php"><i class="fa fa-sign-in-alt fa-fw"></i> Login</a>';
						echo '<a class="btn btn-login navbar-mobile-btn" href="login/index.php"><i class="fa fa-sign-in-alt"></i></a>';
					}
					?>
					<?php
					if (isset($_SESSION['login'])) {
						echo '<a class="btn btn-addlisting" href="../dashboard/addlisting.php"><i class="fa fa-plus-circle fa-fw"></i> Add Listing</a>';
						echo '<a class="btn btn-addlisting navbar-mobile-btn" href="../dashboard/addlisting.php"><i class="fa fa-plus-circle"></i></a>';
					}
					else {
						echo '<a class="btn btn-addlisting" data-toggle="modal" data-target="#login-prompt"><i class="fa fa-plus-circle fa-fw"></i> Add Listing</a>';
						echo '<a class="btn btn-addlisting navbar-mobile-btn" data-toggle="modal" data-target="#login-prompt" href="../dashboard/addlisting.php"><i class="fa fa-plus-circle"></i></a>';
					}
					?>
				</div>
			</div>
		</nav>
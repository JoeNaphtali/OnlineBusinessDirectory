<?php
    // Start Session
	session_start();
	
	// Database Connection
	include "../includes/dbh.inc.php";
	
	// If the user is logged in, store session varibles 
	if (isset($_SESSION['login'])) {
		header("Location: ../index.php");
		exit;
	}
?>

<html lang="en">

    <head>

		<title>Register | FindUs</title>
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
		<script type="text/javascript" src="../js/script.js"></script>

	</head>

	<body>

		<!-- Main Navigation -->

		<nav class="navbar navbar-light solid-navbar navbar-expand fixed-top" data-aos="fade-down">
			<a href="../index.php" class="navbar-brand js-scroll-trigger">FindUs</a>
		</nav>

		<!-- /.Main Navigation -->

        <!-- Registration Form -->

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="registration-form col-lg-8 bg-light px-0 shadow">
                    <form class="p-4 bg-white" action="../includes/register.inc.php" method="post" enctype="multipart/form-data">
						<?php 
						// Error messages
						if (isset($_GET['error'])) {
							if ($_GET['error'] == "nofirstname") {
								echo '<div class="text-center error-message">
								<p class="text-white">Please enter a first name.</p>
								</div>';
							}
							else if ($_GET['error'] == "nolastname") {
								echo '<div class="text-center error-message">
								<p class="text-white">Please enter a last name.</p>
								</div>';
							}
							else if ($_GET['error'] == "noemail") {
								echo '<div class="text-center error-message">
								<p class="text-white">Please enter an email address.</p>
								</div>';
							}
							else if ($_GET['error'] == "nopassword") {
								echo '<div class="text-center error-message">
								<p class="text-white">Please enter a password.</p>
								</div>';
							}
							else if ($_GET['error'] == "norepeat") {
								echo '<div class="text-center error-message">
								<p class="text-white">Please repeat your password.</p>
								</div>';
							}
							else if ($_GET['error'] == "invalidfname") {
								echo '<div class="text-center error-message">
								<p class="text-white">Please enter a valid first name. (Letters only)</p>
								</div>';
							}
							else if ($_GET['error'] == "invalidlname") {
								echo '<div class="text-center error-message">
								<p class="text-white">Please enter a valid last name. (Letters only)</p>
								</div>';
							}
							else if ($_GET['error'] == "invalidemail") {
								echo '<div class="text-center error-message">
								<p class="text-white">Please enter a valid email address.</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordshort") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your password is too short. (Password needs to be at least 8 characters long with at least one digit, one special character, one small letter, one capital letter and no whitespace)
								</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordnodigit") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your password should contain at least one digit. (Password needs to be at least 8 characters long with at least one digit, one special character, one small letter, one capital letter and no whitespace)
								</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordnocapitalletter") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your password should contain at least one capital letter. (Password needs to be at least 8 characters long with at least one digit, one special character, one small letter, one capital letter and no whitespace)
								</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordnosmallletter") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your password should contain at least one small letter. (Password needs to be at least 8 characters long with at least one digit, one special character, one small letter, one capital letter and no whitespace)
								</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordwhitespace") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your password should not contain any whitespace. (Password needs to be at least 8 characters long with at least one digit, one special character, one small letter, one capital letter and no whitespace)
								</p>
								</div>';
							}
							else if ($_GET['error'] == "passwordcheck") {
								echo '<div class="text-center error-message">
								<p class="text-white">
								Your passwords do not match.
								</p>
								</div>';
							}
							else if ($_GET['error'] == "emailtaken") {
								echo '<div class="text-center error-message">
								<p class="text-white">This email address is already taken.</p>
								</div>';
							}
							else if ($_GET['error'] == "emailtaken") {
								echo '<div class="text-center error-message">
								<p class="text-white">This email address is already taken.</p>
								</div>';
							}
							else if ($_GET['error'] == "largeimg") {
								echo '<div class="text-center error-message">
								<p class="text-white">The image uploaded is too large. Image should be less than 5Mb.</p>
								</div>';
							}
							else if ($_GET['error'] == "unknownerror") {
								echo '<div class="text-center error-message">
								<p class="text-white">There was an error uploading your image, please retry.</p>
								</div>';
							}
							else if ($_GET['error'] == "invalidfile") {
								echo '<div class="text-center error-message">
								<p class="text-white">The image you uploaded is of an invalid file type. Please use png, jpg or jpeg images.</p>
								</div>';
							}
						}
						?>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>First Name</label>
								<?php if (isset($_GET['fname'])):?>
								<input class="form-control" type="text" name="first_name" value="<?php echo ($_GET['fname']); ?>" required>
								<?php else :?>
								<input class="form-control" type="text" name="first_name" required>
								<?php endif ?>
							</div>
							<div class="form-group col-md-6">
								<label>Last Name</label>
								<?php if (isset($_GET['lname'])):?>
								<input class="form-control" type="text" name="last_name" value="<?php echo ($_GET['lname']); ?>" required>
								<?php else :?>
								<input class="form-control" type="text" name="last_name" required>
								<?php endif ?>
							</div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
							<?php if (isset($_GET['email'])):?>
                            <input class="form-control" type="email" name="email" value="<?php echo ($_GET['email']); ?>" required>
							<?php else :?>
							<input class="form-control" type="email" name="email" required>
							<?php endif ?>
                        </div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Password</label>
								<input class="form-control" type="password" name="password">
							</div>
                            <div class="form-group col-md-6">
                                <label>Repeat Password</label>
                                <input class="form-control" type="password" name="password_repeat">
                            </div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Profile Picture (Optional)</label>
								<input class="form-control-file" type="file" name="profile_picture" id="profile_picture">
								<div class="image-preview" id="imagePreview">
									<img src="" alt="Image Preview" class="image-preview__image">
									<span class="image-preview__default-text">Image Preview</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-block btn-submit" type="submit" name="register">Register</button>
						</div>
						<div class="form-group">
							<small>By registering, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</small>
						</div>
						<div class="form-group">
							Already on FindUs? <a href="../login/index.php">Login</a>
						</div>
					</form>
                </div>
            </div>
        </div>

		<!-- /.Registration Form -->
		
		<!-- Footer

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

		/.Footer -->

		<script>
			
			const profilePicture = document.getElementById("photo");
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
<html lang="en">

    <head>

		<title>Blogs | FindUs</title>
        <meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
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

		<nav class="navbar main-navbar navbar-light navbar-expand-lg bg-faded justify-content-center static-top">
			<a href="../index.php" class="navbar-brand d-flex w-50 mr-auto">FindUs</a>
			<!-- Search Button -->
			<button class="navbar-toggler search-icon" type="button" data-toggle="collapse" data-target="#search-bar">
				<span class="fa fa-search"></span>
			</button>
			<!-- Hamburger Menu Button -->
			<button class="navbar-toggler hamburger-icon" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!-- Navbar Search Form -->
			<div class="search-collapse collapse w-100" id="search-bar">
				<form>
					<div class="form-row">
						<div class="form-group col-md-5">
							<div class="input-group">
								<span class="input-group-prepend">
									<div class="input-group-text bg-white border-right-0">
										<i class="fa fa-search"></i>
									</div>
								</span>
								<input class="form-control border-left-0 border-right-0" type="search" placeholder="What are you looking for?"/>
							</div>
						</div>
						<div class="form-group col-md-5">
							<div class="input-group">
								<span class="input-group-prepend">
									<div class="input-group-text bg-white border-right-0">
										<i class="fa fa-map-marker-alt"></i>
									</div>
								</span>
								<input class="form-control border-left-0" type="search" placeholder="Where? Province, City, Town"/>
							</div>
						</div>
						<div class="form-group col-md-2">
							<button class="btn btn-search">Search</button>
						</div>								
					</div>
				</form>
			</div>
			<!-- Navigation Menu -->
			<div class="navbar-collapse collapse w-100" id="navbar">
				<ul class="navbar-nav w-100 justify-content-center">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../categories/index.php">Categories</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../promotions/index.php">Promotions</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../events/index.php">Events</a>
					</li>
					<li class="nav-item current">
						<a class="nav-link" href="index.php">Blog</a>
					</li>
				</ul>
				<div class="nav navbar-nav ml-auto w-100 justify-content-end">
					<a class="btn btn-addlisting" href="#">Add Listing</a>
					<a class="btn btn-login" href="../login/index.php">Login</a>
				</div>
			</div>
		</nav>

		<!-- /.Main Navigation -->

		<!-- Content -->

		<div class="container">
			<div class="row">
				<!-- Blog Content Column -->
				<div class="col-lg-8 page-section-no-banner">
					<div class="blog__item__large">
                        <div class="blog__item__pic set-bg" data-setbg="../img/blog/blog-large.jpg">
                        </div>
                        <div class="blog__item__text">
                            <h3><a href="#">Internet Banner Advertising Most Reliable</a></h3>
                            <ul class="blog__item__widget">
                                <li><i class="fa fa-clock-o"></i> 19th March, 2019</li>
                                <li><i class="fa fa-user"></i> John Smith</li>
                            </ul>
                            <p>One of my favourite things I like to watch is the bloopers and outtakes that are shown of
                                mistakes made during the making of a movie.</p>
                        </div>
                    </div>
                    <div class="blog__details__tags p-3 bg-white shadow" style="border-radius: 5px;">
                        <span>Tags</span>
                        <a href="#">Ideas</a>
                        <a href="#">Unique</a>
                        <a href="#">Video</a>
                    </div>
                    <div class="blog__details__share p-3 bg-white shadow" style="border-radius: 5px;"">
                        <a href="#" class="blog__details__share__item">
                            <i class="fa fa-facebook"></i>
                            <span>Share</span>
                        </a>
                        <a href="#" class="blog__details__share__item twitter">
                            <i class="fa fa-twitter"></i>
                            <span>Share</span>
                        </a>
                        <a href="#" class="blog__details__share__item google">
                            <i class="fa fa-google"></i>
                            <span>Share</span>
                        </a>
                        <a href="#" class="blog__details__share__item linkedin">
                            <i class="fa fa-linkedin"></i>
                            <span>Share</span>
                        </a>
                    </div>
				</div>
				<!-- Side Column -->
				<div class="col-lg-4 page-section-no-banner page-section-side">
					<div class="blog__sidebar">
                        <div class="blog__sidebar__search bg-white p-4">
                            <form action="#">
                                <input type="text" placeholder="Searching...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__recent">
                            <h5>Recent Post</h5>
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="../img/blog/recent-1.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <span><i class="fa fa-tags"></i> Shopping</span>
                                    <h6>Tortoise grilled on salt</h6>
                                    <p><i class="fa fa-clock-o"></i> 19th March, 2019</p>
                                </div>
                            </a>
                        </div>
                        <div class="blog__sidebar__categories">
                            <h5>Categories</h5>
                            <ul>
                                <li><a href="#">Finance <span>18</span></a></li>
                            </ul>
                        </div>
                        <div class="blog__sidebar__tags">
                            <h5>Popular Tag</h5>
                            <a href="#">Business</a>
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
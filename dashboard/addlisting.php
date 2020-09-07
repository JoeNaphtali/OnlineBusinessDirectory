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

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">

	<!-- Bootstrap core JavaScript-->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

	<!-- Summernote CSS -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
	<!-- Summernote JS -->
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>

	<!-- Leaflet.js CSS -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
	integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	crossorigin=""/>

	<!-- Leaflet.js Script -->
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
	integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
	crossorigin=""></script>

	<title>Add Listing | Find Us</title>

	<!-- Custom fonts for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="css/sb-admin-2.css" rel="stylesheet">

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
			<li class="nav-item active">
				<a class="nav-link" href="addlisting.php">
				<i class="fas fa-fw fa-plus-circle"></i>
				<span>Add Listing</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="mylistings.php">
				<i class="fas fa-fw fa-layer-group"></i>
				<span>My Listings</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Blog
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link" href="writepost.php">
				<i class="fas fa-fw fa-pencil-alt"></i>
				<span>Write Blog Post</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="myposts.php">
				<i class="fas fa-fw fa-folder-open"></i>
				<span>My Blog Posts</span></a>
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
				<a class="nav-link" href="../includes/logout.inc.php">
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

						<!-- Nav Item - Messages -->
						<li class="nav-item dropdown no-arrow mx-1">
							<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-home fa-fw"></i>
							</a>
						</li>

						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img class="img-profile rounded-circle" src="../img/user-profile-avatar.jpg">
							</a>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Add Listing</h1>
					</div>

					<!-- Content Row -->
					<div class="row">

						<div class="col-md-12">

							<form class="add-listing">

								<div class="add-listing-section basic-info shadow">
									<div class="add-listing-headline">
										<span>Basic Information</span>
									</div>
									<div class="add-listing-container">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label>Listing Name</label>
												<input class="form-control">
											</div>
                                    		<div class="form-group col-md-6">
												<label>Category</label>
												<span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
												<select class="form-control" name="" id="">
													<option value="">All Categories</option>
													<option value="">Hotels</option>
													<option value="">Restaurant</option>
													<option value="">Eat &amp; Drink</option>
													<option value="">Events</option>
													<option value="">Fitness</option>
													<option value="">Others</option>
												</select>
											</div>
                                		</div>
										<div class="form-group">
											<label>Description</label>
											<textarea class="form-control" id="summernote"></textarea>
										</div>
										<!--
										<div class="form-group">
											<label>Date & Time</label>
											<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
												<input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
												<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
													<div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
												</div>
											</div>
										</div>
										-->
                            		</div>
                        		</div>

								<div class="add-listing-section location shadow">
									<div class="add-listing-headline">
										<span>Location</span>
									</div>
									<div class="add-listing-container">
										<div class="map-container">
											<div id="map"></div>
										</div>
										<div class="form-row">
											<div class="col-md-6">
												<label>Province</label>
												<span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
												<select class="form-control">
													<option value="">Lusaka</option>
													<option value="">Copperbelt</option>
													<option value="">Southern</option>
													<option value="">Western</option>
													<option value="">Central</option>
													<option value="">Eastern</option>
													<option value="">Northern</option>
													<option value="">North-Western</option>
													<option value="">Muchinga</option>
													<option value="">Luapula</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label>City/Town</label>
												<input class="form-control">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label>Address</label>
												<input class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Friendly Address</label>
												<input class="form-control">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label>Longitude</label>
												<input class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Latitude</label>
												<input class="form-control">
											</div>
										</div>
                            		</div>
                        		</div>

								<div class="add-listing-section contact-information shadow">
									<div class="add-listing-headline">
										<span>Contact Information</span>
									</div>
									<div class="add-listing-container">
										<div class="form-row">
											<div class="form-group col-md-4">
												<label>Phone</label>
												<input class="form-control">
											</div>
											<div class="form-group col-md-4">
												<label>Website</label>
												<input class="form-control">
											</div>
											<div class="form-group col-md-4">
												<label>E-mail</label>
												<input class="form-control">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-4">
												<label><i class="fab fa-facebook-square fa-fw"></i> Facebook</label>
												<input class="form-control">
											</div>
											<div class="form-group col-md-4">
												<label><i class="fab fa-twitter-square fa-fw"></i> Twitter</label>
												<input class="form-control">
											</div>
											<div class="form-group col-md-4">
												<label><i class="fab fa-instagram-square fa-fw"></i> Instagram</label>
												<input class="form-control">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-4">
												<label><i class="fab fa-youtube-square fa-fw"></i> YouTube</label>
												<input class="form-control">
											</div>
											<div class="form-group col-md-4">
												<label><i class="fab fa-skype fa-fw"></i> Skype</label>
												<input class="form-control">
											</div>
											<div class="form-group col-md-4">
												<label><i class="fab fa-whatsapp-square fa-fw"></i> WhatsApp</label>
												<input class="form-control">
											</div>
										</div>
									</div>
								</div>

								<div class="add-listing-section opening-hours shadow">
									<div class="add-listing-headline">
										<span>Opening Hours</span>
										<div class="switch">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="opening-hours-switch">
												<label class="custom-control-label" for="opening-hours-switch"></label>
											</div>
										</div>
									</div>
									<div class="add-listing-container">
										<div class="monday">
											<label>Monday</label>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-monday" data-target-input="nearest">
														<input type="text" id="monday-open" class="form-control datetimepicker-input" data-target="#opening-monday" disabled/>
														<div class="input-group-append" data-target="#opening-monday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-monday" data-target-input="nearest">
														<input type="text" id="monday-close" class="form-control datetimepicker-input" data-target="#closing-monday" disabled/>
														<div class="input-group-append" data-target="#closing-monday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsMonday();">Clear</button>
										</div>
										<hr>
										<div class="tuesday">
											<label>Tuesday</label>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-tuesday" data-target-input="nearest">
														<input type="text" id="tuesday-open" class="form-control datetimepicker-input" data-target="#opening-tuesday" disabled/>
														<div class="input-group-append" data-target="#opening-tuesday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-tuesday" data-target-input="nearest">
														<input type="text" id="tuesday-close" class="form-control datetimepicker-input" data-target="#closing-tuesday" disabled/>
														<div class="input-group-append" data-target="#closing-tuesday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsTuesday();">Clear</button>
										</div>
										<hr>
										<div class="wednesday">
											<label>Wednesday</label>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-wednesday" data-target-input="nearest">
														<input type="text" id="wednesday-open" class="form-control datetimepicker-input" data-target="#opening-wednesday" disabled/>
														<div class="input-group-append" data-target="#opening-wednesday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-wednesday" data-target-input="nearest">
														<input type="text" id="wednesday-close" class="form-control datetimepicker-input" data-target="#closing-wednesday" disabled/>
														<div class="input-group-append" data-target="#closing-wednesday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsWednesday();">Clear</button>
										</div>
										<hr>
										<div class="thursday">
											<label>Thursday</label>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-thursday" data-target-input="nearest">
														<input type="text" id="thursday-open" class="form-control datetimepicker-input" data-target="#opening-thursday" disabled/>
														<div class="input-group-append" data-target="#opening-thursday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-thursday" data-target-input="nearest">
														<input type="text" id="thursday-close" class="form-control datetimepicker-input" data-target="#closing-thursday" disabled/>
														<div class="input-group-append" data-target="#closing-thursday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsThursday();">Clear</button>
										</div>
										<hr>
										<div class="friday">
											<label>Friday</label>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-friday" data-target-input="nearest">
														<input type="text" id="friday-open" class="form-control datetimepicker-input" data-target="#opening-friday" disabled/>
														<div class="input-group-append" data-target="#opening-friday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-friday" data-target-input="nearest">
														<input type="text" id="friday-close" class="form-control datetimepicker-input" data-target="#closing-friday" disabled/>
														<div class="input-group-append" data-target="#closing-friday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsFriday();">Clear</button>
										</div>
										<hr>
										<div class="saturday">
											<label>Saturday</label>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-saturday" data-target-input="nearest">
														<input type="text" id="saturday-open" class="form-control datetimepicker-input" data-target="#opening-saturday" disabled/>
														<div class="input-group-append" data-target="#opening-saturday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-saturday" data-target-input="nearest">
														<input type="text" id="saturday-close" class="form-control datetimepicker-input" data-target="#closing-saturday" disabled/>
														<div class="input-group-append" data-target="#closing-saturday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsSaturday();">Clear</button>
										</div>
										<hr>
										<div class="sunday">
											<label>Sunday</label>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="input-group date" id="opening-sunday" data-target-input="nearest">
														<input type="text" id="sunday-open" class="form-control datetimepicker-input" data-target="#opening-sunday" disabled/>
														<div class="input-group-append" data-target="#opening-sunday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<div class="input-group date" id="closing-sunday" data-target-input="nearest">
														<input type="text" id="sunday-close" class="form-control datetimepicker-input" data-target="#closing-sunday" disabled/>
														<div class="input-group-append" data-target="#closing-sunday" data-toggle="datetimepicker">
															<div class="input-group-text"><i class="fa fa-clock"></i></div>
														</div>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-secondary" onclick="ClearFieldsSunday();">Clear</button>
										</div>
									</div>
								</div>

								<div class="add-listing-section pricing shadow">
									<div class="add-listing-headline">
										<span>Pricing</span>
										<div class="switch">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="pricing-switch">
												<label class="custom-control-label" for="pricing-switch"></label>
											</div>
										</div>
									</div>
									<div class="add-listing-container">
										<div class="form-group" id="items-container">
										
										</div>
										<div class="controls">
											<button class="btn btn-primary pricing-input" type="button" id="add-item" disabled>Add Item</button>
											<button class="btn btn-primary pricing-input" type="button" id="add-category" disabled>Add Category</button>
										</div>
										<span>* The items entered will appear in the pricing table on the listing page</span>
									</div>
								</div>

                        <!-- Ticket Pricing
                        <div class="add-listing-section pricing shadow">
                        	<div class="add-listing-headline">
                            	<span>Ticket Pricing</span>
                            	<div class="switch">
                              		<div class="custom-control custom-switch">
                                		<input type="checkbox" class="custom-control-input" id="pricing-switch">
                                		<label class="custom-control-label" for="pricing-switch"></label>
                              		</div>
                            	</div>
                          	</div>
                          	<div class="add-listing-container">
                            	<div class="form-group" id="items-container">
                              
                            	</div>
								<div class="controls">
									<button class="btn btn-primary pricing-input" type="button" id="add-item" disabled>Add Item</button>
									<button class="btn btn-primary pricing-input" type="button" id="add-category" disabled>Add Category</button>
								</div>
								<span>* The items entered will appear on the booking page of the event</span>
                          	</div>
                        </div>
                        -->

                        <div class="add-listing-section amenities shadow">
                        	<div class="add-listing-headline">
                            	<span>Amenities</span>
                            	<div class="switch">
                              		<div class="custom-control custom-switch">
                                		<input type="checkbox" class="custom-control-input" id="amenities-switch">
                                		<label class="custom-control-label" for="amenities-switch"></label>
                              		</div>
                            	</div>
                          	</div>
							<div class="add-listing-container">
								<div class="form-check form-check-inline">
									<input class="form-check-input amenity" id="wi-fi" type="checkbox" value="option1" disabled>
									<label class="form-check-label" for="wi-fi">Free Wi-FI</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input amenity" id="pets-allowed" type="checkbox" value="option1" disabled>
									<label class="form-check-label" for="pets-allowed">Pets Allowed</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input amenity" id="smoking-allowed" type="checkbox" value="option1" disabled>
									<label class="form-check-label" for="smoking-allowed">Smoking Allowed</label>
								</div>
							</div>
                        </div>

                        <button class="btn btn-primary"><i class="fa fa-arrow-circle-right fa-fw"></i> Submit Listing</button>

                    </form>

                </div>
                
            </div>

        </div>

    <script>
			
		var mymap = L.map('map').setView([-15.386283, 28.399378], 17);
		var marker = L.marker([-15.386283, 28.399378]).addTo(mymap);

		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
		}).addTo(mymap);

		

    </script>

    <script>
function ClearFieldsMonday() {

document.getElementById("monday-open").value = "";
document.getElementById("monday-close").value = "";
}

function ClearFieldsTuesday() {
  document.getElementById("tuesday-open").value = "";
  document.getElementById("tuesday-close").value = "";
}

function ClearFieldsWednesday() {
  document.getElementById("wednesday-open").value = "";
  document.getElementById("wednesday-close").value = "";
}

function ClearFieldsThursday() {
  document.getElementById("thursday-open").value = "";
  document.getElementById("thursday-close").value = "";
}

function ClearFieldsFriday() {
  document.getElementById("friday-open").value = "";
  document.getElementById("friday-close").value = "";
}

function ClearFieldsSaturday() {
  document.getElementById("saturday-open").value = "";
  document.getElementById("saturday-close").value = "";
}

function ClearFieldsSunday() {
  document.getElementById("sunday-open").value = "";
  document.getElementById("sunday-close").value = "";
}
    </script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

  <script type="text/javascript">
            $(function () {
                $('#opening-monday').datetimepicker({
                    format: 'LT'
                });
                $('#closing-monday').datetimepicker({
                    format: 'LT'
                });
                $('#opening-tuesday').datetimepicker({
                    format: 'LT'
                });
                $('#closing-tuesday').datetimepicker({
                    format: 'LT'
                });
                $('#opening-wednesday').datetimepicker({
                    format: 'LT'
                });
                $('#closing-wednesday').datetimepicker({
                    format: 'LT'
                });
                $('#opening-thursday').datetimepicker({
                    format: 'LT'
                });
                $('#closing-thursday').datetimepicker({
                    format: 'LT'
                });
                $('#opening-friday').datetimepicker({
                    format: 'LT'
                });
                $('#closing-friday').datetimepicker({
                    format: 'LT'
                });
                $('#opening-saturday').datetimepicker({
                    format: 'LT'
                });
                $('#closing-saturday').datetimepicker({
                    format: 'LT'
                });
                $('#opening-sunday').datetimepicker({
                    format: 'LT'
                });
                $('#closing-sunday').datetimepicker({
                    format: 'LT'
                });
            });
        </script>

</body>

</html>

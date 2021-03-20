<?php

// Database Connection
require 'dbh.inc.php';

// If the user clicks the 'Search' button on the Home page
if (isset($_POST['submit-search'])) {
    
    $keyword_search = mysqli_real_escape_string($conn, $_POST['keyword_search']);
	$location_search = mysqli_real_escape_string($conn, $_POST['location_search']);
	if(isset($_POST["listing_category"]))  
    { 
        foreach ($_POST['listing_category'] as $listing_category);            
    }
	
	//$listing_category = mysqli_real_escape_string($conn, $_POST['listing_category']);

	// Display an error if the user did not enter a keyword seach item
    if (empty($keyword_search)) {
        header("Location: ../index.php?error=nokeywordsearch");
        exit();
    }
	
	// Send the user to the 'Search' page with the search parameters in the URL
	header("Location: ../search/index.php?keyword_search=".$keyword_search."&location_search=".$location_search."&listing_category=".$listing_category);
	exit();
    
}
// If user clicks the 'Search' button on the Search page
else if (isset($_POST['submit-search'])) {
	$keyword_search = mysqli_real_escape_string($conn, $_POST['keyword_search']);
	$location_search = mysqli_real_escape_string($conn, $_POST['location_search']);
	if(isset($_POST["listing_category"]))  
    { 
        foreach ($_POST['listing_category'] as $listing_category);            
    }
	
	// Display an error if the user did not enter a keyword seach item
    if (empty($keyword_search)) {
        header("Location: ../search/index.php?error=nokeywordsearch");
        exit();
    }
	
	// Send the user to the 'Search' page with the search parameters in the URL
	header("Location: ../search/index.php?keyword_search=".$keyword_search."&location_search=".$location_search."&listing_category=".$listing_category);
	exit();
}
else {
	// Send the user back to the home page if this script was accessed without clicking the 'Search' button on either of the search forms
	header("Location: ../index.php");
	exit();
}

?>
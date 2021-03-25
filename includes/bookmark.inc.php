<?php

// Database Connection
require 'dbh.inc.php';

$user__id = $_SESSION['user_id']; // Assign id of current user using a session variable

// If user clicks the 'like' or 'dislike'
if (isset($_POST['action'])) {

    // Declare variables   
    $listing_id = $_POST['listing_id'];
    $action = $_POST['action'];

    switch ($action) {
        // Insert into rating table if user likes an idea
        case 'bookmark':
            $sql="INSERT INTO bookmark (listing_id, user__id) 
                   VALUES ($listing_id, $user__id)";
            break;
        // Remove from rating table if user unlikes an idea
        case 'removebookmark':
            $sql="DELETE FROM bookmark WHERE user__id = $user__id AND listing_id = $listing_id";
            break;
        default:
            break;
    }
    
    // Execute query
    mysqli_query($conn, $sql);
    exit(0);

}

// Check whether or not the user has already liked the idea
function userBookmarked($listing_id)
{
  global $conn;
  global $user__id;
  $sql = "SELECT * FROM bookmark WHERE user__id = $user__id 
  		  AND listing_id = $listing_id";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}
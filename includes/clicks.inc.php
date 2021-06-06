<?php

// Database Connection
require 'dbh.inc.php';

// If user clicks the Facebook link
if (isset($_POST['fb_action'])) {

    // Declare variables   
    $listing_id = $_POST['listing_id'];
    $action = $_POST['fb_action'];

    switch ($action) {
        // Increment clicks value by one
        case 'increment':
            $sql="UPDATE listing SET facebook_link_clicks = facebook_link_clicks + 1 WHERE id=$listing_id";
            break;
        default:
            break;
    }   
    // Execute query
    mysqli_query($conn, $sql);
    exit(0);
}

// If user clicks the Twitter link
if (isset($_POST['tt_action'])) {

    // Declare variables   
    $listing_id = $_POST['listing_id'];
    $action = $_POST['tt_action'];

    switch ($action) {
        // Increment clicks value by one
        case 'increment':
            $sql="UPDATE listing SET twitter_link_clicks = twitter_link_clicks + 1 WHERE id=$listing_id";
            break;
        default:
            break;
    }   
    // Execute query
    mysqli_query($conn, $sql);
    exit(0);
}

// If user clicks the Instagram link
if (isset($_POST['ig_action'])) {

    // Declare variables   
    $listing_id = $_POST['listing_id'];
    $action = $_POST['ig_action'];

    switch ($action) {
        // Increment clicks value by one
        case 'increment':
            $sql="UPDATE listing SET instagram_link_clicks = instagram_link_clicks + 1 WHERE id=$listing_id";
            break;
        default:
            break;
    }   
    // Execute query
    mysqli_query($conn, $sql);
    exit(0);
}

// If user clicks the Instagram link
if (isset($_POST['web_action'])) {

    // Declare variables   
    $listing_id = $_POST['listing_id'];
    $action = $_POST['web_action'];

    switch ($action) {
        // Increment clicks value by one
        case 'increment':
            $sql="UPDATE listing SET website_link_clicks = website_link_clicks + 1 WHERE id=$listing_id";
            break;
        default:
            break;
    }   
    // Execute query
    mysqli_query($conn, $sql);
    exit(0);
}
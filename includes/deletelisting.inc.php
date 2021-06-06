<?php

// If user clicks the 'Delete' button
if (isset($_GET['delete'])) {

    // Database connection
    require 'dbh.inc.php';

    // Get the id of the category the user wishes to delete and store it in the varible 'id'
    $listing_id = $_GET['delete'];

    // Delete all rating given to idea
    $sql = "DELETE FROM review WHERE listing_id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../dashboard/mylistings.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $listing_id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Delete all rating given to idea
    $sql = "DELETE FROM opening_hours WHERE listing_id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../dashboard/mylistings.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $listing_id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Delete all rating given to idea
    $sql = "DELETE FROM listing_phone_number WHERE listing_id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../dashboard/mylistings.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $listing_id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Delete all rating given to idea
    $sql = "DELETE FROM bookmark WHERE listing_id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../dashboard/mylistings.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $listing_id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Delete all rating given to idea
    $sql = "DELETE FROM analytics WHERE listing_id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../dashboard/mylistings.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $listing_id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Delete all rating given to idea
    $sql = "DELETE FROM amenity WHERE listing_id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../dashboard/mylistings.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $listing_id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Delete all rating given to idea
    $sql = "DELETE FROM listing WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../dashboard/mylistings.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $listing_id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Return the user the 'Manage Ideas' page with a success message
    header("Location:../dashboard/mylistings.php?ideadeleted");

    // Close connection string
    mysqli_close($conn);
    
}
else {
    header("Location:../dashboard/mylisting.php");
}
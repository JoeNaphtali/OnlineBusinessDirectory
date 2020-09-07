<?php

// If user clicks the 'Save' button
if (isset($_POST['save'])) {

    // Database Connection
    require '../includes/dbh.inc.php';

    // Declare variables
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Display an error if the user left an empty field
    if (empty($first_name) || empty($last_name) || empty($email)) {
        header("Location: ../dashboard/myprofile.php?edit=$id?error=emptyfields&fname=".$first_name."&lname=".$last_name."&email=".$email);
        exit();
    }
    // Display an error if the user enters an invalid email, first name or last name
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $first_name) && !preg_match("/^[a-zA-Z0-9]*$/", $last_name)) {
        header("Location: ../dashboard/myprofile.php?edit=$id?error=invalidmailfnamelname");
        exit();
    }
    // Display an error if the user enters an invalid email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../dashboard/myprofile.php?edit=$id?error=invalidmail&fname=".$first_name."&lname=".$last_name);
        exit();
    }
    // Display an error if the user enters an invalid first name
    else if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
        header("Location: ../dashboard/myprofile.php?edit=$id?error=invalidfname&lname=".$last_name."&email=".$email);
        exit();
    }
    // Display an error if the user enters an invalid last name
    else if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
        header("Location: ../dashboard/myprofile.php?edit=$id?error=invalidlname&fname=".$first_name."&email=".$email);
        exit();
    }
    else {
        //Insert user details into the database
        $sql = "UPDATE user SET first_name=?, last_name=?, email=?, profile_picture_status=? WHERE id='$id'";
        $stmt = mysqli_stmt_init($conn);
        // Check for sql syntax error
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Display error if there is an sql syntax error in the 'INSERT INTO' statement
        header("Location: ../dashboard/myprofile.php?edit=$id?error=sqlerror");
        exit();
        }
        else {
        // Bind varibales the variables to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email, $profile_picture_status);
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        // Return the user to the login page with a success message
        header("Location: ../dashboard/myprofile.php?update=success");
        exit();
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
    // Close connection string
    mysqli_close($conn);
}
else {
    // Send user back to myprofile page, if page was accessed without clicking 'save' button
    header("Location: ../dashboard/myprofile.php");
    exit();
}
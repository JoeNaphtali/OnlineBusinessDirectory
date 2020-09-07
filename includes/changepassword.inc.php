<?php

// If user clicks the 'Change Password' button
if (isset($_POST['change-password'])) {

    // Database connection
    include '../includes/dbh.inc.php';

    // Declare variables
    $id = $_POST['id'];
    $current_password = $_POST['current_password'];
    $repeat_current_password = $_POST['repeat_current_password'];
    $new_password = $_POST['new_password'];
    $repeat_new_password = $_POST['repeat_new_password'];

    // Verify user password
    $password_check = password_verify($repeat_current_password, $current_password);

    // Display an error if the user left an empty field
    if (empty($repeat_current_password) || empty($new_password) || empty($repeat_new_password)) {
        header("Location: ../dashboard/myprofile.php?error=emptyfields");
        exit();
    }
    // Display error and return user to login page if current password does not match user's password
    else if ($password_check == false) {
        header("Location: ../dashboard/myprofile.php?error=oldpasswordcheck");
        exit();
    }
    // Check if password is at least 8 charaters long
    else if (strlen($new_password) < 8) {
        // Display error message if password is less than 8 characters
        header("Location: ../dashboard/myprofile.php?error=passwordshort");
        exit();
    }
    // Check if password contains at least one digit
    else if (!preg_match("/\d/", $new_password)) {
        // Display error message if password does not contain at least one digit
        header("Location: ../dashboard/myprofile.php?error=passwordnodigit");
        exit();
    }
    // Check if password contains at least one capital letter
    else if (!preg_match("/[A-Z]/", $new_password)) {
        // Display error message if password does not contain at least one capital letter
        header("Location: ../dashboard/myprofile.php?error=passwordnocapitalletter");
        exit();
    }
    // Check if password contains at least one small letter
    else if (!preg_match("/[a-z]/", $new_password)) {
        // Display error message if password does not contain at least one small letter
        header("Location: ../dashboard/myprofile.php?error=passwordnosmallletter");
        exit();
    }
    // Check if password contains at least one special character
    else if (!preg_match("/\W/", $new_password)) {
        // Display error message if password does not contain at least one special character
        header("Location: ../dashboard/myprofile.php?error=passwordnospecial");
        exit();
    }
    // Check if password contains white space
    else if (preg_match("/\s/", $new_password)) {
        // Display error message if password contains white space
        header("Location: ../dashboard/myprofile.php?error=passwordwhitespace");
        exit();
    }
    // Check if passwords match
    else if ($new_password !== $repeat_new_password) {
        // Display error if new password does not much repeated password
        header("Location: ../dashboard/myprofile.php?error=newpasswordcheck");
        exit();
    }
    else {
        //Insert new password into the database
        $sql = "UPDATE user SET user_password=? WHERE id='$id'";
        $stmt = mysqli_stmt_init($conn);
        // Check for sql syntax error
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Display error if there is an sql syntax error in the 'INSERT INTO' statement
        header("Location: ../dashboard/myprofile.php?error=sqlerror");
        exit();
        }
        else {
        // Hash the new user password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);    
        // Bind varibales the variables to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $hashed_password);
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        // Return the user to the login page with a success message
        header("Location: ../dashboard/myprofile.php?passwordchange=success");
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
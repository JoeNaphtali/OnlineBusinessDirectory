<?php

if (isset($_POST['reset-request'])) {

    // Database connection
    require 'dbh.inc.php';

    // 'sendemail' function
    include "sendemail.inc.php";

    // Email address the user entered in the 'Forgot Password' form
    $user_email = $_POST["email"];

    // Display an error if the user enters an invalid email
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../forgotpassword/resetrequest.php?error=invalidemail");
        exit();
    }

    // Declare 'selector' and 'token' variables
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    // Timestamp to make token expire after one hour
    $expires = date("U") + 1800;

    // URL that will be sent to the user to reset their password
    $url = "http://localhost/Online%20Business%20Directory/forgotpassword/resetpassword.php?selector=".$selector."&validator=".bin2hex($token)."&email=".$user_email;
    
    // Check if email address the user entered exists in the database
    $sql = "SELECT email FROM user WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'SELECT' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../forgotpassword/resetrequest.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the variables to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $result_check = mysqli_stmt_num_rows($stmt);
        // Display error if email address already exists in database
        if ($result_check == 0) {
            header("Location: ../forgotpassword/resetrequest.php?error=emailnotfound");
            exit();
        }
        else {
            // Delete any exisiting enteries of a token in the database from the user who is trying to reset their password
    $sql = "DELETE FROM password_reset WHERE password_reset_email=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Display error message if there was an error in the 'DELETE' statement
        header("Location: ../forgotpassword/resetrequest.php?error=sqlerror");
        exit();
    }
    else {
        // Bind the varibales to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Insert token into the database
    $sql = "INSERT INTO password_reset (password_reset_email, password_reset_selector, password_reset_token, password_reset_expires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Display error message if there was an error in the 'INSERT' statement
        header("Location: ../forgotpassword/resetrequest.php?error=sqlerror");
        exit();
    }
    else {
        // Hash the token
        $hashed_token = password_hash($token, PASSWORD_DEFAULT);
        // Bind the varibales to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssss", $user_email, $selector, $hashed_token, $expires);
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Send the reset password link(URL) to the user's email address
    $to       =   $user_email;
    $subject  =   "Reset your password for FindUs";
    $message = "<p>We received a password reset request for your account. 
    The link to reset your password is below. If you did not make this request, 
    You can ignore this email.</p>";
    $message .= "<p>Here is your password reset link: </br>";
    $message .= '<a href="'.$url.'">'.$url.'</a></p>';
    $headers = "From: FindUs: <findus@gmail.com>\r\n";
    $headers .= "Reply-To: findus@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    $mailsend =   sendmail($to, $subject, $message, $headers);

    // Close statement
    mysqli_stmt_close($stmt);
    // Close connection string
    mysqli_close($conn);

    // Return to 'Reset Password' page with success message
    header("Location: ../forgotpassword/resetrequest.php?request=sent");
        }
    }
}
else {

    // Send user back to home page if this script was accessed without clicking the 'send email' button
    header("Location: ../index.php");

}
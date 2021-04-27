<?php

// Check if user clicked the 'Reset Password' button to access the script
if (isset($_POST['reset-password'])) {

    // Database connection
    require 'dbh.inc.php';
    
    // Declare variables
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    // Check if user entered a password
    if (empty($password)) {
        header("Location: ../forgotpassword/resetpassword.php?error=nopassword&selector=".$selector."&validator=".$validator."&email=".$email);
        exit();
    }
    // Check if user repeated password
    if (empty($password_repeat)) {
        header("Location: ../forgotpassword/resetpassword.php?error=norepeat&selector=".$selector."&validator=".$validator."&email=".$email);
        exit();
    }
    // Check if password is at least 8 charaters long
    else if (strlen($password) < 8) {
        // Display error message if password is less than 8 characters
        header("Location: ../forgotpassword/resetpassword.php?error=passwordshort&selector=".$selector."&validator=".$validator."&email=".$email);
        exit();
    }
    // Check if password contains at least one digit
    else if (!preg_match("/\d/", $password)) {
        // Display error message if password does not contain at least one digit
        header("Location: ../forgotpassword/resetpassword.php?error=passwordnodigit&selector=".$selector."&validator=".$validator."&email=".$email);
        exit();
    }
    // Check if password contains at least one capital letter
    else if (!preg_match("/[A-Z]/", $password)) {
        // Display error message if password does not contain at least one capital letter
        header("Location: ../forgotpassword/resetpassword.php?error=passwordnocapitalletter&selector=".$selector."&validator=".$validator."&email=".$email);
        exit();
    }
    // Check if password contains at least one small letter
    else if (!preg_match("/[a-z]/", $password)) {
        // Display error message if password does not contain at least one small letter
        header("Location: ../forgotpassword/resetpassword.php?error=passwordnosmallletter&selector=".$selector."&validator=".$validator."&email=".$email);
        exit();
    }
    // Check if password contains at least one special character
    else if (!preg_match("/\W/", $password)) {
        // Display error message if password does not contain at least one special character
        header("Location: ../forgotpassword/resetpassword.php?error=passwordnospecial&selector=".$selector."&validator=".$validator."&email=".$email);
        exit();
    }
    // Check if password contains white space
    else if (preg_match("/\s/", $password)) {
        // Display error message if password contains white space
        header("Location: ../forgotpassword/resetpassword.php?error=passwordwhitespace&selector=".$selector."&validator=".$validator."&email=".$email);
        exit();
    }
    // Check if passwords match
    else if ($password != $password_repeat) {
        // Display an error message if the passwords do not match
        header("Location: ../forgotpassword/resetpassword.php?error=newpasswordcheck&selector=".$selector."&validator=".$validator."&email=".$email);
        exit();
    }

    // Timestamp to check whether or not token has expired
    $current_date = date("U");

    // Select token from 'password_reset table'
    $sql = "SELECT * FROM password_reset WHERE password_reset_selector=? AND password_reset_expires >= ?";
    $stmt = mysqli_stmt_init($conn);
    // Check for any errors in 'SELECT' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Display error message if there was an error in the 'SELECT' statement
        header("Location: ../forgotpassword/resetpassword.php?error=sqlerror&selector=".$selector."&validator=".$validator."&email=".$email);
        exit();
    }
    else {
        // Bind the varibales to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $selector, $current_date);
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$row = mysqli_fetch_assoc($result)) {
            header("Location: ../forgotpassword/resetpassword.php?error=resubmit&selector=".$selector."&validator=".$validator."&email=".$email);
            exit();
        }
        else {
            
            // Convert validator token back to binary
            $token_bin = hex2bin($validator);
            
            $token_check = password_verify($token_bin, $row['password_reset_token']);
            
            // Check if token matches token in the database
            if ($token_check === false) {
                // Display error message if token does not match token in the database
                header("Location: ../forgotpassword/resetpassword.php?error=resubmit&selector=".$selector."&validator=".$validator."&email=".$email);
                exit();
            }
            // If token matches, proceeed
            else if ($token_check === true) {

                $token_email = $row['password_reset_email'];

                $sql = "SELECT * FROM user WHERE email=?;";

                $stmt = mysqli_stmt_init($conn);
                // Check if there was an error in the 'SELECT' statement
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    // Display error message if there was an error in the 'SELECT' statement
                    header("Location: ../forgotpassword/resetpassword.php?error=sqlerror&selector=".$selector."&validator=".$validator."&email=".$email);
                    exit();
                }
                else {

                    // Bind the varibales to a prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $token_email);
                    // Execute the prepared statement
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);
            
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There was an error!";
                        exit();
                    }
                    else {
                        $sql = "UPDATE user SET user_password=? WHERE email=?;";
                        $stmt = mysqli_stmt_init($conn);
                        // Check if there was an error in the 'UPDATE' statement
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            // Display error message if there was an error in the 'UPDATE' statement
                            header("Location: ../forgotpassword/resetpassword.php?error=sqlerror&selector=".$selector."&validator=".$validator."&email=".$email);
                            exit();
                        }
                        else {
                            // Hash the password
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            // Bind the varibales to a prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $token_email);
                            // Execute the prepared statement
                            mysqli_stmt_execute($stmt);

                            // Delete token from 'password_reset' table
                            $sql = "DELETE FROM password_reset WHERE password_reset_email=?;";
                            $stmt = mysqli_stmt_init($conn);
                            // Check if there was an error in the 'DELETE' statement
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                // Display error message if there was an error in the 'DELETE' statement
                                header("Location: ../forgotpassword/resetpassword.php?error=sqlerror&selector=".$selector."&validator=".$validator."&email=".$email);
                                exit();
                            }
                            else {
                                // Bind the varibales to a prepared statement as parameters
                                mysqli_stmt_bind_param($stmt, "s", $token_email);
                                // Execute the prepared statement
                                mysqli_stmt_execute($stmt);
                                // Return user to login page with success message
                                header("Location: ../login/index.php?password=updated");
                            }                    
                        }
                    }
                }
            }
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
    // Close connection string
    mysqli_close($conn);
}
else {
    // Return to home page if script was accessed without cliking the 'Reset Password' button
    header("Location: ../index.php");
}
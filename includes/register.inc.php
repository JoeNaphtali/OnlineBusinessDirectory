<?php

// If user clicks the 'Register' button
if (isset($_POST['register'])) {

    // Database conneciton
    require 'dbh.inc.php';

    // Declare variables
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];
    $profile_picture = false;

    $file = $_FILES['profile_picture'];

	$fileName = $_FILES['profile_picture']['name'];
	$fileTmpName = $_FILES['profile_picture']['tmp_name'];
	$fileSize = $_FILES['profile_picture']['size'];
	$fileError = $_FILES['profile_picture']['error'];
	$fileType = $_FILES['profile_picture']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    // Display an error if the user leaves an empty field
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($password_repeat)) {
        header("Location: ../register/index.php?error=emptyfields&fname=".$first_name."&lname=".$last_name."&email=".$email);
        exit();
    }
    // Display an error if the user enters an invalid email, first name or last name
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $first_name) && !preg_match("/^[a-zA-Z0-9]*$/", $last_name)) {
        header("Location: ../register/index.php?error=invalidmailfnamelname");
        exit();
    }
    // Display an error if the user enters an invalid email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register/index.php.php?error=invalidmail&fname=".$first_name."&lname=".$last_name);
        exit();
    }
    // Display an error if the user enters an invalid first name
    else if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
        header("Location: ../register/index.php?error=invalidfname&lname=".$last_name."&mail=".$email);
        exit();
    }
    // Display an error if the user enters an invalid last name
    else if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
        header("Location: ../register/index.php?error=invalidlname&fname=".$first_name."&mail=".$email);
        exit();
    }
    // Check if passwords match
    else if ($password !== $password_repeat) {
        // Display error if passwords do not match
        header("Location: ../register/index.php?error=passwordcheck&fname=".$first_name."&lname=".$last_name."&mail=".$email);
        exit();
    }
    else {

        // Check if email address the user entered already exists in the database
        $sql = "SELECT email FROM user WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        // Display error if there is an sql syntax error in the 'SELECT' statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../register/index.php?error=sqlerror");
            exit();
        }
        else {
            // Bind varibales the variables to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $email);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result_check = mysqli_stmt_num_rows($stmt);
            // Display error if email address already exists in database
            if ($result_check > 0) {
                header("Location: ../register/index.php?error=emailtaken&fname=".$first_name."&lname=".$last_name);
                exit();
            }
            else {
                //Insert user details into the database
                $sql = "INSERT INTO user (first_name, last_name, profile_picture, email, password) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                // Check for sql syntax error
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                // Display error if there is an sql syntax error in the 'INSERT INTO' statement
                header("Location: ../register/index.php?error=sqlerror");
                exit();
                }
                else {
                    // Check if user uploaded profile picture
                    if (($_FILES['profile_picture']['name'])) {
                        $profile_picture = true;
                    }
                    // Hash the user password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    // Bind varibales the variables to a prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $profile_picture, $email, $hashed_password);
                    // Execute the prepared statement
                    mysqli_stmt_execute($stmt);
                    // Check if user uploaded profile picture
                    if (($_FILES['profile_picture']['name'])) {
                        // Check if profile picture the user uploaded is of a valid file type
                        if (in_array($fileActualExt, $allowed)) {
                            // Check if there were any errors uploading the profile picture
                            if ($fileError === 0) {
                                // Check if the file is less than 100Mb
                                if ($fileSize < 10000000) {
                                    $fileNameNew = "profile_picture_user_".mysqli_insert_id($conn).".".$fileActualExt;
                                    $fileDestination = '../img/profile_pictures/'.$fileNameNew;
                                    move_uploaded_file($fileTmpName, $fileDestination);
                                }
                                else {
                                    // Display an error message if the user uploaded a file larger than 100Mb
                                    header("Location: ../register/index.php?error=largeimg&fname=".$first_name."&lname=".$last_name."&email=".$email);
                                    exit();
                                }
                            }
                            else {
                                // Display an error message if there was an unknown error uploading the profile picture
                                header("Location: ../register/index.php?error=unknownerror&fname=".$first_name."&lname=".$last_name."&email=".$email);
                                exit();
                            }
                        }
                        else {
                            // Display an error message if the user uploaded an invalid file type
                            header("Location: ../register/index.php?error=invalidfile&fname=".$first_name."&lname=".$last_name."&email=".$email);
                            exit();
                        }
                    }    
                    // Return the user to the login page with a success message
                    header("Location: ../login/index.php?register=success");
                    exit();
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
    // Send user back to registration page, if page was accessed without clicking 'register' button
    header("Location: ../register/index.php");
    exit();
}
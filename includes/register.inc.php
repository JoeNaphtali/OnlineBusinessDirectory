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
    $profile_picture_status = false;

    $file = $_FILES['profile_picture'];

	$fileName = $_FILES['profile_picture']['name'];
	$fileTmpName = $_FILES['profile_picture']['tmp_name'];
	$fileSize = $_FILES['profile_picture']['size'];
	$fileError = $_FILES['profile_picture']['error'];
    $fileType = $_FILES['profile_picture']['type'];
    
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    // Display an error if the user did not enter a first name
    if (empty($first_name)) {
        header("Location: ../register/index.php?error=nofirstname&lname=".$last_name."&email=".$email);
        exit();
    }
    // Display an error if the user did not enter a last name
    else if (empty($last_name)) {
        header("Location: ../register/index.php?error=nolastname&fname=".$first_name."&email=".$email);
        exit();
    }
    // Display an error if the user did not enter an email address
    else if (empty($email)) {
        header("Location: ../register/index.php?error=noemail&fname=".$first_name."&lname=".$last_name);
        exit();
    }
    // Display an error if the user did not enter a password
    else if (empty($password)) {
        header("Location: ../register/index.php?error=nopassword&fname=".$first_name."&lname=".$last_name."&email=".$email);
        exit();
    }
    // Display an error if the user did not repeat their password
    else if (empty($password_repeat)) {
        header("Location: ../register/index.php?error=norepeat&fname=".$first_name."&lname=".$last_name."&email=".$email);
        exit();
    }
    // Display an error if the user enters an invalid email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register/index.php?error=invalidemail&fname=".$first_name."&lname=".$last_name);
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
    // Check if password is at least 8 charaters long
    else if (strlen($password) < 8) {
        // Display error message if password is less than 8 characters
        header("Location: ../register/index.php?error=passwordshort&fname=".$first_name."&lname=".$last_name."&mail=".$email);
        exit();
    }
    // Check if password contains at least one digit
    else if (!preg_match("/\d/", $password)) {
        // Display error message if password does not contain at least one digit
        header("Location: ../register/index.php?error=passwordnodigit&fname=".$first_name."&lname=".$last_name."&mail=".$email);
        exit();
    }
    // Check if password contains at least one capital letter
    else if (!preg_match("/[A-Z]/", $password)) {
        // Display error message if password does not contain at least one capital letter
        header("Location: ../register/index.php?error=passwordnocapitalletter&fname=".$first_name."&lname=".$last_name."&mail=".$email);
        exit();
    }
    // Check if password contains at least one small letter
    else if (!preg_match("/[a-z]/", $password)) {
        // Display error message if password does not contain at least one small letter
        header("Location: ../register/index.php?error=passwordnosmallletter&fname=".$first_name."&lname=".$last_name."&mail=".$email);
        exit();
    }
    // Check if password contains at least one special character
    else if (!preg_match("/\W/", $password)) {
        // Display error message if password does not contain at least one special character
        header("Location: ../register/index.php?error=passwordnospecial&fname=".$first_name."&lname=".$last_name."&mail=".$email);
        exit();
    }
    // Check if password contains white space
    else if (preg_match("/\s/", $password)) {
        // Display error message if password contains white space
        header("Location: ../register/index.php?error=passwordwhitespace&fname=".$first_name."&lname=".$last_name."&mail=".$email);
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
                $sql = "INSERT INTO user (first_name, last_name, email, user_password, profile_picture_status) VALUES (?, ?, ?, ?, ?)";
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
                        $profile_picture_status = true;
                    }
                    // Hash the user password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    // Bind the varibales to a prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $email, $hashed_password, $profile_picture_status);
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
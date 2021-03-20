<?php
    // If user clicks the 'Submit Review' button
    if (isset($_POST['submit-review'])) {
        
        // Database connection
        include '../includes/dbh.inc.php';

        // Start session in order to use the session variable 'user_id'
        session_start();

        // Set timezone
		date_default_timezone_set("Africa/Lusaka");

        // Declare Variables
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $listing_id = $_POST['listing_id'];
        $rating = $_POST['rating'];
        $feedback = $_POST['feedback'];
        $date = date('Y-m-d H:i');

        // Check if 'feedback' variable is empty
        if (empty($feedback)) {
            // Display error message in header if 'feedback' variable is empty
            header("Location: ../listing/index.php?l_id=$listing_id?error=nofeedback");
            exit();
        }
        else {
            $sql = "INSERT INTO review (first_name, last_name, email, listing_id, submission_date, feedback, rating)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($conn);
            // Display error if there is an sql syntax error in the 'INSERT INTO' statement
            if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../dashboard/addlisting.php?error=sqlerror");
            exit();
            }
            else {
            // Bind the variables to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $first_name, $last_name, $email, $listing_id, $date, $feedback, $rating);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
        // Close connection string
        mysqli_close($conn);
    }
    else {
        // Return user to home page if script was accessed without clicking the 'Submit Review' button
        header("Location: ../index.php");
    }
?>
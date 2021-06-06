<?php
    // If user clicks the 'Submit Review' button
    if (isset($_POST['submit-review'])) {
        
        // Database connection
        include '../includes/dbh.inc.php';

        // 'sendemail' function
        include "sendemail.inc.php";

        // Start session in order to use the session variable 'user_id'
        session_start();

        // Set timezone
		date_default_timezone_set("Africa/Lusaka");

        // Declare Variables
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $listing_id = $_POST['listing_id'];
        $listing_name = $_POST['listing_name'];
        $owner_email = $_POST['owner_email'];
        $rating = $_POST['rating'];
        $feedback = $_POST['feedback'];
        $owner_id = 1;
        $date = date('Y-m-d H:i');

        // Check if 'feedback' variable is empty
        if (empty($feedback)) {
            // Display error message in header if 'feedback' variable is empty
            header("Location: ../listing/index.php?l_id=$listing_id?error=nofeedback");
            exit();
        }
        else {
            $sql = "INSERT INTO review (listing_id, owner_id, first_name, last_name, email, submission_date, feedback, rating)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($conn);
            // Display error if there is an sql syntax error in the 'INSERT INTO' statement
            if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../dashboard/addlisting.php?error=sqlerror");
            exit();
            }
            else {
            // Bind the variables to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $listing_id, $owner_id, $first_name, $last_name, $email, $date, $feedback, $rating);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
            }
            // Send the reset password link(URL) to the user's email address
            $review_id = mysqli_insert_id($conn);
            $url = "http://localhost/Online%20Business%20Directory/listing/index.php?l_id=$listing_id#review_id_$review_id";
            $to       =   $owner_email;
            $subject  =   "New review on your listing";
            $message = "<p>$first_name $last_name just submitted a review for '$listing_name'.</p>";
            $message .= "<p>You can check it out ";
            $message .= '<a href="'.$url.'">here.</a></p>';
            $headers = "From: FindUs: <findus@gmail.com>\r\n";
            $headers .= "Reply-To: findus@gmail.com\r\n";
            $headers .= "Content-type: text/html\r\n";

            $mailsend =   sendmail($to, $subject, $message, $headers);
            header("Location: ../listing/index.php?l_id=$listing_id#review_id_$review_id");
            exit();
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
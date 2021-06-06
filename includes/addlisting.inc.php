<?php 

// If user clicks the 'Submit Listing' button
if (isset($_POST['submit-listing'])) {

    // Database connection
    include '../includes/dbh.inc.php';

    // Start session in order to use the session variable 'user_id'
    session_start();

    // Declare Variables
    $listing_name = $_POST['listing_name'];

    $file = $_FILES['listing_picture'];

	$fileName = $_FILES['listing_picture']['name'];
	$fileTmpName = $_FILES['listing_picture']['tmp_name'];
	$fileSize = $_FILES['listing_picture']['size'];
	$fileError = $_FILES['listing_picture']['error'];
    $fileType = $_FILES['listing_picture']['type'];
    
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    // Check if 'listing_name' variable is empty
    if (empty($listing_name)) {
        // Display error message in header if 'listing_name' variable is empty
        header("Location: ../dashboard/addlisting.php?error=nolname");
        exit();
    }

    // Check if user selected a category
    if (isset($_POST['category'])) {
        // If user selected a category, store the category id in the 'cateogory_id' variable
        foreach ($_POST['category'] as $category_id);
    }
    else {
        // If user did not select a category, display error message in header
        header("Location: ../dashboard/addlisting.php?error=nocat");
        exit();
    }

    $keywords = $_POST['keywords'];

    $description = $_POST['description'];

    // Check if 'description' variable is empty
    if (empty($description)) {
        // Display error message in header if 'description' variable is empty
        header("Location: ../dashboard/addlisting.php?error=nodesc");
        exit();
    }

    // Check if user selected a province
    if (isset($_POST['province'])) {
        // If user selected a province, store the province name in the 'province' variable
        foreach ($_POST['province'] as $province);
    }
    else {
        // If user did not select a province, display error message in header
        header("Location: ../dashboard/addlisting.php?error=noprov");
        exit();
    }

    $citytown = $_POST['city_town'];

    // Check if 'citytown' variable is empty
    if (empty($citytown)) {
        // Display error message in header if 'citytown' variable is empty
        header("Location: ../dashboard/addlisting.php?error=nocitytown");
        exit();
    }

    $address = $_POST['address'];

    // Check if 'address' variable is empty
    if (empty($address)) {
        // Display error message in header if 'address' variable is empty
        header("Location: ../dashboard/addlisting.php?error=noaddress");
        exit();
    }

    $friendly_address = $_POST['friendly_address'];

    $latitude = $_POST['latitude'];

    // Check if 'latitude' variable is empty
    if (empty($latitude)) {
        // Display error message in header if 'latitude' variable is empty
        header("Location: ../dashboard/addlisting.php?error=nolatitude");
        exit();
    }

    $longitude = $_POST['longitude'];

    // Check if 'longitude' variable is empty
    if (empty($longitude)) {
        // Display error message in header if 'longitude' variable is empty
        header("Location: ../dashboard/addlisting.php?error=nolongitude");
        exit();
    }

    $phone_1 = $_POST['phone_1'];

    // Check if 'phone_1' variable is empty
    if (empty($phone_1)) {
        // Display error message in header if 'phone_1' variable is empty
        header("Location: ../dashboard/addlisting.php?error=nophone");
        exit();
    }

    $phone_2 = $_POST['phone_2'];
    $phone_3 = $_POST['phone_3'];   
    $website = $_POST['website'];
    $email = $_POST['email'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];

    $opening_hours_switch;

    $monday_open = $_POST['monday_open'];
    $monday_close = $_POST['monday_close'];
    $monday_status = true;

    if (empty($monday_open) && !empty($monday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noopenmon");
        exit();
    }
    else if (!empty($monday_open) && empty($monday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noclosemon");
        exit();
    }
    else if (empty($monday_open) && empty($monday_close)) {
        $monday_status = false;
    }

    $tuesday_open = $_POST['tuesday_open'];
    $tuesday_close = $_POST['tuesday_close'];
    $tuesday_status = true;
    if (empty($tuesday_open) && !empty($tuesday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noopenmtue");
        exit();
    }
    else if (!empty($tuesday_open) && empty($tuesday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noclosemtue");
        exit();
    }
    if (empty($tuesday_open) && empty($tuesday_close)) {
        $tuesday_status = false;
    }

    $wednesday_open = $_POST['wednesday_open'];
    $wednesday_close = $_POST['wednesday_close'];
    $wednesday_status = true;
    if (empty($wednesday_open) && !empty($wednesday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noopenwed");
        exit();
    }
    else if (!empty($monday_open) && empty($monday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noclosewed");
        exit();
    }
    if (empty($wednesday_open) && empty($wednesday_close)) {
        $wednesday_status = false;
    }

    $thursday_open = $_POST['thursday_open'];
    $thursday_close = $_POST['thursday_close'];
    $thursday_status = true;
    if (empty($thursday_open) && !empty($thursday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noopenthur");
        exit();
    }
    else if (!empty($thursday_open) && empty($thursday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noclosethur");
        exit();
    }
    if (empty($thursday_open) && empty($thursday_close)) {
        $thursday_status = false;
    }

    $friday_open = $_POST['friday_open'];
    $friday_close = $_POST['friday_close'];
    $friday_status = true;
    if (empty($friday_open) && !empty($friday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noopenfri");
        exit();
    }
    else if (!empty($friday_open) && empty($friday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noclosefri");
        exit();
    }
    if (empty($friday_open) && empty($friday_close)) {
        $friday_status = false;
    }

    $saturday_open = $_POST['saturday_open'];
    $saturday_close = $_POST['saturday_close'];
    $saturday_status = true;
    if (empty($saturday_open) && !empty($saturday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noopensat");
        exit();
    }
    else if (!empty($saturday_open) && empty($saturday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noclosesat");
        exit();
    }
    if (empty($saturday_open) && empty($saturday_close)) {
        $saturday_status = false;
    }

    $sunday_open = $_POST['sunday_open'];
    $sunday_close = $_POST['sunday_close'];
    $sunday_status = true;
    if (empty($sunday_open) && !empty($sunday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noopensun");
        exit();
    }
    else if (!empty($sunday_open) && empty($sunday_close)) {
        header("Location: ../dashboard/addlisting.php?error=noclosesun");
        exit();
    }
    if (empty($sunday_open) && empty($sunday_close)) {
        $sunday_status = false;
    }

    $monday = 'Mon';
    $tuesday = 'Tue';
    $wednesday = 'Wed';
    $thursday = 'Thu';
    $friday = 'Fri';
    $saturday = 'Sat';
    $sunday = 'Sun';

    $item_category = $_POST['item_category'];
    $item_name = $_POST['item_name'];
    $item_description = $_POST['item_description'];
    $item_price = $_POST['item_price'];

    $user_id = $_SESSION['user_id'];

    $visits = 0;
    $total_visit_time = 0;
    $website_link_clicks = 0;
    $twitter_link_clicks = 0;
    $facebook_link_clicks = 0;
    $instagram_link_clicks = 0;
    $mobile_users = 0;
    $other_users = 0;
    $computer_users = 0;
    $twitter_shares = 0;
    $facebook_shares = 0;
    $whatsapp_shares = 0;

    $sunday_visits = 0;
    $monday_visits = 0;
    $tuesday_visits = 0;
    $wednesday_visits = 0;
    $thursday_visits = 0;
    $friday_visits = 0;
    $saturday_visits = 0;

    $sql = "INSERT INTO listing (owner_id, listing_name, category_id, keywords, overview, province, city_town, listing_address, friendly_address, latitude, longtitude, website, email, twitter, facebook, instagram, website_link_clicks, twitter_link_clicks, facebook_link_clicks, instagram_link_clicks, twitter_shares, facebook_shares, whatsapp_shares)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'INSERT INTO' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../dashboard/addlisting.php?error=sqlerrorlolol");
    exit();
    }
    else {
    // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssss", $user_id, $listing_name, $category_id, $keywords, $description, $province, $citytown, $address, $friendly_address, $latitude, $longitude, $website, $email, $twitter, $facebook, $instagram, $website_link_clicks, $twitter_link_clicks, $facebook_link_clicks, $instagram_link_clicks, $twitter_shares, $facebook_shares, $whatsapp_shares);
    // Execute prepared statement
    mysqli_stmt_execute($stmt);
    }
    // Check if user uploaded profile picture
    if (($_FILES['listing_picture']['name'])) {
        // Check if listing picture the user uploaded is of a valid file type
        if (in_array($fileActualExt, $allowed)) {
            // Check if there were any errors uploading the listing picture
            if ($fileError === 0) {
                // Check if the file is less than 100Mb
                if ($fileSize < 10000000) {
                    $fileNameNew = "listing_picture_".mysqli_insert_id($conn).".".$fileActualExt;
                    $fileDestination = '../img/listing_pictures/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                }
                else {
                    // Display an error message if the user uploaded a file larger than 100Mb
                    header("Location: ../register/index.php?error=largeimg&fname=".$first_name."&lname=".$last_name."&email=".$email);
                    exit();
                }
            }
            else {
                // Display an error message if there was an unknown error uploading the listing picture
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

    $last_id = mysqli_insert_id($conn);

    $sql = "INSERT INTO listing_phone_number (listing_id, phone_number, number_rank) VALUES (?, ?, ?)";

    $rank1 = 1;
    $rank2 = 2;
    $rank3 = 3;

    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'INSERT INTO' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../dashboard/addlisting.php?error=sqlerror");
    exit();
    }
    else {
    // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sss", $last_id, $phone_1, $rank1);
    // Execute prepared statement
    mysqli_stmt_execute($stmt);
    // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sss", $last_id, $phone_2, $rank2);
    // Execute prepared statement
    mysqli_stmt_execute($stmt);
    // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sss", $last_id, $phone_3, $rank3);
    // Execute prepared statement
    mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO analytics (listing_id, owner_id, visits, total_visit_time, sun, mon, tue, wed, thu, fri, sat, mobile, other, computer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'INSERT INTO' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../dashboard/addlisting.php?error=sqlerrorvisits");
    exit();
    }
    else {
        // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $last_id, $user_id, $visits, $total_visit_time, $sunday_visits, $monday_visits, $tuesday_visits, $wednesday_visits, $thursday_visits, $friday_visits, $saturday_visits, $mobile_users, $other_users, $computer_users);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO amenity (listing_id, amenity) VALUES (?, ?)";

    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'INSERT INTO' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../dashboard/addlisting.php?error=sqlerror");
    exit();
    }
    else {
        if (isset($_POST['wi_fi'])) {
            $wi_fi = $_POST['wi_fi'];
            // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $last_id, $wi_fi);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
        }
        if (isset($_POST['pets'])) {
            $pets = $_POST['pets'];
            // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $last_id, $pets);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
        }
        if (isset($_POST['smocking'])) {
            $pets = $_POST['smocking'];
            // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $last_id, $smocking);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
        }
    }

    $sql = "INSERT INTO opening_hours (listing_id, weekday, opening_time, closing_time, openclose_status) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'INSERT INTO' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../dashboard/addlisting.php?error=sqlerror");
    exit();
    }
    else {
        // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $last_id, $monday, $monday_open, $monday_close, $monday_status);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
        // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $last_id, $tuesday, $tuesday_open, $tuesday_close, $tuesday_status);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
        // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $last_id, $wednesday, $wednesday_open, $wednesday_close, $wednesday_status);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
        // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $last_id, $thursday, $thursday_open, $thursday_close, $thursday_status);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
        // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $last_id, $friday, $friday_open, $friday_close, $friday_status);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
        // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $last_id, $saturday, $saturday_open, $saturday_close, $saturday_status);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
        // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $last_id, $sunday, $sunday_open, $sunday_close, $sunday_status);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Redirect the user the 'Success' page
    header("Location: ../dashboard/success.php?l_id=$last_id");
    exit();
    
}
else {

    // Return user to home page if script was accessed without clicking the 'Add Listing' button
    header("Location: ../index.php");

}
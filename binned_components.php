<!-- List View -->
<div class="row no-gutters listing-item-horizontal shadow-sm">
    <div class="col-xl-5">
        <div class="listing-item-pic set-bg" data-setbg="../img/listing/list-1.jpg">
            <div class="listing-category category">
                <a href="#"><i class="fa fa-utensils fa-fw stroke-transparent"></i> Food & Drinks</a>
            </div>
            <div class="listing-badge open">
                Open
            </div>
            <div class="bookmark">
                <a href="#"><i class="fa fa-heart stroke-transparent"></i></a>
            </div>
        </div>
    </div>
    <div class="listing-details listing-details-horizontal col-xl-7">
        <a href="../listing/index.php"><h2 class="card-title">Burger House</h2></a>
        <div class="location"><i class="fa fa-map-marker-alt fa-fw"></i> Plot No. 1086, Off Simon Mwansa Kapwepwe Rd</div>
        <div><i class="fa fa-phone fa-fw"></i> +260 975 944 213</div>
        <hr>
        <div class="listing-rating text-muted">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-alt"></i>
            <span> (1 review)</span>
        </div>
    </div>
</div>
<!-- /List View -->

<?php

if (isset($_POST['reset-password'])) {

    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    if (empty($password) || empty($password_repeat)) {
        header("Location: ../forgottenpwd/newpassword.php?emptyfields");
        exit();
    }
    else if ($password != $password_repeat) {
        header("Location: ../forgottenpwd/newpassword.php?newpasswordcheck");
        exit();
    }

    $current_date = date("U");

    require 'dbh.inc.php';

    $sql = "SELECT * FROM password_reset WHERE password_reset_selector=? AND password_reset_expires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $current_date);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$row = mysqli_fetch_assoc($result)) {
            echo "You need to re-submit your reset request.LOL";
            echo $validator;
            echo $selector;
            exit();
        }
        else {
            
            $token_bin = hex2bin($validator);
            $token_check = password_verify($token_bin, $row['password_reset_token']);

            if ($token_check === false) {
                echo "You need to re-submit your reset request.";
                exit();
            }
            else if ($token_check === true) {

                $token_email = $row['password_reset_email'];

                $sql = "SELECT * FROM user WHERE email=?;";

                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error!";
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $token_email);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);
            
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There was an error!";
                        exit();
                    }
                    else {
                        $sql = "UPDATE user SET user_password=? WHERE email=?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error!";
                            exit();
                        }
                        else {
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $token_email);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM password_reset WHERE password_reset_email=?;";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "There was an error!";
                                exit();
                            }
                            else {
                                mysqli_stmt_bind_param($stmt, "s", $token_email);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../login/index.php?password=updated");
                            }                    
                        }
                    }

                }


            }

        }
    }
}
else {

    header("Location: ../index.php");

}
?>
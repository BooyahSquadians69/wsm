<html>
<!-- Boostrap and tailwindcss -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</html>
<?php
require "./components/_dbconnect.php";

if (isset($_GET['email']) && isset($_GET['v_code'])) {
    require "./components/header.php";
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];
    $ref_code = $_GET['r_code'];
    $sql = "SELECT * FROM `website_users` WHERE `email` =  '$email' AND `verification_code` = '$v_code'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['is_verified'] == 0) {
                $sql = "UPDATE `website_users` SET `is_verified` = 1 WHERE `email` =  '$email'";
                if (mysqli_query($conn, $sql)) {
                    // Query was run
                    if (isset($_GET['r_code']) && !empty($ref_code)) {                  
                        // If ref code is there and is not empty
                        // Checking if the ref code is valid
                        $sql = "SELECT * FROM `website_users` WHERE `referral_code` =  '$ref_code'";
                        $result2 = mysqli_query($conn, $sql);
                        if($result2){
                            // If valid ref code
                            $result_fetch2 = mysqli_fetch_assoc($result2);
                            // Get username of the person who refered
                            $ref_username = $result_fetch2['username'];
                            // Get the referral points of that person and increase them by 100
                            $sql = "SELECT * FROM `website_users` WHERE `username` =  '$ref_username'";
                            $result3 = mysqli_query($conn, $sql);
                            $result_fetch3 = mysqli_fetch_assoc($result3);
                            $referral_points = $result_fetch3['referral_points'] + 100;
                            // Setting back the ref points
                            $sql = "UPDATE `website_users` SET `referral_points`='$referral_points' WHERE `username` =  '$ref_username'";
                            $result3 = mysqli_query($conn, $sql);

                            // Updating the person who got reffer
                            $sql = "UPDATE `website_users` SET `referred_by` = '$ref_username',`referral_points`= 100 WHERE `email` =  '$email'";
                            $result4 = mysqli_query($conn, $sql);
                    }else{
                        echo '<div class="alert alert-danger container" role="alert">
                        Invalid Referal Code
                        </div>';
                    }
                    }
                    echo '<div class="alert alert-success container" role="alert">
                    You got verified successfully!
                    </div>';
                    // Login 
                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $result_fetch['username'];
                    $_SESSION['fullname'] = $result_fetch['fullname'];
                    $_SESSION['email'] = $result_fetch['email'];
                    $_SESSION['insta_id'] = $result_fetch['insta_id'];
                    $_SESSION['dc_id'] = $result_fetch['discord_id'];
                    $_SESSION['ref_code'] = $result_fetch['referral_code'];
                    $_SESSION['ref_points'] = $result_fetch['referral_points'];
                    echo '<div class="container"><div class="alert alert-success" role="alert">
                    Logged In Successfully!
                </div></div>';
                    echo '<script>window.location.href="./index.php"</script>';
                } else {
                    echo '<div class="alert alert-danger container" role="alert">
                    Sorry, an error occured please try again later or contact admins.
                    </div>';
                }
            } else {
                echo '<div class="alert alert-danger container" role="alert">
                You are already verified User!
                </div>';
            }
        } else {
            echo '<div class="alert alert-danger container" role="alert">
            No user was found.
            </div>';
        }
    } else {
        echo '<div class="alert alert-danger container" role="alert">
        Sorry, an error occured please try again later or contact admins.
        </div>';
    }
    echo '<div class="container"><button type="button" class="btn btn-primary bg-blue-500"><a href="./index.php">Go Back</a></button></div>';
    require "./components/footer.php";
} else {
    header('Location: ./login.php');
}
?>
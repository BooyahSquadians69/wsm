<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WSM • LOGIN</title>
</head>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<body>
    <?php
    require('./components/header.php');
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_COOKIE['email_username']) && isset($_COOKIE['password'])) {
        $id = $_COOKIE['email_username'];
        $password = $_COOKIE['password'];
    } else {
        $id = "";
        $password = "";
    }
    ?>
    <div class="container">
        <?php require "./components/_dbconnect.php" ?>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['email_username'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM `website_users` WHERE `email` =  '$username' OR `username` = '$username'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $result_fetch = mysqli_fetch_assoc($result);
                    if ($result_fetch['is_verified'] == 1) {
                        if (password_verify($password, $result_fetch['password'])) {
                            $_SESSION['logged_in'] = true;
                            $_SESSION['username'] = $result_fetch['username'];
                            $_SESSION['fullname'] = $result_fetch['fullname'];
                            $_SESSION['email'] = $result_fetch['email'];
                            $_SESSION['insta_id'] = $result_fetch['insta_id'];
                            $_SESSION['dc_id'] = $result_fetch['discord_id'];
                            $_SESSION['ref_code'] = $result_fetch['referral_code'];
                            $_SESSION['ref_points'] = $result_fetch['referral_points'];
                            if (isset($_POST['remember_me'])) {
                                setcookie('email_username', $_POST['email_username'], time() + (60 * 60 * 24 * 7));
                                setcookie('password', $_POST['password'], time() + (60 * 60 * 24 * 7));
                            } else {
                                setcookie('email_username', '', time() - (60 * 60 * 24 * 7));
                                setcookie('password', '', time() - (60 * 60 * 24 * 7));
                            }
                            echo '<div class="container"><div class="alert alert-success" role="alert">
                            Logged In Successfully!
                        </div></div>';
                            echo '<script>window.location.href="./index.php"</script>';
                        } else {
                            echo '<div class="container"><div class="alert alert-danger" role="alert">
                            Incorrect Password!
                        </div></div>';
                        }
                    } else {
                        echo '<div class="container"><div class="alert alert-success" role="alert">
                        You have done the registeration , But please check your mail for the verification mail
                        </div></div>';
                    }
                } else {
                    echo '<div class="container"><div class="alert alert-danger" role="alert">
                Incorrect Username Or Email.<br>
                No Result with that Username Or Email Were Found<br>
                You can register with this Username or Email id <a href= "./register.php"><p class="inline-block text-blue-500 font-semibold">here</p></a>
            </div></div>';
                }
            } else {
                echo '<div class="container"><div class="alert alert-danger" role="alert">
                Some error occured in registeration! Please inform magazine admins about it.
            </div></div>';
            }
        }
        ?>
        <div class="container">
            <?php 
            if(isset($_GET['from'])&& $_GET['from']=='staff_recruitment'){
                echo '<div class="container">
            <div class="alert alert-danger font-semibold" role="alert">
              SORRY! But you will need to login first before submitting an application for staff recruitment!<br>';
            }
            ?>
        </div>
        <form action="<?php $_PHP_SELF ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="email_username" placeholder="User Name OR email@email.com" name="email_username" value="<?php echo $id ?>">
                <div id="passwordHelp" class="form-text text-gray-500">You can use email or username here</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" autocomplete="off" class="form-control" id="password" placeholder="Password" name="password" value="<?php echo $password ?>">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                <label class="form-check-label" for="remember_me">Remember Me</label>
            </div>
            <button type="submit" class="btn btn-primary bg-blue-500">Login</button>
            <div class="form-text inline-block">
                <p class="text-blue-500">
                    <a href="./register.php">
                        Not Registered Yet?
                    </a>
                </p>
            </div>
            OR
            <div class="form-text inline-block">
                <p class="text-blue-500">
                    <a href="./forgot_password.php">
                        Forgot password?
                    </a>
                </p>
            </div>
        </form>
    </div>
    <?php
    require('./components/footer.php');
    ?>
</body>

</html>
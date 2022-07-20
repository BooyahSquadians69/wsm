<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WSM • REGISTER</title>
</head>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "./components/_dbconnect.php" ?>

<body>
    <?php
    require('./components/header.php')
    ?>
    <?php
    function send_mail($email, $v_code,$ref_code){
        // 
        require('./lib/phpmailer/Exception.php');
        require('./lib/phpmailer/PHPMailer.php');
        require('./lib/phpmailer/SMTP.php');

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'weeklystudentmagazinebot@gmail.com';                     //SMTP username
            $mail->Password   = '(: 69 WSM || BOT || PASSWORD 69 :)';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('weeklystudentmagazinebot@gmail.com', 'Weekly Student Magazine Bot');
            $mail->addAddress($email);

            //Attachments
            $mail->addAttachment('./src/img/email.gif');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Verification Email From Weekly Student Magazine';
            $mail->Body    = "Thanks for registeration!<br>
            Click the link given to verify the Email Id
            <a href='http://weekly-student-magazine.epizy.com/email_verify.php?email=$email&v_code=$v_code&r_code=$ref_code'>Verify</a>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    } ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dc_id = $_POST['dc_id'];
        $insta_id = $_POST['insta_id'];
        $referral_code_submit = $_POST['referralCode'];
        $sql = "SELECT * FROM `website_users` WHERE `email` =  '$email' OR `username` = '$username' OR `insta_id` = '$insta_id' OR `discord_id`= '$dc_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // If $result is greater than 0 then to user name or email has been taken already
            if (mysqli_num_rows($result) > 0) {
                // For already existing username
                $result_fetch = mysqli_fetch_assoc($result);
                if ($result_fetch['username'] == $username) {
                    echo '<div class="container"><div class="alert alert-danger" role="alert">
                An account with this username(' . $username . ') already exist , Please try <a href= "./login.php"><p class="inline-block text-blue-500 font-semibold">login</p></a>
                </div></div>';
                }
                // For already existing email
                else if ($result_fetch['email'] == $email) {
                    echo '<div class="container"><div class="alert alert-danger" role="alert">
                    An account with this email(' . $email . ') already exist , Please try <a href= "./login.php"><p class="inline-block text-blue-500 font-semibold">login</p></a>
                </div></div>';
                }
                // For already existing dc_id
                else if ($result_fetch['insta_id'] == $insta_id) {
                    echo '<div class="container"><div class="alert alert-danger" role="alert">
                    An account with this insta id(' . $insta_id . ') already exist!
                </div></div>';
                }
                // For already existing insta_id
                else if ($result_fetch['dc_id'] == $dc_id) {
                    echo '<div class="container"><div class="alert alert-danger" role="alert">
                    An account with this discord Id(' . $dc_id . ') already exist!
                </div></div>';
                }
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT);
                $verification_code = bin2hex(random_bytes(16));
                $referal_code_generate = strtoupper(bin2hex(random_bytes(4)));
                $sql = "INSERT INTO `website_users`(`email`, `fullname`, `username`, `discord_id`, `insta_id`, `password`, `verification_code`,`is_verified`,`referral_code`,`referral_points`) VALUES ('$email','$fullname','$username','$dc_id','$insta_id','$password','$verification_code','0','$referal_code_generate','0')";
                if (mysqli_query($conn, $sql) && send_mail($email, $verification_code,$referral_code_submit)) {// If Query is run successfully , This code will run
                    echo '<div class="container"><div class="alert alert-success" role="alert">
                    We have send a veriication email on the email id ' . $email . '<br>
                    Please check it once and get your account verified<br>
                    <strong>Sometimes it comes in spam mails to.</strong>
                    </div></div>';
                } else {
                    // If Query is NOT run successfully , This code will run
                    echo '<div class="container"><div class="alert alert-danger" role="alert">
                        Some error occured in registeration! Please inform magazine admins about it.
                    </div></div>';
                }
            }
        } else {
            echo '<div class="container"><div class="alert alert-danger" role="alert">
                    Some error occured in registeration! Please inform magazine admins about it.
                </div></div>';
        }
    }
    ?>
    <div class="container">
        <form action="<?php $_PHP_SELF ?>" method="POST">
            <div class="form-row py-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="email@email.com">
                <small id="emailHelp" class="form-text text-muted">Verification Email will come to this email id.</small>
            </div>
            <div class="form-row py-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input name="fullname" type="text" class="form-control" id="fullname" aria-describedby="fullNameHelp" placeholder="Your Full Name">
                <small id="fullNameHelp" class="form-text text-muted">Your REAL Name</small>
            </div>
            <div class="form-row py-3">
                <label for="username" class="form-label">User Name</label>
                <input name="username" type="text" class="form-control" id="username" aria-describedby="userNameHelp" placeholder="Your USERNAME">
                <small id="userNameHelp" class="form-text text-muted">You will able to use email id or this username to login in this website.</small>
            </div>
            <div class="form-row py-3">
                <label for="dc_id">Your Discord ID</label>
                <input type="text" class="form-control" name="dc_id" placeholder="Discord ID" id="dc_id" required>
                <small id="dc_idHelp" class="form-text text-muted">We need this to stay in contact with you</small>
            </div>
            <div class="form-row py-3">
                <label for="insta_id">Your Insta ID</label>
                <input type="text" class="form-control" name="insta_id" placeholder="Insta ID" id="insta_id" required>
                <small id="emailHelp" class="form-text text-muted">We need this to stay in contact with you</small>
            </div>
            <div class="form-row py-3 ">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                <small id="passwordHelp" class="form-text text-muted">Your password is stored encrypted in our data servers.Even our admins will not able to see your password!</small>
            </div>
            <div class="form-row py-3">
                <label for="referralCode">Referal Code</label>
                <input type="text" class="form-control" name="referralCode" placeholder="Referal Code" id="referralCode" <?php
                if (isset($_GET['ref_code'])) {echo 'readonly value=' . $_GET['ref_code'];}?>>
                <small id="emailHelp" class="form-text text-muted">You can leave this empty if you dont have any referal code</small>
            </div>
            <button type="submit" class="mb-3 btn btn-primary bg-blue-500">Register</button>
            <div class="form-text inline-block">
                <p class="text-blue-500">
                    <a href="./login.php">
                        Already Registered?
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
            <small id="submitHelp" class="form-text text-muted">Please wait after click register , since the mail is sent after you click register , dont panic and be patient </small>
        </form>
    </div>
    <?php
    require('./components/footer.php');
    ?>
</body>

</html>
<html>
<!-- Boostrap and tailwindcss -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</html>
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require('./components/_dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WSM  • FORGOT PASSWORD</title>
</head>

<body>
    <?php
    require('./components/header.php');
    function send_mail($email, $reset_token)
    {
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
            $mail->Subject = 'Password Reset Email From Weekly Student Magazine';
            $mail->Body    = "We got a request for your password reset<br>
            Click the link given to reset your password <br>
            <a href='http://weekly-student-magazine.epizy.com/update_password.php?email=$email&reset_token=$reset_token'>Reset Password</a>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    } ?>
    <div class="container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $sql = "SELECT * FROM `website_users` WHERE `email` =  '$email'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $reset_token = bin2hex(random_bytes(16));
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date("Y-m-d");
                    $sql = "UPDATE `website_users` SET `reset_token`='$reset_token',`reset_token_expire`='$date' WHERE `email` = '$email'";
                    if (mysqli_query($conn, $sql) && send_mail($email, $reset_token)) {
                        echo '<div class="container"><div class="alert alert-success" role="alert">
                    Password reset token was send on your email id.<br>
                    If you cant see it in your inbox , please check spam mails too.
                </div></div>';
                    } else {
                        echo '<div class="container"><div class="alert alert-danger" role="alert">
                    An error occured , Please contant server admins!
                </div></div>';
                    }
                } else {
                    echo '<div class="container"><div class="alert alert-warning" role="alert">
                    Email not found in the database , Please try registering the email first
                </div></div>';
                }
            } else {
                echo '<div class="container"><div class="alert alert-danger" role="alert">
                An error occured , Please contant server admins!
            </div></div>';
            }
        } ?>
        <form action="<?php $_PHP_SELF ?>" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="email@email.com">
                <div id="emailHelp" class="form-text">You will receive a password reset link on this mail.</div>
            </div>
            <button type="submit" class="btn btn-primary bg-blue-500">Submit</button>
        </form>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>

</html>

<?php
require('./components/footer.php');
?>
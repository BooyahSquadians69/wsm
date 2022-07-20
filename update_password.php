<html>
<!-- Boostrap and tailwindcss -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WSM  • Password Update</title>
</head>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<body>
    <div class="container">
        <?php
        require("./components/_dbconnect.php");
        require("./components/header.php");
        
        if (isset($_GET['email']) && isset($_GET['reset_token'])) {
            $email = $_GET['email'];
            $reset_token = $_GET['reset_token'];
            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d');
            
            $sql = "SELECT * FROM `website_users` WHERE `email`= '$email' AND `reset_token` = '$reset_token' AND `reset_token_expire` = '$date'";
            $result = mysqli_query($conn, $sql);
            if($result){
                if (mysqli_num_rows($result) == 1) {
                    echo '<form id="update_password" name = "update_password" action="./update_password.php" method="POST">
                    <div class="mb-3">
                    <label for="update_password" class="form-label">Enter New Password</label>
                    <input type="password" class="form-control" id="update_password" name="update_password" placeholder="New Password">
                    </div>
                    <input type="hidden" id ="email" name="email" value = '. $email .'>
                    <button type="submit" class="btn btn-primary bg-blue-500">Submit</button>
                    <div id="submitHelp" class="form-text text-gray-500">Please wait after click submit , since the mail is sent after you click submit , dont panic and be patient </div>
                    </form>';
                } else {
                    echo '<div class="container"><div class="alert alert-danger" role="alert">
                    Invalid or expired Link!
                    </div></div>';
                }
            } else {
                echo '<div class="container"><div class="alert alert-danger" role="alert">
                An error occured , Please contant server admins!
                </div></div>';
            }
        }
        ?>
        <?php 
        if(isset($_POST['update_password'])){
            $password = $_POST['update_password'];
            $email = $_POST['email'];
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE `website_users` SET `password`='$password',`reset_token`= NULL,`reset_token_expire`= NULL WHERE `email` = '$email'";
            if(mysqli_query($conn, $sql)){
                echo '<div class="container"><div class="alert alert-success" role="alert">
                Password Updated Successfully!
                </div></div>';
                echo '<script>
            window.location.href="./index.php"
            </script>';
            }else{
                echo '<div class="container"><div class="alert alert-danger" role="alert">
                An error occured , Please contant server admins!
                </div></div>';
            }
        }
        ?>
    </div>
    <?php require("./components/footer.php"); ?>
</body>
</html>
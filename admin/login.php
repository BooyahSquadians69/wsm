<html>
<!-- Boostrap and tailwindcss -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</html>
<!--Header-->
<?php
if (!isset($_SESSION)) {
    session_start();
};
require "../components/admin/header.php";
?>
<?php
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true) {
    echo '<script>window.location.href="./index.php"</script>';
}
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $LogUser = $_POST['user'];
        $LogPass = $_POST['pass'];
        if ($LogUser == 'WSM_ADMIN' && $LogPass == '_ADMIN@1920') {
            $_SESSION["admin"] = true;
            $_SESSION["admin_logged_in"] = true;
            echo '<script>window.location.href="./index.php"</script>';
        } else {
            echo '<div class="alert alert-danger container my-5" role="alert">
    Incorrect Username or Password
  </div>';
        }
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta name="robots" content="noindex,nofollow">
        <title>WSM || ADMIN</title>
    </head>

    <body>
        <?php require "../components/_dbconnect.php" ?>
        <!--Body-->
        <div class="container">
            <?php
            if (isset($_SESSION['admin_logged_in'])&& $_SESSION['admin_logged_in']==true) {
                echo '<script>window.location.href="./index.php"</script>';
            } else { ?>
                <form action="<?php $_PHP_SELF ?>" method="POST">
                    <div class="area ">
                        <div class="container">
                            <h1 class="text-white">Please Login</h1>
                            <div class="input-group mb-3 ">
                                <span class="input-group-text" id="user">Username</span>
                                <input type="text" class="form-control" name="user" laceholder="Username" aria-label="Username" aria-describedby="user" placeholder="Username" id="username">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="pass">Password</span>
                                <input type="password" class="form-control" autocomplete="current_password" name="pass" placeholder="Password" aria-label="Password" aria-describedby="pass" id="password">
                            </div>
                            <div class="butt mb-3">
                                <button class="btn btn-primary btn-lg" id="submit">Log In</button>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    <?php } ?>
    <!--Footer-->
    <?php require "../components/admin/footer.php"; ?>
    </script>
    </body>

    </html>
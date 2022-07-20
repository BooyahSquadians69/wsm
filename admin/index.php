<html>
<!-- Boostrap and tailwindcss -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</html>
<?php
if (!isset($_SESSION)) {
    session_start();
};
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in']==false) {
    echo '<script>window.location.href="./login.php"</script>';
} else {
    require('../components/admin/header.php'); ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WSM || ADMIN</title>
    </head>

    <body>
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4 text-indigo-500 font-semibold">Welcome to ADMIN page of WSM</h1>
                <h1 class="display-4 text-blue-500 p-3">Select Where do you wanna go?</h1>
                <hr class="my-2">
                <p class="lead">
                    <ul> 
                        <li style="list-style-type:square"><a class="btn btn-danger btn-lg m-2" href="./m_submission.php" role="button">Magazine Admin Page</a></li>
                        <li style="list-style-type:square"><a class="btn btn-danger btn-lg m-2" href="./wb_submission.php" role="button">Website Submissions Admin Page</a></li>
                        <li style="list-style-type:square"><a class="btn btn-danger btn-lg m-2" href="./post_admin.php" role="button">Post Admin Page</a></li>
                        <li style="list-style-type:square"><a class="btn btn-danger btn-lg m-2" href="./promotion.php" role="button">Promotion Admin Page</a></li>
                        <li style="list-style-type:square"><a class="btn btn-danger btn-lg m-2" href="./contact_us.php" role="button">Contact Us Admin Page</a></li>
                        <li style="list-style-type:square"><a class="btn btn-danger btn-lg m-2" href="./staff_recruitment.php" role="button">Staff Reincruitment Page</a></li>
                    <li style="list-style-type:square"><a class="btn btn-danger btn-lg m-2" href="./comments.php" role="button">Comments Admin Page</a></li>
                    <li style="list-style-type:square"><a class="btn btn-danger btn-lg m-2" href="./wb_post.php" role="button">Make a Post</a></li>
                    <li style="list-style-type:square"><a class="btn btn-danger btn-lg m-2" href="./view_pdf.php" role="button">View Magazine Pdf</a></li>
                    <li style="list-style-type:square"><a class="btn btn-danger btn-lg m-2" href="../generate_pdf.php" role="button">Generate Magazine Pdf</a></li>
                    </ul>
                </p>
            </div>
        </div>
        <?php require('../components/admin/footer.php'); ?>
    </body>

    </html>


<?php
}
?>
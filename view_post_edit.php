<html>
<!-- Boostrap and tailwindcss -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</html>
<?php
require './components/_dbconnect.php'; ?>
<div class="container">
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }    
    if(isset($_GET['id'])){
        $getPostId = $_GET['id'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sno = $_POST['snoEdit'];
        $post_id = $_POST['postIdEdit'];
        $username = $_POST['usernameEdit'];
        $comment = $_POST['commentEdit'];
        // Updating data in the db
        $sql = "UPDATE `website_comments` SET `sno` = '$sno', `post_id` = '$post_id', `username` = '$username', `comment` = '$comment',`is_edited` = 1 WHERE `sno` = '$sno'";
        $result = mysqli_query($conn, $sql);

        // Check for the table creation success
        if ($result) {
            // Edited
            echo '<script>
            window.location.href="./view_post.php?id=.'.$getPostId.'&from=edit&error_code=0"
            </script>';
        } else {
            // Server down
            echo '<script>
            window.location.href="./view_post.php?id=.'.$getPostId.'&from=edit&error_code=3"
            </script>';
        }
    }
    echo '<script>
            window.location.href="./view_post.php?id=.'.$getPostId.'
            </script>';
?>
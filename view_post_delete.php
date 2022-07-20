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
    $sql = "SELECT * FROM `website_posts` WHERE `id` = '$getPostId'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        //error 404
        require "./error/404.php";
    } else {
        if (isset($_GET['delete'])) {
            $delete_no = $_GET['delete'];
            $sql = "SELECT * FROM `website_comments` WHERE `post_id`= '$getPostId' AND `sno` = '$delete_no'";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) !== 0) {
                // 0 = deleted
                // 1 = not found
                // 2 = not authorized
                // 3 = server down
                $result = mysqli_fetch_array($res);
                if (isset($_SESSION['username']) && $_SESSION['username'] == $result['username']) {
                    $sql = "SELECT * FROM `website_comments` WHERE `post_id` = '$getPostId' AND `sno` = '$delete_no'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) == 0) {
                        // Not found
                        echo '<script>
            window.location.href="./view_post.php?id=.'.$getPostId.'&from=edit&error_code=1"
            </script>';
                    } else {
                        $sql = "DELETE FROM `website_comments` WHERE `post_id` = '$getPostId' AND `sno` = '$delete_no'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            // deleted
                            echo '<script>
            window.location.href="./view_post.php?id=.'.$getPostId.'&from=edit&error_code=0"
            </script>';
                        } else {
                            // server down err
                            echo '<script>
            window.location.href="./view_post.php?id=.'.$getPostId.'&from=edit&error_code=3"
            </script>';
                        }
                    }
                }
                else if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true) {
                    $sql = "SELECT * FROM `website_comments` WHERE `post_id` = '$getPostId' AND `sno` = '$delete_no'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) == 0) {
                        // Not found
                        echo '<script>
            window.location.href="./view_post.php?id=.'.$getPostId.'&from=edit&error_code=1"
            </script>';
                    } else {
                        $sql = "DELETE FROM `website_comments` WHERE `post_id` = '$getPostId' AND `sno` = '$delete_no'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            // Deleted
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
                } else {
                    // Not authorized
                    echo '<script>
            window.location.href="./view_post.php?id=.'.$getPostId.'&from=edit&error_code=2"
            </script>';
                }
            } else {
                // Not found
                echo '<script>
            window.location.href="./view_post.php?id=.'.$getPostId.'&from=edit&error_code=1"
            </script>';
            }
            echo '<script>
            window.location.href="./view_post.php?id=.'.$getPostId;
        }
    } ?>
</div>
<html>
<!-- Boostrap and tailwindcss -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>
<?php
if (!isset($_SESSION)) {
    session_start();
} ?>
<?php require "./components/_dbconnect.php" ?>
<?php require "./components/header.php" ?>
<?php

if (!isset($_GET['id'])) {
    //404 error
    require "./error/404.php";
    require "./components/footer.php";
} else {
    $getPostId = $_GET['id'];
    $PostSql = "SELECT * FROM `website_posts` WHERE `id` = '$getPostId'";
    $PostRes = mysqli_query($conn, $PostSql);
    if (mysqli_num_rows($PostRes) == 0) {
        //error 404
        require "./error/404.php";
    } else {
        $Data = mysqli_fetch_assoc($PostRes);
        $views = intval($Data['views']) + 1;
        $ReadSql = "UPDATE `website_posts` SET `views` = {$views} WHERE `id` = '{$getPostId}'";
        mysqli_query($conn, $ReadSql);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>WSM • VIEW SUBMIT</title>
        </head>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title " id="editModalLabel">Viewing Comments</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="./view_post_edit.php?id=<?php echo $getPostId;?>" method="POST">
                            <div class="form-group row">
                                <label for="snoEdit" class="col-sm-2 col-form-label">SR. Number</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="snoEdit" name="snoEdit" value="">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="postIdEdit" class="col-sm-2 col-form-label">Post id of comment</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="postIdEdit" name="postIdEdit" value="" readonly>
                                    <small id="type" class="form-text text-muted">
                                        The post where the comment is
                                    </small>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="usernameEdit" class="col-sm-2 col-form-label">Username of Commenter</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="usernameEdit" name="usernameEdit" value="" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="commentEdit" class="col-sm-2 col-form-label">Comment</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="commentEdit" name="commentEdit" value="">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="dateEdit" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="dateEdit" name="dateEdit" value="" readonly>
                                </div>
                            </div>
                            <hr>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary bg-blue-500">Save changes</button>
                        </form>
                        <button type="button" class="btn btn-secondary bg-gray-500" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $sql = "SELECT * FROM `website_posts` WHERE `id`='$getPostId'";
        $result = mysqli_query($conn, $sql);
        $result_fetch = mysqli_fetch_assoc($result);
        ?>
        <section class="text-gray-600 body-font">
            <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
                <img class="w-6/6 mb-10 object-cover object-center rounded" alt="image" src="<?php echo $result_fetch['image_link'] ?>">
                <div class="text-center lg:w-2/3 w-full">
                    <h1 class="title-font sm:text-5xl text-3xl mb-4 font-medium text-gray-900"><?php echo $result_fetch['heading'] ?></h1>
                    <p class="mb-8 leading-relaxed sm:text-3xl text-xl "><?php echo $result_fetch['content'] ?></p>
                    <?php if(!empty($result_fetch['magazine_pdf'])){echo
                        '<p class="sm:text-3xl text-xl" style="color:rgb(230,37,57)">'.'Magazine Link -> </p>'.'<a class="mb-8 p-3 sm:text-3lg text-xl" style="color:rgb(248,141,35);text-decoration:none;" href='.$result_fetch['magazine_pdf'].'>'.$result_fetch['magazine_pdf'].'</a>';}
                        ?>
                    <div class="flex justify-center">
                    </div>
                    <hr class="mt-5" style="height:2px;border-width:0;color:gray;background-color:gray">
                    <?php
                    $post_id = $result_fetch['id'];
                    $sql = "SELECT * FROM `website_comments` WHERE `post_id` = '$post_id'";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <div class="title-font sm:text-5xl text-3xl my-10 py-10 font-medium text-gray-900">
                        Comments (<?php echo mysqli_num_rows($result); ?>)
                    </div>
                    <div class="container">
                        <form action="<?php $_PHP_SELF ?>" method="POST">
                            <div class="form-group py-2">
                                <label for="name">Username</label>
                                <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" placeholder="Enter your username"
                                <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false){
                                    
                                }
                                else{
                                    $username = $_SESSION['username'];
                                    echo "value='$username' readonly";
                                    }?>
                                </div>
                                <div class="form-group py-2">
                                    <label for="comment">Comment</label>
                                    <textarea type="text" class="form-control" id="comment" name="comment" aria-describedby="commentHelp" rows='4' placeholder="Enter your comment"></textarea>
                                </div>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
                                        echo '<div class="alert alert-danger" role="alert">
                                    Sorry but you will need to login before commenting!
                                </div>';
                                    } else {
                                        $username = $_SESSION['username'];
                                        $comment = $_POST['comment'];
                                        date_default_timezone_set('Asia/Kolkata');
                                        $date = date("l F j Y");
                                        if(empty($comment)){
                                            echo '<div class="alert alert-danger container" role="alert">
                                                Sorry You cant have empty comments!
                                            </div><br>';
                                        }
                                        else{
                                        // Inserting data in the db
                                        $sql = "INSERT INTO `website_comments`(`post_id`,`username`,`comment`,`date`) VALUES ('$getPostId','$username','$comment','$date')";
                                        $result = mysqli_query($conn, $sql);

                                        // Check for the submission success
                                        if ($result) {
                                            echo '<div class="alert alert-success container" role="alert">
                                                Your request was to the server successfully!
                                            </div><br>';
                                        } else {
                                            echo '<div class="alert alert-danger container" role="alert">
                                                Sorry! an error occured please try again later or contact admins
                                            </div>';
                                        }
                                    }
                                }
                                }
                                ?>
                                <button type="submit" class="btn btn-primary bg-blue-500">Comment</button>
                        </form>
                    </div>
                    <?php
                    $sql = "SELECT * FROM `website_comments` WHERE `post_id`= '$getPostId'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) == 0) {
                        echo '<p class="my-8 leading-relaxed sm:text-3xl text-xl ">
                            No comments till now.<br>
                            Be the first one to comment!
                            </div>';
                    } else {
                        echo '
                        </p>
                    </div>
                </div>';
                        while ($result_fetch = mysqli_fetch_assoc($result)) {
                            echo '
                    <div class="flex w-2/3 m-2 p-4">
                    <div class="flex-shrink-0 mr-3">
                    <img src="./src/img/user.png" alt="" class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10">
                    </div>
                    <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed max-w-[75vw] break-words">
                    <strong class="mx-0">@</strong>
                    <strong class="mx-0">'.$result_fetch['username'].'</strong>
                    <span class=" text-xs text-gray-400">' . $result_fetch['date'] . '</span>
                    <div class=" flex space-x-2">
                    <p class="text-lg">' . $result_fetch['comment'] . '</p><br>';
                    
                    if($result_fetch['is_edited']==1){
                        echo '<img class="rounded" alt="" src="./src/img/edited.png">';
                        echo '<p class="text-base text-gray-500 italic">Edited</p>';
                    }
                    echo '<br>
                    </div>
                    ';

                            if (isset($_SESSION['username']) && $_SESSION['username'] == $result_fetch['username']) {
                                echo '<button type="button" class="edit btn btn-success bg-green-600 my-1" id="' . $result_fetch['sno'] . '">Edit</button>';
                                echo '<button type="button" class="delete btn btn-danger bg-red-500 mx-2 my-1" id="' . $result_fetch['sno'] . '">Delete</button>';
                            } elseif (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true) {
                                echo '<button type="button" class="edit btn btn-success bg-green-600  my-1" id="' . $result_fetch['sno'] . '">Edit</button>';
                                echo '<button type="button" class="delete btn btn-danger bg-red-500 mx-2 my-1" id="' . $result_fetch['sno'] . '">Delete</button>';
                            }
                            echo '
                            </div>
                    </div>';
                        }
                    }

                    if (isset($_GET['from']) && isset($_GET['error_code'])) {
                        // 0 = deleted
                        // 1 = not found
                        // 2 = not authorized
                        // 3 = server down
                        if (isset($_GET['from']) && $_GET['from'] == 'delete') {
                            if (isset($_GET['error_code']) & $_GET['error_code'] == 0) {
                                echo '<div class="alert alert-success" role="alert">
                                    Comment was deleted successfully!
                                </div>';
                            } else if (isset($_GET['error_code']) && $_GET['error_code'] == 1) {
                                echo '<div class="alert alert-danger" role="alert">
                                    Comment not found
                                </div>';
                            } else if (isset($_GET['error_code']) && $_GET['error_code'] == 2) {
                                echo '<div class="alert alert-danger" role="alert">
                                    You are not authorized to delete this comment!
                                </div>';
                            } else if (isset($_GET['error_code']) && $_GET['error_code'] == 3) {
                                echo '<div class="alert alert-danger" role="alert">
                                Sorry! An error occured while deleting your comment maybe servers are down , Please try again later
                                </div>';
                            }
                        }
                    }
                    ?>
        </section>

        <body>
            <script>
                // Delete Btn click event
                deletes = document.getElementsByClassName("delete");
                Array.from(deletes).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        console.log("delete");
                        sno = e.target.id;
                        sno = sno.trim();
                        console.log(sno);
                        if (confirm("Are you sure you want to delete this comment!")) {
                            console.log("yes");
                            window.location = `./view_post_delete.php?id=<?php echo $getPostId; ?>&delete=${sno}`;
                        } else {
                            console.log("no");
                        }
                    });
                });

                // Edit btn click event
                edits = document.getElementsByClassName("edit");
                Array.from(edits).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        // console.log("edit",e.target);
                        target = e.target.parentNode;
                        sno = e.target.id;
                        console.log(target)
                        console.log(sno)

                        post_id = <?php echo '"' . $getPostId . '"'; ?>;
                        username = target.getElementsByTagName("strong")[1].innerText;
                        comment = target.getElementsByTagName("p")[0].innerText;
                        date = target.getElementsByTagName("span")[0].innerText;

                        snoEdit.value = `${sno}`
                        postIdEdit.value = `${post_id}`
                        usernameEdit.value = `${username}`
                        commentEdit.value = `${comment}`
                        dateEdit.value = `${date}`

                        $("#editModal").modal("toggle");
                    });
                });
            </script>
        </body>
        <?php require "./components/footer.php"; ?>

        </html>
<?php
    }
}
?>
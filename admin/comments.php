<html>
<!-- Boostrap and tailwindcss -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

</html>
<?php
require "../components/_dbconnect.php";
if (!isset($_SESSION)) {
    session_start();
};

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in']==false) {
    echo '<script>window.location.href="./index.php"</script>';
} else {
    echo '<script>window.location.href="./index.php"</script>';

    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        $sql = "DELETE FROM `website_comments` WHERE `sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<div class="alert alert-success container" role="alert">
            The submission was delete successfully!
        </div>';
        } else {
            echo '<div class="alert alert-danger container" role="alert">
            Some error occured in deleting the submission! Please try again later.
        </div>';
        }
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
            echo '<div class="alert alert-success container" role="alert">
        The records were updated successfully!
      </div><br>';
        } else {
            echo '<div class="alert alert-danger container" role="alert">
        Sorry! an error occured please try again later or contact admins.
      </div>';
        }
        // }
    }
?>
    <html>
    <script>
        window.history.replaceState({}, '', location.href.replace(location.search, ""));
    </script>

    </html>

    <!--Body-->
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
                    <form action="<?php $_PHP_SELF ?>" method="POST">
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
    <div class="main container">
        <title>WSM || COMMMENTS</title>
        <h1 class="text-black mb-6 text-2xl font-semibold text-center text-green-600">All COMMENTS</h1>
        <!-- <div class="p-4"><a class="btn btn-primary" href="../submit.php" style="width: 100%;"></a></div> -->
        <div class="container table-responsive table-responsive-xl">
            <table class="table table-bordered" id="myTable" style="table-layout: fixed; width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Serial Number</th>
                        <th scope="col">Post Id</th>
                        <th scope="col">Name of commenter</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `website_comments` ORDER BY sno DESC";
                    $res = mysqli_query($conn, $sql);
                    $srno = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $srno = $srno + 1;
                    ?>
                        <!--Card Start-->
                        <tr>
                            <th scope="row"><?php echo $srno ?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['post_id'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['username'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['comment'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['date'])?></td>
                            <td>
                                <button class='edit btn btn-sm btn-primary m-1' id="
                                <?php echo trim($row['sno']) ?>
                                ">View</button>
                                <button class='delete btn btn-sm btn-danger m-1' id="
                                <?php echo trim($row['sno']) ?>
                                ">Decline</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!--Card End-->
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(() => {
            $("#myTable").DataTable();
        });
    </script>
    <script>
        // Delete Btn click event
        deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete");
                sno = e.target.id.substr(1);
                sno = sno.trim();
                console.log(sno);
                if (confirm("Are you sure you want to delete this submission!")) {
                    console.log("yes");
                    window.location = `./wb_submission.php?delete=${sno}`;
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
                tr = e.target.parentNode.parentNode;
                console.log(tr)
                sno = e.target.id.substr(1);
                sno = sno.trim();
                console.log(sno)

                id = tr.getElementsByTagName("td")[0].innerText;
                username = tr.getElementsByTagName("td")[1].innerText
                comment = tr.getElementsByTagName("td")[2].innerText;
                date = tr.getElementsByTagName("td")[3].innerText;

                snoEdit.value = `${sno}`
                postIdEdit.value = `${id}`
                usernameEdit.value = `${username}`
                commentEdit.value = `${comment}`
                dateEdit.value = `${date}`

                $("#editModal").modal("toggle");
            });
        });
    </script>

<?php require('../components/admin/footer.php');
} ?>
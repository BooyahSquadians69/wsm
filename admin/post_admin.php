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
    require('../components/admin/header.php');

    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        $sql = "DELETE FROM `website_posts` WHERE `sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<div class="alert alert-success container" role="alert">
            The post was delete successfully!
        </div>';
        } else {
            echo '<div class="alert alert-danger container" role="alert">
            Some error occured in deleting the post! Please try again later.
        </div>';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sno = $_POST['snoEdit'];
        $id = $_POST['idEdit'];
        $type = $_POST['typeEdit'];
        $heading = $_POST['headingEdit'];
        $content = $_POST['contentEdit'];
        $imageLink = $_POST['imageLinkEdit'];
        $magazine_pdf = $_POST['magazinePdfLinkEdit'];
        $admin = $_POST['adminEdit'];
        // Updating data in the db
        $sql = "UPDATE `website_posts` SET `id` = '$id', `type` = '$type', `heading` = '$heading', `content` = '$content' ,`image_link`='$imageLink',`magazine_pdf`='$magazine_pdf',`admin`='$admin' WHERE `sno` = '$sno'";
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
                    <h5 class="modal-title " id="editModalLabel">Viewing Submission</h5>
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
                            <label for="idEdit" class="col-sm-2 col-form-label">Id</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="idEdit" name="idEdit" value="">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="typeEdit" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="typeEdit" name="typeEdit" value="">
                                <small id="typeEditHelp" class="form-text  text-red-900 font-bold">
                                    PLEASE DONT CHANGE UNLESS YOU KNOW WHAT YOU ARE DOING
                                </small>
                                <small id="typeEditHelp" class="form-text  text-red-900 font-semibold">
                                    IF YOU WILL PUT ANYTHING EXECPT VALID TYPES MENTIONS ,
                                    THE SUBMISSION WILL GET CURRUPT! AND IT WILL NOT COME IN MAGAZINE!
                                    THE SPACING AND THE CAPITALIZATION MATTERS

                                </small>
                                <small id="typeEditHelp" class="form-text text-blue-900">
                                    <br> VALID TYPES ->
                                    <?php
                                    $type_list = [
                                        "Personal Experience",
                                        "Self Help Articles",
                                        "Honest Reviews",
                                        "Official News",
                                        "Interview",
                                        "Roasts",
                                        "Trend",
                                        "Memes",
                                        "Story",
                                        "Other",
                                    ];
                                    echo '<ul  style="list-style-type:circle">';
                                    foreach ($type_list as $type) {
                                        echo "<li>" . $type . '</li>';
                                    } ?>
                                    </ul><br>
                                </small>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="headingEdit" class="col-sm-2 col-form-label">Heading</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="headingEdit" name="headingEdit" value="">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="contentEdit" class="col-sm-2 col-form-label">Content, <br>You can use <a href="https://www.w3schools.com/TAgs/default.asp" target="_blank" class="text-blue-600"> html tags here</a></label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control-plaintext" id="contentEdit" name="contentEdit" rows="10" value=""></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="imageLinkEdit" class="col-sm-2 col-form-label">Image Link</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="imageLinkEdit" name="imageLinkEdit" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="magazinePdfLinkEdit" class="col-sm-2 col-form-label">Magazine Pdf Link</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="magazinePdfLinkEdit" name="magazinePdfLinkEdit" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="viewsEdit" class="col-sm-2 col-form-label">Views</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="viewsEdit" name="viewsEdit" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="adminEdit" class="col-sm-2 col-form-label">Admin Responsible</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" readonly id="adminEdit" name="adminEdit" value="">
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
        <title>WSM || SUBMISSIONS</title>
        <h1 class="text-black mb-6 text-2xl font-semibold text-center text-green-600">All Posts</h1>
        <div class="p-4"><a class="btn btn-primary" href="./wb_post.php" style="width: 100%;">New Post</a></div>
        <div class="container table-responsive table-responsive-xl">
            <table class="table table-bordered" id="myTable" style="table-layout: fixed; width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Serial Number</th>
                        <th scope="col">Post_ID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Content</th>
                        <th scope="col">Image_Link</th>
                        <th scope="col">Views</th>
                        <th scope="col">Magazine Pdf Link</th>
                        <th scope="col">Admin Responsible</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `website_posts` ORDER BY sno DESC";
                    $res = mysqli_query($conn, $sql);
                    $srno = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $srno = $srno + 1;
                    ?>
                        <!--Card Start-->
                        <tr>
                            <th scope="row"><?php echo $srno ?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['id'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['type'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap(htmlentities($row['heading']))?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap(htmlentities($row['content']))?></td>
                            <td style="word-wrap: break-word"><?php echo wordwrap(htmlentities($row['image_link']))?></td>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['views'])?></td>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['magazine_pdf'])?></td>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['admin'])?></td>
                            <td>
                                <button class='edit btn btn-sm btn-primary m-1' id="
                                <?php echo trim($row['sno']) ?>
                                ">Edit</button>
                                <button class='delete btn btn-sm btn-danger m-1' id="
                                <?php echo trim($row['sno']) ?>
                                ">Delete</button>
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
                    window.location = `./post_admin.php?delete=${sno}`;
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
                type = tr.getElementsByTagName("td")[1].innerText
                heading = tr.getElementsByTagName("td")[2].innerText;
                content = tr.getElementsByTagName("td")[3].innerText;
                imageLink = tr.getElementsByTagName("td")[4].innerText;
                views = tr.getElementsByTagName("td")[5].innerText;
                magazine_link = tr.getElementsByTagName("td")[6].innerText;
                admin = tr.getElementsByTagName("td")[7].innerText;

                snoEdit.value = `${sno}`
                idEdit.value = `${id}`
                typeEdit.value = `${type}`
                headingEdit.value = `${heading}`
                contentEdit.value = `${content}`
                imageLinkEdit.value = `${imageLink}`
                viewsEdit.value = `${views}`
                magazinePdfLinkEdit.value = `${magazine_link}`
                adminEdit.value = `${admin}`

                $("#editModal").modal("toggle");
            });
        });
    </script>

<?php require('../components/admin/footer.php');
} ?>
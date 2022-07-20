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
        $sql = "DELETE FROM `final_submit` WHERE `sno` = $sno";
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
        $sno = $_POST['idEdit'];
        $email = $_POST['emailEdit'];
        $name = $_POST['nameEdit'];
        $type = $_POST['typeEdit'];
        $heading = $_POST['headingEdit'];
        $submission = $_POST['submissionEdit'];
        // Updating data in the db
        $sql = "UPDATE `final_submit` SET `email` = '$email', `name` = '$name', `type` = '$type', `heading` = '$heading', `submission` = '$submission' WHERE `sno` = '$sno'";
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
                            <label for="idEdit" class="col-sm-2 col-form-label">SR. Number</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="idEdit" name="idEdit" value="">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="nameEdit" class="col-sm-2 col-form-label">Name Of Submitter</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="nameEdit" name="nameEdit" value="">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="emailEdit" class="col-sm-2 col-form-label">Email Of Submitter</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="emailEdit" name="emailEdit" value="">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="typeEdit" class="col-sm-2 col-form-label">Type of Submission</label>
                            <div class="col-sm-10">
                                <input readyonly type="text" class="form-control-plaintext" id="typeEdit" name="typeEdit" value="">
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
                            <label for="headingEdit" class="col-sm-2 col-form-label">Heading of Submission</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="headingEdit" name="headingEdit" value="">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="submissionEdit" class="col-sm-2 col-form-label">Submission</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="submissionEdit" name="submissionEdit" value="">
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
        <h1 class="text-black mb-6 text-2xl font-semibold text-center text-green-600">All Submissions</h1>
        <div class="p-4"><a class="btn btn-primary" href="./m_submit.php" style="width: 100%;">New Submission</a></div>
        <div class="container table-responsive table-responsive-xl">
            <table class="table table-bordered" id="myTable" style="table-layout: fixed; width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Serial Number</th>
                        <th scope="col">Name of Submitter</th>
                        <th scope="col">Email of Submitter</th>
                        <th scope="col">Type Of Submission</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Submission</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `final_submit` ORDER BY sno DESC";
                    $res = mysqli_query($conn, $sql);
                    $srno = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $srno = $srno + 1;
                    ?>
                        <!--Card Start-->
                        <tr>
                            <th scope="row"><?php echo $srno ?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['name'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['email'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['type'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['heading'])?></td>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['submission'])?></td>
                            <td>
                                <button class='edit btn btn-sm btn-primary m-1' id="
                                <?php echo trim($row['sno']) ?>
                                ">View</button>
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
                    window.location = `./m_submission.php?delete=${sno}`;
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

                name = tr.getElementsByTagName("td")[0].innerText;
                email = tr.getElementsByTagName("td")[1].innerText
                type = tr.getElementsByTagName("td")[2].innerText;
                heading = tr.getElementsByTagName("td")[3].innerText;
                submission = tr.getElementsByTagName("td")[4].innerText;

                idEdit.value = `${sno}`
                nameEdit.value = `${name}`
                emailEdit.value = `${email}`
                typeEdit.value = `${type}`
                headingEdit.value = `${heading}`
                submissionEdit.value = `${submission}`

                $("#editModal").modal("toggle");
            });
        });
    </script>

<?php require('../components/admin/footer.php');
} ?>
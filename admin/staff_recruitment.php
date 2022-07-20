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

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] == false) {
    echo '<script>window.location.href="./index.php"</script>';
} else {
    require('../components/admin/header.php');

    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        $sql = "DELETE FROM `staff_recruitment` WHERE `sno` = $sno";
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
?>
    <html>
    <script>
        window.history.replaceState({}, '', location.href.replace(location.search, ""));
    </script>

    </html>

    <!--Body-->
    <!-- view Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="viewModalLabel">Viewing Submission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row py-2">
                            <label for="positionView">Post he/she wanna apply for in staff</label>
                            <input class="form-control" name="positionView" id="positionView" required readonly>
                        </div>
                        <div class="form-row py-2">
                            <label for="timeView">How much time he/she can give to magazine each day?</label>
                            <input class="form-control" name="timeView" id="timeView" required readonly>
                        </div>
                        <div class="form-row py-2">
                            <label for="helpView">How can he/she help?</label>
                            <textarea type="text" class="form-control" name="helpView" id="helpView" required readonly rows='5'></textarea>
                        </div>
                        <div class="form-row py-2">
                            <label for="experience">Past Experience</label>
                            <textarea type="text" class="form-control" name="experienceView" placeholder="If not then enter NA" id="experienceView" required readonly rows='5'></textarea>
                        </div>
                        <div class="form-row py-2">
                            <label for="email">Email address</label>
                            <input type="email" name="emailView" readonly class="form-control" id="emailView" placeholder="name@example.com" value="" required>
                        </div>
                        <div class="form-row py-2">
                            <label for="fullname">REAL Name</label>
                            <input type="text" value="" class="form-control" readonly placeholder="Name" id="fullnameView" name="fullnameView" required>
                        </div>
                        <div class="form-row py-2">
                            <label for="username">USER Name</label>
                            <input type="text" value="" class="form-control" readonly placeholder="User Name" id="usernameView" name="usernameView" required>
                        </div>
                        <div class="form-row py-2">
                            <label for="dc_id">Discord ID</label>
                            <input type="text" class="form-control" name="dc_idView" id="dc_idView" required value="" readonly>
                        </div>
                        <div class="form-row py-2">
                            <label for="insta_id">Insta ID</label>
                            <input type="text" class="form-control" name="insta_idView" id="insta_idView" required value="" readonly>
                        </div>
                    </form>
                    <button type="button" class="btn btn-secondary bg-gray-500" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="main container">
        <title>WSM || SUBMISSIONS</title>
        <h1 class="text-black mb-6 text-2xl font-semibold text-center text-green-600">Staff Recruitment Submissions</h1>
        <div class="container table-responsive table-responsive-xl">
            <table class="table table-bordered" id="myTable" style="table-layout: fixed; width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Serial Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Username</th>
                        <th scope="col">Discord Id</th>
                        <th scope="col">Insta Id</th>
                        <th scope="col">Position</th>
                        <th scope="col">Time</th>
                        <th scope="col">Help</th>
                        <th scope="col">Experience</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `staff_recruitment` ORDER BY sno DESC";
                    $res = mysqli_query($conn, $sql);
                    $srno = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $srno = $srno + 1;
                    ?>
                        <!--Card Start-->
                        <tr>
                            <th scope="row"><?php echo $srno ?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['email'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['fullname'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap(htmlentities($row['username']))?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap(htmlentities($row['discord_id']))?></td>
                            <td style="word-wrap: break-word"><?php echo wordwrap(htmlentities($row['insta_id']))?></td>
                            <td style="word-wrap: break-word"><?php echo wordwrap(htmlentities($row['position']))?></td>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['time']) ?></td>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['help']) ?></td>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['experience']) ?></td>
                            <td>
                                <button class='view btn btn-sm btn-primary m-1' id="
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
                    window.location = `./staff_recruitment.php?delete=${sno}`;
                } else {}
            });
        });

        // view btn click event
        views = document.getElementsByClassName("view");
        Array.from(views).forEach((element) => {
            element.addEventListener("click", (e) => {
                // console.log("view",e.target);
                tr = e.target.parentNode.parentNode;
                console.log(tr)
                sno = e.target.id.substr(1);
                sno = sno.trim();
                console.log(sno)

                email = tr.getElementsByTagName("td")[0].innerText;
                fullname = tr.getElementsByTagName("td")[1].innerText
                username = tr.getElementsByTagName("td")[2].innerText;
                discord_id = tr.getElementsByTagName("td")[3].innerText;
                inst_id = tr.getElementsByTagName("td")[4].innerText;
                position = tr.getElementsByTagName("td")[5].innerText;
                time = tr.getElementsByTagName("td")[6].innerText;
                help = tr.getElementsByTagName("td")[7].innerText;
                experience = tr.getElementsByTagName("td")[8].innerText;

                emailView.value = `${email}`
                fullnameView.value = `${fullname}`
                usernameView.value = `${username}`
                dc_idView.value = `${discord_id}`
                insta_idView.value = `${discord_id}`
                positionView.value = `${position}`
                timeView.value = `${time}`
                helpView.value = `${help}`
                experienceView.value = `${experience}`

                $("#viewModal").modal("toggle");
            });
        });
    </script>

<?php require('../components/admin/footer.php');
} ?>
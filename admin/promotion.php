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

    if (isset($_GET['reject']) && isset($_GET['username'])) {
        $sno = $_GET['reject'];
        $sql = "SELECT * FROM `website_promotion` WHERE `sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $result_fetch = mysqli_fetch_assoc($result);
            $username = $result_fetch['username'];

            $sql = "SELECT * FROM `website_users` WHERE `username` = '$username'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $result_fetch = mysqli_fetch_assoc($result);
                $ref_points = $result_fetch['referral_points'] + 100;

                $sql = "UPDATE `website_users` SET `referral_points`='$ref_points' WHERE `username` = '$username'";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $sql = "DELETE FROM `website_promotion` WHERE `sno` = $sno";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo '<div class="alert alert-success container" role="alert">
            The post was delete successfully!
        </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger container" role="alert">
            Server are down please try again later.
        </div>';
                }
            } else {
                echo '<div class="alert alert-danger container" role="alert">
            Server are down please try again later.
        </div>';
            }
        } else {
            echo '<div class="alert alert-danger container" role="alert">
            Server are down please try again later.
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
                    <h5 class="modal-title " id="viewModalLabel">Viewing Promotion Submissions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row py-3">
                            <label for="usernameView" class="form-label">Username</label>
                            <input type="text" class="form-control" id="usernameView" name="socialMediaView" aria-describedby="usernameHelp" placeholder="username" readonly>
                        </div>
                        <div class="form-row py-3">
                            <label for="socialMediaView" class="form-label">Social Media</label>
                            <input type="text" class="form-control" id="socialMediaView" name="socialMediaView" aria-describedby="socialMediaHelp" placeholder="Social Media Link" readonly>
                        </div>
                        <div class="form-row py-3">
                            <label for="contentView" class="form-label">Content</label>
                            <textarea name="contentView" class="form-control" id="contentView" aria-describedby="contentViewHelp" placeholder="Message to post" rows='5' readonly></textarea>
                        </div>
                    </form>
                    <button type="button" class="btn btn-secondary bg-gray-500" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="main container">
        <title>WSM || PROMOTION</title>
        <h1 class="text-black mb-6 text-2xl font-semibold text-center text-green-600">Promotion Submissions</h1>
        <div class="container table-responsive table-responsive-xl">
            <table class="table table-bordered" id="myTable" style="table-layout: fixed; width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Serial Number</th>
                        <th scope="col">Username</th>
                        <th scope="col">Social Media</th>
                        <th scope="col">Message</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `website_promotion` ORDER BY sno DESC";
                    $res = mysqli_query($conn, $sql);
                    $srno = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $srno = $srno + 1;
                    ?>
                        <!--Card Start-->
                        <tr>
                            <th scope="row"><?php echo $srno ?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['username'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap($row['social_media'])?></th>
                            <td style="word-wrap: break-word"><?php echo wordwrap(htmlentities($row['content']))?></th>
                            <td>
                                <button class='view btn btn-sm btn-primary m-1' id="
                                <?php echo trim($row['sno']) ?>
                                ">View</button>
                                <button class='reject btn btn-sm btn-danger m-1' id="
                                <?php echo trim($row['sno']) ?>
                                ">Reject</button>
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
        // Reject Btn click event
        rejects = document.getElementsByClassName("reject");
        Array.from(rejects).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("reject");
                sno = e.target.id.substr(1);
                sno = sno.trim();
                console.log(sno);
                tr = e.target.parentNode.parentNode;
                username = tr.getElementsByTagName("td")[0].innerText;
                if (confirm("Are you sure you want to reject this order!")) {
                    window.location = `./promotion.php?reject=${sno}&username=${username}`;
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

                username = tr.getElementsByTagName("td")[0].innerText;
                socialMedia = tr.getElementsByTagName("td")[1].innerText
                message = tr.getElementsByTagName("td")[2].innerText;

                usernameView.value = `${username}`
                socialMediaView.value = `${socialMedia}`
                contentView.value = `${message}`

                $("#viewModal").modal("toggle");
            });
        });
    </script>

<?php require('../components/admin/footer.php');
} ?>
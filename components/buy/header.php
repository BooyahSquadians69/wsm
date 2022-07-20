<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@600&display=swap" rel="stylesheet">
<head><link rel="stylesheet" href="../src/css/output.css"></head>
<?php
if (!isset($_SESSION)) {
    session_start();
}
?>


<header class="text-gray-600 body-font">
    <div class="container grid place-items-center p-4">
        <a class="flex title-font font-medium items-center text-gray-700 hover:text-gray-700 mb-4 md:mb-0" style="text-decoration: none" href="../" style="text-decoration:none;">
            <img src="../src/img/logo.png" alt="Logo" class="w-20 h-20 p-2 rounded-full">
            <span class="ml-3 text-2xl" style="font-family: 'Teko', sans-serif;">Weekly Student Magazine</span>
        </a>
        <nav class="flex flex-wrap text-base items-center justify-center">
            <a class="mr-5 hover:text-gray-900" href="../">
                <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
                    <span class="material-icons">home</span>
                    Home
                </button>
            </a>
            <a class="mr-5 hover:text-gray-900" href="../submit.php" style="text-decoration:none;">
                <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
                    <span class="material-icons">style</span>
                    Submit
                </button>
            </a>
            <a class="mr-5 hover:text-gray-900" href="../about.php" style="text-decoration:none;">
                <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
                    <span class="material-icons">person</span>
                    About Us
                </button>
            </a>
            <a class="mr-5 hover:text-gray-900" href="../contact.php" style="text-decoration:none;">
                <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
                    <span class="material-icons">contact_page</span>
                    Contact Us
                </button>
            </a>
            <a class="mr-5 hover:text-gray-900" href="../referral.php" style="text-decoration:none;">
                <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
                    <span class="material-icons">redeem</span>
                    Referral Rewards
                </button>
            </a>
            <a class="mr-5 hover:text-gray-900" href="https://discord.gg/JWGXUNbgHb" style="text-decoration:none;">
                <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
                <img src="../src/img/discord.png" class="w-8"> Discord</button>
            </a>
            <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                echo '
                <div class="btn-group">
                <button type="button" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0 text-black action:bg-gray-200 action:text-black-800 hover:text-black-800 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="material-icons">
                account_circle  
                </span>' . ' ' . $_SESSION['username'] . '
                </button>
                <div class="dropdown-menu">
                <button class="dropdown-item hover:bg-gray-200 " data-toggle="modal" data-target="#profileModal">
                Profile
              </button>
                      <div class="dropdown-divider hover:bg-gray-200"></div>
                      <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </div>
';
            } else {
                echo '<a class="mr-5 hover:text-gray-900" href="../login.php">
                    <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
                    <span class="material-icons">login</span>
                    Login
                    </button>
                </a>';
            }
            ?>
        </nav>
    </div>
</header>


<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Your profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"><br>
                This is all information we have about you
                <br>
                <hr><br>
                <?php
                require("../components/_dbconnect.php");
                $username = $_SESSION['username'];
                $sql = "SELECT * FROM `website_users` WHERE `username`= '$username'";
                $res = mysqli_query($conn, $sql);
                $result = mysqli_fetch_assoc($res);
                $email = $result['email'];
                $username = $result['username'];
                $fullname = $result['fullname'];
                $discordId = $result['discord_id'];
                $instaId = $result['insta_id'];
                $is_verified = $result['is_verified'];
                ?>
                <form action="<?php $_PHP_SELF ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" readonly value=" <?php echo $email; ?>">
                        <?php
                        if ($is_verified == 0) {
                            echo '<small id="emailHelp" class="form-text text-muted">
                      Your email is not verified! Get it verified as soon as possible , you must have got an email from website bot when you entered the email 
                      Please check once
                      </small>';
                        } ?>
                    </div>
                    <div class="form-group">
                        <label for="username">User-Name</label>
                        <input type="text" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Enter username" readonly value="<?php echo $username?>">
                    </div>
                    <div class="form-group">
                        <label for="fullname">Full-Name</label>
                        <input type="text" class="form-control" id="fullname" aria-describedby="fullnameHelp" placeholder="Enter your fullname" readonly value="<?php echo $fullname?>">
                    </div>
                    <div class="form-group">
                        <label for="fullname">Discord Id</label>
                        <input type="text" class="form-control" id="discordId" aria-describedby="discordIdHelp" placeholder="Enter your discord id" readonly value="<?php echo $discordId?>">
                    </div>
                    <div class="form-group">
                        <label for="instaId">Instagram Id</label>
                        <input type="text" class="form-control" id="instaId" aria-describedby="instaIdHelp" placeholder="Enter instaId" readonly value="<?php echo $instaId ?>">
                    </div>
                    <hr><br>
                    <a href="../contact.php"> <em class="text-red-600"> If you think any of this is incorrect or needs to be change please contact us and tell the staff know about this with proofs </em></a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary bg-gray-500" data-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-primary bg-blue-500">Save changes</button> -->
                </form>
            </div>
        </div>
    </div>
</div>
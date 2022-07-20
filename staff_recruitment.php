<html>
<!-- Boostrap and tailwindcss -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container">

</html>
<?php
require('./components/_dbconnect.php');
require('./components/header.php');
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
  echo '<script>
            window.location.href="./login.php?from=staff_recruitment"
            </script>';
  
  require('./components/footer.php');
} else {
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM `staff_recruitment` WHERE `email`='$email'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      echo '<div class="alert alert-danger container" role="alert">
              Sorry! You have already submitted a staff recruitment request<br>
              <strong> Please wait for it to get review first! </strong>
            </div>';
    } else { ?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WSM • STAFF</title>
      </head>
      <script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
      </script>
      </div>

      <body>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $email = $_POST['email'];
          $fullname = $_POST['fullname'];
          $username = $_POST['username'];
          $discord_id = $_POST['dc_id'];
          $insta_id = $_POST['insta_id'];
          $position = $_POST['position'];
          $time = $_POST['time'];
          $help = $_POST['help'];
          $experience = $_POST['experience'];
          // Sending data to mysql
          require('./components/_dbconnect.php');
          // Inserting data in the db
          $sql = "INSERT INTO `staff_recruitment`(
            `email`, 
            `fullname`, 
            `username`, 
            `discord_id`, 
            `insta_id`, 
            `position`, 
            `time`, 
            `help`, 
            `experience`
            ) VALUES (
              '$email',
              '$fullname',
              '$username',
              '$discord_id',
              '$insta_id',
              '$position',
              '$time',
              '$help',
              '$experience')";
          $result = mysqli_query($conn, $sql);

          // Check for the table creation success
          if ($result) {
            echo '<div class="alert alert-success container" role="alert">
        Your request was to the server successfully!
      </div><br>';
          } else {
            echo '<div class="alert alert-danger container" role="alert">
        Sorry! an error occured please try again later or contact admins
      </div>';
          }
          // }
        }
        ?>
        <div class="container">
          <form action="<?php $_PHP_SELF ?>" method="POST">
            <div class="form-row py-2">
              <label for="type_of_submit">Select for with post you wanna apply for in staff</label>
              <select class="form-control" name="position" id="position" required>
                <option>Other</option>
                <option>Editorial department</option>
                <option>Art director</option>
                <option>Graphic designer</option>
                <option>Circulation director</option>
                <option>Security team</option>
              </select>
            </div>
            <div class="form-row py-2">
              <label for="time">How much time can you give to magazine each day?</label>
              <select class="form-control" name="time" id="time" required>
                <option>Less than 1 Hour</option>
                <option>1-2 Hours</option>
                <option>2-5 Hours</option>
                <option>More than 5 Hours</option>
              </select>
            </div>
            <div class="form-row py-2">
              <label for="how_help">How can you help?</label>
              <textarea type="text" class="form-control" name="help" id="help" rows='5' required></textarea>
            </div>
            <div class="form-row py-2">
              <label for="past_experience">Any past experience?</label>
              <textarea type="text" class="form-control" name="experience" rows='5' placeholder="If not then enter NA" id="experience" required></textarea>
            </div>
            <div class="form-row py-2">
              <label for="email">Email address</label>
              <input type="email" name="email" readonly class="form-control" id="email" placeholder="name@example.com" value="<?php echo $_SESSION['email'] ?>" required>
              <small id="emailHelp" class="form-text text-muted">(ALREADY FILLED BY YOUR LOGIN DATA)</small>
            </div>
            <div class="form-row py-2">
              <label for="fullname">Your REAL Name</label>
              <input type="text" value="<?php echo $_SESSION['fullname'] ?>" class="form-control" readonly placeholder="Name" id="fullname" name="fullname" required>
              <small id="usernameHelp" class="form-text text-muted">(ALREADY FILLED BY YOUR LOGIN DATA)</small>
            </div>
            <div class="form-row py-2">
              <label for="username">Your USER Name</label>
              <input type="text" value="<?php echo $_SESSION['username'] ?>" class="form-control" readonly placeholder="User Name" id="username" name="username" required>
              <small id="usernameHelp" class="form-text text-muted">(ALREADY FILLED BY YOUR LOGIN DATA)</small>
            </div>
            <div class="form-row py-2">
              <label for="dc_id">Your Discord ID</label>
              <input type="text" class="form-control" name="dc_id" id="dc_id" required value="<?php echo $_SESSION['dc_id'] ?>" readonly>
              <small id="dc_idHelp" class="form-text text-muted">We need this to stay in contact with you (ALREADY FILLED BY YOUR LOGIN DATA)</small>
            </div>
            <div class="form-row py-2">
              <label for="insta_id">Your Insta ID</label>
              <input type="text" class="form-control" name="insta_id" id="insta_id" required value="<?php echo $_SESSION['insta_id'] ?>" readonly>
              <small id="insta_idHelp" class="form-text text-muted">We need this to stay in contact with you (ALREADY FILLED BY YOUR LOGIN DATA)</small>
            </div>
            <div class="p-4 w-full">
              <button id='submit' class="flex mx-auto text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">Submit</button>
            </div>
          </form>
        </div>
      </body>

      </html>
      <!-- Js -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script>
        document.getElementById('submit').onclick = () => {
          this.disabled = true;
        }
      </script>
<?php
    }
  } else {
    echo '<div class="alert alert-danger container" role="alert">
          Sorry! an error occured please try again later or contact admins
        </div>';
  }
  require('./components/footer.php');
} ?>




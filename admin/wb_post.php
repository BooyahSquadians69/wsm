<html>
<!-- Boostrap and tailwindcss -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/css/index.css">
  <title>WSM-SUBMIT</title>
</head>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

<body>
  <div class="container">
    <?php
    if (!isset($_SESSION)) {
      session_start();
    };
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in']==false) {
      echo '<script>window.location.href="./index.php"</script>';
  } else {
      require('../components/admin/header.php');

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Storing the data in veriables
        $id = $_POST['id'];
        $id = str_replace(' ', '_', $id);
        $type = $_POST['type'];
        $heading = $_POST['heading'];
        $content = $_POST['content'];
        $image_link = $_POST['image_link'];
        $magazine_pdf = $_POST['magazinePdfLink'];
        $admin = $_SESSION['fullname'];
        if (!preg_match('/^[_a-z]+$/i', $id)) {
          echo '<div class="alert alert-danger" role="alert">
      You entered WRONG ID!
      ID can only have TEXT , NO NUMBER OR SYMBOLS
    </div>';
        } else {
          // Sending data to mysql
          require('../components/_dbconnect.php');
          $sql = "SELECT * FROM `website_posts` WHERE `id` = '$id'";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            if (mysqli_num_rows($result) > 0) {
              echo '<div class="alert alert-danger container" role="alert">
          Another post with the same id exists, ID should be unique.
        </div>';
            } else { // Inserting data in the db
              $sql = "INSERT INTO `website_posts`(`id`, `type`, `heading`, `content`,`image_link`,`magazine_pdf`,`admin`) VALUES ('$id','$type','$heading','$content','$image_link','$magazine_pdf','$admin')";
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
          } else {
            echo '<div class="alert alert-danger container" role="alert">
        Sorry! an error occured please try again later or contact admins
      </div>';
          }
        }
      }
    ?>
      <div class="container">
        <form action="<?php $_PHP_SELF ?>" method="POST">
          <div class="form-row my-2 py-2">
            <label for="id">ID of the post</label>
            <input type="text" name="id" class="form-control" id="id" placeholder="post_id" required>
            <small id="id" class="form-text font-semibold text-red-600">
              ONLY UNDERSCORES AND ALPHABETS ARE ALLOWED , ANYTHING OTHER THAN THAT AND THE POST WILL GET CURRUPT
            </small>
          </div>
          <div class="form-row my-2 py-2">
            <label for="type_of_submit">Please select what type of your post</label>
            <select class="form-control" name="type" id="type_of_submit" required>
              <option>Other</option>
              <option>Personal Experience</option>
              <option>Self Help Articles</option>
              <option>Honest Reviews</option>
              <option>Official News</option>
              <option>Interview</option>
              <option>Roasts</option>
              <option>Gossip</option>
              <option>Story</option>
              <option>Trend</option>
              <option>Memes</option>
            </select>
            <small id="type" class="form-text text-muted">
              Select the option that you think suits your post.
            </small>
          </div>
          <div class="form-row my-2 py-2">
            <label for="heading">Heading of the post</label>
            <input type="text" name="heading" class="form-control" id="heading" required>
          </div>
          <div class="form-row my-2 py-2">
            <label for="heading">Content of the post, You can use <a href="https://www.w3schools.com/TAgs/default.asp"target="_blank" ><span class="text-blue-500">html tags</span> </a>here!</label>
            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
          </div>
          <div class="form-row my-2 py-2">
            <label for="image">Image for the post</label>
            <input type="url" name="image_link" class="form-control" id="image_link" placeholder="image_link" required>
          </div>
          <div class="form-row my-2 py-2">
            <label for="magazinePdfLink">Magazine Pdf Link</label>
            <input type="url" name="magazinePdfLink" class="form-control" id="magazinePdfLink" placeholder="Magazine pdf link here">
            <small id="id" class="form-text font-semibold text-red-600">
              If no magazine pdf link then leave it empty
            </small>
          </div>
          <div class="p-2 w-full">
            <button id='submit' class="flex mx-auto text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">Submit</button>
          </div>
        </form>
      </div>
  </div>
  <?php
      require('../components/admin/footer.php')
  ?>
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
<?php } ?>
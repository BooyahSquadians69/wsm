<html>
<!-- Boostrap and tailwindcss -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@600&display=swap" rel="stylesheet">
<title>WSM • BUY</title>

</html>

<body>
  <?php
  require('../components/buy/header.php');

  require('../components/_dbconnect.php');
  if (!isset($_SESSION)) {
    session_start();
  }
  echo '<div class="container">';
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $social_media = $_POST['socialMedia'];
    $content = $_POST['content'];
    $username = $_SESSION['username'];

    $sql = "SELECT `referral_points` FROM `website_users` WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);
    $result_fetch = mysqli_fetch_array($result);
    $referral_points = $result_fetch['referral_points'];
    if ($referral_points > 100) {
      $sql = "INSERT INTO `website_promotion` (`username`, `social_media`, `content`) VALUES ('$username','$social_media','$content')";
      if (mysqli_query($conn, $sql)) {
        $referral_points = $referral_points - 100;
        $sql = "UPDATE `website_users` SET `referral_points`='$referral_points' WHERE `username`='$username'";
        if (mysqli_query($conn, $sql)) {
          echo "<div class='alert alert-success' role='alert'>
      The order was placed<br>
      Your referral points now are $referral_points<br>
      The admins will look after your order and will complete it as soon as possible.
    </div>";
        } else {
          echo '<div class="alert alert-danger" role="alert">
    Servers are down please try again later!
  </div>';
        }
      } else {
        echo '<div class="alert alert-danger" role="alert">
    Servers are down please try again later!
  </div>';
      }
    } else {
      echo '<div class="alert alert-danger" role="alert">
      Sorry but you dont have enough Referral Points to buy this reward!
    </div>';
    }
  }
  ?>
  </div>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <section class="text-gray-600 body-font overflow-hidden">
    <div class="container px-5 py-24 mx-auto">
      <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-128 object-cover object-center rounded p-4" src="../src/img/icons/insta.png">
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
          <h2 class="text-sm title-font text-gray-500 tracking-widest">REWARD NAME</h2>
          <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">Promotion in WSM Insta and Discord</h1>
          <p class="leading-relaxed">We can promote any of your social media in WSM instagram page and discord server.</p>
          <form action="<?php $_PHP_SELF ?>" method="POST">
            <div class="form-row py-3">
              <label for="socialMedia" class="form-label">Social Media</label>
              <input type="text" class="form-control" id="socialMedia" name="socialMedia" aria-describedby="socialMediaHelp" placeholder="Social Media Link">
              <small id="socialMediaHelp" class="form-text text-muted">Link of your account in the social media you wanna promote your self.</small>
            </div>
            <div class="form-row py-3">
              <label for="content" class="form-label">Content</label>
              <textarea name="content" class="form-control" id="content" aria-describedby="contentHelp" placeholder="Message to post" rows='5'></textarea>
              <small id="contentHelp" class="form-text text-muted">The message you want us to post.</small>
            </div>
            <br>
            <hr>
            <br>
            <div class="flex">
              <span class="title-font font-medium text-2xl text-gray-900">$100.00 Reward Points</span>
              <button class="flex ml-auto text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded px-8 py-2" type='submit'>Buy</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php require('../components/buy/footer.php'); ?>
</body>
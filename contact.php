
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
  <title>WSM • CONTACT</title>
</head>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<body>
  <?php
  if(!isset($_SESSION)){
    session_start();
  }
  require('./components/header.php');
  echo '<div class="container">';
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $message = $_POST['message'];
    // Sending data to mysql
    require('./components/_dbconnect.php');
    // Create a table in the db
    $sql = "INSERT INTO `website_contact`(`email`, `name`, `message`) VALUES ('$email','$name','$message')";
    $result = mysqli_query($conn, $sql);

    // Check for the table creation success
    if ($result) {
      echo '<div class="alert alert-success" role="alert">
      Your request was to the server successfully!
    </div><br>';
    } else {
      echo '<div class="alert alert-danger" role="alert">
      Sorry! an error occured please try again later or contact admins
    </div>';
    }
  }
  ?>
</div>
  <section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-col text-center w-full mb-12">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Contact Us</h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Any suggestion/review/bug report can be send to us here.</p>
      </div>
      <form action="<?php $_PHP_SELF ?>" method="POST">
        <div class="lg:w-1/2 md:w-2/3 mx-auto">
          <div class="flex flex-wrap -m-2">
            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="name" name="name" class="leading-7 text-sm text-gray-600">Name</label>
                <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-red-500 focus:bg-white focus:ring-2 focus:ring-red-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                <?php if(isset($_SESSION['username'])){
                  echo 'value="'.$_SESSION['username'].'" readonly';
                } ?>
                >
              </div>
            </div>
            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="email" name="email" class="leading-7 text-sm text-gray-600">Email</label>
                <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-red-500 focus:bg-white focus:ring-2 focus:ring-red-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                <?php if(isset($_SESSION['email'])){
                  echo 'value="'.$_SESSION['email'].'" readonly';
                } ?>
                >
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="message" name="message" class="leading-7 text-sm text-gray-600">Message</label>
                <textarea id="message" name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-red-500 focus:bg-white focus:ring-2 focus:ring-red-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
              </div>
            </div>
            <div class="p-2 w-full">
              <button class="flex mx-auto text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg" type='submit'>Submit</button>
            </div>
          </form>
            <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
              <a class="text-red-500" href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSMTRvJrLTnjfXNHKsMdZSqgPftjzSfgJlNrdKWhrGpXczjFDhVdHHFpzxbQlsHXMqPhrxGW">weeklystudentmagazine@gmail.com</a>
            </div>
          </div>
        </div>
    </div>
  </section>
  <?php
  require('./components/footer.php')
  ?>
</body>

</html>
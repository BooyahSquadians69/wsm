<html>
<!-- Boostrap and tailwindcss -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" sizes="180x180" href="http://weekly-student-magazine.epizy.com/favicon//apple-touch-icon.png">
  <link rel="icon" type="http://weekly-student-magazine.epizy.com/favicon/favicon-32x32" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="http://weekly-student-magazine.epizy.com/favicon/favicon-16x16" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <title>WSM • INDEX</title>
</head>
<body>
  <?php
  require('./components/header.php');
  ?>
  <!-- Main code -->
  <section class="text-gray-600 body-font">
    <div class="container">
      <div class="container px-5 py-4 mx-auto">
        <div class="alert alert-warning alert-danger fade show" role="alert">
          <a href="./staff_recruitment.php" class="hover:text-red-900">
            <strong class="text-red-700 text-xl"> We are recruiting people for staff team of WSM. Click here to apply for staff team</a></strong>
          <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
      </div>
      
    <?php
    require('./components/_dbconnect.php');
    $sql = "SELECT * FROM `website_posts`";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      if (mysqli_num_rows($result) > 0) {
        while($result_fetch = mysqli_fetch_assoc($result)){
          echo '<br>';
          ?>
          <div class="flex flex-wrap m-4 p-3">
          <div class="p-4 md:w-1/3">
            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
              <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="<?php echo $result_fetch['image_link']?>" alt="blog">
              <div class="p-6">
                <!-- <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1"><?php echo 'Time -'.$result_fetch['timestamp']?></h2> -->
                <h1 class="title-font text-lg font-medium text-gray-900 mb-3"><?php echo $result_fetch['heading']?></h1>
                <p class="leading-relaxed mb-3"><?php echo substr($result_fetch['content'],0,35)?>...</p>
                <div class="flex items-center flex-wrap ">
                  <a class="text-blue-500 hover:text-blue-600 inline-flex items-center md:mb-2 lg:mb-0" href='./view_post.php?id=<?php echo $result_fetch['id']?>'>Read More
                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M5 12h14"></path>
                      <path d="M12 5l7 7-7 7"></path>
                    </svg>
                  </a>
                  <span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                      <circle cx="12" cy="12" r="3"></circle>
                    </svg><?php echo $result_fetch['views']?>
                  </span>
                  <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                      <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                    </svg><?php 
                    $post_id = $result_fetch['id'];
                    $sql = "SELECT * FROM `website_comments` WHERE `post_id` = '$post_id'";
                    $res = mysqli_query($conn, $sql);
                    if ($res) {
                      echo mysqli_num_rows($res);
                    }else{
                      echo '0';
                    }
                    ?>
                  </span>
                </div>
                <!-- <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1"><?php echo '<br> By '.$result_fetch['admin']?></h2> -->
              </div>
            </div>
          </div>
        </div>;
        <?php
        }
      } else {
        echo '<div class="alert alert-danger container" role="alert">
        Sorry! No post were found to show.
      </div>';
      }
    } else {
      echo '<div class="alert alert-danger container" role="alert">
        Sorry! an error occured please try again later or contact admins
      </div>';
    }
    ?>
    </div>
  </section>
  <?php
  require('./components/footer.php')
  ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>
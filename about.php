<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/index.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>WSM-About</title>
</head>
<body>
    <?php
    include('./components/header.php')
    ?>
    <section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto flex flex-col">
    <div class="lg:w-4/6 mx-auto">
      <div class="rounded-lg h-64 overflow-hidden">
        <img alt="content" class="object-cover object-center h-full w-full" src="./src/img/standard.gif">
      </div>
      <div class="flex flex-col sm:flex-row mt-10">
        <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
          <div class="w-20 h-20 inline-flex items-center justify-center">
          <img alt="content" class="w-30 h-30" src="./src/img/logo.png">
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </div>
          <div class="flex flex-col items-center text-center justify-center">
            <h2 class="font-medium title-font mt-4 text-gray-900 text-lg">Weekly Students Magazine</h2>
            <div class="w-12 h-1 bg-red-700 rounded mt-2 mb-4"></div>
            <p class="text-base">The Weekly Students Magazine AKA WSM,is an initiative started by the students of the Grade 9 is a E-Magazine made by the Students and for the Students</p>
          </div>
        </div>
        <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
          <p class="leading-relaxed text-lg mb-4">Weekly Students Wagazine would cover:<br><br>
            Stuff declared by the school<br>
            Addressing rumors<br>
            Homework help<br>
            Roasting teachers (Pvt. channel)<br>
            Memes<br>
            Fandom stuff<br>
            Music<br>
            Gossip (the regular tea)</p><br>
          <!-- <a class="text-red-700 inline-flex items-center">Learn More
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </a> -->
        </div>
      </div>
    </div>
  </div>
</section>
    <?php
    include('./components/footer.php')
    ?>
</body>

</html>
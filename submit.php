<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./src/css/index.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>WSM-Submit</title>
</head>

<body>
  <?php
  include('./components/header.php')
  ?>
  <div class="container">
    <form>
      <div class="form-group">
        <label for="exampleFormControlInput1">Email address</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
      </div>
      <div class="form-row">
        <div class="col">
          <label for="username">Your Name</label>
          <input type="text" class="form-control" placeholder="Name" id="username">
        </div>
      </div>
      <div class="form-group pt-3">
        <label for="type_of_submit">Please select what type of submission you wanna do</label>
        <select class="form-control" id="type_of_submit">
          <option>Other</option>
          <option>Official News</option>
          <option>Honest Reviews</option>
          <option>Interview</option>
          <option>Gossip</option>
          <option>Trend</option>
          <option>Personal Experience</option>
          <option>Self Help Articles</option>
          <option>Roasts</option>
          <option>Memes</option>
        </select>
      </div>
      <div class="form-group">
        <label for="heading">Heading of your submission</label>
        <input type="text" class="form-control" placeholder="Heading" id="heading">
      </div>

      <div class="form-group">
        <label for="Submission">Enter your submission</label>
        <textarea class="form-control" id="Submission" placeholder="Submission" rows="5"></textarea>
      </div>
    </form>
  </div>
  <?php
  include('./components/footer.php')
  ?>
</body>

</html>
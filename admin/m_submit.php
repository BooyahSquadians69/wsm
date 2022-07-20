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
    <title>WSM || SUBMIT</title>
</head>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<body>
    <?php
    require('../components/_dbconnect.php');
    if (!isset($_SESSION)) {
        session_start();
    };
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in']==false) {
        echo '<script>window.location.href="./index.php"</script>';
    } else {
        require('../components/admin/header.php');
    ?>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $type = $_POST['type'];
            $heading = $_POST['heading'];
            $submission = $_POST['submission'];
            // Sending data to mysql
            // Inserting data in the db
            $sql = "INSERT INTO `final_submit`(`email`, `name`, `type`, `heading`, `submission`) VALUES ('$email','$name','$type','$heading','$submission')";
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
            // }
        }
        ?>
        <div class="container">
            <div class="alert alert-warning container" role="alert">
                WARNING! This submission will directly go to the final magazine!
                If you want to send the submission to website admin page first then
                <button class="btn btn-warning bg-yellow-500" href="../submit.php" type="button">Click Here</button>
            </div>
            <form action="<?php $_PHP_SELF ?>" method="POST">
                <div class="form-row">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
                    <small id="email" class="form-text text-muted mb-4">
                        Please enter your REAL email id,If you enter wrong email id, we will reject this submission.
                    </small>
                </div>
                <div class="form-row">
                    <label for="username">Your Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" id="username" required>
                    <small id="name" class="form-text text-muted mb-4">
                        Please enter your REAL name,If you enter wrong name, we will reject this submission.
                    </small>
                </div>
                <!-- <div class="form-row">
        <label for="id">Enter id for your submission</label>
        <input type="text" name="id" class="form-control" placeholder="ID" id="id" required>
        <small id="name" class="form-text text-muted mb-4">
          ID can only have TEXT NO NUMBER OR SYMBOLS
        </small>
      </div> -->
                <div class="form-row pt-2">
                    <label for="type_of_submit">Please select what type of submission you wanna do</label>
                    <select class="form-control" name="type" id="type_of_submit" required>
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
                    <small id="type" class="form-text text-muted mb-4">
                        Select the option that you think suits your submission.
                    </small>
                </div>
                <div class="form-row">
                    <label for="heading">Heading of your submission</label>
                    <input type="text" class="form-control" name="heading" placeholder="Heading" id="heading" required>
                    <small id="heading" class="form-text text-muted mb-4">
                        Enter some heading that you think suits your submission. (Heading can be same as Id)
                    </small>
                </div>

                <div class="form-row">
                    <label for="Submission">Enter your submission</label>
                    <textarea class="form-control" id="Submission" name="submission" placeholder="Submission" rows="5" required></textarea>
                    <small id="Submission" class="form-text text-muted mb-4">
                        Please describe about your submission in breif.
                    </small>
                </div>
                <div class="p-2 w-full">
                    <button id='submit' class="flex mx-auto text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">Submit</button>
                </div>
            </form>
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
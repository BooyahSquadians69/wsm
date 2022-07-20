<?php
    // Connecting to the Database
    $mysql_host = "remotemysql.com";
    $mysql_user = "BPJtFyyJyY";
    $mysql_password = "pQNcl7Vjpc";;
    $mysql_database = "BPJtFyyJyY";
      
    // Create a connection
    $conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
    // Die if connection was not successful
    if (!$conn) {
      die('<div class="alert alert-danger" role="alert">
      Sorry! an error occured please try again later or contact admins
    </div><br>If Admin ask for error report ->'. mysqli_connect_error());
    }    
?>
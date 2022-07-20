<?php 
session_start();
$_SESSION['admin_logged_in'] = NULL;
$_SESSION['user'] = NULL;
header('location: ./login.php')
?>
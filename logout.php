<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login or home page after logout
header("Location: login.php"); // Replace "login.php" with your desired page
exit();
?>

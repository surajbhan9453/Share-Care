<?php
session_start();

// Access $_SESSION variables here
if (isset($_SESSION['name']) && $_SESSION['role'] === 'donor') {
    $userID = $_SESSION['name'];
    $name = $_SESSION['name'];

} else {
    // Handle cases where the user is not logged in
    header("Location: ../login.php");
    exit();
}
?>
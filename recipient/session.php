<?php
session_start();

if (isset($_SESSION['name']) && $_SESSION['role'] === 'recipient') {
    $userID = $_SESSION['userid'];
    $name = $_SESSION['name'];
} else {
    header("Location: ../login.php");
    exit();
}
?>

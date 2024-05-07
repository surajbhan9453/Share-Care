<?php
// Start the session
session_start();

// Destroy session and redirect after logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<?php
include 'config.php';
include 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve'])) {
        $donation_id = $_POST['donation_id'];
        $donation_id = mysqli_real_escape_string($conn, $donation_id);
        $updateQuery = "UPDATE donations SET status = 'accepted' WHERE id = '$donation_id'";
        mysqli_query($conn, $updateQuery);
        header("Location: pending_request.php");
        
    } elseif (isset($_POST['reject'])) {
        $donation_id = $_POST['donation_id'];
        $donation_id = mysqli_real_escape_string($conn, $donation_id);
        $updateQuery = "UPDATE donations SET status = 'rejected' WHERE id = '$donation_id'";
        mysqli_query($conn, $updateQuery);
        header("Location: pending_request.php");
    }
}
?>

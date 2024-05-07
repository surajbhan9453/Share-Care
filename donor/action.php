<?php

include 'session.php';
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['donation_id'], $_POST['action'])) {
        $donation_id = $_POST['donation_id'];
        $recipientEmail = $_POST['recipientEmail'];
        $action = $_POST['action'];

        if ($action === 'approve') {
            $update_request_query = "UPDATE requests SET request_status = 'approved' WHERE donation_id = '$donation_id' AND recipient_email = '$recipientEmail'";
            mysqli_query($conn, $update_request_query);

            // Update status in the donations table
            $update_donation_query = "UPDATE donations SET status = 'approved' WHERE id = '$donation_id'";
            mysqli_query($conn, $update_donation_query);
        } elseif ($action === 'reject') {
            // Update request_status in the requests table
            $update_request_query = "UPDATE requests SET request_status = 'rejected' WHERE donation_id = '$donation_id'";
            mysqli_query($conn, $update_request_query);

            // Update status in the donations table
            $update_donation_query = "UPDATE donations SET status = 'rejected' WHERE id = '$donation_id'";
            mysqli_query($conn, $update_donation_query);
        }

        // Redirect back to the pending_donations.php page after processing
        header("Location: approval_requests.php");
        exit();
    }
}
?>

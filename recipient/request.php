<?php

include 'config.php';
include 'session.php';

$recipient_email = $_SESSION['userid']; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donation_id = $_POST['donation_id'];
    $donor_email = $_POST['donor_email'];
    $recipient_name = $_SESSION['name'];
    $recipient_email = $_SESSION['userid']; 

    if (isset($_POST['accept'])) {
        $request_status = 'requested';

        $insert_query = "INSERT INTO requests (recipient_name, recipient_email, donation_id, donor_email, request_status) 
                 VALUES ('$recipient_name', '$recipient_email', $donation_id, '$donor_email', '$request_status')";

        if (mysqli_query($conn, $insert_query)) {
            echo "Donation accepted and saved in the database!";
            header("Location: index.php");
            // exit();
        } else {
            echo "Error updating donation status: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['reject'])) {
        $request_status = 'rejected';
        $insert_query = "INSERT INTO requests (recipient_name, recipient_email, donation_id, donor_email, request_status) 
        VALUES ('$recipient_name', '$recipient_email', $donation_id, '$donor_email', '$request_status')";

        if (mysqli_query($conn, $insert_query)) {
            echo "Donation rejected and status saved in the database!";
            header("Location: index.php");
            exit();
        } else {
            echo "Error updating donation status: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid action!";
    }
    mysqli_close($conn);
}
?>
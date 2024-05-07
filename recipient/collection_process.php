<?php
include 'session.php';
include 'config.php';

$userid = $_SESSION['userid'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['collected'])) {
        $donation_id = $_POST['donation_id'];
        $donor_email = $_POST['donor_email'];

        $updateRequestQuery = "UPDATE requests SET request_status = 'collected' WHERE donation_id = '$donation_id' AND donor_email = '$donor_email'";
        $resultUpdateRequest = mysqli_query($conn, $updateRequestQuery);

        $updateDonationQuery = "UPDATE donations SET status = 'collected', collected_by = '$userid' WHERE id = '$donation_id'";
        $resultUpdateDonation = mysqli_query($conn, $updateDonationQuery);

        if ($resultUpdateRequest && $resultUpdateDonation) {
            header("Location: collect_donation.php");
            exit();
        } else {
            echo "Error updating donation status!";
        }
    }
}
?>

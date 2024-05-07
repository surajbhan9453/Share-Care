<?php
    include 'config.php';
    include 'session.php';
    $userid = $_SESSION['userid'];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_donation'])) {
    $donation_id = mysqli_real_escape_string($conn, $_POST['donation_id']);
    $updatedItemType = mysqli_real_escape_string($conn, $_POST['itemtype']);
    $updatedItemName = mysqli_real_escape_string($conn, $_POST['item_name']);
    $updatedQuantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $updatedAddress = mysqli_real_escape_string($conn, $_POST['address']);
    $updatedPhone = mysqli_real_escape_string($conn, $_POST['phone']);
    $updatedComments = mysqli_real_escape_string($conn, $_POST['comments']);

    // Update the donation details in the database
    $updateQuery = "UPDATE donations SET item_type = '$updatedItemType', item_name = '$updatedItemName', quantity = '$updatedQuantity', address = '$updatedAddress', phone = '$updatedPhone', comments = '$updatedComments' WHERE id = '$donation_id' AND donor = '$userid' AND status = 'pending'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Redirect to a page or display a success message
        header("Location: pending_donations.php");
        exit();
    } else {
        // Handle if there's an error during the update
        echo "Error updating donation details: " . mysqli_error($conn);
    }
} else {
    // Handle if there's no donation ID or invalid request method
    echo "Invalid request.";
}
?>
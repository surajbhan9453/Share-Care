<?php
include 'config.php';
include 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $Query = "DELETE FROM users WHERE email = ?";
    $stmt = $conn->prepare($Query);
    $stmt->bind_param("s", $user_id);

    if ($stmt->execute()) {
        $message = "User removed successfully!";
    } else {
        $message = "Failed to remove user!";
    }

    $stmt->close();
}
header("Location: all_users.php?message=" . urlencode($message));
exit();
?>

<?php 
include 'session.php';
include 'config.php';

// Fetch user-specific donation information
$userID = $_SESSION['userid'];
$sql = "SELECT COUNT(CASE WHEN donor = ? THEN 1 END) AS total_donations, COUNT(CASE WHEN donor = ? AND status = 'pending' THEN 1 END) AS pending_donations, COUNT(CASE WHEN donor = ? AND status = 'accepted' THEN 1 END) AS accepted_donations, COUNT(CASE WHEN donor = ? AND status = 'collected' THEN 1 END) AS collected_donations, COUNT(CASE WHEN donor = ? AND status = 'rejected' THEN 1 END) AS rejected_donations FROM donations";
$stmtCombined = $conn->prepare($sql);
$stmtCombined->bind_param("sssss", $userID, $userID, $userID, $userID, $userID);

// Execute the combined query
$stmtCombined->execute();
$resultCombined = $stmtCombined->get_result();

$totalDonations = 0;
$pendingDonations = 0;
$acceptedDonations = 0;
$collectedDonations = 0;
$rejectedDonations = 0;


if ($resultCombined->num_rows > 0) {
    $rowCombined = $resultCombined->fetch_assoc();
    $totalDonations = $rowCombined['total_donations'];
    $pendingDonations = $rowCombined['pending_donations'];
    $acceptedDonations = $rowCombined['accepted_donations']; // Fixed variable assignment
    $collectedDonations = $rowCombined['collected_donations']; // Fixed variable assignment
    $rejectedDonations = $rowCombined['rejected_donations']; // Fixed variable assignment
}
// Close prepared statement and database connection
$stmtCombined->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share & Care</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ce0692ee2e.js" crossorigin="anonymous"></script>
</head>

<body>
    <section class="header">
        <nav>
            <a href="index.php"><img src="../Images/Share&Carelogo3.png" alt=""></a>

            <!-- Login/Signup button at the top-right corner -->
            <div class="login-signup">
                <a href="../logout.php">Logout</a>
            </div>


            <div class="nav-link" id="navLink">
                <ul>
                    <li><a href="index.php">DASHBOARD</a></li>
                    <li><a href="donate.php">DONATE</a></li>
                    <li><a href="approval_requests.php">PENDING REQUESTS</a></li>
                    <li><a href="prev_donation.php">ALL DONATIONS</a></li>
                    <p class="welcome-message">Welcome, <?php echo $_SESSION['name']; ?></p>
            </div>
        </nav>


        <div class="dashboard">
            <h2 style="margin-left: 95px; color:white">Dashboard</h2>
            <div class="status-boxes">
                <div class="status-box">
                    <h3>Total Donations</h3>
                    <p><?php echo $totalDonations; ?></p>
                </div>
                <div class="status-box">
                    <h3>Pending Donations</h3>
                    <p><?php echo $pendingDonations; ?></p>
                </div>
                <div class="status-box">
                    <h3>Donations Accepted and to Be Assigned to the Recipient</h3>
                    <p><?php echo $acceptedDonations; ?></p>
                </div>
                <div class="status-box">
                    <h3>Donations Accepted But Not Collected Yet</h3>
                    <p><?php echo ($acceptedDonations-$collectedDonations); ?></p>
                </div>
                <div class="status-box">
                    <h3>Donations Rejected</h3>
                    <p><?php echo $rejectedDonations; ?></p>
                </div>
                <div class="status-box">
                    <h3>Donations Collected</h3>
                    <p><?php echo $collectedDonations; ?></p>
                </div>
            </div>


        </div>

    </section>

</body>

</html>
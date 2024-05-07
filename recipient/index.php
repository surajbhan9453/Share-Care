<?php 
include 'session.php';
include 'config.php';

$userID = $_SESSION['userid'];
$sql = "SELECT COUNT(CASE WHEN recipient_email = ? THEN 1 END) AS total_donations, COUNT(CASE WHEN recipient_email = ? AND request_status = 'requested' THEN 1 END) AS requested_donations, COUNT(CASE WHEN recipient_email = ? AND request_status = 'rejected' THEN 1 END) AS rejected_donations, COUNT(CASE WHEN recipient_email = ? AND request_status = 'collected' THEN 1 END) AS collected_donations FROM requests";
$stmtCombined = $conn->prepare($sql);
$stmtCombined->bind_param("ssss", $userID, $userID, $userID, $userID);

$stmtCombined->execute();
$resultCombined = $stmtCombined->get_result();

$totalDonations = 0;
$rejectedDonations = 0;
$collectedDonations = 0;
$requestedDonations = 0;

if ($resultCombined->num_rows > 0) {
    $rowCombined = $resultCombined->fetch_assoc();
    $totalDonations = $rowCombined['total_donations'];
    $requestedDonations = $rowCombined['requested_donations'];
    $collectedDonations = $rowCombined['collected_donations'];
    $rejectedDonations = $rowCombined['rejected_donations']; 
}
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

            <div class="login-signup">
                <a href="../logout.php">Logout</a>
            </div>


            <div class="nav-link" id="navLink">
                <ul>
                    <li><a href="index.php">DASHBOARD</a></li>
                    <li><a href="request_process.php">AVAILABLE DONATIONS</a></li>
                    <li><a href="collect_donation.php">COLLECT DONATIONS</a></li>
                    <p class="welcome-message">Welcome, <?php echo $_SESSION['name']; ?></p>
            </div>
        </nav>


        <div class="dashboard">
            <h2 style="margin-left: 95px; color:white">Recipient Dashboard</h2>
            <div class="status-boxes">
                <div class="status-box">
                    <h3>Total Donations</h3>
                    <p><?php echo $totalDonations; ?></p>
                </div>
                <div class="status-box">
                    <h3>Donations Requested</h3>
                    <p><?php echo $requestedDonations; ?></p>
                </div>
                <div class="status-box">
                    <h3>Donations Rejected</h3>
                    <p><?php echo $rejectedDonations; ?></p>
                </div>
                <div class="status-box">
                    <h3>Donations Collected</h3>
                    <p><?php echo ($collectedDonations); ?></p>
                </div>
            </div>


        </div>

    </section>

</body>

</html>
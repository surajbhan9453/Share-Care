<?php 
include 'session.php';
include 'config.php';

$userID = $_SESSION['userid'];
$sql = "SELECT 
        COUNT(*) AS all_donations,
        SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS total_pending,
        SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) AS total_rejected,
        SUM(CASE WHEN status = 'accepted' THEN 1 ELSE 0 END) AS total_accepted,
        SUM(CASE WHEN status = 'collected' THEN 1 ELSE 0 END) AS total_collected FROM donations";

$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

$allDonations = 0;
$totalPending = 0;
$totalRejected = 0;
$totalAccepted = 0;
$totalCollected = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $allDonations = $row['all_donations'];
    $totalPending = $row['total_pending'];
    $totalRejected = $row['total_rejected'];
    $totalAccepted = $row['total_accepted'];
    $totalCollected = $row['total_collected'];
}

// Close prepared statement and database connection
$stmt->close();
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
    <script src="https://kit.fontawesome.com/477c9fcb6e.js" crossorigin="anonymous"></script>
</head>
</head>

<body>
    <section class="header">
        <nav>
            <a href="index.html"><img src="../Images/Share&Carelogo3.png" alt=""></a>

            <!-- Login/Signup button at the top-right corner -->
            <div class="login-signup">
                <a href="../logout.php">Logout</a>
            </div>


            <div class="nav-link" id="navLink">
                <ul>
                    <li><a href="index.php">DASHBOARD</a></li>
                    <li><a href="pending_request.php">PENDING REQUESTS</a></li>
                    <li><a href="all_users.php">MANAGE USERS</a></li>
                    <li><a href="all_donations.php">ALL DONATIONS</a></li>
                </ul>
                <p class="welcome-message">Welcome, <?php echo $_SESSION['name']; ?></p>
            </div>
        </nav>


        <div class="dashboard">
            
        <h2 style="margin-left: 95px; color:white"><i class="fa-solid fa-user-tie fa-beat-fade fa-sm" style="color: #ffffff;"></i> ADMIN DASHBOARD</h2>
            <div class="status-boxes">
                <div class="status-box">
                    <h3>All Donations</h3>
                    <p><?php echo $allDonations; ?></p>
                </div>
                <div class="status-box">
                    <h3>Total Pending Donations</h3>
                    <p><?php echo $totalPending; ?></p>
                </div>
                <div class="status-box">
                    <h3>Donations Accepted and to Be Assigned to the Recipient</h3>
                    <p><?php echo $totalAccepted; ?></p>
                </div>
                <div class="status-box">
                    <h3>Donations Accepted But Not Collected Yet</h3>
                    <p><?php echo ($totalAccepted); ?></p>
                </div>
                <div class="status-box">
                    <h3>Total Rejected</h3>
                    <p><?php echo $totalRejected; ?></p>
                </div>
                <div class="status-box">
                    <h3>Total Collected</h3>
                    <p><?php echo $totalCollected; ?></p>
                </div>
            </div>
            
            
        </div>
        
    </section>

</body>

</html>

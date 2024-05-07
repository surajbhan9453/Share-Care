<?php 
include 'session.php';
include 'config.php';

$userid = $_SESSION['userid'];
$query = "SELECT donations.*, users.first_name, users.last_name FROM donations INNER JOIN users ON donations.donor = users.email WHERE donations.status='pending'";
$result = mysqli_query($conn, $query);
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

<body>
    <section class="header">
        <nav>
            <a href="index.html"><img src="../Images/Share&Carelogo3.png" alt=""></a>

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

        <div class="pending-donations">
        <h2><i class="fa-solid fa-hourglass-end fa-sm" style="color: #ffffff; padding-right: 5px;"></i>Pending Requests</h2>
            <?php
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <form method="post" action="request_approval.php">
                        <div class="donation-card">
                            <div class="donation-details">
                                <h3>Donor: <?php echo ucwords($row['first_name'].' '.$row['last_name']); ?></h3>
                                <p>Item: <?php echo ucwords($row['item_type']); ?></p>
                                <p>Item Name: <?php echo ucwords($row['item_name']); ?></p>
                                <p>Quantity: <?php echo ucwords($row['quantity']); ?></p>
                                <p>Address: <?php echo ucwords($row['address']); ?></p>
                                <p>Phone: <?php echo ucwords($row['phone']); ?></p>
                                <p>Comments: <?php echo ucwords($row['comments']); ?></p>
                                <input type="hidden" name="donation_id" value="<?php echo $row['id']; ?>">
                                <input type="submit" class="submit-btn" name="approve" value="Approve">
                                <input type="submit" class="submit-btn" name="reject" value="Reject">
                            </div>
                        </div>
                    </form>
                <?php
                }
            }
            else{
                echo "<div class='no-records-message'>
                <h2>No Pending donations found</h2>
                <p>There are currently no donations available.</p>
                <!-- Add any additional content or styling here -->
            </div>
            ";
            }
            ?>
        </div>
    </section>
</body>
</html>
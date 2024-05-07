<?php 
include 'session.php';
include 'config.php';

$userid = $_SESSION['userid'];
$query = "SELECT d.*, r.recipient_email
          FROM donations d
          INNER JOIN requests r ON d.id = r.donation_id
          WHERE r.donor_email = '$userid' AND r.request_status='requested'";

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

    <style>
    button[type="submit"] {
        border: none;
        padding: 8px 15px;
        cursor: pointer;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        margin-right: 10px;
    }

    button[type="submit"] i {
        margin-right: 5px;
    }

    button[name="approve"] {
        background-color: #12a537;
    }

    button[name="reject"] {
        background-color: #a51d38;
    }

    .no-records-message {
        text-align: center;
        margin: 50px auto;
        padding: 20px;
        border: 2px dashed #ccc;
        border-radius: 8px;
        width: 80%;
        max-width: 600px;
    }

    .no-records-message h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #ffffff;
    }

    .no-records-message p {
        font-size: 16px;
        color: #959292;
    }
    </style>
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
                    <li><a href="approval_requests.php">PENDING DONATIONS</a></li>
                    <li><a href="prev_donation.php">PREVIOUS DONATION</a></li>
                </ul>
                <p class="welcome-message">Welcome, <?php echo $_SESSION['name']; ?></p>
            </div>
        </nav>

        <div class="pending-donations">
            <?php
        if(mysqli_num_rows($result) > 0) {
            echo "<h2>Requests for Approval</h2>";
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <div class="donation-card">
                <div class="donation-details">
                    <h3><?php echo ucwords($row['recipient_email']); ?></h3>
                    <p>Item: <?php echo ucwords($row['item_type']); ?></p>
                    <p>Item Name: <?php echo ucwords($row['item_name']); ?></p>
                    <p>Quantity: <?php echo ucwords($row['quantity']); ?></p>
                    <p>Address: <?php echo ucwords($row['address']); ?></p>
                    <p>Phone: <?php echo ucwords($row['phone']); ?></p>
                    <p>Comments: <?php echo ucwords($row['comments']); ?></p>
                </div>
                <div class="status">
                    <form method="post" action="action.php">
                        <input type="hidden" name="donation_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="recipientEmail" value="<?php echo $row['recipient_email']; ?>">
                        <button type="submit" name="action" value="approve" style="background-color: #12a537;">
                            <i class="fa-solid fa-check-double fa-xl" style="color: white;"></i> Accept
                        </button>
                    </form>
                    <form method="post" action="action.php">
                        <input type="hidden" name="donation_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="action" value="reject" style="background-color: #a51d38;">
                            <i class="fa-solid fa-xmark fa-xl" style="color: white;"></i> Reject
                        </button>
                    </form>
                </div>
            </div>
            <?php
                }
            }
            else{
                echo "<div class='no-records-message'>
                <h2>No Pending Requests found</h2>
                <p>There are currently no requests available.</p>
            </div>
            ";
            }
            ?>
        </div>
    </section>
</body>

</html>
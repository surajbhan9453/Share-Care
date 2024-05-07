<?php 
include 'session.php';
include 'config.php';

$userid = $_SESSION['userid'];
$query = "SELECT *
FROM donations
WHERE status = 'approved'
AND id IN (SELECT donation_id FROM requests where recipient_email='$userid');";


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
            <a href="index.php"><img src="../Images/Share&Carelogo3.png" alt=""></a>
            <div class="login-signup">
                <a href="../logout.php">Logout</a>
            </div>


            <div class="nav-link" id="navLink">
                <ul>
                    <li><a href="index.php">DASHBOARD</a></li>
                    <li><a href="request_process.php">AVAILABLE DONATIONS</a></li>
                    <li><a href="collect_donation.php">COLLECT DONATIONS</a></li>
                </ul>
                <p class="welcome-message">Welcome, <?php echo $_SESSION['name']; ?></p>
            </div>
        </nav>

        <div class="table-container">
            <h2>Collect Donations</h2>
            <table class="donation-table">
                <thead>
                    <tr>
                        <th>Item Type</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Address to Collect</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are rows returned from the query
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['item_type'] . "</td>";
                            echo "<td>" . $row['item_name'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>";
                            echo "<form method='post' action='collection_process.php'>";
                            echo "<input type='hidden' name='donation_id' value='" . $row['id'] . "'>";
                            echo "<input type='hidden' name='donor_email' value='" . $row['donor'] . "'>";
                            echo "<button type='submit' name='collected'><i class='fa-solid fa-check-circle' style='color: #00f;'></i> Collected </button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align: center; font-weight: bold;'>No records found</td></tr>";

                    }
                    ?>
                </tbody>
            </table>
        </div>

    </section>

</body>

</html>
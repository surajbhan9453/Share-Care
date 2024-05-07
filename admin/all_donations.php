<?php 
include 'session.php';
include 'config.php';

$userid = $_SESSION['userid'];
// Fetch donation records
$query = "SELECT * FROM donations";
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

<!-- Table to show prevoius donations -->

        <div class="table-container">
            <h2>Donation Records</h2>
            <table class="donation-table">
                <thead>
                    <tr>
                        <th>Item Type</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Address to Collect</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Collected By</th>
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
                            echo "<td>" . $row['collected_by'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        </section>
        
        </body>
</html>

<?php
include 'session.php';
include 'config.php';
$userid = $_SESSION['userid'];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['donation_id'])) {
    // Retrieve the donation details based on the ID from the URL
    $donation_id = $_GET['donation_id'];
    
    $query = "SELECT * FROM donations WHERE id = '$donation_id' AND donor = '$userid' AND status = 'pending'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
       
    } else {
        echo "Donation not found or an error occurred.";
    }
}
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
                </ul>
                <p class="welcome-message">Welcome, <?php echo $_SESSION['name']; ?></p>
            </div>
        </nav>

        <div class="form-container">
            <h2>Edit Donation</h2>
            <form method="post" action="update_donation.php">
                <label for="itemtype">Item Type:</label>
                <input type="hidden" name="donation_id" value="<?php echo $donation_id; ?>">
                <select name="itemtype" value="<?php echo $row['item_type']; ?>">
                    <?php
        $options = ['food', 'clothes', 'fruits','beverages', 'other consumables'];
        foreach ($options as $option) : ?>
                    <option value="<?php echo $option; ?>"
                        <?php echo ($row['item_type'] === $option) ? 'selected' : ''; ?>>
                        <?php echo ucwords($option); ?>
                    </option>
                    <?php endforeach; ?>
                </select><br><br>

                <label for="item_name">Item Name:</label>
                <input type="text" id="item_name" name="item_name" value="<?php echo $row['item_name']; ?>"><br><br>
                <label for="quantity">Quantity:</label>
                <input type="text" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>"><br><br>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>"><br><br>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>"><br><br>
                <label for="comments">Comments:</label>
                <input type="text" id="comments" name="comments" value="<?php echo $row['comments']; ?>"><br><br>


                <input type="submit" name="update_donation" value="Update">
            </form>
        </div>
    </section>
</body>

</html>
<?php include 'session.php';
    include 'config.php';
    // Collect form data
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $item_type = $_POST['item_type'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $comments = $_POST['comments'];
    $donor = $_SESSION['userid'];


    // Insert data into the database
    // Insert data into the database
    $sql = "INSERT INTO donations (`item_type`, `item_name`, `quantity`, `address`, `phone`,`comments`, donor) VALUES ('$item_type', '$item_name', $quantity, '$address', '$phone','$comments', '$donor')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>Donation Submitted!</h2>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Close the database connection
    $conn->close();
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
    <h2>Donation Form</h2>
    <form action="#" method="post" class="donation-form">
        <div class="form-group">
            <label for="item_type">Item Type:</label>
            <select id="item_type" name="item_type">
                <option value="food">Food</option>
                <option value="clothes">Clothes</option>
                <option value="fruits">Fruits</option>
                <option value="beverages">Beverages</option>
                <option value="other_consumables">Other Consumables</option>
            </select>
        </div>
        <div class="form-group">
            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="address">Address to Collect:</label>
            <textarea id="address" name="address" required></textarea>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
        </div>
        <div class="form-group">
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments"></textarea>
        </div>
        <input type="submit" value="Submit" class="submit-btn">
    </form>
</div>
    
        
    </section>
</body>

</html>

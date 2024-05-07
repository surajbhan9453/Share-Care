




<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share & Care</title>
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ce0692ee2e.js" crossorigin="anonymous"></script>

</head>
<body>


</div>
<section class="header">
        <nav>
            <a href="index.html"><img src="Images/Share&Carelogo3.png" alt=""></a>

            <!-- Login/Signup button at the top-right corner -->
            <div class="login-signup">
                <a href="login.php">Login</a>
            </div>


            <div class="nav-link" id="navLink">
                <i class="fas fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                   
                    <li><a href="topdonors.html">TOP DONORS</a></li>
                    <li><a href="contact.html">CONTACT</a></li>
                </ul>
            </div>
            <i class="fas fa-bars" onclick="showMenu()"></i>
        </nav>
        <div class="container">
    <div class="login-box" style="width: 400px; margin: 0 auto;">
        <h2>Login</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="user_id">User ID:</label>
            <input type="text" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input class="btn"  name="login" type="submit" value="Login">
            <!-- Add the "Create a new account" button here -->
        <p>Don't have an account? <a href="signup.php">Create a new account</a></p>
        </form>
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'donor/config.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate login credentials
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql) or die('query failed!');

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            // Password is correct, log in the user
            session_start();
            $_SESSION['userid'] = $row['email'];
            $_SESSION['role'] = $row['user_type'];
            $_SESSION['name'] = $row['first_name'] . ' ' . $row['last_name'];
            
            // Determine user type and redirect accordingly
            if ($row['user_type'] === 'donor') {
                header("Location: donor");
            } elseif ($row['user_type'] === 'recipient') {
                header("Location: recipient");
            } elseif ($row['user_type'] === 'admin') {
                header("Location: admin");
            } else{
                // Handle other user types or invalid scenarios
                echo "Invalid user type!";
                // Redirect to an error page or take appropriate action
            }
            exit();
        } else {
            echo "<h2 style='color: red;'>Invalid email or password</h2>";
        }
    } else {
        echo "<h2>Invalid email or password</h2>";
    }
    $conn->close();
}
?>

    </div>
      
    </section>


</body>
</html>

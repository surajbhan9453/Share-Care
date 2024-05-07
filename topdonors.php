<?php
include 'config.php';

// Fetch all users from the database
$query = "SELECT * FROM users where user_type='donor'";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share & Care</title>
    <link rel="stylesheet" href="topdonor.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ce0692ee2e.js" crossorigin="anonymous"></script>
</head>

<body>
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
                   
                    <li><a href="topdonors.php">TOP DONORS</a></li>
                    <li><a href="contact.html">CONTACT</a></li>
                </ul>
            </div>
            <i class="fas fa-bars" onclick="showMenu()"></i>
        </nav>
        <div class="table-container">
            <h2>Top Donors</h2>
            <table class="donation-table">
                <thead>
                    <tr>
                        <th>Donor Name</th>
                        <th>No. of Donation</th>
                        <th>Collected by recipient</th>
                        <th>Email id</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are rows returned from the query
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['first_name'] ." ". $row['last_name'] . "</td>";
                            echo"<td>    2       </td>";
                            echo"<td>    1       </td>";
                            echo "<td>" . $row['email'] . "</td>";
                                               
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add User - Admin Panel</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/477c9fcb6e.js" crossorigin="anonymous"></script>

<style>
    body {
    min-height: 90vh;
    width: 100%;
    background-image: linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.6)),url(../Images/pexels-bess-hamiti-35537.jpg);
    background-position: center;
    background-size: cover;
    position: relative;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.form-container {
    width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: black;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 2px;
}

input[type="text"],
input[type="email"],
select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}


</style>
</head>

<body>
    <div class="form-container">
        <h2>Add New User</h2>
        <form action="process_add_user.php" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" required><br><br>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br><br>

            <label for="user_type">User Type:</label>
            <select name="user_type" required>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select><br><br>

            <input type="submit" class="submit-btn" value="Add User">
        </form>
    </div>
</body>

</html>

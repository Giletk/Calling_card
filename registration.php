<!DOCTYPE html>
<html lang="ru">  
<head>  
    <meta charset="UTF-8">
    <title>Сыралёв И. А.</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap">

</head>
<body>
<div class="container col-4">
        <h2>Registration Form</h2>
        <form action="registration.php" method="post">
            <div class="form-group">
                <label for="email">Email:   </label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login">Login:   </label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>
</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("db.php");

echo "started";
// Database configuration
$servername = "db";
$username = "root";
$password = "kali";
$dbName = "MyApp";

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbName);
echo "link created; ";

// Login check
if (isset($_COOKIE['User'])) {
    header("Location: profile.php");
}

// Check connection
if (!$link) {
    echo "Did not connect; ";
    die("Connection failed: " . mysqli_connect_error());
}
echo "connected; ";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "submit initiated; ";
    // Prepare data for insertion
    $email = $_POST["email"];
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Check if all fields are filled
    if (!$email || !$login || !$password) {
        echo "Some fields are empty; ";
        die("Fill all of the fields!");
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$login', '$password')";
    echo "executing query; ";
    // Execute query
    if (mysqli_query($link, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}

// Close connection
mysqli_close($link);
?>

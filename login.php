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
        <h2>Log in</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="login">Login:   </label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Log in">
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
$dbusername = "root";
$dbpassword = "kali";
$dbName = "MyApp";

// Create connection
$link = mysqli_connect($servername, $dbusername, $dbpassword, $dbName);
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
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Check if all fields are filled
    if (!$login || !$password) {
        echo "Some fields are empty; ";
        die("Fill all of the fields!");
    }

    // SQL query to insert data into the database
    $sql = "SELECT * FROM users WHERE username='$login' AND password='$password'";
    echo "executing query; ";
    $result = mysqli_query($link, $sql);
    
    // Execute query
    if (mysqli_num_rows($result) == 1) {
        setcookie("User", $login, time()+7200);
        header('Location: profile.php');
      } else {
        echo "Неправильный логин или пароль";
      }
}

// Close connection
mysqli_close($link);
?>

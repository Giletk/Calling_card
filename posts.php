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
</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("db.php");


// Database configuration
$servername = "db";
$username = "root";
$password = "kali";
$dbName = "MyApp";

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbName);


// Login check
if (!isset($_COOKIE['User'])) {
    header("Location: login.php");
}

// Check connection
if (!$link) {
    echo "Did not connect; ";
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id=$id";
$res = mysqli_query($link, $sql);
$rows = mysqli_fetch_array($res);
$title = $rows['title'];
$main_text = $rows['main_text'];

echo "<h2>$title</h2>";
echo "<p>$main_text</p>";

// Close connection
mysqli_close($link);
?>
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
<div class="container">
        <div class="row">
            <h1>Post page!</h1>
            <div class="col-12 index box">
                <?php
                if (!isset($_COOKIE['User'])) {
                    ?>
                        <a href="/registration.php">Register</a>
                        <p></p>
                        <a href="/login.php">Log in</a>
                        
                    <?php
                    } else {
                        // подключение к БД
                    }
                ?>
            </div>
        </div>
</div>


</body>
</html>

<?php
// Database configuration
$servername = "127.0.0.1";
$username = "root";
$password = "kali";
$dbName = "MyApp";

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to retrieve all records from the "posts" table
$sql = "SELECT * FROM posts";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class=\"container col-4\">";
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        // Create link for each record
        echo "<a class=\"col-8\" href='posts.php?id=" . urlencode($row["id"]) . "'>" . htmlspecialchars($row["title"]) . "</a><br>";
    }
    echo "</div>";
} else {
    echo "No posts yet!";
}

// Close connection
mysqli_close($link);
?>

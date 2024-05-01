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
    <div class="container normal nav_bar">
        <div class="row">
            <div class="col-6 my_logo"></div>
            <div class="col-6 nav_text">
                <p>Информация обо мне!</p>             
            </div>
        </div>
    </div>

    <div class="container col-12">
        <div class="row">
            <div class="col-8">
                <h1>About me</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <h2>Сыралёв Иван, Ведущий специалист по прохождению стажировок! Дайте мне средства массовой информации и я покажу вам свою кошку! Без кота и жизнь не та. Я пришёл в этот мир не для того, чтобы ничего не делать, а для того, чтобы показывать рыбов. 
                </h2>
            </div>
            <div class="col-4">
                <div class="row my_photo neon-border caption_text">
                    <p class="photo_caption">Сыралёв И. А.</p>
                </div>
            </div>
        </div>
        <div class="container">
        <div class="row">
            <div class="button_js col-12">
                <button id="myButton">Press me!</button>
                <p id="demo"></p>
            </div>
        </div>
    </div>
</div>
    
<div class="container col-4">
    <h2>Привет, <?php echo $_COOKIE['User']; ?>!</h2>
    <h3>Поделитесь своими мыслями!</h3>
    <form action="profile.php" method="POST" enctype="multipart/form-data" name="upload">
        <div class="form-group">
            <label for="title">Заголовок: </label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Текст: </label>
            <textarea id="content" name="content" rows="4" style="width: calc(100% - 25px);" required></textarea>
            <!-- Width is calculated to be 100% minus the width of the scrollbar -->
        </div>
        <div class="form-group">
            <label for="file">Выберите файл: </label>
            <input type="file" id="file" name="file">
        </div>
        <div class="form-group">
            <input type="submit" value="Submit Post">
        </div>
    </form>
</div>


    <script type="text/javascript" src="js\button.js"></script>
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare data for insertion
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Check if all fields are filled
    if (!$title || !$content) {
        echo "Some fields are empty; ";
        die("Fill all of the fields!");
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$content')";
    // Execute query
    if (mysqli_query($link, $sql)) {
        echo "New record created successfully; ";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    if(!empty($_FILES["file"]))
    {
        if (((@$_FILES["file"]["type"] == "image/gif") || (@$_FILES["file"]["type"] == "image/jpeg")
        || (@$_FILES["file"]["type"] == "image/jpg") || (@$_FILES["file"]["type"] == "image/pjpeg")
        || (@$_FILES["file"]["type"] == "image/x-png") || (@$_FILES["file"]["type"] == "image/png"))
        && (@$_FILES["file"]["size"] < 102400))
        {
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            echo "File uploaded successfuly in:  " . "upload/" . $_FILES["file"]["name"];
        }
        else
        {
            echo "Upload failed! ";
        }
    }
}

// Close connection
mysqli_close($link);
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "db";
$username = "root";
$password = "kali";
$dbName = "MyApp";

$link = mysqli_connect($servername, $username, $password);
if (!$link) {
  die("Ошибка подключения: " . mysqli_connection_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if (!mysqli_query($link, $sql)) {
  echo "Не удалось создать БД";
}

mysqli_close($link);


$link = mysqli_connect($servername, $username, $password, $dbName);

// Создание таблицы пользователей
$sql = "CREATE TABLE IF NOT EXISTS users(
    id  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(15) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL
  )";

// Обработка ошибки создания таблицы пользователей
if(!mysqli_query($link, $sql)) {
    echo "Не удалось создать таблицу users";
  }

  // Создание таблицы записей
$sql = "CREATE TABLE IF NOT EXISTS posts(
    id  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    main_text VARCHAR(400) NOT NULL
  )";

// Обработка ошибки создания таблицы записей
if(!mysqli_query($link, $sql)) {
    echo "Не удалось создать таблицу posts";
  }


mysqli_close($link);
?>
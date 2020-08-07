<?php
  // This file will contain the function to create the connection with the database. Keep in mind that you must use your previously created database constants in order to connect with your database.

  require_once "../config/db.php";

  $servername = HOST;
  $database = DATABASE;
  $username = USER;
  $password = PASSWORD;

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
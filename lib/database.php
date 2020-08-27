<?php
  /*
    This file will contain a class with the method responsible to create the connection with the database. 
    Keep in mind that you must use your previously created database constants in order to connect with your database.
  */

  class Database {

    public static function setConnection(string $servername, string $database, string $username, string $password)
    {
      try {
        // Set DSN
        $dsn = 'mysql:host=' . $servername . ';dbname=' . $database;
        // Create a PDO instance
        $conn = new PDO($dsn, $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }

  }

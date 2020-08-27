<?php
  /*
    This file will contain a class with the method responsible to create the connection with the database.
    Keep in mind that you must use your previously created database constants in order to connect with your database.
  */

  class Database {

    private $host;
    private $database;
    private $user;
    private $password;

    public function __construct()
    {
      $this->host = constant('HOST');
      $this->database = constant('DATABASE');
      $this->user = constant('USER');
      $this->password = constant('PASSWORD');
    }

    public function connect()
    {
      try {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
        // Create a PDO instance
        $conn = new PDO($dsn, $this->user, $this->password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }

  }

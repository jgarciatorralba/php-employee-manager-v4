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

      /*
        Check if the database already exists, creating it if not 
        (including table creation and insertion of some dummy data).
      */
      $db = $this->checkExistingDB();
      if ($db == "Database created successfully"){
        $sql = "USE " . $this->database;
        $this->executeSQLQuery($sql);
        
        $sql = '
          CREATE TABLE employees (
            id INT(11),
            redirect VARCHAR(5),
            avatar VARCHAR(255),
            name VARCHAR(25),
            lastName VARCHAR(40),
            email VARCHAR(60),
            gender VARCHAR(6),
            city VARCHAR(40),
            streetAddress VARCHAR(40),
            state VARCHAR(25),
            age INT(3),
            postalCode INT(8),
            phoneNumber INT(9),
            PRIMARY KEY(id)
          );
        ';
        $this->executeSQLQuery($sql);
        
        $sql = '
          CREATE TABLE users (
            userId INT(11),
            name VARCHAR(25),
            password VARCHAR(100),
            email VARCHAR(60),
            PRIMARY KEY(userId)
          );
        ';
        $this->executeSQLQuery($sql);

        $sql = "
          INSERT INTO employees
          (id, redirect, avatar, name, lastName, email, gender, city, streetAddress, state, age, postalCode, phoneNumber) values
          (1, 'true', 'https:\/\/uifaces.co\/our-content\/donated\/5N18dOsU.jpg', 'Jack', 'Lei', 'jackon@network.com', 'man', 'San Jose', '126', 'CA', 24, 394221, 738362764),
          (2, 'true', 'https:\/\/images.generated.photos\/2I8a-p549TkdrqgBf3s2ijlitawgb6zTuYRB7SGMYEc\/rs:fit:512:512\/Z3M6Ly9nZW5lcmF0\/ZWQtcGhvdG9zL3Yy\/XzA5NjQyMDMuanBn.jpg', 'John', 'Doe', 'jhondoe@foo.com', 'man', 'New York', '89', 'NY', 36, 09889, 128364564),
          (3, 'true', 'https:\/\/i.imgur.com\/kcPMLNS.jpg', 'Leila', 'Mills', 'mills@leila.com', 'woman', 'San Diego', '55', 'CA', 29, 098765, 998363246),
          (4, 'true', 'https:\/\/uifaces.co\/our-content\/donated\/rlZDBrY_.jpeg', 'Richard', 'Desmond', 'desmondr@foo.com', 'man', 'Salt Lake City', '90', 'UT', 30, 457320, 908769876),
          (5, 'true', 'https:\/\/randomuser.me\/api\/portraits\/women\/76.jpg', 'Susan', 'Smith', 'susansmith@baz.com', 'woman', 'Louisville', '43', 'KNT', 28, 445321, 224355488);
        ";
        $this->executeSQLQuery($sql);

        $sql = "
          INSERT INTO users
          (userId, name, password, email) values
          (1, 'admin', '$2y$10\$nuh1LEwFt7Q2/wz9/CmTJO91stTBS4cRjiJYBY3sVCARnllI.wzBC', 'admin@assemblerschool.com');
        ";
        $this->executeSQLQuery($sql);
      }
    }

    public function connect()
    {
      try {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
        // Create a PDO instance
        $conn = new PDO($dsn, $this->user, $this->password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }

    public function createDB()
    {
      try {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host;
        // Create a PDO instance
        $conn = new PDO($dsn, $this->user, $this->password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "DROP DATABASE IF EXISTS " . $this->database;
        // Use exec() because no results are returned
        $conn->exec($sql);
        $sql = "CREATE DATABASE " . $this->database;
        $conn->exec($sql);
        return "Database created successfully";
      } catch(PDOException $e) {
        return "Database creation failed: " . $e->getMessage();
      }
      // Close connection
      $conn = null;
    }

    public function checkExistingDB()
    {
      $conn = $this->connect();
      if (gettype($conn) != 'string') {
        // Close connection
        $conn = null;
        // Assign some string to the variable
        $conn = 'Connection was OK';
      }
      $errorNotFoundDB = '[1049]';
      if (strpos($conn, $errorNotFoundDB)){
        return $this->createDB();
      } else {
        return false;
      }
    }

    public function executeSQLQuery(string $SQLQuery)
    {
      try {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
        // Create a PDO instance
        $conn = new PDO($dsn, $this->user, $this->password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Use exec() because no results are returned
        $conn->exec($SQLQuery);
      } catch(PDOException $e) {
        echo "Query execution failed: " . $e->getMessage();
      }
      // Close connection
      $conn = null;
    }

  }

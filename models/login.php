<?php

    class LoginModel extends Model {

        /* ~~~ MODEL METHODS ~~~ */

        public function __construct()
        {
            parent::__construct();
        }

        public function checkCredentials($username, $password)
        {
            $user = $this->getUser($username);

            if (gettype($user) != 'array'){
                return $user;
            } else {
                if (!password_verify($password, $user["password"])) {
                    return "user";
                }
            }

            return password_verify($password, $user["password"]);
        }

        public function getUser($username)
        {
            try {
                $conn = $this->database->connect();
                if (gettype($conn) != 'string') {
                    // Using prepared statements and named parameters (also positional params are an option)
                    $sql = 'SELECT * FROM users WHERE name = :name';
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(['name' => $username]);

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = $stmt->fetch();
                    // close connection
                    $conn = null;
                    return $result;
                } else {
                    return "connection";
                }
            } catch(PDOException $e) {
                return "query";
            }
        }

    }

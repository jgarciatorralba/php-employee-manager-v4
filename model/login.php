<?php

    include_once(LIB."database.php");

    class LoginModel {

        /* ~~~ MODEL METHODS ~~~ */

        public function checkCredentials($username, $password)
        {
            $user = $this->getUser($username);
            return password_verify($password, $user["password"]);
        }

        public function getUser($username)
        {
            $conn = Database::setConnection(HOST, DATABASE, USER, PASSWORD);
            if ($conn) {
                $stmt = $conn->prepare("SELECT * FROM users WHERE name = '$username';");
                $stmt->execute();

                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetch();
                // close connection
                $conn = null;
                return $result;
            }
        }

        public function getUsers()
        {
            $conn = Database::setConnection(HOST, DATABASE, USER, PASSWORD);
            if ($conn) {
                $stmt = $conn->prepare("SELECT * FROM users");
                $stmt->execute();

                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetch();
                // close connection
                $conn = null;
                return $result;
            }
        }

        public function logOut()
        {
            $_SESSION = array();
            session_destroy();
            header("Location: index.php");
        }

    }

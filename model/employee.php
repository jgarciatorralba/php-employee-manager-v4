<?php

    include_once(LIB."database.php");

    class EmployeeModel {

        /* ~~~ MODEL METHODS ~~~ */

        public function addEmployee(array $newEmployee)
        {
            $employees = $this->readEmployees();
            $newEmployee['id'] = $this->getNextIdentifier($employees);

            $conn = Database::setConnection(HOST, DATABASE, USER, PASSWORD);
            if ($conn) {
                $id = $newEmployee['id'];
                if (isset($newEmployee['avatar'])){
                    $avatar = $newEmployee['avatar'];
                } else {
                    $avatar = "";
                }
                $name = $newEmployee['name'];
                if (isset($newEmployee['lastName'])){
                    $lastName = $newEmployee['lastName'];
                } else {
                    $lastName = "";
                }
                $email = $newEmployee['email'];
                if (isset($newEmployee['gender'])){
                    $gender = $newEmployee['gender'];
                } else {
                    $gender = "";
                }
                $city = $newEmployee['city'];
                $streetAddress = $newEmployee['streetAddress'];
                $state = $newEmployee['state'];
                $parsedAge = intval($newEmployee['age']);
                $postalCode = $newEmployee['postalCode'];
                $phoneNumber = $newEmployee['phoneNumber'];

                $sql =
                    "INSERT INTO 
                        employees (id, avatar, name, lastName, email, gender, city, streetAddress, state, age, postalCode, phoneNumber) 
                        values ($id, '$avatar', '$name', '$lastName', '$email', '$gender', '$city', '$streetAddress', '$state', $parsedAge, $postalCode, $phoneNumber)"
                ; 
                $conn->prepare($sql)->execute();

                // close connection
                $conn = null;
            }
        }

        public function deleteEmployee(string $id)
        {
            $conn = Database::setConnection(HOST, DATABASE, USER, PASSWORD);
            if ($conn) {
                $parsedId = intval($id);
                $stmt = $conn->prepare("DELETE FROM employees WHERE id = $parsedId;");
                $stmt->execute();

                // close connection
                $conn = null;
            }
        }

        public function updateEmployee(array $updateEmployee)
        {
            $conn = Database::setConnection(HOST, DATABASE, USER, PASSWORD);

            if ($conn) {
                $parsedId = intval($updateEmployee['id']);
                $redirect = $updateEmployee['redirect'];
                $avatar = $updateEmployee['avatar'];
                $name = $updateEmployee['name'];
                $lastName = $updateEmployee['lastName'];
                $email = $updateEmployee['email'];
                $gender = $updateEmployee['gender'];
                $city = $updateEmployee['city'];
                $streetAddress = $updateEmployee['streetAddress'];
                $state = $updateEmployee['state'];
                $parsedAge = intval($updateEmployee['age']);
                $postalCode = $updateEmployee['postalCode'];
                $phoneNumber = $updateEmployee['phoneNumber'];

                $sql = 
                    "UPDATE employees 
                        SET 
                            redirect = '$redirect', 
                            avatar = '$avatar', 
                            name = '$name', 
                            lastName = '$lastName', 
                            email = '$email', 
                            gender = '$gender', 
                            city = '$city', 
                            streetAddress = '$streetAddress', 
                            state = '$state', 
                            age = $parsedAge, 
                            postalCode = $postalCode, 
                            phoneNumber = $phoneNumber 
                        WHERE id = $parsedId;"
                ;
                $conn->exec($sql);

                // close connection
                $conn = null;
            }
        }

        public function getEmployee(string $id)
        {
            $conn = Database::setConnection(HOST, DATABASE, USER, PASSWORD);
            if ($conn) {
                $parsedId = intval($id);
                $stmt = $conn->prepare("SELECT * FROM employees WHERE id = $parsedId;");
                $stmt->execute();

                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetch();
                // close connection
                $conn = null;
                return $result;
            }
        }

        public function getQueryStringParameters(): array
        {
            return $_GET;
        }

        public function getNextIdentifier(array $employeesCollection): int
        {
            $last_id = (int) end($employeesCollection)["id"];
            return $last_id + 1;
        }

        public function readEmployees()
        {
            $conn = Database::setConnection(HOST, DATABASE, USER, PASSWORD);
            if ($conn) {
                $stmt = $conn->prepare("SELECT * FROM employees;");
                $stmt->execute();

                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();
                // close connection
                $conn = null;
                return $result;
            }
        }

    }

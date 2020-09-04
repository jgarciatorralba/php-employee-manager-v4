<?php

    class EmployeeModel extends Model {

        /* ~~~ MODEL METHODS ~~~ */

        public function __construct()
        {
            parent::__construct();
        }

        public function addEmployee(array $newEmployee)
        {
            $employees = $this->readEmployees();
            if (gettype($employees) == 'string') {
                return $employees;
            } else {
                $newEmployee['id'] = $this->getNextIdentifier($employees);
                try {
                    $conn = $this->database->connect();
                    if (gettype($conn) != 'string'){
                        $id = $newEmployee['id'];
                        if (isset($newEmployee['redirect'])){
                            $redirect = $newEmployee['redirect'];
                        } else {
                            $redirect = "";
                        }
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
                            'INSERT INTO
                                employees (id, redirect, avatar, name, lastName, email, gender, city, streetAddress, state, age, postalCode, phoneNumber)
                                values (:id, :redirect, :avatar, :name, :lastName, :email, :gender, :city, :streetAddress, :state, :age, :postalCode, :phoneNumber)';
                        
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([
                            'id' => $id,
                            'redirect' => $redirect,
                            'avatar' => $avatar,
                            'name' => $name,
                            'lastName' => $lastName,
                            'email' => $email,
                            'gender' => $gender,
                            'city' => $city,
                            'streetAddress' => $streetAddress,
                            'state' => $state,
                            'age' => $parsedAge,
                            'postalCode' => $postalCode,
                            'phoneNumber' => $phoneNumber
                        ]);

                        // close connection
                        $conn = null;

                        return $id;
                    } else {
                        return "There was a problem with the database connection";
                    }
                } catch(PDOException $e) {
                    return "There was a problem with the SQL query";
                }
            }
        }

        public function deleteEmployee(string $id)
        {
            try {
                $conn = $this->database->connect();
                if (gettype($conn) != 'string') {
                    $parsedId = intval($id);
                    $sql = 'DELETE FROM employees WHERE id = :id';
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(['id' => $parsedId]);

                    // close connection
                    $conn = null;

                    return true;
                } else {
                    return "There was a problem with the database connection";
                }
            } catch(PDOException $e) {
                return "There was a problem with the SQL query";
            }
        }

        public function updateEmployee(array $updateEmployee)
        {
            try {
                $conn = $this->database->connect();
                if (gettype($conn) != 'string') {
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
                        'UPDATE employees
                            SET 
                            redirect = :redirect, 
                            avatar = :avatar, 
                            name = :name, 
                            lastName = :lastName, 
                            email = :email, 
                            gender = :gender, 
                            city = :city, 
                            streetAddress = :streetAddress, 
                            state = :state, 
                            age = :age, 
                            postalCode = :postalCode, 
                            phoneNumber = :phoneNumber 
                        WHERE id = :id';

                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        'redirect' => $redirect,
                        'avatar' => $avatar,
                        'name' => $name,
                        'lastName' => $lastName,
                        'email' => $email,
                        'gender' => $gender,
                        'city' => $city,
                        'streetAddress' => $streetAddress,
                        'state' => $state,
                        'age' => $parsedAge,
                        'postalCode' => $postalCode,
                        'phoneNumber' => $phoneNumber,
                        'id' => $parsedId
                    ]);

                    // close connection
                    $conn = null;

                    return $parsedId;
                } else {
                    return "There was a problem with the database connection";
                }
            } catch(PDOException $e) {
                return "There was a problem with the SQL query";
            }
        }

        public function getEmployee(string $id)
        {
            try {
                $conn = $this->database->connect();
                if (gettype($conn) != 'string') {
                    $parsedId = intval($id);
                    $sql = 'SELECT * FROM employees WHERE id = :id';
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(['id' => $parsedId]);

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = $stmt->fetch();
                    // close connection
                    $conn = null;
                    return $result;
                } else {
                    return "There was a problem with the database connection";
                }
            } catch (PDOException $e) {
                return "There was a problem with the SQL query";
            }
        }

        public function getNextIdentifier(array $employeesCollection): int
        {
            $last_id = (int) end($employeesCollection)["id"];
            return $last_id + 1;
        }

        public function readEmployees()
        {
            try {
                $conn = $this->database->connect();
                if (gettype($conn) != 'string') {
                    $stmt = $conn->prepare("SELECT * FROM employees;");
                    $stmt->execute();

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = $stmt->fetchAll();
                    // close connection
                    $conn = null;
                    return $result;
                } else {
                    return "There was a problem with the database connection";
                }
            } catch (PDOException $e) {
                return "There was a problem with the SQL query";
            }
        }

    }

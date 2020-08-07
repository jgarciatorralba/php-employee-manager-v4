<?php

include_once(LIB."database.php");

function addEmployee(array $newEmployee)
{
    $employees = readEmployees();
    $newEmployee['id'] = getNextIdentifier($employees);

    $conn = setConnection (HOST, DATABASE, USER, PASSWORD);
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
                employees (id, avatar, [name], lastName, email, gender, city, streetAddress, [state], age, postalCode, phoneNumber) 
                values ($id, $avatar, $name, $lastName, $email, $gender, $city, $streetAddress, $state, $parsedAge, $postalCode, $phoneNumber)"
        ;
        $conn->exec($sql);

        // close connection
        $conn = null;
    }
}


function deleteEmployee(string $id)
{
    $conn = setConnection (HOST, DATABASE, USER, PASSWORD);
    if ($conn) {
        $parsedId = intval($id);
        $stmt = $conn->prepare("DELETE FROM employees WHERE id = $parsedId;");
        $stmt->execute();

        // close connection
        $conn = null;
    }
}


function updateEmployee(array $updateEmployee)
{
    // $employees = readEmployees();
    // $key = array_search($updateEmployee['id'], array_column($employees, 'id'));
    // if (!is_numeric($key)) return false;
    // $employees[$key] = $updateEmployee;
    // return writeEmployees($employees) ? $employees[$key] : false;

    $conn = setConnection (HOST, DATABASE, USER, PASSWORD);
    // $conn->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
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
                    redirect =$redirect, 
                    -- avatar = $avatar, 
                    name = '$name', 
                    -- lastName = $lastName, 
                    -- email = $email, 
                    -- gender = $gender, 
                    -- city = $city, 
                    streetAddress = $streetAddress, 
                    -- state = $state, 
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


function getEmployee(string $id)
{
    $conn = setConnection (HOST, DATABASE, USER, PASSWORD);
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


function removeAvatar($id)
{
    $employees = readEmployees();
    $key = array_search($id, array_column($employees, 'id'));
    if (!is_numeric($key)) return false;
    unset($employees[$key]);
    return writeEmployees($employees);
}


function getQueryStringParameters(): array
{
    return $_GET;
}


function getNextIdentifier(array $employeesCollection): int
{
    $last_id = (int) end($employeesCollection)["id"];
    return $last_id + 1;
}


function readEmployees()
{
    $conn = setConnection (HOST, DATABASE, USER, PASSWORD);
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


function writeEmployees($data)
{
    $data = json_encode($data, JSON_PRETTY_PRINT);
    $result = file_put_contents(RESOURCES."employees.json", $data);
    return is_numeric($result);
}

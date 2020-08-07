<?php

function addEmployee(array $newEmployee)
{
    $employees = readEmployees();
    $newEmployee['id'] = getNextIdentifier($employees);
    array_push($employees, $newEmployee);
    return writeEmployees($employees) ? $newEmployee : false;
}


function deleteEmployee(string $id)
{
    $employees = readEmployees();
    $key = array_search($id, array_column($employees, 'id'));
    if (!is_numeric($key)) return false;
    array_splice($employees, $key, 1);
    return writeEmployees($employees);
}


function updateEmployee(array $updateEmployee)
{
    $employees = readEmployees();
    $key = array_search($updateEmployee['id'], array_column($employees, 'id'));
    if (!is_numeric($key)) return false;
    $employees[$key] = $updateEmployee;
    return writeEmployees($employees) ? $employees[$key] : false;
}


function getEmployee(string $id)
{
    $employees = readEmployees();
    $key = array_search($id, array_column($employees, 'id'));
    if (!is_numeric($key)) return false;
    return $employees[$key];
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
    $last_id = (int) end($employeesCollection)->id;
    return $last_id + 1;
}


function readEmployees()
{
    // $data = file_get_contents(RESOURCES."employees.json");
    // return json_decode($data);

    include_once(LIB."database.php");

    $conn = setConnection (HOST, DATABASE, USER, PASSWORD);
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM employees");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
        $conn = null;
    }
}


function writeEmployees($data)
{
    $data = json_encode($data, JSON_PRETTY_PRINT);
    $result = file_put_contents(RESOURCES."employees.json", $data);
    return is_numeric($result);
}

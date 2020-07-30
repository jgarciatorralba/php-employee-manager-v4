<?php

include_once('sessionHelper.php');

function addEmployee(array $newEmployee)
{
    $employees = readEmployees();

    $employee = new stdClass();

    $employee->id = getNextIdentifier($employees);

    if (isset($newEmployee['name'])) $employee->name = $newEmployee['name'];
    if (isset($newEmployee['lastName'])) $employee->lastName = $newEmployee['lastName'];
    if (isset($newEmployee['email'])) $employee->email = $newEmployee['email'];
    if (isset($newEmployee['gender'])) $employee->gender = $newEmployee['gender'];
    if (isset($newEmployee['age'])) $employee->age = $newEmployee['age'];
    if (isset($newEmployee['streetAddress'])) $employee->streetAddress = $newEmployee['streetAddress'];
    if (isset($newEmployee['city'])) $employee->city = $newEmployee['city'];
    if (isset($newEmployee['state'])) $employee->state = $newEmployee['state'];
    if (isset($newEmployee['postalCode'])) $employee->postalCode = $newEmployee['postalCode'];
    if (isset($newEmployee['phoneNumber'])) $employee->phoneNumber = $newEmployee['phoneNumber'];
    if (isset($newEmployee['avatar'])) $employee->avatar = $newEmployee['avatar'];

    array_push($employees, $employee);

    return writeEmployees($employees) ? $employee : false;
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

    $employees[$key]->name = $updateEmployee['name'];
    $employees[$key]->lastName = $updateEmployee['lastName'];
    $employees[$key]->email = $updateEmployee['email'];
    $employees[$key]->gender = $updateEmployee['gender'];
    $employees[$key]->age = $updateEmployee['age'];
    $employees[$key]->streetAddress = $updateEmployee['streetAddress'];
    $employees[$key]->city = $updateEmployee['city'];
    $employees[$key]->state = $updateEmployee['state'];
    $employees[$key]->postalCode = $updateEmployee['postalCode'];
    $employees[$key]->phoneNumber = $updateEmployee['phoneNumber'];
    $employees[$key]->avatar = $updateEmployee['avatar'];

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
    $path = '../../resources/employees.json';
    $data = file_get_contents($path);
    return json_decode($data);
}


function writeEmployees($data)
{
    $path = '../../resources/employees.json';
    $data = json_encode($data, JSON_PRETTY_PRINT);
    $result = file_put_contents($path, $data);
    return is_numeric($result);
}

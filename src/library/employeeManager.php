<pre>
<?php

/**
 * EMPLOYEE FUNCTIONS LIBRARY
 *
 * @author: Jose Manuel Orts
 * @date: 11/06/2020
 */

function addEmployee(array $newEmployee)
{
    $employees = readEmployees();

    $employee = [
        'id' => getNextIdentifier($employees),
        'name' => $newEmployee['name'],
        'lastName' => $newEmployee['lastName'],
        'email' => $newEmployee['email'],
        'gender' => $newEmployee['gender'],
        'age' => $newEmployee['age'],
        'streetAddress' => $newEmployee['streetAddress'],
        'city' => $newEmployee['city'],
        'state' => $newEmployee['state'],
        'postalCode' => $newEmployee['postalCode'],
        'phoneNumber' => $newEmployee['phoneNumber']
    ];

    array_push($employees, $employee);
    writeEmployees($employees);
}


function deleteEmployee(string $id)
{
    $employees = readEmployees();
    $key = array_search($id, array_column($employees, 'id'));
    if ($key) {
        array_splice($employees, $key, 1);
        writeEmployees($employees);
    }
}


function updateEmployee(array $updateEmployee)
{
    $employees = readEmployees();
    $key = array_search($updateEmployee['id'], array_column($employees, 'id'));

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

    writeEmployees($employees);
}


function getEmployee(string $id)
{
    $employees = readEmployees();
    $key = array_search($id, array_column($employees, 'id'));
    if ($key) return $employees[$key];
    return false;
}


function removeAvatar($id)
{
    // TODO implement it
}


function getQueryStringParameters(): array
{
    // TODO implement it
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
    file_put_contents($path, $data);
}

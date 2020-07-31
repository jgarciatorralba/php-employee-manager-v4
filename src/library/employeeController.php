<?php

include_once('sessionHelper.php');

include_once('employeeManager.php');

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $data = getHandler();
        if ($data) echo json_encode($data);
        else http_response_code(404);
        break;
    case 'POST':
        $data = postHandler();
        if ($data) echo json_encode($data);
        else http_response_code(500);
        break;
    case 'DELETE':
        if (!deleteHandler()) http_response_code(500);
        break;
    default:
        http_response_code(400);
        break;
}

function getHandler()
{
    return isset($_GET['employee']) ? getEmployee($_GET['employee']) : readEmployees();
}

function postHandler()
{
    $employee = $_POST;
    if (count($employee) === 0) return false;
    // propiety redirect is set if post request is from employee.php
    if (isset($employee['redirect'])) header('Location: ../employee.php?id=' . $employee['id'] . '&success=true');
    return isset($employee['id']) && is_numeric($employee['id']) ? updateEmployee($employee) : addEmployee($employee);
}

function deleteHandler()
{
    parse_str(file_get_contents("php://input"), $data);
    if (!isset($data['id'])) return false;
    else header("Location: ./index.php");
    return deleteEmployee($data['id']);
}

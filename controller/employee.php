<?php

require_once BASE_PATH . "/config.php";
require_once MODEL."employee.php";

//header('Content-Type: application/json');

$action;

if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "getListAJAX";
}

if (function_exists($action)) {
    call_user_func($action, $_REQUEST);
}

/*switch ($_SERVER['REQUEST_METHOD']) {
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
}*/

function getListAJAX() {
    return readEmployees();
}

function getEmployeeAJAX()
{
    include(VIEW."employee.php");
    return getEmployee($_GET['employee']);
}

function createEmployeeAJAX() {
    $employee = $_POST;
    if (count($employee) === 0) return false;
    return addEmployee($employee);
}

function updateEmployeeAJAX() {
    $employee = $_POST;
    if (count($employee) === 0) return false;
    header('Location:'. BASE_PATH .'index.php?controller=employee.php&id=' . $employee['id'] . '&success=true');
    return updateEmployee($employee);
}

function postHandler()
{
    $employee = $_POST;
    if (count($employee) === 0) return false;
    // propiety redirect is set if post request is from employee.php
    if (isset($employee['redirect'])) 
    return isset($employee['id']) && is_numeric($employee['id']) ? updateEmployee($employee) : addEmployee($employee);
}

function deleteHandler()
{
    parse_str(file_get_contents("php://input"), $data);
    if (!isset($data['id'])) return false;
    else header('Location:'. BASE_PATH .'index.php?dashboard');
    return deleteEmployee($data['id']);
}

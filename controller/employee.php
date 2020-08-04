<?php

require_once BASE_PATH . "/config.php";
require_once MODEL."employee.php";

$action;

if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "showEmployees";
}

if (function_exists($action)) {
    call_user_func($action, $_REQUEST);
} 

function showEmployees(){
    $employees = readEmployees();
    echo json_encode($employees);
}

function getEmployeeAJAX()
{
    $employee = getEmployee($_GET["empID"]);
    echo json_encode($employee);
}

function showEmployeeForm() {
    include(VIEW."employee.php");
}

function createEmployeeAJAX() {
    $employee = $_POST;
    if (count($employee) === 0) return false;
    return addEmployee($employee);
}

function submitEmployee()
{
    $employee = $_POST;
    if (count($employee) === 0) return false;    
    isset($employee['id']) && is_numeric($employee['id']) ? updateEmployee($employee) : addEmployee($employee);

    // propiety redirect is set if post request is from employee.php
    if (isset($employee['redirect'])) header('Location: index.php?controller=employee&action=showEmployeeForm&id='.$employee['id'].'&success=true');
}

function deleteEmployeeAJAX()
{
    parse_str(file_get_contents("php://input"), $data);
    if (!isset($data['id'])) return false;
    return deleteEmployee($data['id']);
}

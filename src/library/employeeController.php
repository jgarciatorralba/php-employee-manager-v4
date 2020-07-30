<?php

include_once('sessionHelper.php');

include_once('employeeManager.php');

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $data = getHandler();
        if ($data) echo $data;
        else http_response_code(404);
        break;
    case 'POST':
        $data = postHandler();
        if ($data) echo $data;
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
    if (isset($_GET['employee'])) $data = getEmployee($_GET['employee']);
    else $data = readEmployees();
    return $data ? json_encode($data) : false;
}

function postHandler()
{
    $employee = $_POST;
    if (!isset($employee)) return false;
    if (!isset($employee['id'])) {
        $return = addEmployee($employee);
    } else {
        $return = updateEmployee($employee);
        header('Location: ../employee.php?id=' . $employee['id'] . '&success=true');
    }
    return $return;
}

function deleteHandler()
{
    parse_str(file_get_contents("php://input"), $data);
    if (!isset($data['id'])) return false;
    else header("Location: ./index.php");
    return deleteEmployee($data['id']);
}

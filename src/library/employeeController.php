<?php

include_once('sessionHelper.php');

include_once('employeeManager.php');

header('Content-Type: application/json');

if (requestHandler() === false) {
    $response = new stdClass();
    $response->success = false;
    echo json_encode($response);
}

function requestHandler()
{
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            return getHandler();
        case 'POST':
            return postHandler();
        case 'DELETE':
            return deleteHandler();
        default:
            return false;
    }
}

function getHandler()
{
    // parse_str(file_get_contents("php://input"), $data);
    // echo $data;
    echo json_encode(readEmployees());
}

function postHandler()
{
}

function deleteHandler()
{
    parse_str(file_get_contents("php://input"), $data);
    if (!isset($data['id'])) return false;
    else header("Location: ./index.php");
    return deleteEmployee($data['id']);
}

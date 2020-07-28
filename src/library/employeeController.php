<?php

include_once('sessionHelper.php');

include_once('employeeManager.php');

header('Content-Type: application/json');

if (requestHandler() == false) {
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
        case 'PUT':
            return putHandler();
        case 'DELETE':
            return deleteHandler();
        default:
            return false;
    }
}

function getHandler()
{
    echo json_encode(readEmployees());
}

function postHandler()
{
}

function putHandler()
{
    parse_str(file_get_contents("php://input"), $data);
    if (!isset($data['id'])) return false;
}

function deleteHandler()
{
    parse_str(file_get_contents("php://input"), $data);
    if (!isset($data['id'])) return false;
    return deleteEmployee($data['id']);
}

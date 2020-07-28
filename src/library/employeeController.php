<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

        include('employeeManager.php');

        header('Content-Type: application/json');

        $employees = readEmployees();

        echo json_encode($employees);
        break;

    case 'POST':
        // codigo
        break;
    case 'PUT':
        echo 'prueba de put';
        break;
    case 'UPDATE':
        echo 'prueba de update';
        // codigo
        break;
    case 'DELETE':
        echo 'prueba de delete';
        parse_str(file_get_contents("php://input"), $data);
        echo $data['fruit'];
        // codigo
        break;
}

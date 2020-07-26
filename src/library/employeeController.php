<?php

include('employeeManager.php');

header('Content-Type: application/json');

$employees = readEmployees();

echo json_encode($employees);

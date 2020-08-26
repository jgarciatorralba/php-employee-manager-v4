<?php

    require_once MODEL."employee.php";

    class EmployeeController {

        /* ~~~ CONTROLLER FUNCTIONS ~~~ */

        public function showEmployees(){
            $employees = readEmployees();
            echo json_encode($employees);
        }
        
        public function getEmployeeAJAX()
        {
            $employee = getEmployee($_GET["empID"]);
            echo json_encode($employee);
        }
        
        public function showEmployeeForm() {
            include(VIEW."employee.php");
        }
        
        public function createEmployeeAJAX() {
            $employee = $_POST;
            if (count($employee) === 0) return false;
            return addEmployee($employee);
        }
        
        public function submitEmployee()
        {
            $employee = $_POST;
            if (count($employee) === 0) return false;
            isset($employee['id']) && is_numeric($employee['id']) ? updateEmployee($employee) : addEmployee($employee);
        
            // propiety redirect is set if post request is from employee.php
            if (isset($employee['redirect'])) header('Location: index.php?controller=employee&action=showEmployeeForm&id='.$employee['id'].'&success=true');
        }
        
        public function deleteEmployeeAJAX()
        {
            parse_str(file_get_contents("php://input"), $data);
            if (!isset($data['id'])) return false;
            return deleteEmployee($data['id']);
        }

    }

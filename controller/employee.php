<?php

    require_once MODEL."employee.php";

    class EmployeeController extends Controller {

        private $employeeModel;
        
        /* ~~~ CONTROLLER METHODS ~~~ */

        public function __construct()
        {
            parent::__construct();
        }

        public function showEmployees()
        {
            $this->employeeModel = new EmployeeModel();
            
            $employees = $this->employeeModel->readEmployees();
            echo json_encode($employees);
        }
        
        public function getEmployeeAJAX()
        {
            $this->employeeModel = new EmployeeModel();
            
            $employee = $this->employeeModel->getEmployee($_GET["empID"]);
            echo json_encode($employee);
        }
        
        public function showEmployeeForm()
        {
            include(VIEW."employee.php");
        }
        
        public function createEmployeeAJAX()
        {
            $this->employeeModel = new EmployeeModel();
            
            $employee = $_POST;
            if (count($employee) === 0) return false;
            return $this->employeeModel->addEmployee($employee);
        }
        
        public function submitEmployee()
        {
            $this->employeeModel = new EmployeeModel();
            
            $employee = $_POST;
            if (count($employee) === 0) return false;
            isset($employee['id']) && is_numeric($employee['id']) ? $this->employeeModel->updateEmployee($employee) : $this->employeeModel->addEmployee($employee);
        
            // propiety redirect is set if post request is from employee.php
            if (isset($employee['redirect'])) header('Location: index.php?controller=employee&action=showEmployeeForm&id='.$employee['id'].'&success=true');
        }
        
        public function deleteEmployeeAJAX()
        {
            $this->employeeModel = new EmployeeModel();

            parse_str(file_get_contents("php://input"), $data);
            if (!isset($data['id'])) return false;
            return $this->employeeModel->deleteEmployee($data['id']);
        }

    }

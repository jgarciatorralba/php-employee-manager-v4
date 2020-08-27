<?php

    class EmployeeController extends Controller {
        
        /* ~~~ CONTROLLER METHODS ~~~ */

        public function __construct()
        {
            parent::__construct();
        }

        public function showEmployees()
        {
            $employees = $this->model->readEmployees();
            echo json_encode($employees);
        }
        
        public function getEmployeeAJAX()
        {
            $employee = $this->model->getEmployee($_GET["empID"]);
            echo json_encode($employee);
        }
        
        public function showEmployeeForm()
        {
            $this->view->render('employee');
        }
        
        public function createEmployeeAJAX()
        {
            $employee = $_POST;
            if (count($employee) === 0) return false;
            return $this->model->addEmployee($employee);
        }
        
        public function submitEmployee()
        {
            $employee = $_POST;
            if (count($employee) === 0) return false;
            isset($employee['id']) && is_numeric($employee['id']) ? $this->model->updateEmployee($employee) : $this->model->addEmployee($employee);
        
            // propiety redirect is set if post request is from employee.php
            if (isset($employee['redirect'])) header('Location: index.php?controller=employee&action=showEmployeeForm&id='.$employee['id'].'&success=true');
        }
        
        public function deleteEmployeeAJAX()
        {
            parse_str(file_get_contents("php://input"), $data);
            if (!isset($data['id'])) return false;
            return $this->model->deleteEmployee($data['id']);
        }

    }

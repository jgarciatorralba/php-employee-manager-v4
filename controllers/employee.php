<?php

    class EmployeeController extends Controller {
        
        /* ~~~ CONTROLLER METHODS ~~~ */

        public function __construct()
        {
            parent::__construct();
            $this->view->success = "";
        }

        public function showEmployees()
        {
            $employees = $this->model->readEmployees();
            echo json_encode($employees);
        }
        
        public function getEmployeeAJAX($param = null)
        {
            $employee = $this->model->getEmployee($param[0]);
            echo json_encode($employee);
        }
        
        public function showEmployeeForm($param = null)
        {
            if (!empty($param[1])){
                $this->view->success = true;
            }
            $this->view->render('employee');
        }
        
        public function createEmployeeAJAX()
        {
            $employee = $_POST;
            if (count($employee) === 0) return false;
            
            $createdEmployee = $this->model->addEmployee($employee);
            if (gettype($createdEmployee) == 'string'){
                echo json_encode($createdEmployee);
            } else {
                return $createdEmployee;
            }

            // return $this->model->addEmployee($employee);
        }
        
        public function submitEmployee()
        {
            $employee = $_POST;
            if (count($employee) === 0) return false;
            isset($employee['id']) && is_numeric($employee['id']) ? $this->model->updateEmployee($employee) : $employee = $this->model->addEmployee($employee);
        
            header('Location: ' . URL . 'employee/showEmployeeForm/' . $employee['id'] . '/success');
        }
        
        public function deleteEmployeeAJAX()
        {
            parse_str(file_get_contents("php://input"), $data);
            if (!isset($data['id'])) return false;
            echo json_encode($this->model->deleteEmployee($data['id']));
        }

    }

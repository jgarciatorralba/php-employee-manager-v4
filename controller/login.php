<?php

    require_once MODEL."login.php";

    class LoginController {

        private $loginModel;
        
        /* ~~~ CONTROLLER METHODS ~~~ */

        public function validateAccess()
        {
            $this->loginModel = new LoginModel();
            
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                // unset($_POST['username']);
                // unset($_POST['password']);
            
                if ($this->loginModel->checkCredentials($username, $password)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['lifeTime'] = 600;
                    $_SESSION['time'] = time();
                    header('Location: index.php');
                } else {
                    session_destroy();
                    header('Location: index.php?error');
                }
                exit();
            } else {
                $this->loginModel->logOut();
            }
        }

        public function goToDashboard()
        {
            if (SessionHelper::activeSession()){
                include(VIEW."dashboard.php");
            } else {
                header('Location: index.php');
            }
        }

        public function goToEmployee()
        {
            if (SessionHelper::activeSession()){
                include(VIEW."employee.php");
            } else {
                header('Location: index.php');
            }
        }

        public function goToLogin()
        {
            header('Location: index.php');
        }

        public function goToError()
        {
            include(VIEW . 'error.php');
        }

        public function kickout()
        {
            $this->loginModel = new LoginModel();
            $this->loginModel->logOut();
        }

    }
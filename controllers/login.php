<?php

    class LoginController extends Controller {

        /* ~~~ CONTROLLER METHODS ~~~ */

        public function __construct()
        {
            parent::__construct();
        }

        public function validateAccess()
        {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                // unset($_POST['username']);
                // unset($_POST['password']);
                
                if ($this->model->checkCredentials($username, $password)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['lifeTime'] = 600;
                    $_SESSION['time'] = time();
                    header('Location: ' . URL);
                } else {
                    header('Location: ' . URL);
                }
                exit();
            } else {
                SessionHelper::logOut();
            }
        }

        public function goToDashboard()
        {
            if (SessionHelper::activeSession()){
                $this->view->render('dashboard');
            } else {
                header('Location: ' . URL);
            }
        }

        public function goToEmployee()
        {
            if (SessionHelper::activeSession()){
                $this->view->render('employee');
            } else {
                header('Location: ' . URL);
            }
        }

        public function goToLogin()
        {
            header('Location: ' . URL);
        }

        public function goToError()
        {
            $this->view->render('error');
        }

        public function kickout()
        {
            SessionHelper::logOut();
        }

    }
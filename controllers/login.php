<?php

    class LoginController extends Controller {

        /* ~~~ CONTROLLER METHODS ~~~ */

        public function __construct()
        {
            parent::__construct();
            $this->view->message = "";
        }

        public function validateAccess()
        {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                
                $credentials = $this->model->checkCredentials($username, $password);
                if ($credentials === true) {
                    $_SESSION['username'] = $username;
                    $_SESSION['lifeTime'] = 600;
                    $_SESSION['time'] = time();

                    $this->view->render('dashboard');
                } else {
                    switch ($credentials){
                        case 'connection':
                            $message = "There was a problem with the database connection";
                            break;
                        case 'query':
                            $message = "An error occurred during the query execution";
                            break;
                        default:
                            $message = "Wrong username or password";
                            break;
                    }
                    $this->view->message = $message;
                    $this->view->render('login');
                }
                exit();
            } else {
                SessionHelper::logOut();
            }
        }

        public function goToDashboard()
        {
            SessionHelper::checkTimeout();
            $this->view->render('dashboard');
        }

        public function goToEmployee()
        {
            SessionHelper::checkTimeout();
            $this->view->render('employee');
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
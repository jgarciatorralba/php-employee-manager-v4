<?php

    session_start();
    require_once MODEL."login.php";

    class SessionHelper {

        private $loginModel;

        public static function checkActiveSession()
        {
            $loginModel = new LoginModel();

            if (self::activeSession()){
                if (self::sessionTimeout()){
                    $loginModel->logOut();
                }
            }
        }

        public static function activeSession()
        {
            return isset($_SESSION['username']);
        }

        public function sessionTimeout()
        {
            return time() - $_SESSION['time'] > $_SESSION['lifeTime'];
        }

    }

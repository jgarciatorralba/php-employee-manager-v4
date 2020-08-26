<?php
    session_start();
    require_once MODEL."login.php";

    class SessionHelper {

        public static function checkActiveSession()
        {
            if (self::activeSession()){
                if (self::sessionTimeout()){
                    logOut();
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

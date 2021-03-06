<?php

    class SessionHelper
    {

        public static function checkTimeout()
        {
            if (self::activeSession()) {
                if (self::sessionTimeout()) {
                    $_SESSION = array();
                    session_destroy();
                    header('Location: ' . URL . '?timeout');
                }
            }
        }

        public static function activeSession()
        {
            return isset($_SESSION['username']);
        }

        public static function sessionTimeout()
        {
            return time() - $_SESSION['time'] > $_SESSION['lifeTime'];
        }

        public static function logOut()
        {
            $_SESSION = array();
            session_destroy();
            header('Location: ' . URL);
        }
    }

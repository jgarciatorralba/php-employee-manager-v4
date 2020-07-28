<?php
session_start();
//Verifies if session is active
if (isset($_SESSION['userName'])) {
    if (time() - $_SESSION['start_time'] > $_SESSION['lifeTime']) {
        session_destroy();
        //unset session variables
        unset($_SESSION['userName']);
        unset($_SESSION['password']);
        unset($_SESSION['start_time']);
        //And redirect to index.php (only for other pages)
        header('Location: ../../index.php');
    }
    echo "We are inside session";
} else {
    header('Location: ../../index.php');
}

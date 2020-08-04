<?php
require_once "config.php";
require_once LIB."sessionHelper.php";

if (!isset($_GET["controller"])){
    if (activeSession()) {
        include(VIEW . 'dashboard.php');
    } else {
        include(VIEW . 'login.php');
    }

} else {
    
    $controller = $_GET["controller"];
    if (file_exists(CONTROLLER . $controller)) {
        include(CONTROLLER . $controller);
    } else {
        include(VIEW . "error.php");
    }

}
<?php
require_once "config/config.php";
require_once LIB."sessionHelper.php";

if (!isset($_GET["controller"])){
    if (activeSession()) {
        include(VIEW . 'dashboard.php');
    } else {
        include(VIEW . 'login.php');
    }

} else {
    
    $controller = $_GET["controller"];
    if (file_exists(CONTROLLER . $controller . ".php")) {
        include(CONTROLLER . $controller . ".php");
    } else {
        include(VIEW . "error.php");
    }

}
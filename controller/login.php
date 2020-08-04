<?php

require_once MODEL."login.php";

include_once(LIB.'sessionHelper.php');

$action;

if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "goToLogin";
}

if (function_exists($action)) {
    call_user_func($action, $_REQUEST);
} else {
    // goToError();
}

/* ~~~ CONTROLLER FUNCTIONS ~~~ */

function validateAccess()
{
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // unset($_POST['username']);
        // unset($_POST['password']);
    
        if (checkCredentials($username, $password)) {
            $_SESSION['username'] = $username;
            $_SESSION['lifeTime'] = 600;
            $_SESSION['time'] = time();
            header('Location: index.php');
        } else {
            session_destroy();
            header('Location: index.php?error');
            // include(VIEW . 'login.php?error');
        }
        exit();
    } else {
        logOut();
    }
}

function goToDashboard()
{
    if (activeSession()){
        include(VIEW."dashboard.php");
    } else {
        header('Location: index.php');
    }
}

function goToEmployee()
{
    if (activeSession()){
        include(VIEW."employee.php");
    } else {
        header('Location: index.php');
    }
}

function goToLogin()
{
    header('Location: index.php');
}

function goToError()
{
    include(VIEW . 'error.php');
}

function kickout()
{
    logOut();
}
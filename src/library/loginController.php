<?php
include('loginManager.php');

session_start();
$_SESSION['lifeTime'] = 600; //10 minutes

//Verifies credentials only the moment that we log in
if (isset($_POST['userName']) && isset($_POST['password'])) {
    $username = $_POST['userName'];
    $password = $_POST['password'];
    unset($_POST['userName']);
    unset($_POST['password']);

    $logged = checkCredentials($username, $password);

    if ($logged) {
        $_SESSION['userName'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['start_time'] = time();
        header("Location: ../dashboard.php");
    } else {
        header("Location: ../../index.php");
    }
    exit();
}

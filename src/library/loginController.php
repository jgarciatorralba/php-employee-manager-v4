<?php
include('loginManager.php');

session_start();

if (isset($_POST['userName']) && isset($_POST['password'])) {
    $username = $_POST['userName'];
    $password = $_POST['password'];
    unset($_POST['userName']);
    unset($_POST['password']);

    $logged = checkCredentials($username, $password);

    if ($logged) {
        $_SESSION['userName'] = $username;
        $_SESSION['password'] = $password;
        header("Location: ../dashboard.php");
    } else {
        header("Location: ../../index.php");
    }
}

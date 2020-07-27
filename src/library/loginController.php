<?php

include('loginManager.php');

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    unset($_POST['username']);
    unset($_POST['password']);

    if (checkCredentials($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location: ../dashboard.php");
    } else {
        session_destroy();
        header("Location: ../../index.php");
    }
}

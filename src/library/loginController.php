<?php

include_once('sessionHelper.php');

if (isset($_GET['logout'])) logOut();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    unset($_POST['username']);
    unset($_POST['password']);

    if (checkCredentials($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['lifeTime'] = 600;
        $_SESSION['time'] = time();
        header('Location: ../dashboard.php');
    } else {
        session_destroy();
        header('Location: ../../index.php?error');
    }
    exit();
}

<?php
require_once MODEL."login.php";
require_once VIEW."login.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    unset($_POST['username']);
    unset($_POST['password']);

    if (checkCredentials($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['lifeTime'] = 600;
        $_SESSION['time'] = time();
        header('Location: index.php?dashboard');
    } else {
        session_destroy();
        header('Location: index.php?error');
    }
    exit();
}
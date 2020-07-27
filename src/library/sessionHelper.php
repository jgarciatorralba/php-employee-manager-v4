<?php

include_once('loginManager.php');

session_start();

if (!activeSession()) header('Location: ../index.php');
else if (sessionTimeout()) logout();

if (!activeSession()) header('Location: ../index.php');

function activeSession()
{
    return isset($_SESSION['username']);
}

function sessionTimeout()
{
    return time() - $_SESSION['time'] > $_SESSION['lifeTime'];
}

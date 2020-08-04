<?php
session_start();
require_once MODEL."login.php";

if(activeSession())
    if (sessionTimeout()) logOut();

function activeSession()
{
    return isset($_SESSION['username']);
}

function sessionTimeout()
{
    return time() - $_SESSION['time'] > $_SESSION['lifeTime'];
}

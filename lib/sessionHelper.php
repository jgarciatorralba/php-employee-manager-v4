<?php
session_start();

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

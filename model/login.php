<?php

function checkCredentials($username, $password)
{
    $user = getUser($username);
    return $user ? password_verify($password, $user->password) : false;
}

function getUser($username)
{
    $users = getUsers();
    $key = array_search($username, array_column($users, 'name'));
    return is_numeric($key) ? $users[$key] : false;
}

function getUsers()
{
    $data = file_get_contents(RESOURCES."users.json");
    return json_decode($data)->users;
}

function logOut()
{
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
}
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
    $path = '../../resources/users.json';
    $data = file_get_contents($path);
    return json_decode($data)->users;
}

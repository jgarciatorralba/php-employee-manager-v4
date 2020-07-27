<?php

function checkCredentials($username, $password)
{
    $user = getUser($username);
    return password_verify($password, $user->password);
}

function getUsers()
{
    $path = '../../resources/users.json';
    $data = file_get_contents($path);
    return json_decode($data)->users;
}

function getUser($username)
{
    $users = getUsers();
    $key = array_search($username, array_column($users, 'name'));
    if (is_numeric($key)) return $users[$key];
    return false;
}

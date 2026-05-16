<?php
//include_once('dba.php');
require_once('db.php');


function login($user)
{
    $con = getConnection();
    $sql = "select * from users where username='{$user['username']}' and password='{$user['password']}' and role='{$user['role']}'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function addUser($user)
{
    $con = getConnection();
    $sql = "insert into users values('', '{$user['username']}', '{$user['password']}', '{$user['email']}', '{$user['role']}')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function deleteUser($id) {}

function updateUser($user) {}

function getAllUser() {}

function getAllMembers()
{
    $con = getConnection();

    $sql = "SELECT id, username, email, role FROM users WHERE role='user'";
    $result = mysqli_query($con, $sql);

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

<?php
require_once('db.php');

function addUser($user)
{
    $con = getConnection();

    $password = password_hash($user['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password_hash, role, created_at) 
            VALUES ('{$user['name']}', '{$user['email']}', '$password', '{$user['role']}', NOW())";

    return mysqli_query($con, $sql);
}

function login($user)
{
    $con = getConnection();

    $sql = "SELECT * FROM users WHERE name='{$user['name']}' AND role='{$user['role']}'";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($user['password'], $row['password_hash'])) {
            return $row;
        }
    }

    return false;
}

function getAllMembers()
{
    $con = getConnection();

    $sql = "SELECT id, name, email, role FROM users WHERE role='user'";
    $result = mysqli_query($con, $sql);

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function deleteUser($id)
{
    $con = getConnection();
    $sql = "DELETE FROM users WHERE id='$id'";
    return mysqli_query($con, $sql);
}
?>
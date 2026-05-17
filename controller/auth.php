<?php
session_start();
require_once('../model/userModel.php');

$type = $_POST['type'];

if ($type == 'login') {

    $user = json_decode($_POST['user'], true);

    $username = $user['username'];
    $password = $user['password'];
    $role = $user['role'];

    if ($username == "" || $password == "" || $role == "") {
        echo json_encode([
            "status" => false,
            "message" => "Null username/password/role"
        ]);
        exit();
    }

    $data = ['username' => $username, 'password' => $password, 'role' => $role];

    $userData = login($data);

    if ($userData) {
        $_SESSION['user'] = [
            "id" => $userData['id'],
            "username" => $userData['username'],
            "role" => $userData['role']
        ];

        echo json_encode([
            "status" => true,
            "message" => "Login successful"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Invalid user"
        ]);
    }
} else if ($type == 'signup') {
    $user = json_decode($_POST['user'], true);

    $username = $user['username'];
    $password = $user['password'];
    $email = $user['email'];
    $role = $user['role'];

    if ($username == "" || $password == "" || $email == "" || $role == "") {
        echo json_encode([
            "status" => false,
            "message" => "Null username/password/email/role not allowed"
        ]);
        exit();
    }

    $data = ['username' => $username, 'password' => $password, 'email' => $email, 'role' => $role];
    $status = addUser($data);

    if ($status) {
        echo json_encode([
            "status" => true,
            "message" => "Signup successful"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Signup failed"
        ]);
    }
}

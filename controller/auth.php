<?php
session_start();
require_once('../model/userModel.php');
header('Content-Type: application/json');

$type = $_POST['type'];

if ($type == 'login') {

    $user = json_decode($_POST['user'], true);

    $name = $user['name'];
    $password = $user['password'];

    if ($name == "" || $password == "") {
        echo json_encode([
            "status" => false,
            "message" => "Null name/password"
        ]);
        exit();
    }

    $data = ['name' => $name, 'password' => $password];

    $userData = login($data);

    if ($userData) {
        $_SESSION['user'] = [
            "id" => $userData['id'],
            "name" => $userData['name'],
            "role" => $userData['role']
        ];

        echo json_encode([
            "status" => true,
            "message" => "Login successful",
            "role" => $userData['role']
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Invalid user"
        ]);
    }
} else if ($type == 'signup') {
    $user = json_decode($_POST['user'], true);

    $name = $user['name'];
    $password = $user['password'];
    $email = $user['email'];
    $role = $user['role'];

    if ($name == "" || $password == "" || $email == "" || $role == "") {
        echo json_encode([
            "status" => false,
            "message" => "Null name/password/email/role not allowed"
        ]);
        exit();
    }

    $data = ['name' => $name, 'password' => $password, 'email' => $email, 'role' => $role];
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

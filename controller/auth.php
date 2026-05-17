<?php
session_start();
require_once('../model/userModel.php');
header('Content-Type: application/json');

$type = $_POST['type'];

if ($type == 'login') {

    $user = json_decode($_POST['user'], true);

    $name = $user['name'];
    $password = $user['password'];
    $role = $user['role'];

    if ($name == "" || $password == "" || $role == "") {
        echo json_encode([
            "status" => false,
            "message" => "Null name/password/role"
        ]);
        exit();
    }

    $data = ['name' => $name, 'password' => $password, 'role' => $role];

    $userData = login($data);

    if ($userData) {

    $_SESSION['user'] = [
        "id" => $userData['id'],
        "name" => $userData['name'],
        "role" => $userData['role']
    ];  

        if($userData['role'] == 'admin'){

            echo json_encode([
                "status" => true,
                "message" => "Admin login successful",
                "redirect" => "../view/dashboard.php"
            ]);

        }
        else{

            echo json_encode([
                "status" => true,
                "message" => "Member login successful",
                "redirect" => "../view/browseView.php"
            ]);

        }

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

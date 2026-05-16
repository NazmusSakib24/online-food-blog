<?php
session_start();
require_once('../model/userModel.php');

header('Content-Type: application/json');

$type = $_POST['type'] ?? '';

if ($type == "getMembers") {

    $members = getAllMembers();

    echo json_encode([
        "status" => true,
        "members" => $members
    ]);
}
else if ($type == "deleteMember") {
    $id = $_POST['id'] ?? '';

    if (deleteUser($id)) {
        echo json_encode([
            "status" => true,
            "message" => "Member deleted successfully"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Failed to delete member"
        ]);
    }
}
else {
    echo json_encode([
        "status" => false,
        "message" => "Invalid type"
    ]);
}

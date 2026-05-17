<?php
session_start();
require_once('../model/userModel.php');

header('Content-Type: application/json');

$type = $_POST['type'];

if ($type == "loadMembers") {

    $members = getAllMembers();

    if (!$members || count($members) == 0) {

        echo json_encode([
            "status" => false,
            "message" => "No members found"
        ]);

        exit();
    }

    echo json_encode([
        "status" => true,
        "members" => $members
    ]);
} else if ($type == "deleteMember") {
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
} else {
    echo json_encode([
        "status" => false,
        "message" => "Invalid type"
    ]);
}

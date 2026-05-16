<?php
session_start();
require_once('../model/postModel.php');
require_once('../model/commentModel.php');

$type = $_POST['type'];

if ($type == "getUserPosts") {

    $user_id = $_POST['user_id'];

    $posts = getPostsByUserId($user_id);

    echo json_encode([
        "status" => true,
        "posts" => $posts
    ]);
}
elseif ($type == "getUserComments") {

    $user_id = $_POST['user_id'];

    $comments = getCommentsByUserId($user_id);

    echo json_encode([
        "status" => true,
        "comments" => $comments
    ]);
}
?>
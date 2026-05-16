<?php
session_start();
require_once('../model/postModel.php');

$type = $_POST['type'];

if ($type == 'addPost') {

    $post = json_decode($_POST['post'], true);

    $title = $post['title'];
    $content = $post['content'];
    $user_id = $_SESSION['user']['id'];

    if ($title == "" || $content == "") {
        echo json_encode([
            "status" => false,
            "message" => "Null title/content not allowed"
        ]);
        exit();
    }

    $data = ['title' => $title, 'content' => $content, 'user_id' => $user_id];
    $status = addPost($data);

    if ($status) {
        echo json_encode([
            "status" => true,
            "message" => "Post added successfully"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Failed to add post"
        ]);
    }
} else if ($type == 'loadPost') {
    $posts = getAllPost();
    echo json_encode([
        "status" => true,
        "posts" => $posts
    ]);
} else if ($type == 'deletePost') {
    $id = $_POST['id'];
    $user_id = $_SESSION['user']['id'];
    $role = $_SESSION['user']['role'];

    $post = getPostById($id);

    if ($post['user_id'] != $user_id && $role != 'admin') {
        echo json_encode([
            "status" => false,
            "message" => "You are not authorized to delete this post"
        ]);
        exit();
    }

    $status = deletePost($id, $user_id, $role);

    if ($status) {
        echo json_encode([
            "status" => true,
            "message" => "Post deleted successfully"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Failed to delete post"
        ]);
    }
} else if ($type == 'editPost') {
    $post = json_decode($_POST['post'], true);

    if (!$post) {
        echo json_encode([
            "status" => false,
            "message" => "Invalid data received"
        ]);
        exit();
    }

    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];

    $user_id = $_SESSION['user']['id'];
    $role = $_SESSION['user']['role'];

    $oldPost = getPostById($id);

    $title = trim($post['title']) !== "" ? $post['title'] : $oldPost['title'];
    $content = trim($post['content']) !== "" ? $post['content'] : $oldPost['content'];

    if(!$oldPost){
        echo json_encode([
            "status" => false,
            "message" => "Post not found"
        ]);
        exit();
    }

    if ($oldPost['user_id'] != $user_id && $role != 'admin') {
        echo json_encode([
            "status" => false,
            "message" => "You are not authorized to edit this post"
        ]);
        exit();
    }


    $data = ['id' => $id, 'title' => $title, 'content' => $content];
    $status = editPost($data);

    if ($status) {
        echo json_encode([
            "status" => true,
            "message" => "Post updated successfully"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Failed to update post"
        ]);
    }
}

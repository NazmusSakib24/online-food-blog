<?php
session_start();

require_once('../model/postModel.php');
require_once('../model/commentModel.php');

header('Content-Type: application/json');

$type = $_POST['type'];

if ($type == "loadUserPosts") {

    $user_id = $_POST['user_id'] ?? 0;

    $posts = getPostsByUserId($user_id);

    if (!$posts) {
        echo json_encode([
            "status" => false,
            "message" => "No posts found"
        ]);
        exit();
    }

    echo json_encode([
        "status" => true,
        "posts" => $posts
    ]);
} elseif ($type == "loadUserComments") {

    $user_id = $_POST['user_id'] ?? 0;

    $comments = getCommentsByUserId($user_id);

    if (!$comments) {
        echo json_encode([
            "status" => false,
            "message" => "No comments found"
        ]);
        exit();
    }

    echo json_encode([
        "status" => true,
        "comments" => $comments
    ]);
} elseif ($type == "deletePost") {
    $id = $_POST['id'];
    $user_id = $_SESSION['user']['id'];
    $role = $_SESSION['user']['role'];

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
} else if ($type == "editPost") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $user_id = $_SESSION['user']['id'];
    $role = $_SESSION['user']['role'];

    $oldPost = getPostById($id);
    if (!$oldPost) {
        echo json_encode([
            "status" => false,
            "message" => "Post not found"
        ]);
        exit();
    }

    $title = trim($title) !== "" ? $title : $oldPost['title'];
    $content = trim($content) !== "" ? $content : $oldPost['content'];

    $data = [
        "id" => $id,
        "title" => $title,
        "content" => $content
    ];

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
} elseif ($type == "deleteComment") {

    $id = $_POST['id'];

    $status = deleteComment($id);

    if ($status) {
        echo json_encode([
            "status" => true,
            "message" => "Comment deleted successfully"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Failed to delete comment"
        ]);
    }
} elseif ($type == "editComment") {

    $commentData = json_decode($_POST['comment'], true);

    $id = $commentData['id'];
    $comment = $commentData['comment'];
    $post_id = $commentData['post_id'];

    $oldComment = getCommentById($id);

    if (!$oldComment) {
        echo json_encode([
            "status" => false,
            "message" => "Comment not found"
        ]);
        exit();
    }

    $data = [
        "id" => $id,
        "comment" => $comment
    ];

    $status = editComment($data);

    if ($status) {
        echo json_encode([
            "status" => true,
            "message" => "Comment updated successfully"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Failed to update comment"
        ]);
    }
} else {
    echo json_encode([
        "status" => false,
        "message" => "Invalid request type"
    ]);
}

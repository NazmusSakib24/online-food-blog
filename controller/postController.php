<?php
session_start();
require_once('../model/postModel.php');

$type = $_POST['type'];

if ($type == 'loadPost') {
    $posts = getAllPost();
    echo json_encode([
        "status" => true,
        "posts" => $posts
    ]);
} elseif ($type == 'loadComments') {
    require_once('../model/commentModel.php');

    $post_id = $_POST['post_id'];
    $comments = getCommentsByPostId($post_id);

    echo json_encode([
        "status" => true,
        "comments" => $comments
    ]);
} else if ($type == 'addPost') {
    if (!isset($_SESSION['user'])) {
        echo json_encode(["status" => false, "message" => "Login required"]);
        exit();
    }

    $post = json_decode($_POST['post'], true);

    $title = $post['title'];
    $content = $post['content'];
    $post_type = $post['post_type'];
    $restaurant_id = $post['restaurant_id'];
    $menu_item_id = $post['menu_item_id'];
    $user_id = $_SESSION['user']['id'];

    if ($title == "" || $content == "") {
        echo json_encode([
            "status" => false,
            "message" => "Null title/content not allowed"
        ]);
        exit();
    }

    $data = ['title' => $title, 'content' => $content, 'post_type' => $post_type, 'restaurant_id' => $restaurant_id, 'menu_item_id' => $menu_item_id, 'user_id' => $user_id];
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
} else if ($type == 'deletePost') {
    if (!isset($_SESSION['user'])) {
        echo json_encode(["status" => false, "message" => "Login required"]);
        exit();
    }
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
    if (!isset($_SESSION['user'])) {
        echo json_encode(["status" => false, "message" => "Login required"]);
        exit();
    }
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

    if (!$oldPost) {
        echo json_encode([
            "status" => false,
            "message" => "Post not found"
        ]);
        exit();
    }

    $title = trim($post['title']) !== "" ? $post['title'] : $oldPost['title'];
    $content = trim($post['content']) !== "" ? $post['content'] : $oldPost['content'];


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
} elseif ($type == 'addComment') {
    if (!isset($_SESSION['user'])) {
        echo json_encode(["status" => false, "message" => "Login required"]);
        exit();
    }
    require_once('../model/commentModel.php');

    $commentData = json_decode($_POST['comment'], true);

    $post_id = $commentData['post_id'];
    $comment = $commentData['comment'];
    $user_id = $_SESSION['user']['id'];

    if ($comment == "") {
        echo json_encode([
            "status" => false,
            "message" => "Null comment not allowed"
        ]);
        exit();
    }

    $data = ['post_id' => $post_id, 'user_id' => $user_id, 'comment' => $comment];
    $status = addComment($data);

    if ($status) {
        echo json_encode([
            "status" => true,
            "message" => "Comment added successfully"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Failed to add comment"
        ]);
    }
} elseif ($type == 'deleteComment') {
    if (!isset($_SESSION['user'])) {
        echo json_encode(["status" => false, "message" => "Login required"]);
        exit();
    }
    require_once('../model/commentModel.php');

    $id = $_POST['id'];
    $user_id = $_SESSION['user']['id'];
    $role = $_SESSION['user']['role'];

    $comment = getCommentById($id);

    if ($comment['user_id'] != $user_id && $role != 'admin') {
        echo json_encode([
            "status" => false,
            "message" => "You are not authorized to delete this comment"
        ]);
        exit();
    }

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
} elseif ($type == 'editComment') {
    if (!isset($_SESSION['user'])) {
        echo json_encode(["status" => false, "message" => "Login required"]);
        exit();
    }
    require_once('../model/commentModel.php');

    $commentData = json_decode($_POST['comment'], true);

    $id = $commentData['id'];
    $comment = $commentData['comment'];
    $post_id = $commentData['post_id'];

    $user_id = $_SESSION['user']['id'];
    $role = $_SESSION['user']['role'];

    $oldComment = getCommentById($id);

    if (!$oldComment) {
        echo json_encode([
            "status" => false,
            "message" => "Comment not found"
        ]);
        exit();
    }

    if ($oldComment['user_id'] != $user_id && $role != 'admin') {
        echo json_encode([
            "status" => false,
            "message" => "You are not authorized to edit this comment"
        ]);
        exit();
    }


    $data = ['id' => $id, 'comment' => $comment];
    $status = editComment($data);

    if ($status) {
        echo json_encode([
            "status" => true,
            "message" => "Comment updated successfully",
            "post_id" => $post_id
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Failed to update comment"
        ]);
    }
}

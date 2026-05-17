<?php
require_once('db.php');

function addComment($data)
{
    $con = getConnection();

    $sql = "INSERT INTO food_experience_comments (post_id, user_id, comment)
            VALUES ('{$data['post_id']}', '{$data['user_id']}', '{$data['comment']}')";

    return mysqli_query($con, $sql);
}

function getCommentsByPostId($post_id)
{
    $con = getConnection();

    $sql = "SELECT food_experience_comments.*, users.name
            FROM food_experience_comments
            JOIN users ON food_experience_comments.user_id = users.id
            WHERE post_id='{$post_id}'
            ORDER BY food_experience_comments.id DESC";

    $result = mysqli_query($con, $sql);

    $comments = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }

    return $comments;
}

function deleteComment($id)
{
    $con = getConnection();

    $sql = "DELETE FROM food_experience_comments WHERE id='{$id}'";

    return mysqli_query($con, $sql);
}

function getCommentById($id)
{
    $con = getConnection();

    $sql = "SELECT * FROM food_experience_comments WHERE id='{$id}'";

    $result = mysqli_query($con, $sql);

    return mysqli_fetch_assoc($result);
}

function editComment($data)
{
    $con = getConnection();

    $sql = "UPDATE food_experience_comments 
            SET comment='{$data['comment']}'
            WHERE id='{$data['id']}'";

    return mysqli_query($con, $sql);
}
function getCommentsByUserId($user_id)
{
    $con = getConnection();
    $sql = "SELECT * FROM food_experience_comments WHERE user_id = $user_id ORDER BY id DESC";
    $result = mysqli_query($con, $sql);

    $comments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }

    return $comments;
}

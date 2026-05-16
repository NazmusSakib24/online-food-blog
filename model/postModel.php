<?php
require_once('db.php');

function addPost($data)
{
    $con = getConnection();
    $sql = "INSERT INTO posts (title, content, user_id, type) 
        VALUES ('{$data['title']}', '{$data['content']}', '{$data['user_id']}', '{$data['type']}')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function getAllPost()
{
    $con = getConnection();

    $sql = "SELECT 
                posts.id,
                posts.title,
                posts.content,
                posts.user_id,
                posts.type,
                posts.created_at,
                users.username
            FROM posts
            JOIN users ON posts.user_id = users.id
            ORDER BY posts.id DESC";

    $result = mysqli_query($con, $sql);

    $posts = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }

    return $posts;
}

function getPostById($id)
{
    $con = getConnection();
    $sql = "select * from posts where id='{$id}'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function editPost($data)
{
    $con = getConnection();

    $sql = "UPDATE posts 
            SET title='{$data['title']}', content='{$data['content']}'
            WHERE id='{$data['id']}'";

    return mysqli_query($con, $sql);
}

function deletePost($id, $user_id, $role)
{
    $con = getConnection();

    $checkSql = "SELECT user_id FROM posts WHERE id='{$id}'";
    $result = mysqli_query($con, $checkSql);
    $row = mysqli_fetch_assoc($result);

    if ($row['user_id'] != $user_id && $role != 'admin') {
        return false;
    }

    $sql = "DELETE FROM posts WHERE id='{$id}'";
    return mysqli_query($con, $sql);
}
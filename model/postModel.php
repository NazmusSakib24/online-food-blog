<?php
require_once('db.php');

function addPost($data)
{
    $con = getConnection();

    $restaurant_id = ($data['restaurant_id'] == "" || $data['restaurant_id'] == null)
        ? "NULL"
        : $data['restaurant_id'];

    $menu_item_id = ($data['menu_item_id'] == "" || $data['menu_item_id'] == null)
        ? "NULL"
        : $data['menu_item_id'];

    $sql = "INSERT INTO food_experience_posts
            (title, content, user_id, post_type, restaurant_id, menu_item_id, created_at, updated_at)
            VALUES
            (
                '{$data['title']}',
                '{$data['content']}',
                '{$data['user_id']}',
                '{$data['post_type']}',
                $restaurant_id,
                $menu_item_id,
                NOW(),
                NOW()
            )";

    return mysqli_query($con, $sql);
}

function getAllPost()
{
    $con = getConnection();

    $sql = "SELECT 
                food_experience_posts.id,
                food_experience_posts.title,
                food_experience_posts.content,
                food_experience_posts.user_id,
                food_experience_posts.post_type,
                food_experience_posts.created_at,
                food_experience_posts.updated_at,
                users.name
            FROM food_experience_posts
            JOIN users ON food_experience_posts.user_id = users.id
            ORDER BY food_experience_posts.id DESC";

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
    $sql = "select * from food_experience_posts where id='{$id}'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function editPost($data)
{
    $con = getConnection();

    $sql = "UPDATE food_experience_posts 
            SET title='{$data['title']}', content='{$data['content']}' , updated_at=NOW() 
            WHERE id='{$data['id']}'";

    return mysqli_query($con, $sql);
}

function deletePost($id, $user_id, $role)
{
    $con = getConnection();

    $checkSql = "SELECT user_id FROM food_experience_posts WHERE id='{$id}'";
    $result = mysqli_query($con, $checkSql);
    $row = mysqli_fetch_assoc($result);

    if ($row['user_id'] != $user_id && $role != 'admin') {
        return false;
    }

    $sql = "DELETE FROM food_experience_posts WHERE id='{$id}'";
    return mysqli_query($con, $sql);
}
function getPostsByUserId($user_id)
{
    $con = getConnection();
    $sql = "SELECT * FROM food_experience_posts WHERE user_id = $user_id ORDER BY id DESC";
    $result = mysqli_query($con, $sql);

    $posts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }

    return $posts;
}

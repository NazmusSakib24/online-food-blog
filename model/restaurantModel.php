<?php
/*
    session_start();

    if(!isset($_SESSION['user'])){
        header('location: login.php');
    }

    if($_SESSION['user']['role'] != 'admin'){
        header('location: login.php');
    }
*/
    require_once('db.php');

    function addRestaurant($restaurant){
        $con = getConnection();

        $sql = "INSERT INTO restaurants VALUES (
            null, 
            '{$restaurant['name']}',
            '{$restaurant['location']}',
            '{$restaurant['area']}',
            '{$restaurant['short_background']}',
            '{$restaurant['goals']}',
            CURRENT_TIMESTAMP
        )";

        if(mysqli_query($con, $sql)){
            return true;
        }
        else {
            return false;
        }
    }

    function getAllRestaurant(){
        $con = getConnection();

        $sql = "SELECT * FROM restaurants";

        $result = mysqli_query($con, $sql);

        $restaurants = [];

        while ($row = mysqli_fetch_assoc($result)){
            $restaurants[] = $row;
        }

        return $restaurants;
    }

    function deleteRestaurant($id){
        $con = getConnection();

        $sql = "DELETE FROM restaurants where id = '{$id}'";

        if (mysqli_query($con, $sql)){
            return true;
        }
        else {
            return false;
        }
    }

    function getRestaurantById($id){
        $con = getConnection();

        $sql = "SELECT * FROM restaurants WHERE id = '{$id}'";

        $result = mysqli_query($con, $sql);

        $restaurant = mysqli_fetch_assoc($result);

        return $restaurant;
    }

    function updateRestaurant($restaurant){
        $con = getConnection();

        $sql = "UPDATE restaurants SET 
        name = '{$restaurant['name']}',
        location = '{$restaurant['location']}',
        area = '{$restaurant['area']}',
        short_background = '{$restaurant['short_background']}',
        goals = '{$restaurant['goals']}'
        WHERE id = '{$restaurant['id']}'";

        if(mysqli_query($con, $sql)){
            return true;
        }
        else {
            return false;
        }
    }
?>
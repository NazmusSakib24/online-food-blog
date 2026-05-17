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

    function addMenuItem($menuItem){

        $con = getConnection();

        $sql = "INSERT INTO menu_items VALUES(
                    null,
                    '{$menuItem['restaurant_id']}',
                    '{$menuItem['name']}',
                    '{$menuItem['description']}',
                    '{$menuItem['price']}',
                    '{$menuItem['image_path']}',
                    CURRENT_TIMESTAMP
                )";

        if(mysqli_query($con, $sql)){
            return true;
        }
        else{
            return false;
        }
    }

    function getAllMenuItems(){
        $con = getConnection();

        $sql = "SELECT * FROM menu_items";

        $result = mysqli_query($con, $sql);

        $menuItems = [];

        while($row = mysqli_fetch_assoc($result)){
            $menuItems[] = $row;
        }

        return $menuItems;
    }


    function deleteMenuItem($id){
        $con = getConnection();

        $sql = "DELETE FROM menu_items WHERE id='{$id}'";

        if(mysqli_query($con, $sql)){
            return true;
        }
        else{
            return false;
        }
    }

    function getMenuItemById($id){

        $con = getConnection();

        $sql = "SELECT * FROM menu_items WHERE id='{$id}'";

        $result = mysqli_query($con, $sql);

        $menuItem = mysqli_fetch_assoc($result);

        return $menuItem;

    }
    

    function updateMenuItem($menuItem){

        $con = getConnection();

        $sql = "UPDATE menu_items SET
                restaurant_id = '{$menuItem['restaurant_id']}',
                name = '{$menuItem['name']}',
                description = '{$menuItem['description']}',
                price = '{$menuItem['price']}'
                WHERE id = '{$menuItem['id']}'";

            if(mysqli_query($con, $sql)){
                return true;
            }
            else{
                return false;
            }

    }


    function getMenuItemsByRestaurant($restaurantId){
        $con = getConnection();
        $sql = "SELECT * FROM menu_items
                Where restaurant_id = '{$restaurantId}'";
        $result = mysqli_query($con, $sql);
        $menuItems = [];
        while ($row = mysqli_fetch_assoc($result)){
            $menuItems[]=$row;
        }

        return $menuItems;
    } 
?>
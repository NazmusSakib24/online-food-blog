<?php
    require_once('../model/menuItemModel.php');

    if(isset($_POST['add_menu_item'])){

        $restaurant_id = $_POST['restaurant_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        if(
            $restaurant_id == "" ||
            $name == "" ||
            $description == "" ||
            $price == ""
        ){
            echo "Please fill all fields!";
        }
        else{

            $menuItem = [
                'restaurant_id' => $restaurant_id,
                'name' => $name,
                'description' => $description,
                'price' => $price
            ];

            $status = addMenuItem($menuItem);

            if($status){
                header('location: ../view/menuItemsView.php');
            }
            else{
                echo "Failed to add menu item!";
            }
        }
    }
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $status = deleteMenuItem($id);

        if($status){
            header('location: ../view/menuItemsView.php');
        }
        else{
            echo "Failed to delete menu item!";
        }
    }

    if(isset($_POST['update_menu_item'])){

        $id = $_POST['id'];
        $restaurant_id = $_POST['restaurant_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        if(
            $restaurant_id == "" ||
            $name == "" ||
            $description == "" ||
            $price == ""
        ){
            echo "Please fill all fields!";
        }
        else{

            $menuItem = [
                'id' => $id,
                'restaurant_id' => $restaurant_id,
                'name' => $name,
                'description' => $description,
                'price' => $price
            ];

            $status = updateMenuItem($menuItem);

            if($status){
                header('location: ../view/menuItemsView.php');
            }
            else{
                echo "Failed to update menu item!";
            }
        }
    }
?>
<?php

    session_start();

    if(!isset($_SESSION['user'])){
        header('location: ../view/login.php');
    }

    require_once('../model/menuItemModel.php');

    if(isset($_POST['add_menu_item'])){

        $restaurant_id = $_POST['restaurant_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $src = $_FILES['image']['tmp_name'];

        $ext = explode('.', $_FILES['image']['name']);
        $count = count($ext);

        $extension = strtolower($ext[$count-1]);

        if(
            $extension != "jpg" &&
            $extension != "jpeg" &&
            $extension != "png"
        ){

            echo "Invalid image type";
            exit();
        }

        if($_FILES['image']['size'] > 2097152){

            echo "File too large";
            exit();
        }

        $newName = time().".".$extension;

        $des = '../asset/public/upload/menu/'.$newName;

        if(move_uploaded_file($src, $des)){

            $image_path = '../asset/public/upload/menu/'.$newName;

            $data = [
                'restaurant_id' => $restaurant_id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'image_path' => $image_path
            ];

            $status = addMenuItem($data);

            if($status){

                header('location: ../view/menuItemsView.php');

            }else{

                echo "Database error";
            }

        }else{

            echo "Image upload failed";
        }
    }


    if(isset($_GET['delete_id'])){

        $id = $_GET['delete_id'];

        $status = deleteMenuItem($id);

        if($status){

            header('location: ../view/menuItemsView.php');

        }else{

            echo "Delete failed";
        }
    }


    if(isset($_POST['update_menu_item'])){

        $id = $_POST['id'];
        $restaurant_id = $_POST['restaurant_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

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

        }else{

            echo "Update failed";
        }
    }

?>
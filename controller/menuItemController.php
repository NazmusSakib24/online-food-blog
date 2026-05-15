<?php
    require_once('../model/menuItemModel.php');

    if(isset($_POST['add_menu_item'])){

        $restaurant_id = $_POST['restaurant_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        
        $src = $_FILES['image']['tmp_name'];
        $ext = explode('.', $_FILES['image']['name']);
        $count = count($ext);
        $newName = time().".".$ext[$count-1];

        $path = "../asset/public/upload/menu/".$newName;

        if(
            $restaurant_id == "" ||
            $name == "" ||
            $description == "" ||
            $price == "" ||
            $_FILES['image']['name'] == ""
        ){
            echo "Please fill all fields!";
        }
        else{

            $menuItem = [
                'restaurant_id' => $restaurant_id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'image_path' => $path
            ];

            $status = addMenuItem($menuItem);

            if($status){
                move_uploaded_file($src, $path);
                header('location: ../view/restaurantDetails.php?id='.$restaurant_id);
            }
            else{
                echo "Failed to add menu item!";
            }
        }
    }

    if(isset($_GET['delete_id'])){

    $id = $_GET['delete_id'];

    $status = deleteMenuItem($id);

    if($status){

        header('location: ../view/restaurantDetails.php?id='.$_GET['restaurant_id']);

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
                'price' => $price,
            ];

            $status = updateMenuItem($menuItem);

           if($status){

                header('location: ../view/restaurantDetails.php?id='.$restaurant_id);
           }
            else{
                echo "Failed to update menu item!";
            }
        }
    }
?>
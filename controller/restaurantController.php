<?php
    require_once('../model/restaurantModel.php');

    if(isset($_POST['add_restaurant'])){
        $name = $_POST['name'];
        $location = $_POST['location'];
        $area = $_POST['area'];
        $short_background = $_POST['short_background'];
        $goals = $_POST['goals'];

        if (
            $name == "" || $location == "" || $area == "" || $short_background == "" || $goals == ""   
        ){
            echo "Please fill all fields";
        }

        else{
            $restaurant = [
                'name' => $name, 'location' => $location, 'area' => $area, 'short_background' => $short_background, 'goals' => $goals
            ];

            $status = addRestaurant($restaurant);

            if($status){
                header('location:../view/restaurantsView.php');
            }
            else{
                echo "Failed to add restaurant";
            }
        }
    }
    else{
            echo "Invalid request";
    }

    if(isset($_GET['id'])){
        
        $id = $_GET['id'];

        $status = deleteRestaurant($id);
        
        if($status){
            header('location:../view/restaurantsView.php');
        }
        else{
            echo "Failed to delete restaurant";
        }
    }

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $location = $_POST['location'];
        $area = $_POST['area'];
        $short_background = $_POST['short_background'];
        $goals = $_POST['goals'];

        if ($name == "" || $location == ""|| $area == "" || $short_background == "" || $goals == ""){
            echo "please fill all fields";
        }
        else {

            $restaurant=[
                'id' => $id,
                'name'=> $name,
                'location' => $location,
                'area' => $area,
                'short_background' => $short_background,
                'goals' => $goals
            ];

            $status = updateRestaurant($restaurant);
            if ($status){
                header('location:../view/restaurantsView.php');
            }
            else{
                echo "Failed to update restaurant.";
            }
        }
    }
?>
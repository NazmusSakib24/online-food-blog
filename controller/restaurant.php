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
                echo "Restaurant Added Successfully.";
            }
            else{
                echo "Failed to add restaurant";
            }
        }
    }
    else{
            echo "Invalid request";
    }
?>
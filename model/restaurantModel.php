<?php
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
?>
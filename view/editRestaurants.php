<?php

    require_once('../model/restaurantModel.php');
    
    if(!isset($_GET['id'])){
        header('location: menuItemsView.php');
    }

    $id = $_GET['id'];

    $restaurant = getRestaurantById($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Restaurant</title>
</head>
<body>

    <h1>Edit Restaurant</h1>

    <form method="post" action="../controller/restaurantController.php">

        ID:
        <input type="text" name="id" value="<?= $restaurant['id'] ?>" readonly>
        <br><br>

        Name:
        <input type="text" name="name" value="<?= $restaurant['name'] ?>">
        <br><br>

        Location:
        <input type="text" name="location" value="<?= $restaurant['location'] ?>">
        <br><br>

        Area:
        <input type="text" name="area" value="<?= $restaurant['area'] ?>">
        <br><br>

        Short Background:
        <textarea name="short_background"><?= $restaurant['short_background'] ?></textarea>
        <br><br>

        Goals:
        <textarea name="goals"><?= $restaurant['goals'] ?></textarea>
        <br><br>

        <input type="submit" name="update_restaurant" value="Update Restaurant">

    </form>

</body>
</html>
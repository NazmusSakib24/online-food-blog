<?php

    require_once('../model/menuItemModel.php');
    require_once('../model/restaurantModel.php');

    $id = $_GET['id'];

    $menuItem = getMenuItemById($id);

    $restaurants = getAllRestaurant();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Menu Item</title>
</head>
<body>

    <h1>Edit Menu Item</h1>

    <form action="../controller/menuItemController.php" method="post">

        ID:
        <input type="text" name="id" value="<?= $menuItem['id'] ?>" readonly>
        <br>

        <input type="hidden" name="restaurant_id" value="<?= $menuItem['restaurant_id'] ?>">

        <br><br>

        Item Name:
        <input type="text" name="name" value="<?= $menuItem['name'] ?>">
        <br><br>

        Description:
        <textarea name="description"><?= $menuItem['description'] ?></textarea>
        <br><br>

        Price:
        <input type="text" name="price" value="<?= $menuItem['price'] ?>">
        <br><br>

        <input type="submit" name="update_menu_item" value="Update Menu Item">

    </form>

</body>
</html>
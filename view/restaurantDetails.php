<?php
    require_once('../model/restaurantModel.php');
    require_once('../model/menuItemModel.php');

    $id = $_GET['id'];
    $restaurant = getRestaurantById($id);
    $menuItems = getMenuItemsByRestaurant($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
</head>
<body>
    <h1><?= $restaurant['name'] ?></h1>

    <p>
        <b>Location:</b> <?= $restaurant['location'] ?>
    </p>

    <p> <b>Area:</b> <?= $restaurant['area'] ?> </p>

    <p><b>Short Background:</b> <?= $restaurant['short_background'] ?></p>

    <p><b>Goals:</b> <?= $restaurant['goals'] ?> </p>

    <h2>Menu Items</h2>
        <table border="1">
            <tr>
                <th>Image</th>
                <th>Na`me</th>
                <th>Description</th>
                <th>Price</th>
            </tr>

            <?php foreach($menuItems as $m){ ?>
                <tr>
                    <td>
                        <img src="<?= $m['image_path'] ?>" width="100">
                    </td>
                    <td><?= $m['name'] ?></td>
                    <td><?= $m['description'] ?></td>
                    <td><?= $m['price'] ?></td>
                </tr>
            <?php } ?>
        </table>
</body>
</html>
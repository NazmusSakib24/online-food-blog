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
        <a href="menuItemsView.php?restaurant_id=<?= $id ?>">
            Add Menu Item
        </a>

<br><br>
        <table border="1">
            <tr>
                <th>Image</th>
                <th>Menu Item </th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            <?php foreach($menuItems as $m){ ?>
                <tr>
                    <td>
                        <img src="<?= $m['image_path'] ?>" width="100">
                    </td>
                    <td><a href="menuItemDetails.php?id=<?= $m['id'] ?>">
                            <?= $m['name'] ?>
                        </a>
                    </td>
                    <td><?= $m['description'] ?></td>
                    <td><?= $m['price'] ?></td>
                    <td><a href="editMenuItem.php?id=<?= $m['id'] ?>?">Edit</a> |
                        <a href="../controller/menuItemController.php?delete_id=<?= $m['id'] ?>&restaurant_id=<?= $id ?>">
                             Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
</body>
</html>
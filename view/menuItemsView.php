<?php

    require_once('../model/restaurantModel.php');
    require_once('../model/menuItemModel.php');
    
    $restaurants = getAllRestaurant();
    $menuItems = getAllMenuItems();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Menu Items</title>
</head>
<body>

    <h1>Menu Item Management</h1>

    <form action="../controller/menuItemController.php" method="post" enctype="multipart/form-data">

        Restaurant:
        <select name="restaurant_id">

            <?php foreach($restaurants as $r){ ?>

                <option value="<?= $r['id'] ?>">
                    <?= $r['name'] ?>
                </option>

            <?php } ?>

        </select>

        <br><br>

        Item Name:
        <input type="text" name="name">
        <br><br>

        Description:
        <textarea name="description"></textarea>
        <br><br>

        Price:
        <input type="text" name="price">
        <br><br>

        Image:
        <input type="file" name="image">
        <br><br>    
        
        <input type="submit" name="add_menu_item" value="Add Menu Item">

    </form>
    <br><br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Restaurant ID</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <?php foreach($menuItems as $m){ ?>
            <tr>
                <td><?= $m['id'] ?></td>
                <td><?= $m['restaurant_id'] ?></td>
                <td><?= $m['name'] ?></td>
                <td><?= $m['description'] ?></td>
                <td><?= $m['price'] ?></td>
                <td>
                    <a href="editMenuItem.php?id=<?= $m['id'] ?>">Edit
                    </a> |

                    <a href="../controller/menuItemController.php?id=<?= $m['id'] ?>">Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>
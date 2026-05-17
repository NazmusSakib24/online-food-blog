<?php
/*
    session_start();

    if(!isset($_SESSION['user'])){
        header('location: login.php');
    }

    if($_SESSION['user']['role'] != 'admin'){
        header('location: login.php');
    }
*/

    require_once('../model/restaurantModel.php');
    require_once('../model/menuItemModel.php');
    
    $selectedRestaurant = "";

    if(isset($_GET['restaurant_id'])){
        $selectedRestaurant = $_GET['restaurant_id'];
    }

    $restaurants = getAllRestaurant();

        if(isset($_GET['restaurant_id'])){
        $menuItems = getMenuItemsByRestaurant($_GET['restaurant_id']);
    }
    else{
        $menuItems = getAllMenuItems();
    }

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
            <select  name="restaurant_id"<?= isset($_GET['restaurant_id']) ? 'disabled' : '' ?>
>

                <?php foreach($restaurants as $r){ ?>

                    <option 
                        value="<?= $r['id'] ?>"<?= ($selectedRestaurant == $r['id']) ? 'selected' : '' ?>>
                        <?= $r['name'] ?>
                    </option>

                <?php } ?>

            </select>

            <?php if(isset($_GET['restaurant_id'])){ ?>

                <input type="hidden" name="restaurant_id" value="<?= $_GET['restaurant_id'] ?>">

            <?php } ?>

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
            <th>Image</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <?php foreach($menuItems as $m){ ?>
            <tr>
                <td><?= $m['id'] ?></td>
                <td><?= $m['restaurant_id'] ?></td>
                <td>
                    <img src="<?= $m['image_path'] ?>" width="80">
                </td>
                <td><?= $m['name'] ?></td>
                <td><?= $m['description'] ?></td>
                <td><?= $m['price'] ?></td>
                <td>
                    <a href="editMenuItem.php?id=<?= $m['id'] ?>">Edit
                    </a> |

                    <a href="../controller/menuItemController.php?delete_id=<?= $m['id'] ?>&restaurant_id=<?= $selectedRestaurant ?>">
                    Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>
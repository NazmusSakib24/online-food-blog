<?php

    require_once('../model/menuItemModel.php');

    if(!isset($_GET['id'])){
        header('location: menuItemsView.php');
    }

    $id = $_GET['id'];

    $menuItem = getMenuItemById($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Menu Item Details</title>
</head>
<body>

    <h1><?= $menuItem['name'] ?></h1>

    <img src="<?= $menuItem['image_path'] ?>" width="250">

    <p>
        <b>Description:</b>
        <?= $menuItem['description'] ?>
    </p>

    <p>
        <b>Price:</b>
        <?= $menuItem['price'] ?>
    </p>

</body>
</html>
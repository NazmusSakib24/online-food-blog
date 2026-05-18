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
    <link rel="stylesheet" href="../asset/style.css">
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

    <hr>

    <h2>Reviews</h2>

        <form method="post">

            <textarea 
                name="review"
                rows="5" 
                cols="50" 
                placeholder="Write your review...">
            </textarea>

            <br><br>

            <input type="submit" name="submit_review" value="Submit Review">

        </form>

</body>
</html>
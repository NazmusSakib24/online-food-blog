<?php

session_start();

if(!isset($_SESSION['user'])){
    header('location: login.php');
}

if($_SESSION['user']['role'] != 'admin'){
    header('location: login.php');
}


require_once('../model/restaurantModel.php');
require_once('../model/menuItemModel.php');
require_once('../model/reviewModel.php');

$restaurantCount = getRestaurantCount();
$menuItemCount = getMenuItemCount();
$reviewCount = getReviewCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Admin Dashboard</h1>

    <hr>

    <h2>Summary</h2>

    <p>
        <b>Total Restaurants:</b>
        <?= $restaurantCount ?>
    </p>

    <p>
        <b>Total Menu Items:</b>
        <?= $menuItemCount ?>
    </p>

    <p>
        <b>Total Reviews:</b>
        <?= $reviewCount ?>
    </p>

    <hr>

    <h2>Management</h2>

    <a href="restaurantsView.php">
        Restaurant Management
    </a>

    <br><br>

    <a href="menuItemsView.php">
        Menu Item Management
    </a>

    <br><br>

    <a href="foodExperience.php">Food Experience Management</a> 
    <br><br>
    <a href="memberList.php">Member List</a>
    <br><br>
    <a href="../controller/logout.php">Logout</a>

        

</body>
</html>
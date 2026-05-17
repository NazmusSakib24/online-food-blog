<?php
session_start();

$role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : 'visitor';
$user_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Food Experience</title>
</head>

<body>

    <h1>Food Experience</h1>

    <?php if ($role == 'visitor') { ?>
        <a href="login.php">Login</a>
    <?php } else { ?>
        <h3>
            Hello, <?php echo $_SESSION['user']['name']; ?>!
        </h3>
        <p>
            Enjoy reading the experiences and sharing your own |
            <a href="../controller/logout.php">Logout</a>
        </p>
    <?php } ?>

    <hr>

    <h3>Create Post</h3>

    <?php if ($role === 'member' || $role === 'admin') { ?>

        <input type="text" id="title" placeholder="Title"><br><br>

        <textarea id="content" placeholder="Write experience"></textarea><br><br>

        Type<select id="post_type">
            <option value="">Select Type</option>
            <option value="restaurant">Restaurant</option>
            <option value="food">Food</option>
            <option value="both">Both</option>
        </select><br><br>

        Restaurant Id:
        <select id="restaurant_id">
            <option value="">-- None --</option>
        </select><br><br>

        Menu Id: <select id="menu_item_id">
            <option value="">-- None --</option>
        </select><br><br>

        <input type="button" onclick="addPost()" value="Post">

    <?php } else { ?>
        <p>Please login to share your food experience.</p>
    <?php } ?>

    <p id="msg"></p>

    <hr>

    <div id="postDiv"></div>

    <script>
        let role = <?php echo json_encode($role); ?>;
        let user_id = <?php echo json_encode($user_id); ?>;
    </script>

    <script src="../asset/post.js"></script>

</body>

</html>
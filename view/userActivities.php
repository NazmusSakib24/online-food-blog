<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$user_id = $_GET['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Activity</title>
</head>

<body>

    <h2>User Activity</h2>

    <div id="userInfo"></div>

    <p id="postMsg"></p>
    <div id="postDiv"></div>

    <p id="commentMsg"></p>
    <div id="commentDiv"></div>


    <script>
        let user_id = <?php echo $user_id; ?>;
    </script>

    <script src="../asset/userActivities.js"></script>

</body>

</html>
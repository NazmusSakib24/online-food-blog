<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// optional: only admin allowed
if ($_SESSION['user']['role'] != 'admin') {
    header("Location: homePage.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Member List</title>
</head>
<body>

<h2>Member List</h2>

<div id="memberDiv"></div>

<script src="../asset/member.js"></script>

</body>
</html>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
</head>

<body>

    <?php if (isset($_SESSION['user'])) { ?>

        <h1>Welcome Home! <?php echo $_SESSION['user']['username']; ?></h1>

    <?php } else { ?>

        <h1>Welcome Visitor!</h1>

    <?php } ?>

    <a href="foodExperience.php">Food Experience</a> |

    <?php if (isset($_SESSION['user'])) { ?>

        <?php if ($_SESSION['user']['role'] == 'admin') { ?>
            <a href="memberList.php">Member List</a> |
        <?php } ?>

        <a href="../controller/logout.php">Logout</a>

    <?php } else { ?>

        <a href="login.php">Login</a>

    <?php } ?>

</body>

</html>
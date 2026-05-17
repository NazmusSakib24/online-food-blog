<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
</head>

<body>

    <form>
        Username: <input type="text" name="name" id="name" value="" /> <br>
        Password: <input type="password" name="password" id="password" value="" /> <br>
        <input type="button" name="submit" value="Submit" onclick="login()" />
        <a href="../view/signup.php">Signup</a>
        <a href="../view/foodExperience.php">Continue as Guest</a>
    </form>

    <p id="msg"></p>

    <script src="../asset/login.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Signup</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>

<body>

    <form>
        Username: <input type="text" name="name" id="name" value="" /> <br>
        Password: <input type="password" name="password" id="password" value="" /> <br>
        Email: <input type="email" name="email" id="email" value="" /> <br>
        Role: <select name="role" id="role">
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="member">Member</option>
        </select><br><br>
        <input type="button" value="Submit" onclick="signup()" />
        <a href="login.php">login</a>

    </form>

    <p id="msg"></p>

    <script src="../asset/signup.js"></script>
</body>

</html>
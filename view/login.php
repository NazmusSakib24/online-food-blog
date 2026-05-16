<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>

    <form>
        Username:   <input type="text" name="username" id="username" value=""/> <br>
        Password:   <input type="password" name="password" id="password" value=""/> <br>
        Role:      <select name="role" id="role">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select><br><br>
                    <input type="button" name="submit" value="Submit" onclick="login()"/>
                      <a href="../view/signup.php">Signup</a>
                      <a href="../view/foodExperience.php">Continue as Guest</a>
    </form>

    <p id="msg"></p>

    <script src="../asset/login.js"></script>
</body>
</html>
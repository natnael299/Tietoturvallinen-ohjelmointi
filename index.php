<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Let's kirjaudu</h1>
    <form action="login.php" method="post">
        <label for="username">Käyttäjä</label>
        <input type="text" name="username" id="usernamex"><br>
        <label for="password">Passu</label>
        <input type="password" name="password" id="passwordx"><br>
        <p>Not registered yet? <a href="./reg-form.php">Register</a></p>
        <input type="submit" value="Login">
    </form>
</body>
</html>
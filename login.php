<?php

require "db.php";

$db = new DataBase();

$form_index = $_SERVER['REQUEST_URI'];

if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        if ($db->logIn("users", $_POST['username'], $_POST['password'])) {
            header("Location: tasks.php");
        } else echo "Username or Password wrong";
    } else echo "Error: Database connection";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <link rel="stylesheet" type="text/css" href="Login_page_style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="login-box">
            <div class="title">Login here</div>
            <form action="login.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input name="username" type="text" placeholder="Enter Username" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input name="password" type="password" placeholder="Enter Password" required>
                    </div>
                </div>
                <div class="login-button">
                    <input type="submit" value="Login">
                </div>
                <div class="additional-links">
                    <a href="Lost_password_page.html">Lost password?</a><br>
                    <a href="register.php">Not registerd?</a>
                </div>
            </form>
        </div>
    </body>
</html>
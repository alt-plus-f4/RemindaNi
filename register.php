<?php

require "db.php";

$db = new DataBase();

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['discord']) && isset($_POST['name'])) {
    if($_POST['password'] == $_POST['password2']){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            if ($db->dbConnect()) {
                if ($db->signUp("users", $_POST['email'], $_POST['username'], $_POST['password'], $_POST['discord'], $_POST['name'])) {
                    header("Location: tasks.php");
                } else echo "Sign up Failed";
            } else echo "Error: Database connection";
        }else echo "Not a valid email!";
    }else echo "Passwords should be the same";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="Registration_page_style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="registration-box">
            <div class="title">Регистрация</div>
            <form action="register.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full name</span>
                        <input name="name" type="text" placeholder="Enter your name" maxlength="25"  required>
                    </div>

                    <div class="input-box">
                        <span class="details">Username</span>
                        <input name="username" type="text" placeholder="Enter your username" maxlength="15" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Email</span>
                        <input name="email" type="text" placeholder="Enter your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Discord tag</span>
                        <input name="discord" type="text" placeholder="Enter tag Ex satan#6969" pattern=".*#\d{4}\b" minlength="5" maxlength="32" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Password</span>
                        <input name="password" type="text" placeholder="Enter a password" minlength="3" maxlength="15" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Confirm password</span>
                        <input name="password2" type="text" placeholder="Enter your password" minlength="3" maxlength="15" required>
                    </div>
                </div>
                <div class="registration-button">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </body>
</html>
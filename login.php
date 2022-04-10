<?php

require "db.php";

$db = new DataBase();

$form_index = $_SERVER['REQUEST_URI'];

if (isset($_POST['email']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        if ($db->logIn("users", $_POST['email'], $_POST['password'])) {
            header("Location: tasks.php");
        } else $error =  "Потребителското име или паролата са грешни!";
    } else $error = "Error: Database connection";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <link rel="stylesheet" type="text/css" href="Login_page_style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="login-box">
            <div class="title">Влез в акаунта си</div>
            <form action="login.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input name="email" type="email" placeholder="Въведи email" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Парола</span>
                        <input name="password" type="password" placeholder="Въведи парола" required>
                    </div>
                </div>
                <div class="err">
                    <a><?php print($error); ?></a>
                </div>
                <div class="login-button">
                    <input type="submit" value="Влез">
                </div>
                <div class="additional-links">
                    <a href="register.php">Не си регистриран?</a>
                </div>
            </form>
        </div>
    </body>
</html>
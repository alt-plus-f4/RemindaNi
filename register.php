<?php

require "db.php";

$db = new DataBase();

if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['password2'])) {
    if($_POST['password'] == $_POST['password2']){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            if ($db->dbConnect()) {
                if ($db->signUp("users", $_POST['email'], $_POST['name'], $_POST['password']) == 1) {
                    header("Location: verify.php");
                } else $error = "Потребителското име или email адресът са използвани.";
            } else $error = "Error: Database connection";
        }else $error = "Невалиден email адрес";
    }else $error = "Паролите не са еднакви";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="Registration_page_style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="registration-box">
            <div class="title">Регистрация</div>
            <form action="register.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Потребителско име "прякор"</span>
                        <input name="name" type="text" placeholder="Въведи потребителско име" value ="<?php echo $_POST['name'] ??'';?>" maxlength="15" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input name="email" type="email" placeholder="Въведи email" value="<?php echo $_POST['email'] ??'';?>" maxlength="100" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Парола</span>
                        <input name="password" type="password" placeholder="Въведи парола" minlength="3" maxlength="15" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Потвърди парола</span>
                        <input name="password2" type="password" placeholder="Повтори паролата" minlength="3" maxlength="15" required>
                    </div>
                </div>
                <a><?php print($error)?></a>
                <div class="registration-button">
                    <input type="submit" value="Регистрирай се">
                </div>
            </form>
        </div>
    </body>
</html>
<?php 
    session_start();
    if($_SESSION['id'] != NULL)
        $logged = 1;
    else $logged = 0;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <title>Профил</title>
        <link rel="stylesheet" type="text/css" href="Burger_style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">  
        <link rel="stylesheet" type="text/css" href="Home_page_style.css">
    </head>

    <body>
        <header class="top-bar">
            <div class="left">
                <a href="/"><img class="logo" src="logo.png" alt="logo"></a>
            </div>
            <nav class="right">
                <ul class="links">
                <li><a href="forus.php">За нас</a></li>
                <?php if($logged == 0){ ?>

                <li><a href="register.php">Регистрация</a></li>
                <li><a href="login.php">Влез</a></li>
                    
                <?php }?>
                <?php if($logged == 1){ ?>

                <li><a href="tasks.php">Задачи</a></li>
                <li><a href="logout.php">Излез</a></li>

                <?php }?>
                </ul>
                <div class="burger">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
                <script src="burger.js"></script>
            </nav>
        </header>

        <div id="info-box">
            <h2 style="text-align: center;">Здравей, <?=$_SESSION['name']?>!</h2>
            <?php if($_SESSION['status'] != 4 && $logged == 1) {?>
            <div class="verify">
                <?php if($_SESSION['status'] != 2 || $_SESSION['status'] == 1 && $logged == 1){ ?>
                <h2 style="text-align: center;">Ако желаеш да бъдеш известяван по email:</h2>
                <a href="verify.php"> <button class='email-verify'>Потвърди си email-а.</button></a>
                <?php } ?>

                <?php if($_SESSION['status'] != 3 || $_SESSION['status'] == 1 && $logged == 1){ ?>
                <h2 style="text-align: center;">Ако искаш да получаваш известия по дискорд:</h2>
                <a href="<?=$auth_url?>"><button class='discord-log-in'>Добави си Discord акаунта.</button></a>
                <?php } ?>
            </div>
            <?php } ?>
            <h2 style="text-align: center; margin-top: 20px;"><a href="logout.php"><button class='email-verify'>Излез от профила си</button></a></h2>
        </div>
    </body>
</html>
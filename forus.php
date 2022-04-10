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
        <title>For us</title>
        <link rel="stylesheet" type="text/css" href="Burger_style.css">
        <link rel="stylesheet" type="text/css" href="For_us_page_style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <header class="top-bar">
        <div class="left">
            <a href="/"><img class="logo" src="logo.png" alt="logo"></a>
        </div>
        <nav class="right">
            <ul class="links">
            <li><a href="index.php">Начална страница</a></li>
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
    <div class="info-box">
        <div class="info-text">
            <p>ТУЕС е училище с високи стандарти. То изисква от свойте ученици много голяма част от тяхното свободно време и енергия. Ние, като възпитаници на тази професионална гимназия, лично сме изпитали напрежението от многобройните задачи. Именно заради това решихме да направим организирането на изобилието от задания по-лесно.</p>
        </div>
    </div>
    <div class="info-box">
        <div class="info-text">
            <p>ТУЕС е училище с високи стандарти. То изисква от свойте ученици много голяма част от тяхното свободно време и енергия. Ние, като възпитаници на тази професионална гимназия, лично сме изпитали напрежението от многобройните задачи. Именно заради това решихме да направим организирането на изобилието от задания по-лесно.</p>
        </div>
    </div>
    <div class="info-box">
        <div class="info-text">
            <p>ТУЕС е училище с високи стандарти. То изисква от свойте ученици много голяма част от тяхното свободно време и енергия. Ние, като възпитаници на тази професионална гимназия, лично сме изпитали напрежението от многобройните задачи. Именно заради това решихме да направим организирането на изобилието от задания по-лесно.</p>
        </div>
    </div>
    </body>
</html>
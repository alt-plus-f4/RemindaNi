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

        <title>Home</title>
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
                <li><a href="profile.php">Профил</a></li>

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
            <?php if($_SESSION['status'] != 4 && $logged == 1) {?>
            <div class="verify">
                <?php if($_SESSION['status'] != 2 || $_SESSION['status'] == 1 && $logged == 1){ ?>
                <a>Потвърди си имейла, като цъкнеш пратения линк.</a>
                <?php } ?>

                <?php if($_SESSION['status'] != 3 || $_SESSION['status'] == 1 && $logged == 1){ ?>
                <a href="login-discord.php?action=login"><button class='discord-log-in'>Добави си Discord акаунта.</button></a>
                <?php } ?>
            </div>
            <?php } ?>
            <div id="value-proposition">
                <img class="logo" src="logo.png" alt="logo"><br>
                <p>Винаги бъдете сигурни, че всичките ви задачи ще бъдат изпълнени на време!</p>
            </div>

            <div id="proof">
                <img class="image" src="social_proof_image.png" alt="social proof">

                <div class="text">
                    <p class="sentance">Всичките 8 човека, които изпробваха нашия уеб сайт, останаха доволни.</p>
                    <p class="sentance">По техни думи уеб апликацията е работила безпогрешно.</p>
                    <p class="sentance">Била е лесна за достъп и използване.</p>
                    <p class="sentance">Значително е подобрило начина им на работа и живот.</p>
                </div>
            </div>

            <div id="benefits">
                <img class="image" src="Benefits_image.webp" alt="Girl with tasks">

                <div class="text">
                    <p class="head-sentance">&emsp;Използвайки нашите услуги, Вие ще:</p>
                    <p class="sentance">&emsp;&emsp;&emsp;- Можете по-лесно да следите заданията си;</p>
                    <p class="sentance">&emsp;&emsp;&emsp;- Завършите всичките си задачи на време;</p>
                    <p class="sentance">&emsp;&emsp;&emsp;- Подобрите организираността си;</p>
                    <p class="sentance">&emsp;&emsp;&emsp;- Придобиете повече свободно време;</p>
                </div>
            </div>

            <div id="features">
                <img class="image" src="features_image.jpg" alt="Clock with notes">

                <div class="text">
                    <p class="head-sentance">Ето някои от нашите отличителните свойства:</p>
                    <p class="sentance">&emsp;- Непрестанни известия, докато задачата не бъде изпълнена;</p>
                    <p class="sentance">&emsp;- Възможност за добавяне на описание към задание;</p>
                    <p class="sentance">&emsp;- Краен срок без ограничения;</p>
                    <p class="sentance">&emsp;- Възможност за създаване на до 25 задължения;</p>
                </div>
            </div>

            <div id="call-to-action">
                <iframe src="https://discord.com/widget?id=961339209761845288&theme=dark" width="350px" height="450" class="discord" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                
                <div class="text">
                    <p class="cta-text">Ако сме ви впечатлили, можете да се регистрирате. </p>
                    <p class="cta-text">Ако вече сте регистрирани влезте в профила ви!</p>
                    <p class="cta-text">Ако вече сте в профила ви, отидете към заданията!</p>
                    <p class="cta-text">Влезте в дискорд сървъра ни!</p>
                </div> 
            </div>
        </div>
    </body>
</html>


 <!-- TODO: better design-->

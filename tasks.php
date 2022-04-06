<?php
    session_start();

    $conf = parse_ini_file('config.ini'); // Configs
    $servername= $conf['db_servername'];
    $username = $conf['db_username'];
    $password= $conf['db_password'];
    $dbname = $conf['db_name'];
    $db    = $conf['db_sub_name'];

    if(!$user_id = $_SESSION['id'])
        header("Location: login.php");

    $res = [];

    $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed: " . $conn->connect_error);

    if($title  = $_POST['title']??''){
        $form_index = $_SERVER['REQUEST_URI']; // Used to differentiate editing and submitting a form

        if (strpos($form_index,"tasks.php?itemid=new") === false){ // Editing{   
            $date  = $_POST['date']??'';
            $time  = $_POST['time']??'';
            $desc  = $_POST['desc']??'';

            (int) $link_id = (int) filter_var($form_index, FILTER_SANITIZE_NUMBER_INT);
            $sql = "UPDATE `$db` SET `UserId` = '$user_id', `Title` = '$title', `Date` = '$date', `Time` = '$time', `Description` = '$desc' WHERE `ass`.`id` = $link_id;"; // UserID not added
            
            if ($conn->query($sql))
                header("Location: tasks.php");
        }

        else {                                          // Submitting
            $date  = $_POST['date']??'';
            $time  = $_POST['time']??'';
            $desc  = $_POST['desc']??'';
            
            $sql = "INSERT INTO `$db` (`id`, `UserId`, `Title`, `Date`, `Time`, `Description`) VALUES (NULL, '$user_id', '$title', '$date', '$time', '$desc'); "; // UserID not added
          
            if ($conn->query($sql))
                header("Location: tasks.php");
        }
    }

    $query = mysqli_query($conn, "SELECT * FROM $db WHERE `Userid` = $user_id; ");
    
    while($row = $query->fetch_assoc())
        $res[] = $row;

    $conn->close();
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tasks</title>
        <link rel="stylesheet" type="text/css" href="Task_page_style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="top-bar">
            <header>
                <h1><img class="logo" src="logo.png" alt="logo"></h1>
                <a class="contacts" href="index.html"><button>Начало</button></a>
            </header>
        </div>
        <div class="add-task-box">
        <?php 	foreach($res as $item) { ?> 

            <form id="item-<?=$item['id']?>" class="input-box" action="tasks.php?itemid=<?=$item['id']?>" method="post">
                <a class="delete-button" href="delete.php?item-<?=$item['id']?>" value="X">X</a>
                <input name="title" class="title"type="text" value="<?=$item['Title']?>" placeholder="Enter title" required disabled>
                <input name="date" class="today"type="date" value="<?=$item['Date']?>" required disabled>
                <input name="time" class="now" type="time"  value="<?=$item['Time']?>" required disabled>
                <textarea name="desc" class="note" required disabled><?=$item['Description']?></textarea>
                <input name="submit" class="submit" type="submit" value="submit" disabled style="display: none;">
                <input name="edit" class="submit" type="button" value="edit" onclick="editForm(`item-<?=$item['id']?>`)">
            </form>

        <?php } ?>
            <form id="new" class="input-box" action="tasks.php?itemid=new" method="post" style="display: none;">
                <input name="title" class="title" type="text" placeholder="Enter title" required>
                <input name="date" class="today" type="date" required>
                <input name="time" type="time" class="now" value="23:59" required="">
                <textarea name="desc" class="note" required >Description</textarea>
                <input name="submit" class="submit" type="submit" value="submit">
            </form>

            <button class="add-task-button" type="button" onclick="displayNew()">+</button>
        </div>
        <script src="test.js"></script> 
    </body>
</html>
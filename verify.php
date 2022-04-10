<?php
    require "PHPMailer/PHPMailerAutoload.php";
    require "db.php";

    $conf = parse_ini_file('config.ini'); // Configs
    $servername= $conf['db_servername'];
    $username = $conf['db_username'];
    $password= $conf['db_password'];
    $dbname = $conf['db_name'];
    $db    = $conf['db_sub_name'];

    session_start();

    $session_email = $_SESSION['email'];

    $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed: " . $conn->connect_error);

    if ($secret = $_GET['secret']??null && $session_email != NULL){ // If hack 
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `secret` = '$secret' AND `email` = '$session_email'; ");
        $res = mysqli_fetch_row($query);
        
        $id = $res[0]; // Id index
        $status = $res[4];
        if($status == 1)
            $status = 2;
        else if($status == 3)
            $status = 4;
        else
            header("Location: index.php");

        if($res != NULL){
            $query = mysqli_query($conn, "UPDATE `users` SET `status` = $status WHERE `users`.`id` = $id;");
            $secret = sha1($session_email.time());
            $query = mysqli_query($conn, "UPDATE `users` SET `secret` = '$secret' WHERE `users`.`id` = $id;");
            $conn->close();
            $_SESSION['status'] = $status;
            header("Location: tasks.php");
        }
        else
            header("Location: index.php");
    }

    else if($session_email != NULL){
        $query = mysqli_query($conn, "SELECT `secret` FROM `users` WHERE `email` = '$session_email'; ");
        $res = mysqli_fetch_row($query);
        $res = $res[0];
        $secret_url = "https://remindani.coderr.tech/verify.php?secret=" . $res;
        $error = smtpmailer($session_email, $secret_url);
        header("Location: index.php");
    }
    else{
        header("Location: index.php");
    }
?>
<?php
    session_start();

    require "db.php";

    $db = new DataBase();

    $form_index = $_SERVER['REQUEST_URI'];
    
    if (strpos($form_index,"/delete.php?item-") !== FALSE){

        $id = explode("-", $form_index);

        $db->delete((int)$id[1]);

        header("Location: tasks.php");

    }

    else 
        header("Location: tasks.php");
?>
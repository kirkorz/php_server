<?php
    session_start();
    if(!array_key_exists("role",$_SESSION)){
        $_SESSION['role'] ="guest";
    }
    if(isset($_GET['controller'])){
        $controller = $_GET['controller'];
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        } else{
            $action = 'index';
        }
    } else {
        $controller = 'landing';
        $action = 'userindex';
    }
    require_once('routes.php');
?>

<div>
<?php
    session_start();
    if(isset($_SESSION['token'])){
        echo '<a href="/?controller=auth&action=dashboard">Dashboard</a><br>';
        echo '<a href="/?controller=auth&action=logout">Log out</a><br>';
    } else{
        echo '<a href="/?controller=auth&action=index">Log in</a><br>';
        echo '<a href="">Sign up</a><br>';
    }
?>    
</div>

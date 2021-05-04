<div>
    <?php 
    if($_SESSION['role'] == 'admin'){
        echo '<a href="/?controller=landing&action=modindex">Home</a><br>';
    } else{
        echo '<a href="/?controller=landing&action=userindex">Home</a><br>';
    }
    require_once 'views/questions/search.php';
    ?>
</div>
<div>
    <?php
        session_start();
        if(isset($_SESSION['token'])){
            if($_SESSION['role'] == 'admin'){  
                echo '<a href="/?controller=auth&action=logout">Log out</a><br>';
            } else{
                echo '<a href="/?controller=landing&action=dashboard">Dashboard</a><br>';
                echo '<a href="/?controller=auth&action=logout">Log out</a><br>';
            }
        } else{
            echo '<a href="/?controller=auth&action=index">Log in</a><br>';
            echo '<a href="/?controller=auth&action=index2">Sign up</a><br>';
        }        
    ?>
</div>
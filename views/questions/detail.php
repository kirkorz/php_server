<?php
	echo "Questions : $question[title] <br> asked by : {$question[authors][0][name]} <br>";
    if(isset($_SESSION['token'])){
        require_once('views/questions/delete.php');
    }
    require_once('views/answers/list.php');
?>
<?php
    session_start();
    if(isset($_SESSION['token'])){
        require_once('views/answers/post.php');
    }
    else{
        echo "Log in to Comment";
    } 
?>
<?php
	//conact = "/?controller=landing&action=index" 
	session_start();
    if(isset($_SESSION['token'])){
        require_once('views/questions/post.php');
    }
	
	foreach ($questions as $question) {
		echo "<div><a href='/?controller=detail&action=index&id=$question[_id]'> $question[title] </a></div><br>";
		$question_id = $question['_id'];
	}
	foreach (range(0,intval($count / 5 )) as $number) {
		echo "<a href=" ;echo $conact."&id=$number>$number</a>    ";
	}
?>
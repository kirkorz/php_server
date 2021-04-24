<?php
	echo "Questions : $question[title] <br> asked by : {$question[authors][0][name]} <br>";
    foreach($question[comments] as $comment){
        foreach($comment['comments'] as $user){
            echo '=>>> '.$user['author'].'  :  ';
            echo $user['text'].'<br>';
        }
    }
?>
<form action="/?controller=detail&action=addcomment" method="post">
    <span>add comment</span>
    <input type="text" name="txtcomment" /> 
    <input value="submit" type="submit"/>
</form>'
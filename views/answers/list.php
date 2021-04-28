<?php
    foreach($answers['comments'] as $ans){
        echo ($ans['author']['name']);
        echo " ===> "."  $ans[text] <br> ";
    }
    if(intval($count)>=1){
        foreach (range(1,intval($count)) as $number) {
            echo "<a href=" ;echo $conact."&id=".$question['_id']."&page=$number>$number</a>    ";
        }
    }
?>
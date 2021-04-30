<div>
    <?php
        foreach($answers['comments'] as $ans){
            echo ($ans['author']['name']);
            echo " ===> "."  $ans[text] <br> ";
        }
    ?>
</div>
<div>
        <?php
        if(intval($count)>=1){
            foreach (range(1,intval($count)) as $number) {
                echo "<a href=" ;echo $conact."&id=".$question['_id']."&page=$number>$number</a>    ";
            }
        }
        ?>
</div>
<div>
<?php
    if(isset($_SESSION['token'])){
        require_once('views/answers/post.php');
    }
    else{
        echo "Log in to Comment";
    }
?>
</div>
<div>

</div>

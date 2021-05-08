<div>
    <div>
    <?php
    session_start();
	echo "Questions : $question[title] <br> asked by : {$question['authors'][0]['name']} <br>";
    echo "Tags : "; foreach ($question['tags'] as $tag) {
        echo $tag." || ";
    }
    echo "<br>";
    if(isset($_SESSION['token'])){
        require_once('views/questions/delete.php');
    }
    ?>    
    </div>
    <div>
        <?php 
            if($_SESSION['role'] == 'admin'){
                require_once('views/questions/makepub.php');
                require_once('views/questions/addcategory.php');
            }
            else{
                require_once('views/answers/list.php');
            }
        ?>
    </div>
</div>

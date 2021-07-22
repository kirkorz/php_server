<div>
    <ul>
        <li class="filter">noibat</li>
    </ul>
</div>
<div class="list_ans">
    <ul class="listanswer">
    <?php
        foreach($answers as $ans){
            echo "<div>".$ans['author']['name']." ===> "."  $ans[text]"."</div> ";
            echo "<div> Date: "."$ans[posted]"."</div>";
            echo "<div> Star: "."$ans[star]"."</div>";
            echo "<br>";
        }
    ?>
    </ul>
</div>
<div>
    <?php
        if(intval($count)>1){
            echo "<div class='pagination_ans' id='".$question['_id']."'>";
            echo "more </div>";
            // echo "<ul>";
            // foreach (range(1,intval($count)) as $number) {
            //     // echo "<a href=" ;echo $conact."&id=".$question['_id']."&page=$number>$number</a>    ";
			// 	echo "<li style='display:inline-block;'><a>$number</a></li>";
            // };
            // echo "<ul>";
            // echo "</div>";
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
<script id="listanswer" type="text/x-handlebars-template">
    <ul class="listanswer">
    {{#each answer}}
        <div>{{this.author.name}} ===> {{this.text}} </div>
        <div>Date: {{this.posted}}</div>
        <div>Star: {{this.star}}</div>
        <br>    
    {{/each}}
    </ul>
</script>

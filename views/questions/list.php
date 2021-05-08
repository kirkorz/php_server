<section>
	<?php 
    if(isset($_SESSION['token']) && $_SESSION['role'] == 'user'){
        require_once('views/questions/post.php');
    } 
	?>
	<div>
		<?php
		foreach ($questions as $question) {
			echo "<div><a href='/?controller=detail&action=index&id=$question[_id]'> $question[title] </a></div><br>";
			$question_id = $question['_id'];
		}
		?>
	</div>
	<div>
		<?php
		if($count != 0){
			foreach (range(0,intval($count / 5 )) as $number) {
				echo "<a href=" ;echo $conact."&id=$number>$number</a>    ";
			}
		}
		?>
	</div>
</section>
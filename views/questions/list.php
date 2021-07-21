<section>
	<?php 
    if(isset($_SESSION['token']) && $_SESSION['role'] == 'user'){
        require_once('views/questions/post.php');
    } 
	?>
	<div class="list_question">
		<ul class="listquestion">
		<?php
		foreach ($questions as $question) {
			$up = isset($question['upvote']) ? $question['upvote'] : 0;
			$down = isset($question['downvote']) ? $question['downvote'] : 0;
			echo "<div>
			<span class='vote' data-value=$question[_id]>upvote $up</span>
			<span class='vote' data-value=$question[_id]>downvote $down</span>
			<a href='/?controller=detail&action=index&id=$question[_id]'> $question[title] </a>
			</div><br>";
			$question_id = $question['_id'];
		}
		?>
		</ul>
	</div>
	<div class="page_pagiantion">
		<?php
		if($count != 0){
			echo "<ul class='pagepagiantion'>";
			foreach (range(0,intval($count / 5 ) -1 ) as $number) {
				echo "<li style='display:inline-block;'><a>$number</a></li>";
			}
			echo "</ul>";
		}
		?>
	</div>
</section>
<script id="listquestion" type="text/x-handlebars-template">
    <ul class="listquestion">
    {{#each question}}
		<div>
			{{#if this.upvote }}
			<span class="vote" data-value='{{this._id}}'>upvote {{this.upvote}}</span>
			{{else}}
			<span class="vote" data-value='{{this._id}}'>upvote 0</span>
			{{/if}}
			{{#if this.downvote }}
			<span class="vote" data-value='{{this._id}}'>upvote {{this.downvote}}</span>
			{{else}}
			<span class="vote" data-value='{{this._id}}'>downvote 0</span>
			{{/if}}
			<a href='/?controller=detail&action=index&id={{this._id}}'>{{this.title}}</a>
		</div>
		<br>
    {{/each}}
    </ul>
</script>
<script id="pagepagiantion" type="text/x-handlebars-template">
    <ul class="pagepagiantion">
	{{#each count}}
		<li style='display:inline-block;'><a>{{this}}</a></li>
    {{/each}}
    </ul>
</script>
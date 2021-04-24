<?php
	foreach ($questions as $question) {
		echo "<div><a href='/?controller=detail&action=index&id=$question[_id]'> $question[title] </a></div>";
	}
?>
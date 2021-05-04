<?php
if($_SESSION['role'] == 'admin'){
        $actions = "moddelQuestion";
    } else{
		$actions = "deleteQuestion";
	}
?>
<div>
<form action="/?controller=detail&action=<?php echo $actions.'&id='.$question['_id']; ?>" method="post">
	<input value="del" type="submit"/>
</form>
</div>
<form action="/?controller=detail&action=addComment<?php echo '&id='.$question['_id'];?>" method="post">
    <span>add comment</span>
    <input type="text" name="txtcomment" /> 
    <input value="submit" type="submit"/>
</form>
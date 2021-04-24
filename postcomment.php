<?php
    session_start();
    echo 'a';
    // $comment = $_POST['txtcomment'];
    // echo $comment;
    $newURL = '/detail.php';
    header('Location: '.$newURL);
?>
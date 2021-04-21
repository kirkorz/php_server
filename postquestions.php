<?php
    session_start();
    $data = array(
        'title' => $_POST["txttitle"],
        'detail' => $_POST["txtdetail"],
        'token' => $_SESSION['accessToken']
    );
    $url = 'http://localhost:3000/api/questions';
    $ch = curl_init($url);
    $postString = http_build_query($data,'','&');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo $httpcode . "<br/>";
    curl_close($ch);
    // session_start();
    // echo $result;
    // print_r($result);
    $newURL = '/dashboard.php';
    header('Location: '.$newURL);
?>
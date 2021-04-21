<html>
    <body>
        <h1>Dashboard for User</h1>
        <form action="postquestions.php" method="post">
            <input type="text" name="txttitle" /> 
            <input type="text" name="txtdetail">
            <input value="submit" type="submit"/>
        </form>
        <?php
            session_start();
            $data = array(
                'token' => $_SESSION['accessToken']
            );
            $url = 'http://localhost:3000/api/questions';
            $ch = curl_init($url);
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $response = curl_exec($ch);
            $result = json_decode($response, true);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        ?>
    </body>
</html>
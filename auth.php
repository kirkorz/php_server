<html>
    <body>
        <?php
            $data = array(
                'username' => $_POST["txtusername"],
                'password' => $_POST["txtpassword"]
            );
            echo $data['password'];
            $url = 'http://localhost:3001/auth/login';
            $ch = curl_init($url);
            $postString = http_build_query($data,'','&');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            echo $httpcode . "<br/>";
            curl_close($ch);
            echo "token" . $_POST["email"] . "<br/>";
            echo $response;
            session_start();
            $_SESSION['message'] = 'mod';
            $newURL = '/dashboard.php';
            header('Location: '.$newURL);
        ?>
    </body>
</html>
<html>
    <body>
        <?php
            $data = array(
                'username' => $_POST["txtusername"],
                'password' => $_POST["txtpassword"]
            );
            $url = 'http://localhost:3000/auth/login';
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
            session_start();
            echo $result;
            print_r($result);
            if (array_key_exists('check', $result)) {
                $_SESSION['accessToken'] = $result["accessToken"];
                if($result["check"]=='false'){
                    $newURL = '/dashboard.php';    
                }
                else{
                    $newURL = '/mod.php';
                }
            }            
            else{
                $newURL = '/error.php';
            }
            header('Location: '.$newURL);
        ?>
    </body>
</html>
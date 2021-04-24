<html>
    <h1>This is home page</h1>
    <?php
        session_start();
        if(isset($_SESSION['name'])){
            echo "<span>Hello $_SESSION[name]</span> <br>";
        }
        else{
            echo '<form action="auth.php" method="post">
            <span>log in</span>
            <input type="text" name="txtusername" /> 
            <input type="text" name="txtpassword">
            <input value="submit" type="submit"/>
            </form>';
        }
    ?>
    
    <?php
        $url = 'http://localhost:3000/api/questions';
        $ch = curl_init($url);
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);
        $result = json_decode($response, true);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        foreach($result as $value){
            echo '<a href="./detail.php'.'/'.'?id='.$value['_id'].'">'.$value['title'].'</a>'.'<br>';
            // echo $value['title'].'....'.$value['created_at'].'<br>';
            // foreach($value['comments'] as $comment){
            //     foreach($comment['comments'] as $c){
            //         echo '=>>>'.$c['author']['name'].'  :  ';
            //         echo $c['text'].'<br>';
            //     }
            // }
        }
    ?>
</html>
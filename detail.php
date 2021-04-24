<html>
    <body>
        <?php
            $id =  $_GET['id'];
            $url = 'http://localhost:3000/api/questions/public/'.$id;
            $ch = curl_init($url);
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            $response = curl_exec($ch);
            $result = json_decode($response, true)[0];
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            echo "Questions : $result[title] <br> asked by : {$result[authors][0][name]} <br>";
            foreach($result[comments] as $comment){
                foreach($comment['comments'] as $c){
                    echo '=>>> '.$c['author']['name'].'  :  ';
                    echo $c['text'].'<br>';
                }
            }
            // echo json_encode(json_decode($response), JSON_PRETTY_PRINT); 
        ?>
        <!-- <form action="." method="post">
                <input type="text" name="txtcomment" /> 
                <input value="submit" type="submit"/>
        </form> -->
    </body>
</html>
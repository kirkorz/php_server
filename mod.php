<html>
    <body>
        <h1>Dashboard for Mod</h1>
        <?php
            session_start();
            if(!empty($_SESSION['accessToken'])) {
               $message = $_SESSION['accessToken'];
               echo $message;
            } 
            else{
                echo "Mod";
            }
        ?>
    </body>
</html>
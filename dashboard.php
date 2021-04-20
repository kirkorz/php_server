<html>
    <body>
        <h1>Dashboard</h1>
        <?php
            session_start();
            if(!empty($_SESSION['message'])) {
               $message = $_SESSION['message'];
               echo $message;
            } 
            else{
                echo "User";
            }
        ?>
    </body>
</html>
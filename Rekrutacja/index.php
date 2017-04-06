
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require_once "./lib/nusoap.php";
            $client = new nusoap_client("http://localhost/Rekrutacja/server.php");
            session_start();
        
            if(isset($_SESSION['logout'])){
                session_destroy();
                header("Refresh:0; url=index.php");
            }
        
        
            if (!isset($_SESSION['ids'])) {
        ?>
        <!-- stronka przed zalogowaniem -->
        <?php
            } else {
        ?>
        <!-- stronka po zalogowaniu -->
        <?php
            }
        ?> 
    </body>
</html>

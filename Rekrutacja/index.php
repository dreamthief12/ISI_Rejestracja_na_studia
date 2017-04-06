
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require_once "./lib/nusoap.php";
            $client = new nusoap_client("http://localhost/Rekrutacja/server.php");
            $err = $client->getError();
            if ($err) {
                echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
            }
            session_start();
            if (isset($_GET['logout'])) {
                session_destroy();
                header("Location: index.php");
            }
            if((isset($_POST['log']) && isset($_POST['pas']))){
                $result=$client->call('ServerWS.login', array('id' => $_POST['log'], 'password' => $_POST['pas'], 'who' => 'student')); 
                if($result)
                    $_SESSION['student']=1;
                }
            if (!isset($_SESSION['student'])) {
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

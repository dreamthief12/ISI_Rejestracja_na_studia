
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
                header("Refresh:0; url=index.php");
            }
            if((isset($_POST['log']) && isset($_POST['pas']))){
                $result=$client->call('ServerWS.login', array('id' => $_POST['log'], 'password' => $_POST['pas'], 'who' => 'Student')); 
                if($result)
                    $_SESSION['student']=1;
                }
            if (!isset($_SESSION['student'])) {
        ?>
        <!-- stronka przed zalogowaniem -->
        
        <!-- rejestracja -->
          $r = $client->call("ServerWS.registration", array('name' => $_POST['name'], 'surname' => $_POST['surname'], 'birthDate' => $_POST['birthDate'], 'address'=> $_POST['address'], 'pesel'=> $_POST['pesel'], 'email'=> $_POST['email'], 'phonenr'=> $_POST['phonenr']));
          echo $r;
        
        <?php
            } else {
        ?>
        <!-- stronka po zalogowaniu -->
        <?php
            }
        ?> 
    </body>
</html>

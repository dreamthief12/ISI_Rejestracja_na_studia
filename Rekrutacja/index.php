
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
        
        
        <!-- edycja danych -->
        $re = $client->call("ServerWS.editData", array('name' => $_POST['name'], 'surname' => $_POST['surname'], 'birthDate' => $_POST['birthDate'], 'address'=> $_POST['address'], 'pesel'=> $_POST['pesel'], 'email'=> $_POST['email'], 'phonenr'=> $_POST['phonenr'], 'photo' => $photo, 'gender' => $_POST['gender'], 'id' => 1));
                    $res = explode(';', $re);
                    //print_r($res);
                    ?>

                    <form method="post" action="index.php">  
                        <table align="center">
                            <?php ?>
                            <tr><td>Your data:</td></tr>
                            <tr><td>Name: </td><td><input type="text" name="name" required="required" value="<?php echo $res[0]; ?>"/></td></tr>
                            <tr><td>Surname: </td><td><input type="text" name="surname" required="required" value="<?php echo $res[1]; ?>"/></td></tr>
                            <tr><td>Birthdate: </td><td><input type="date" name="birthDate" required="required" value="<?php echo $res[2]; ?>"/></td></tr>
                            <tr><td>Address: </td><td><input type="text" name="address" required="required" value="<?php echo $res[3]; ?>"/></td></tr>
                            <tr><td>PESEL: </td><td><input type="number" name="pesel" required="required" value="<?php echo $res[4]; ?>"/></td></tr>
                            <tr><td>E-mail: </td><td><input type="text" name="email" required="required" value="<?php echo $res[5]; ?>"/></td></tr>
                            <tr><td>Phone number: </td><td><input type="number" name="phonenr" required="required" value="<?php echo $res[6]; ?>"/></td></tr>
                            <tr><td>Photo: </td><td><input type="file" name="image" required="required" /></td><td><img src="data:image/jpg;base64,<?php echo base64_encode($res[7]); ?>" width="100px" height="100px"></td></tr>
                            <tr><td>Gender: </td><td><select name="gender"><option value="m">Mężczyzna</option><option value="k">Kobieta</option></select></td></tr>
                            <tr><td><input type = "submit" value = "Submit" name="submit"></td></tr>
                            <?php
                            
                            $photo = file_get_contents($_FILES["image"]['tmp_name']);
                            
                            
                           //if(isset($_POST['submit'])){
//                                $img = addslashes($_FILES['image']['tmp_name']);
//                                $img = file_get_contents($img);
//                                $img = base64_encode($img);
                            //}
                            
                            
                            ?>

                        </table>           
                    </form>
        <!-- dodawanie wyników matur -->
         $result = $client->call("ServerWS.editExamData", array('class' => 3, 'result' => 20, 'examNumber' => '123', 'id' => 1));
                            print_r($result);
//                            if($_POST['submit']){
//                                //tutaj co ma się wyświetlić po zedytowaniu danych
//                            } else {
//                                //tutaj co ma się wyświetlić formularz do edycji 
//                            }
                           
        <?php
            } else {
        ?>
        <!-- stronka po zalogowaniu -->
        <?php
            }
        ?> 
    </body>
</html>

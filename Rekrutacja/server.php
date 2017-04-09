<?php

require_once "./lib/nusoap.php";

class Student {
    
}

class DBController{
    public function connect(){
        global $conn;
        $conn = mysqli_connect("localhost", "root", "12345", "isi") or die("Error" . mysqli_error($conn));
    }
}

class AccountController{
    
    public function login($id, $password, $whoo){
        global $conn;
        $who = mysqli_real_escape_string($conn, $whoo);
        $sql = "SELECT Haslo FROM $who WHERE Id$who"."a = ".mysqli_real_escape_string($conn, $id);
        $pas = mysqli_query($conn, $sql);
        $cryptDB = mysqli_fetch_assoc($pas);
        $actualCrypt = crypt($password, $cryptDB['Haslo']);
        if (hash_equals($actualCrypt, $cryptDB['Haslo'])){
            return 1;
        } 
        else{
            return 0;
        }
    }
    
    public function createAccount($imie, $nazwisko, $upr, $haslo, $email, $wydzial){
        global $conn; 
        $imiee = mysqli_real_escape_string($conn, $imie);
        $nazwiskoo = mysqli_real_escape_string($conn, $nazwisko);
        $uprr = mysqli_real_escape_string($conn, $upr);
        $hasloo = crypt($haslo);
        $emaill = mysqli_real_escape_string($conn, $email);
        $wydziall = mysqli_real_escape_string($conn, $wydzial);
        $sql = "INSERT INTO Pracownik (Imie, Nazwisko, IdUprawnienia, Haslo, Email, IdWydzialu) VALUES ('$imiee', '$nazwiskoo', $uprr, '$hasloo', '$emaill', $wydziall)";
        if (mysqli_query($conn, $sql)){
            return "Konto pracownika zostalo utworzone";
        }
        else {
            return "Wystąpił błąd. Spróbuj ponownie.";
        }
        
    }
    
    public function deleteAccount($id){
        global $conn;
        $idd = mysqli_real_escape_string($conn, $id);
        $sql = "DELETE FROM Pracownik WHERE IdPracownika = $idd";
        if (mysqli_query($conn, $sql)){
            return "Konto pracownika zostalo usuniete.";
        }
        else {
            return "Wystąpił błąd. Spróbuj ponownie.";
        }
    }
}

class Transfer{
    
}

class Protocol{
    
}

class Degree{
    
    public function setLimit($kierunek, $wydzial, $limit){
        global $conn;
        $kierunekk = mysqli_real_escape_string($conn, $kierunek);
        $wydziall = mysqli_real_escape_string($conn, $wydzial);
        $limitt = mysqli_real_escape_string($conn, $limit);
        $sql = "UPDATE Kierunek SET LiczbaMiejsc = $limitt WHERE Nazwa ='".$kierunekk."' AND IdWydzialu = $wydziall";
        if(mysqli_query($conn, $sql)){
            return "Liczba miejsc została zmieniona.";
        }
        else {
            return "Wystąpił błąd. Spróbuj ponownie.";
        }       
    }
    
     public function setReserveAmount($kierunek, $wydzial, $limit){
        global $conn;
        $kierunekk = mysqli_real_escape_string($conn, $kierunek);
        $wydziall = mysqli_real_escape_string($conn, $wydzial);
        $limitt = mysqli_real_escape_string($conn, $limit);
        $sql = "UPDATE Kierunek SET LiczbaRezerwowych = $limitt WHERE Nazwa ='".$kierunekk."' AND IdWydzialu = $wydziall";
        if(mysqli_query($conn, $sql)){
            return "Liczba miejsc rezerwowych została zmieniona.";
        }
        else {
            return "Wystąpił błąd. Spróbuj ponownie.";
        }       
    }
    
}

class ServerWS {
	public $server = NULL;
	
	public function __construct(){
            $this->server = new nusoap_server();
	}
        
        public function registerMethod($nameMethod){
            $this->server->register($nameMethod);
	}
        
	public function processRequest(){
            $this->server->service($GLOBALS['HTTP_RAW_POST_DATA'] );
	}
        
        public function login($id, $password, $who){
            $ac = new AccountController();
            $r = $ac->login($id, $password, $who);
            return $r;
        }
        
        public function createAccount($imie, $nazwisko, $upr, $haslo, $email, $wydzial){
            $ac = new AccountController();
            $r = $ac->createAccount($imie, $nazwisko, $upr, $haslo, $email, $wydzial);
            return $r;
        }
        
        public function deleteAccount($id){
            $ac = new AccountController();
            $r = $ac->deleteAccount($id);
            return $r;
        }
        
        public function setLimit($kierunek, $wydzial, $limit){
            $d = new Degree();
            $r = $d->setLimit($kierunek, $wydzial, $limit);
            return $r;
        }
        
        public function setReserveAmount($kierunek, $wydzial, $limit){
            $d = new Degree();
            $r = $d->setReserveAmount($kierunek, $wydzial, $limit);
            return $r;
        }
        
}

$conn;
$db = new DBController();
$db -> connect();

$server = new ServerWS();
$server->registerMethod('ServerWS.login');
$server->registerMethod('ServerWS.createAccount');
$server->registerMethod('ServerWS.deleteAccount');
$server->registerMethod('ServerWS.setLimit');
$server->registerMethod('ServerWS.setReserveAmount');

$server->processRequest();




<?php

require_once "./lib/nusoap.php";



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
	
    public function registration($name, $surname, $birthDate, $address, $pesel, $email, $phonenr){
        global $conn;
        
        if(empty($address)) $address = '';
        if(empty($phonenr)) $phonenr = 0;
        
        $name = mysqli_real_escape_string($conn, $name);
        $surname = mysqli_real_escape_string($conn, $surname);
        $birthDate = mysqli_real_escape_string($conn, $birthDate);
        $address = mysqli_real_escape_string($conn, $address);
        $pesel = mysqli_real_escape_string($conn, $pesel);
        $email = mysqli_real_escape_string($conn, $email);
        $phonenr = mysqli_real_escape_string($conn, $phonenr);
        
        
        if(!(empty($name)&&empty($surname)&&empty($birthDate)&&empty($pesel)&&empty($email))){
            $sq = mysqli_query($conn, "INSERT INTO Student (Imie, Nazwisko, DataUrodzenia, Adres, Pesel, Email, nrTelefonu) values ('$name', '$surname', '$birthDate', '$address', $pesel, '$email', $phonenr);");
            if($sq==1){
                return "Zarejestrowano.";
            } else {
                return "Rejestracja nie powiodla sie. Sprobuj ponownie.";
            }  
        } else {
            return "WYPELNIJ WSZYSTKIE POLA!";
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

class Student {
    public function editData($name, $surname, $birthDate, $address, $pesel, $email, $phonenr, $photo, $gender, $id){
        global $conn;
        
        //$id = session id
        
        if(empty($address)) $address = '';
        if(empty($phonenr)) $phonenr = 0;
        
        $name = mysqli_real_escape_string($conn, $name);
        $surname = mysqli_real_escape_string($conn, $surname);
        $birthDate = mysqli_real_escape_string($conn, $birthDate);
        $address = mysqli_real_escape_string($conn, $address);
        $pesel = mysqli_real_escape_string($conn, $pesel);
        $email = mysqli_real_escape_string($conn, $email);
        $phonenr = mysqli_real_escape_string($conn, $phonenr);

        if(!(empty($name)&&empty($surname)&&empty($birthDate)&&empty($pesel)&&empty($email))){
            $sq = mysqli_query($conn, "UPDATE Student SET (Imie, Nazwisko, DataUrodzenia, Adres, Pesel, Email, nrTelefonu, Zdjecie, Plec) values ('$name', '$surname', '$birthDate', '$address', $pesel, '$email', $phonenr, '$photo', '$gender');");
            if($sq==1){
                return "Zaktualizowano!";
            } else {
                return "Aktualizacja nie powiodla sie. Sprobuj ponownie.";
            }  
        } 
        
        $sql="Select * from Student where IdStudenta=$id;";
        $showstudentdata = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($showstudentdata)) {
            $studentdata .= $row['Imie'].';'.$row['Nazwisko'].';'.$row['DataUrodzenia'].';'.$row['Adres'].';'.$row['Pesel'].';'.$row['Email'].';'.$row['nrTelefonu'].';'.$row['Zdjecie'].';'.$row['Plec'];
        }
        return $studentdata;
        
        
        
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
        
	public function registration($name, $surname, $birthDate, $address, $pesel, $email, $phonenr){
            $r = new AccountController();
            $result = $r->registration($name, $surname, $birthDate, $address, $pesel, $email, $phonenr);
            return $result;
        }
        
        
        public function editData($name, $surname, $birthDate, $address, $pesel, $email, $phonenr, $photo, $gender, $id){
            $s = new Student();
            $result = $s->editData($name, $surname, $birthDate, $address, $pesel, $email, $phonenr, $photo, $gender, $id);
            return $result;
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
$server->registerMethod('ServerWS.registration');
$server->registerMethod('ServerWS.editData');


$server->processRequest();




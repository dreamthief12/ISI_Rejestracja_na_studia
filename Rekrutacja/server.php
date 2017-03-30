<?php

require_once "./lib/nusoap.php";

class Student {
    
}

class DBController{
    
}

class AccountController{
    
}

class Transfer{
    
}

class Protocol{
    
}

class Degree{
    
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
        
}

$server = new ServerWS();



$server->processRequest();




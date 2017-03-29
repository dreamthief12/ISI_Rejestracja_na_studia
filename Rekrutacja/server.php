<?php

require_once "./lib/nusoap.php";

class ServerWS {
	public $server = NULL;
	
	public function __construct(){
		$this->server = new nusoap_server();
	}
        
}

$server = new ServerWS();



$server->processRequest();




<?php if(!defined('BASEPATH'))die('No direct script access.');

class controller {
	function some_method(){}
	function another_method(){
		$API = SimpleAPI::getInstance();
		$API->setParameter('response', 'hello world');
		$API->sendResponse();
	}
	function __construct(){

		}


	}

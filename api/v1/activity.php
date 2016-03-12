<?php if(!defined('BASEPATH'))die('No direct script access.');

class activity {
	function another_method(){}
	function invoke(){
		$API = SimpleAPI::getInstance();
		$API->setParameter('response', array('really cool'));
		$API->sendResponse();
	}
	function __construct(){

		}


	}

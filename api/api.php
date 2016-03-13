<?php
define('BASEPATH', __FILE__);

if ($_SERVER['HTTP_HOST']=="localhost:8888"){
	error_reporting(-1);
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

define('API_JSON', 'Content-type: application/json');

class SimpleAPI {
	//manages the output of the call.

	private static $_instance = null;
	public static function getInstance(){
        if (self::$_instance === null) {
            self::$_instance = new self(array());
        }
        return self::$_instance;
    	}
	public function requestMethod(){
		return $_SERVER['REQUEST_METHOD'];
	}

	// public function requires($name, $field){
	// 	if($field && !key_exists($name, $field)){
	// 		$this->logError("Missing field [".$name."]");
	// 		$this->sendResponse();
	// 		die('');
	//
	// 		}
	// 	}
	public function logError($issue){
		$this->errors[] = $issue;
		return $this;
		}
	public function statusCode($code){
		$this->status = $code;
		return $this;
	}
	private $response = array();
	private $errors;
	private $status;

	public function sendResponse(){
		header('Content-type: application/json');

		if (count($this->errors)>0){
			$this->response = array();
			$this->response['status']= isset($this->status) ? $this->status : "400";
			$this->response['errors'] = $this->errors;


			} else {
				$this->response['status']= "200";
				}

		if (isset($_REQUEST['callback'])){
			echo $_REQUEST['callback'] . "(" . json_encode($this->response) . ");";
			} else {
				echo json_encode($this->response);
				}
		}
	public function setParameter($name, $value){
		$this->response[$name] = $value;
	}
	public function directive(){
		$count = 0;
		$directive = false;
		if(isset($this->directive)) return $this->directive;

		foreach($_GET as $key =>$val){
			if($count == 0){
				$directive = $key;
				unset($_GET[$key]);
				$count++;
				}
			}
			if($directive){
				$return = array_filter(explode("/", $directive));

				} else {
					$return = $directive;
					}
					if(count($return)==1){
						array_push($return, "index");
					}
				$this->directive = $return;

			return $return;

		}

	function __construct(){
		}


	}

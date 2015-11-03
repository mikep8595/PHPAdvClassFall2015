<?php

/**
 * Description of RestServer
 *
 * @author Mike
 */
class RestServer {   
    
    private $status = 200; //lets you know protocol of the page.
    private $status_codes = array(  
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Access Forbidden',
        404 => 'Not Found',
        409 => 'Conflict',
        500 => 'Internal Server Error',
    );
    private $response = array(       
        "message" => NULL,
        "errors" => NULL,
        "data" => NULL
    );
    private $id;
    private $resource;
    private $verb;
    private $server_data;
    
    function getServer_data() {
        return $this->server_data;
    }

    private function setServer_data() {
        if( strpos(filter_input(INPUT_SERVER, 'CONTENT_TYPE'), "application/json") !== false) {
            $this->server_data = json_decode(trim(file_get_contents('php://input')), true);


        switch ( json_last_error() ) {
                case JSON_ERROR_NONE:
                { //data UTF-8 compliant
                  //tell client to recieve JSON data and send           
                }
                break;
                case JSON_ERROR_SYNTAX:
                case JSON_ERROR_UTF8:
                case JSON_ERROR_DEPTH:
                case JSON_ERROR_STATE_MISMATCH:
                case JSON_ERROR_CTRL_CHAR:
                    throw new Exception(json_last_error_msg());           
                break;
                default:
                   throw new Exception('JSON encode error Unknown error');
                break;
        }               
        }    
    }

        
    public function getId() {
        return $this->id;
    }

    public function getResource() {
        return $this->resource;
    }
 
    function getStatus() {
        return $this->status;
    }
    
    function getVerb() {
        return $this->verb;
    }

    private function setVerb() {
        $this->verb = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        $verbs_allowed = array('GET','POST','PUT','DELETE');

        if ( !in_array($this->verb, $verbs_allowed) ) {
            throw new Exception("Unexpected Header Requested ". $this->verb);
        }        
    }
    
    
    
    function setStatus($status) {       
        if (!array_key_exists($status, $this->status_codes)){
        
            throw new Exception('Not Valid Status' . $status);
        }
        else {
            $this->status = $status;
        }
    }
    
    public function setMessage($message) {
        $this->response["message"] = $message;
    }
    
    public function setError($error) {
        $this->response["error"] = $error;
    }
    
    public function setData($data) {
        $this->response["data"] = $data;
    }

            
    public function __construct() {
        header("Access-Control-Allow-Orgin: *"); //who is allowed to access this page
        header("Access-Control-Allow-Methods: GET, POST, UPDATE, DELETE");
        header("Content-Type: application/json; charset=utf8"); //will be outputing json
        $this->getRestArgs();
        $this->setVerb();
        $this->setServer_data();
    }
    
//    private function setID(){
//        $endpoint = filter_input(INPUT_GET, 'endpoint');
//        $restArgs = explode('/', rtrim($endpoint, '/'));   
//        
//        if ( isset($restArgs[0]) && is_numeric($restArgs[0]) ) {
//            $this->id = intval($restArgs[0]);
//        }
//        
//    }
//    
//    private function setResource(){
//        $endpoint = filter_input(INPUT_GET, 'endpoint');
//        $restArgs = explode('/', rtrim($endpoint, '/'));    
//        $this->resource = array_shift($restArgs);
//        
//    }
    
    private function getRestArgs() {
        $endpoint = filter_input(INPUT_GET, 'endpoint');
        $restArgs = explode('/', rtrim($endpoint, '/'));    
        $this->resource = array_shift($restArgs);
        $this->id = NULL;
        
        if ( isset($restArgs[0]) && is_numeric($restArgs[0]) ) {
            $this->id = intval($restArgs[0]);
        }
    }
    
    public function outputResponse(){
        header("HTTP/1.1 " . $this->getStatus() . " " . $this->status_codes[$this->getStatus()]);
        echo json_encode($this->response, JSON_PRETTY_PRINT);        
    }

}

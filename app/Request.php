<?php

namespace App\App;

/**
 * Currently it's only working if the requestBody has JSON format
 */
class Request {
    private static Request $instance;
    private String $requestType;
    private Array $requestBody;
    private Array $headers;

    private function __construct() {}

    private function loadDatas() : Void {
        $this->requestType = $_SERVER['REQUEST_METHOD'];
        if (file_get_contents('php://input')) {
            $this->requestBody = json_decode(file_get_contents('php://input'),true);
        }
        $this->headers = getallheaders();
    }

    public static function getRequest() : Request {
        if (!isset($instance)) {
            self::$instance = new Request();
            self::$instance->loadDatas();
        }

        return self::$instance;
    }
    
    /**
     * getHeader
     *
     * @param  String $name Name of the header
     * @return String|bool Return the content of the selected header, if the header does not exist it's return false
     */
    public function getHeader(String $name) : String|bool {
        if (isset($this->headers[$name])) {
            return $this->headers[$name];
        }
        return false;
    }
    /**
     * getBody
     * Return the array representation of the request body.
     * @return Array|bool if the request body is empty its return false
     */
    public function getBody() : Array|bool {
        if (isset($this->requestBody)) {
            return $this->requestBody;
        }
        return false;
    } 
        
    /**
     * getRequestType
     * Get the request type
     * @return String It will return a string what conatins the request HTTP method (ex: POST, PUT, PATCH, GET, DELETE)
     */
    public function getRequestType() : String {
        return $this->requestType;
    }
}
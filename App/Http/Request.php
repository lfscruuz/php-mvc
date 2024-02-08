<?php

namespace App\http;

class Request{
    private $router;
    private $httpMethod;
    private $uri;
    private $queryParams = [];
    private $postvars = [];
    private $headers = [];

    public function __construct($router){
        $this->router = $router;
        $this->queryParams = $_GET ?? [];
        $this->postvars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER["REQUEST_METHOD"] ?? "";
        $this->setUri();
    }
    
    private function setUri(){
        $this->uri = $_SERVER["REQUEST_URI"] ?? "";

        $xUri = explode("?", $this->uri);
        $this->uri = $xUri[0];
        
    }

    public function getRouter(){
        return $this->router;
    }
    public function getHttpMethod(){
        return $this->httpMethod;
    }
    public function getUri(){
        return $this->uri;
    }
    public function getHeaders(){
        return $this->headers;
    }
    public function getQueryParams(){
        return $this->queryParams;
    }
    public function getPostVars(){
        return $this->postvars;
    }
}
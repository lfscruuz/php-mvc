<?php

namespace App\http;
use \Closure;

class Router{
    private $url = '';
    private $prefix = '';
    private $routes = [];
    private $request;

    public function __construct($url){
        $this->request = new Request();
        $this->url = $url;
    }

    private function setPrefix($url){
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? '';
    }

    private function addRoute($method, $route, $params = []){
        echo "<pre>";
        print_r($params);
        echo "<pre>";
        foreach($params as $key => $value){
            if ($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }
        echo "<pre>";
        print_r($params);
        echo "<pre>";
        exit;
    }

    public function get($route, $params = []){
        return $this->addRoute('GET', $route, $params);
    }
}


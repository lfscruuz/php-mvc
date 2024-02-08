<?php
    namespace App\http\Middleware;

    class Queue{
        private $middlewares = [];
        private $controller;
        private $controllerArgs = [];
        private static $map = [];
        private static $default = [];

        public function __construct($middlewares, $controller, $controllerArgs){
            $this->middlewares = array_merge(self::$default, $middlewares);
            $this->controller = $controller;
            $this->controllerArgs = $controllerArgs;
        }

        public static function setMap($map){
            self::$map = $map;
        }

        public static function setDefault($default){
            self::$default = $default;
        }
        public function next($request){
            
            if (empty($this->middlewares)){
                return call_user_func_array($this->controller, $this->controllerArgs);
            }

            $middleware = array_shift($this->middlewares);

            if (!isset(self::$map[$middleware])){
                throw new \Exception("Problemas ao processar o middleware da requisição", 500);
            }
            
            $queue = $this;
            $next = function($request) use($queue) {
                return $queue->next($request);
            };

            

            return (new self::$map[$middleware])->handle($request, $next);
        }

    }
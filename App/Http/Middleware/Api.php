<?php
    namespace App\http\Middleware;

    class Api{
        public function handle($request, $next){
           $request->getRouter()->setContentType('application/json');
            return $next($request);
        }
    }
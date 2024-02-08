<?php
    namespace App\http\Middleware;

    class Maintenance{
        public function handle($request, $next){
            if (getenv('MAINTENANCE') == 'true'){
                throw new \Exception('Página em manutunção. Tente novamente mais tarde.', 503);
            }

            return $next($request);
        }
    }
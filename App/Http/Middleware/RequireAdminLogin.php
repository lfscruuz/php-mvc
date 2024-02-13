<?php
namespace App\http\Middleware;
use App\Session\Admin\login as SessionAdminLogin;

class RequireAdminLogin{
    public function handle($request, $next){
        if(!SessionAdminLogin::isLogged()){
            $request->getRouter()->redirect('/admin/login');
        }

        return $next($request);
    }
}
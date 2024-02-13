<?php
namespace App\http\Middleware;
use App\Session\Admin\login as SessionAdminLogin;

class RequireAdminLogout{
    public function handle($request, $next){
        if(SessionAdminLogin::isLogged()){
            $request->getRouter()->redirect('/admin');
        }

        return $next($request);
    }
}
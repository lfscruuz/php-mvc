<?php

use App\http\Response;
Use App\Controller\Admin;

$obRouter->get('/admin',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function(){
        return new Response(200, 'admin');
    }
]);

$obRouter->get('/admin/login',[
    "middlewares" =>[
        "required-admin-logout"
    ],
    function($request){
        return new Response(200, Admin\Login::getLogin($request));
    }
]);

$obRouter->post('/admin/login',[
    "middlewares" =>[
        "required-admin-logout"
    ],
    function($request){
        return new Response(200, Admin\Login::setLogin($request));
    }
]);

$obRouter->get('/admin/logout',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request){
        return new Response(200, Admin\Login::setLogout($request));
    }
]);
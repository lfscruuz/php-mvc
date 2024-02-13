<?php

use App\http\Response;
use App\Controller\Admin;

$obRouter->get('/admin',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request){
        return new Response(200, Admin\Home::getHome($request));
    }
]);


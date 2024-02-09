<?php

use App\http\Response;
Use App\Controller\Admin;

$obRouter->get('/admin/testimonies',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request){
        return new Response(200, Admin\Home::getHome($request));
    }
]);
$obRouter->get('/admin/testimonies',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request){
        return new Response(200, Admin\testimony::getTestimonies($request));
    }
]);
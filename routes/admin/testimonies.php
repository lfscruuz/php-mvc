<?php

use App\http\Response;
Use App\Controller\Admin;

$obRouter->get('/admin/testimonies',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request){
        return new Response(200, Admin\testimony::getTestimonies($request));
    }
]);

$obRouter->get('/admin/testimonies/new',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request){
        return new Response(200, Admin\testimony::getNewTestimony($request));
    }
]);

$obRouter->post('/admin/testimonies/new',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request){
        return new Response(200, Admin\testimony::setNewTestimony($request));
    }
]);

$obRouter->get('/admin/testimony/{id}/edit',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request, $id){
        return new Response(200, Admin\testimony::getEditTestimony($request, $id));
    }
]);

$obRouter->post('/admin/testimony/{id}/edit',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request, $id){
        return new Response(200, Admin\testimony::setEditTestimony($request, $id));
    }
]);

$obRouter->get('/admin/testimony/{id}/delete',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request, $id){
        return new Response(200, Admin\testimony::getDeleteTestimony($request, $id));
    }
]);

$obRouter->post('/admin/testimony/{id}/delete',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request, $id){
        return new Response(200, Admin\testimony::setDeleteTestimony($request, $id));
    }
]);
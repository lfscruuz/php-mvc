<?php

use App\http\Response;
Use App\Controller\Admin;

$obRouter->get('/admin/users',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request){
        return new Response(200, Admin\Users::getUsers($request));
    }
]);

$obRouter->get('/admin/users/new',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request){
        return new Response(200, Admin\Users::getNewUser($request));
    }
]);

$obRouter->post('/admin/users/new',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request){
        return new Response(200, Admin\Users::setNewUser($request));
    }
]);

$obRouter->get('/admin/users/{id}/edit',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request, $id){
        return new Response(200, Admin\Users::getEditUser($request, $id));
    }
]);

$obRouter->post('/admin/users/{id}/edit',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request, $id){
        return new Response(200, Admin\Users::setEditUser($request, $id));
    }
]);

$obRouter->get('/admin/users/{id}/delete',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request, $id){
        return new Response(200, Admin\Users::getDeleteUser($request, $id));
    }
]);

$obRouter->post('/admin/users/{id}/delete',[
    "middlewares" =>[
        "required-admin-login"
    ],
    function($request, $id){
        return new Response(200, Admin\Users::setDeleteUser($request, $id));
    }
]);
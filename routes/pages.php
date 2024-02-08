<?php

use App\http\Response;
Use App\Controller\Pages;

$obRouter->get('/',[
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);

$obRouter->get('/sobre',[
    function(){
        return new Response(200, Pages\About::getAbout());
    }
]);

$obRouter->get('/depoimentos',[
    function($request){
        return new Response(200, Pages\Testimony::getTestimonies($request));
    }
]);

$obRouter->post('/depoimentos',[
    function($request){
        
        return new Response(201, Pages\Testimony::insertTestimony($request));
    }
]);
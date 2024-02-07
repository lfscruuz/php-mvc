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
    function(){
        return new Response(200, Pages\Testimony::getTestimonies());
    }
]);

$obRouter->post('/depoimentos',[
    function($request){
        echo "<pre>";
        print_r($request);
        echo '</pre>';
        exit;
        return new Response(201, Pages\Testimony::getTestimonies());
    }
]);
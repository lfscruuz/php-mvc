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

$obRouter->get('/pagina/{idPagina}/{acao}',[
    function($idPagina, $acao){
        return new Response(200, $idPagina.' - '.$acao);
    }
]);
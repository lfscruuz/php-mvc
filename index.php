<?php
Require __DIR__.'/vendor/autoload.php';

use App\http\Response;
Use App\http\Router;
Use App\Controller\Pages\Home;

define('URL','http://localhost/mvc');

$obRouter = new Router(URL);

$obRouter->get('/',[
    function(){
        return new Response(200, Home::getHome());
    }
]);


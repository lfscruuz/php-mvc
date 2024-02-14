<?php
use App\http\Response;
use App\Controller\Api;

$obRouter->get('/api/v1', [
    function($request){
        return new Response(200, Api\Api::getDetails($request), 'application/json');
    }
]);
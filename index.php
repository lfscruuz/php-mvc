<?php
require __DIR__.'/vendor/autoload.php';

Use App\http\Router;
Use App\Utils\view;

define('URL','http://localhost/mvc');
View::init([
    'URL' => URL
]);

$obRouter = new Router(URL);

include __DIR__.'/routes/pages.php';

$obRouter->run()->sendResponse();
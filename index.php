<?php
require __DIR__.'/includes/app.php';
Use App\http\Router;

$obRouter = new Router(URL);

include __DIR__.'/routes/pages.php';

$obRouter->run()->sendResponse();
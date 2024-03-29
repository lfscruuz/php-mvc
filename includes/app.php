<?php
    require __DIR__.'/../vendor/autoload.php';
    Use App\Utils\view;
    use WilliamCosta\DotEnv\Environment;
    use WilliamCosta\DatabaseManager\Database;
    use App\http\Middleware\Queue as MiddlewareQueue;

    Environment::load(__DIR__.'/../');
    Database::config(
        getenv('DB_HOST'),
        getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PASS'),
        getenv('DB_PORT')
    );
    
    define('URL',getenv('URL'));
    View::init([
        'URL' => URL
    ]);

    MiddlewareQueue::setMap([
        'maintenance' => \App\Http\Middleware\Maintenance::class,
        'required-admin-logout' => App\http\Middleware\RequireAdminLogout::class,
        'required-admin-login' => App\http\Middleware\RequireAdminLogin::class,
        'api' => App\http\Middleware\Api::class,
        'user-basic-auth' => App\http\Middleware\UserBasicAuth::class,
    ]);

    MiddlewareQueue::setDefault([
        'maintenance'
    ]);
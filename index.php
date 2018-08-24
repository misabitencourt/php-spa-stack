<?php

require 'vendor/autoload.php';

use App\Helpers\Session as Session;
use Dotenv\Dotenv as Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

function dd($var)
{
    die(var_dump($var));
}

date_default_timezone_set(getenv('TIMEZONE'));

if (getenv('ENV') === 'dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

$session = new Session();
$session->start();

$capsule = new Capsule();

$capsule->addConnection([
    'driver' => getenv('DB_DRIVER'),
    'host' => getenv('DB_HOST'),
    'database' => getenv('DB_NAME'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => getenv('DB_CHARSET'),
    'collation' => getenv('DB_COLLATION'),
    'prefix' => getenv('ENV') === 'test' ? 'test_' : ''
]);

$capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher());
$capsule->setAsGlobal();
$capsule->bootEloquent();

$slimConfiguration = new \Slim\Container([
    'settings' => [
        'displayErrorDetails' => (getenv('ENV') === 'dev'),
    ],
]);

$app = new \Slim\App($slimConfiguration);

$container = $app->getContainer();

// register twig
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__.'/views', [
        'cache' => getenv('ENV') === 'prod' ? '../cache' : false,
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

foreach (glob(__DIR__.'/endpoints/*.php') as $filename) {
    require $filename;
}

$app->run();

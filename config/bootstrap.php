<?php
// define a working directory
defined('APP_PATH') || define('APP_PATH', dirname(__DIR__));

use Slim\Slim;
use Slim\Views;

require APP_PATH . '/vendor/autoload.php';

$config = require_once APP_PATH . '/config/app.php';

// Prepare app
$app = new Slim($config['App']);

// Create monolog logger and store logger in container as singleton
// (Singleton resources retrieve the same log resource definition each time)
$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('slim-skeleton');
    $log->pushHandler(
        new \Monolog\Handler\StreamHandler(APP_PATH . '/tmp/logs/app.log', \Monolog\Logger::DEBUG)
    );
    return $log;
});

// Prepare view
$app->view(new Views\Twig());
$app->view->parserOptions = array(
    'charset'          => 'utf-8',
    'cache'            => realpath(APP_PATH . '/tmp/cache'),
    'auto_reload'      => true,
    'strict_variables' => false,
    'autoescape'       => true,
);
$app->view->parserExtensions = array(new Views\TwigExtension());

// Prepare Twig
$twig = $app->view->getEnvironment();
foreach ($config['Twig'] as $twigKey => $twigValue) {
    $twig->addGlobal($twigKey, $twigValue);
}

// Configures routers
$routers = require_once APP_PATH . '/config/router.php';
foreach ($routers as $name => $router) {
    $path     = array_shift($router);
    $methods  = (array) array_pop($router);
    $callable = array_pop($router);
    $route    = $app->map($path, $callable);

    foreach ($methods as $method) {
        $route->via($method);
    }
    if (count($router) > 0) {
        $route->setMiddleware($router);
    }
    if (is_string($name)) {
        $route->setName($name);
    }
}

// Not found template
$app->notFound(function() use ($app) {
    $app->render('404.twig');
});

// Run app
$app->run();

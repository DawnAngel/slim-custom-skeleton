<?php
/**
 * Config router of app
 * <code>
 * 'name' => [$path, $callable, $methods]
 * 'name' => [$path, $middleware, $callable, $methods]
 * 'name' => [$path, $middleware1, $middleware2, $callable, $methods]
 * </code>
 * vars:
 * $path        string
 * $middleware  string|Closure
 * $callable    string|Closure
 * $methods     string|array
 */
return [
/** Page Controller Actions */
    'index' => ['/', 'App\\Controllers\\RootController:indexAction', 'GET'],
    // 'pages' => ['/:page', 'App\\Controllers\\RootController:indexAction', 'GET'],
/** Api Controller Actions */
    'api' => ['/api', 'App\\Controllers\\ApiController:indexAction', 'GET'],
];

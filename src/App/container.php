<?php
// Initialization of the container
use App\Utils\Picker;

$container = $app->getContainer();

// Initializing views in the container
$container['views'] = function ($container) {
    $view = new \Slim\Views\Twig(SRC . DS . 'Views', [
        'cache' => ((Picker::get('app.env') === 'dev') ? false : 'var/cache/views') // Views cache
    ]);
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    return $view;
};

// Initialization of flash messages in the container
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// Initialization of the csrf protection in the container
$container['csrf'] = function () {
    $guard =  new Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", false);
        return $next($request, $response);
    });
    return $guard;
};
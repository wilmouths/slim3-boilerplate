<?php
// Redefining the 404 error page
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $container->views->render($response, 'errors/404.html.twig');
    };
};
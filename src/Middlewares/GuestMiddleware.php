<?php

namespace App\Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Utils\Session;

/**
 * GuestMiddleware.php
 *
 * Manages the necessary non-authentication on the roads
 * Redirect user if is logged when roads asks not to be authenticated
 *
 * @package    Middlewares
 * @author     WILMOUTH Steven
 * @version    1
 */
class GuestMiddleware
{

    /**
     * @var object $container
     */
    private $container;

    /**
     * GuestMiddleware constructor.
     * @param \Twig_Environment $twig
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Invoke middleware
     * @param RequestInterface $request
     * @param RequestInterface $response
     * @param $next
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, $next)
    {
        if(!Session::isLogged('user')) {
            return $next($request, $response);
        } else {
            return $response->withStatus(302)->withHeader('Location', $this->container->get('router')->pathFor('user.view', ['name' => Session::get('user')->name]));
        }
    }
    
}

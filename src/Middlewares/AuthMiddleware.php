<?php

namespace App\Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Utils\Session;

/**
 * AuthMiddleware.php
 *
 * Manages the necessary authentication on the roads
 * Redirect user if isn't logged when roads need authentification
 *
 * @package    Utils
 * @author     WILMOUTH Steven
 * @version    1
 */
class AuthMiddleware
{

    /**
     * @var object $container
     */
    private $container;

    /**
     * AuthMiddleware constructor.
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
        if(Session::isLogged('user')) {
            return $next($request, $response);
        } else {
            return $response->withStatus(302)->withHeader('Location', $this->container->get('router')->pathFor('user.login.form', []));
        }
    }
    
}

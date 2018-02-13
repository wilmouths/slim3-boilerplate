<?php

namespace App\Middlewares\Twig;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Utils\Session;

/**
 * FlashMiddleware.php
 *
 * Management of flash messages
 * Create var for Twig
 *
 * @package    Middlewares
 * @author     WILMOUTH Steven
 * @version    1
 */
class FlashMiddleware
{

    private $twig;

    /**
     * FlashMiddleware constructor.
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Invoke middleware
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return mixed
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $this->twig->addGlobal('flash', Session::exist('flash') ? Session::get('flash') : []);
        if (Session::exist('flash')) {
            Session::unset('flash');
        }
        return $next($request, $response);
    }

}

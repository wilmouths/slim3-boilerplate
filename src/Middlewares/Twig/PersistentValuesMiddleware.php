<?php

namespace App\Middlewares\Twig;

use App\Utils\Session;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * PersistentValuesMiddleware.php
 *
 * Persist data in form
 * Create var for Twig
 *
 * @package    Middlewares
 * @author     WILMOUTH Steven
 * @version    1
 */
class PersistentValuesMiddleware
{

    private $twig;

    /**
     * PersistentValuesMiddleware constructor.
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Invoke middleware
     * @param Request$request
     * @param Response $response
     * @param $next
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $this->twig->addGlobal('persistValues', Session::exist('persistValues') ? Session::get('persistValues') : []);
        if (Session::exist('persistValues')) {
            Session::unset('persistValues');
        }
        $response = $next($request, $response);
        if ($response->getStatusCode() !== 200) {
            Session::set('persistValues', $request->getParams());
        }
        return $response;
    }

}

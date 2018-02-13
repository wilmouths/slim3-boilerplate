<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use App\Utils\Session;

/**
 * BaseController.php
 *
 * Mother class of all controllers
 *
 * @package    Controllers
 * @author     WILMOUTH Steven
 * @version    1
 */
class BaseController
{

    private $container;

    /**
     * BaseController constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * View rendering function
     * @param ResponseInterface $response
     * @param string $view View path (ViewFolder/ViewName) without extension
     * @param array|null $params
     */
    public function render(ResponseInterface $response, $view, $params = array())
    {
        $this->container->views->render($response, $view . '.html.twig', $params);
    }

    /**
     * JSON rendering function
     * @param ResponseInterface $response
     * @param $name
     * @param array $params
     * @param int $status
     * @return static
     */
    public function json(ResponseInterface $response, $data)
    {
        return $response->withHeader('Content-type', 'application/json')->withJson($data, 201);
    }

    /**
     * Redirect function
     * @param ResponseInterface $response
     * @param string $name Route name
     * @param array $params
     * @param int $status
     * @return static
     */
    public function redirect(ResponseInterface $response, $name, $params = array(), $status = 302)
    {
        return $response->withStatus($status)->withHeader('Location', $this->container->get('router')->pathFor($name, (!is_null($params) ? $params : [])));
    }

    /**
     * Function that generates flash messages
     * @param $type
     * @param $message
     */
    public function flash($type, $message)
    {
        if (Session::exist('flash')) {
            Session::set('flash', []);
        }
        Session::set('flash', [$type => $message]);
    }

    /**
     * Attribute Getter
     * @param $name
     * @return mixed
     */
    public function __get($name) {
        return $this->$name;
    }

}

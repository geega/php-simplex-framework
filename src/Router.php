<?php
/**
 * User: Script
 * Date: 27.08.2017
 * Time: 6:20
 */

namespace Geega\Simplex;


use Geega\Request\Request;

class Router
{
    private $request;

    private $controller;

    private $method;

    private $map = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $params)
    {
        $this->map['GET'][$path] = $params;
    }
    public function post($path, $params)
    {
        $this->map['POST'][$path] = $params;
    }

    public function setRoute($route)
    {
        $route = explode('@', $route);

        if (empty($route[0])) {
            throw new \Exception('Not found controller');
        }

        $this->controller = '\\app\\controllers\\'.$route[0];
        if (empty($route[1])) {
            throw new \Exception('Not found method controller');
        }
        $this->method = $route[1];
    }

    public function getCurrentController()
    {
        return $this->controller;
    }

    public function getCurrentMethod()
    {
        return $this->method;
    }
    public function getCurrent()
    {
        if (empty($this->map[$this->request->requestMethod])) {
            throw new \Exception('Not found method');
        }

        $currentMap = $this->map[$this->request->requestMethod];
        if (empty($currentMap[$this->request->uri])) {
            $currentRoute = $currentMap['/404'];
        } else {
            $currentRoute = $currentMap[$this->request->uri];
        }
        $this->setRoute($currentRoute);
        return $this;
    }
}
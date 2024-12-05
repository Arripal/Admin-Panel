<?php

class Router
{
    private $routes = [];

    private function add_route($url, $controller, $method, $secured)
    {
        $this->routes[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method,
            'secured' => $secured

        ];
        return $this;
    }

    public function get($url, $controller, $secured = true)
    {
        return $this->add_route($url, $controller, 'GET', $secured);
    }

    public function delete($url, $controller, $secured = true)
    {
        return $this->add_route($url, $controller, 'DELETE', $secured);
    }

    public function put($url, $controller, $secured = true)
    {
        return $this->add_route($url, $controller, 'PUT', $secured);
    }

    public function post($url, $controller, $secured = true)
    {
        return $this->add_route($url, $controller, 'POST', $secured);
    }

    public function current_route($url, $method)
    {
        $route = current(array_filter($this->routes, function ($route) use ($url, $method) {
            return $route['url'] == $url && $route['method'] == strtoupper($method);
        }));

        if (!$route) {
            return null;
        }

        return $route;
    }

    public function is_secured_route($route)
    {
        return $route['secured'];
    }

    public function use_route($url, $method)
    {
        $route = $this->current_route($url, $method);

        if (!$route) {
            throw new Exception("Impossible d'accéder à votre requête", 500);
        }

        return require(__DIR__ . '../../controllers' . $route['controller']);
    }
}

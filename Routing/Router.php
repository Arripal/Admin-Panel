<?php

class Router
{
    private $routes = [];
    private $protected_paths = [
        ['admin' => '/admin/dashboard']
    ];

    private function add_route($url, $controller, $method,)
    {
        $this->routes[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method,

        ];
        return $this;
    }


    public function get($url, $controller,)
    {
        return $this->add_route($url, $controller, 'GET');
    }

    public function delete($url, $controller,)
    {
        return $this->add_route($url, $controller, 'DELETE');
    }

    public function put($url, $controller,)
    {
        return $this->add_route($url, $controller, 'PUT');
    }

    public function post($url, $controller,)
    {
        return $this->add_route($url, $controller, 'POST');
    }


    private function current_route($url, $method)
    {
        $route = current(array_filter($this->routes, function ($route) use ($url, $method) {
            return $route['url'] == $url && $route['method'] == strtoupper($method);
        }));
        return $route;
    }

    public function use_route($url, $method)
    {

        $route = $this->current_route($url, $method);


        if (!$route) {
            throw new RouterException("Impossible d'accéder à votre requête", 500);
        }

        return require(__DIR__ . '../../controllers' . $route['controller']);
    }

    public function is_protected_path($url_path)
    {
        $protected_paths = $this->protected_paths;

        $protected = array_map(function ($path) use ($url_path) {
            foreach ($path as $role => $path) {
                return str_starts_with($url_path, $path);
            }
        }, $protected_paths);

        return $protected[0];
    }
}

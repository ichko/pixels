<?php
namespace Framework;

class Router
{
    public $route_definitions = [];

    public function add($route, $instance, $method = 'index')
    {
        $this->route_definitions[$route] = [$instance, $method];
        return $this;
    }

    public function route($path, $request_method)
    {
        foreach ($this->route_definitions as $route => [$instance, $method]) {
            $test = $this->try_route($route, $path, $params);
            if ($test) {
                if (is_callable($instance)) {
                    return $instance(...$params);
                }
                return [$method, call_user_func_array(
                    [$instance, $method],
                    $params
                )];
            }
        }

        throw new Exception('No route found.');
    }

    private function try_route($route, $path, &$params)
    {
        $path = trim($path, '/');
        $route_regex = $this->parse_route($route);

        $test = preg_match($route_regex, $path, $params, PREG_OFFSET_CAPTURE, 0);
        if ($test) {
            unset($params[0]);
            $params = array_map(function ($element) {
                return $element[0];
            }, $params);
        }

        return $test;
    }

    private function parse_route($route)
    {
        $route = str_replace('/', '\/', $route);
        $route = preg_replace('/\?/', '([\w\d-_]+)', $route);

        return "/^$route$/i";
    }
}

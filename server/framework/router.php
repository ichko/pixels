<?php
namespace Framework;

class Router
{
    public $route_definitions = [];

    public function add($route, $controller, $controller_method = 'get')
    {
        $this->route_definitions[$route] = [$controller, $controller_method];
        return $this;
    }

    public function __invoke($path, $request_method)
    {
        foreach (
            $this->route_definitions as $route =>
            list($controller, $controller_method)
        ) {
            $test = $this->try_route($route, $path, $params);
            if ($test && strcasecmp($request_method, $controller_method) == 0) {
                if (method_exists($controller, $controller_method)) {
                    return call_user_func_array(
                        [$controller, $controller_method],
                        $params
                    );
                }

                return call_user_func_array(
                    $controller,
                    $params
                );
            }
        }

        throw new Exception('No route found.');
    }

    private function try_route($route, $path, &$params)
    {
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

        return "/$route$/i";
    }
}

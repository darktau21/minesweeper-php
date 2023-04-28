<?php

namespace core;

class Router
{
    private $routes = [];

    public function add($route_path, Controller $controller)
    {
        $link = ltrim($route_path, '/');
        $link = explode('/', $link);
        $this->routes[$link[0]] = [
            'controller' => $controller,
            'param' => str_replace(':', '', $link[1]),
        ];
    }

    public function load($route_path, $get, $post)
    {
        $link = ltrim($route_path, '/');
        $link = explode('/', $link);

        if (is_null($this->routes[$link[0]])) {
            if (NORMAL) {
                header('Location: /404');
            } else {
                header('Location: ?path=/404');
            }
            exit();
        }

        $this->routes[$link[0]]['controller']->index($get, $post, [
            $this->routes[$link[0]]['param'] => $link[1]
        ]);
    }
}
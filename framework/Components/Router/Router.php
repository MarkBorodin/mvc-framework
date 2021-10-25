<?php


namespace framework\Components\Router;


include __DIR__ . '/../../../vendor/autoload.php';


use app\Controllers\HomeController;
use app\Controllers\ParamsController;
use framework\Interfaces\RouteInterface;


class Router implements RouteInterface
{
    public function route(): callable
    {
        $url = $_SERVER['REQUEST_URI'];
        $parsed_data = $this->parse_url($url);

        // не работает автолоадер, не пойму почему
        $controller = ucfirst($parsed_data[0]).'Controller';
        $controllerName = "app\Controllers\\" . $controller;
        $controller = new $controllerName();

        $action = $parsed_data[1];
        $args = $parsed_data[2];

        return function () use ($controller, $action, $args)
        {
            return call_user_func([$controller, $action], $args ?? []);
        };
    }

    public function parse_url($url): array
    {
        $data = explode('/', parse_url($url)['path']);
        $controller = $data[1];
        $action = $data[2];
        $args = array_slice($data, 3);
        $argKeys = array();
        $argValues = array();

        foreach ($args as $value) {
            if (array_search($value, $args) % 2 === 0)
            {
                array_push($argKeys, $value);
            }
            else
            {
                array_push($argValues, $value);
            }

            $newArgs = array_combine($argKeys, $argValues);
        }

        $result_data = array();
        array_push($result_data, $controller);
        array_push($result_data, $action);
        array_push($result_data, $newArgs);
        return $result_data;
    }
}
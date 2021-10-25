<?php


namespace framework;


use framework\Interfaces\RouteInterface;
use framework\Interfaces\RunnableInterface;

class Application implements RunnableInterface
{
    protected $router;

    public function __construct(RouteInterface $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        try {
            $action = $this->router->route();
            $action();
        } catch (\Throwable $exception) {
            http_response_code();
            echo 'Not found';
        }
    }
}
<?php

namespace App\App\Controller;

use App\App\Routing\Router;

abstract class AbstractController {

    private Router $router;

    public function __construct(Router $router) {
        $this->router = $router;
    }

    public function getRoute() : String {
        return $this->router->getCurrentRoute();
    }

    public function getParam(String $param) : String {
        return $this->router->getParam($param);
    }

    abstract public function getView() : String;

}
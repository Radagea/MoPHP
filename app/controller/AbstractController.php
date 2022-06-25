<?php

namespace App\App\Controller;

use App\App\App;
use App\App\Routing\Route;
use App\App\Routing\Router;
use App\App\View\View;

abstract class AbstractController {

    private Route $route;

    public function __construct(Route $route) {
        $this->route = $route;
        App::getApp();
    }

    public function getRoute() : String {
        return $this->route->getFullPath();
    }

    public function getParam(String $param) : ?String {
        if (array_key_exists($param,$this->route->getParams())) {
            return $this->route->getParams()[$param];
        }
        return null;
    }

    abstract public function getView() : View;

}
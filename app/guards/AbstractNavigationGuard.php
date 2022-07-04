<?php

namespace App\App\Guards;

use App\App\Routing\Route;

abstract class AbstractNavigationGuard {
    private Route $route;

    public function __construct(Route $route) {
        $this->route = $route;
    }

    protected function redirect(String $url) : Void {
        header('Location: '.$url);
        die();
    }
    
    /**
     * get 
     * Get the custom data for the next route what you can add at the routes.json
     * @param  String $data - the data what you want to get from the route
     * @return mixed it can return Null, String, Int or bool
     */
    protected function getData(String $data) {
        if (array_key_exists($data,$this->route->getDatas())) {
            return $this->route->getDatas()[$data];
        }
        return null;
    }

    public function getParam(String $param) : ?String {
        if (array_key_exists($param,$this->route->getParams())) {
            return $this->route->getParams()[$param];
        }
        return null;
    }

    abstract public function checkPermission() ;
}
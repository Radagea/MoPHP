<?php

namespace App\App\Routing;

use App\App\Routing\Route;


class Router {
    private Array $routes = [];
    private Route $currentRoute;
    private Route $err404;


    public function __construct() {
        $path = $_SERVER['DOCUMENT_ROOT']."/../routes.json";
        $fileData = file_get_contents($path);
        $datas = json_decode($fileData,true);
        
        $this->add($datas);

        $this->err404 = new Route();

        $this->recognizeRoute();
        $this->insertController();
    }

    private function add($datas) : Void {
        foreach ($datas as $data) {
            $route = new Route();
            $route->addRoute($data);
            array_push($this->routes,$route);
        }
    }

    private function recognizeRoute() : Void {
        $this->currentRoute = new Route();
        $this->currentRoute->setFullPath($_SERVER['REQUEST_URI']);
        $van = 0;
        foreach ($this->routes as $route) {
            if ($this->currentRoute->compareWith($route)) {
               $this->currentRoute->setName($route->getName());
               $this->currentRoute->setController($route->getController());
               $van ++;
               break;
           }
           if ($route->getName() === '404') {
                $this->err404->setFullPath($route->getFullPath());
                $this->err404->setController($route->getController());
           }
        }
        if ($van == 0) {
            $this->currentRoute = $this->err404;
        }
    }

    private function insertController() : Void {
        $file = $this->currentRoute->getController();
        $namespace = 'App\\Src\\Controller\\'.$file;
        if (!class_exists($namespace)) {
            $this->currentRoute = $this->err404;
            $this->insertController();
        }

        $controller = new $namespace($this);
        
        echo $controller->getView();
    }




    //Getters

    public function getCurrentRoute() {
        return $this->currentRoute->getFullPath();
    }

    public function getParam(String $param) {
        return $this->currentRoute->getParams()[$param];
    }
}


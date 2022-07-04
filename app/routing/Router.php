<?php

namespace App\App\Routing;

use App\App\Routing\Route;
use App\Src\Guards\NavigationGuard;
use App\App\App;

class Router {
    private Array $routes = [];
    private Route $currentRoute;
    private Route $err404;
    private static Router $instance;

    public static function getRouter() {
        if (!isset(self::$instance)) {
            self::$instance = new Router();
            self::$instance->make();
        }

        return self::$instance;
    }

    private function make() {
        $path = $_SERVER['DOCUMENT_ROOT']."/../routes.json";
        $fileData = file_get_contents($path);
        $datas = json_decode($fileData,true);
        
        $this->add($datas);

        $this->err404 = new Route();
        $this->recognizeRoute();
        $this->navGuardCheck();
        $this->insertController();
    }

    private function __construct() {
    }

    private function navGuardCheck() {
        $navguard = null;
        if ($this->currentRoute->getNavGuard() != null) {
            $navGuard = $this->currentRoute->getNavGuard();
        } else {
            $navGuard = App::getApp()->getNavGuard();
        }
        if (class_exists($navGuard)) {
            $guard = new $navGuard($this->currentRoute);
            $guard->checkPermission();
        }
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
               $this->currentRoute->setDatas($route->getDatas());
               $this->currentRoute->setNavGuard($route->getNavGuard());
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
            return;
        }
        $controller = new $namespace();
        
        echo $controller->getView();
    }

    public function getRoute() : Route {
        return $this->currentRoute;
    }

}


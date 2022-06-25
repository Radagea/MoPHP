<?php

namespace App\App;

use App\App\Routing\Router;
use App\App\Request;

class App {

    private Router $router;
    private static App $instance;
    private Request $request;

    private function __construct() {}

    private function makeApp() {
        $this->router = Router::getRouter();
        $this->request = Request::getRequest();
    }

    public static function getApp() {
        if (!isset(self::$instance)) {
            self::$instance = new App();
            self::$instance->makeApp();
        }
        return self::$instance;
    }
}
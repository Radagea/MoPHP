<?php

namespace App\App;

use App\App\Routing\Router;

class App {

    private Router $router;
    private static App $instance;

    private function __construct() {}

    private function makeApp() {
        $this->router = Router::getRouter();
    }

    public static function getApp() {
        if (!isset(self::$instance)) {
            self::$instance = new App();
            self::$instance->makeApp();
        }

        return self::$instance;
    }
}
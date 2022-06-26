<?php

namespace App\App;

use App\App\Routing\Router;
use App\App\Request;

class App {

    private Router $router;
    private static App $instance;
    private Request $request;

    private Array $databaseSettings;

    private function __construct() {}

    private function makeApp() : Void {
        $file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/../settings.json");
        $datas = json_decode($file,1);
        if (isset($datas['database'])) {
            $this->databaseSettings = $datas['database'];
        }
        $this->request = Request::getRequest();
        $this->router = Router::getRouter();
    }

    public static function getApp() : App {
        if (!isset(self::$instance)) {
            self::$instance = new App();
            self::$instance->makeApp();
        }
        return self::$instance;
    }

    public function getDatabaseSettings() : Array {
        return $this->databaseSettings;
    }
}
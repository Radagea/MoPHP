<?php

namespace App\App;

use App\App\Errors\ErrorHandler;
use App\App\Routing\Router;
use App\App\Request;
use App\App\Errors\MoError;

class App {

    private Router $router;
    private static App $instance;
    private Request $request;
    private String $enviroment;
    private String|null $navGuard = null;

    private Array $databaseSettings;

    private function __construct() {}

    private function makeApp() : Void {
        $file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/../settings.json");
        $datas = json_decode($file,1);
        if (isset($datas['database'])) {
            $this->databaseSettings = $datas['database'];
        }
        if (isset($datas['defaultNavigationGuard'])) {
            $this->navGuard = $datas['defaultNavigationGuard'];
        }
        $this->enviroment = $datas["enviroment"];
        $this->request = Request::getRequest();
        try {
            $this->includeAssists();
            $this->router = Router::getRouter();
        } catch (MoError $error) {
            new ErrorHandler($error);
        }
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

    public function getNavGuard() : String|null {
        return $this->navGuard;
    }

    private function includeAssists() : Void {
        include_once($_SERVER['DOCUMENT_ROOT'].'/../app/packages/global/GlobalFunctions.php');
    }
}
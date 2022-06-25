<?php

namespace App\App\Controller;

use App\App\Controller\Response;
use App\App\Request;
use App\App\Routing\Route;
use App\App\Routing\Router;

abstract class ApiController {
    protected Request $request;
    private Route $route;

    abstract protected function GET_return() : Response;
    abstract protected function POST_return() : Response;
    abstract protected function PUT_return() : Response;
    abstract protected function PATCH_return() : Response;
    abstract protected function DELETE_return() : Response;

    private function ERROR_return() : Response {
        return new Response(['message' => 'ERROR This HTTP method is not supported yet!'],501);
    }

    public function __construct() {
        $this->request = Request::getRequest();
        $this->route = Router::getRouter()->getRoute();
    }

    public function getView() : Response{
        $methodname = $this->request->getRequestType().'_return';
        if (method_exists($this,$methodname)) {
            return $this->$methodname();
        }
        
        return $this->ERROR_return();
    }
}
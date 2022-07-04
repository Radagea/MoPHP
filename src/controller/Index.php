<?php

namespace App\Src\Controller;

use App\App\View\View;
use App\App\Controller\AbstractController;
use App\App\Errors\MoError;

class Index extends AbstractController {
    public function getView(): View {
        $data["route"] = $_SERVER['DOCUMENT_ROOT'];
        $data["param"] = "Let's Code!";
        $view = new View('index.html',$data);
        return $view;
    }
}
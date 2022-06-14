<?php

namespace App\Src\Controller;

use App\App\Controller\AbstractController;
use App\App\View\View;

class Index extends AbstractController {
    public function getView(): View {
        $data["route"] = $_SERVER['DOCUMENT_ROOT'];
        $view = new View('index.html',$data);
        return $view;
    }
}
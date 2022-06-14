<?php

namespace App\Src\Controller;

use App\App\Controller\AbstractController;
use App\App\View\View;

class Routing extends AbstractController {
    public function getView() : View {
        $data["route"] = $this->getParam('id');
        return new View('index.html',$data);
    }
}
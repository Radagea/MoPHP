<?php

namespace App\Src\Controller\Errors;

use App\App\Controller\AbstractController;
use App\App\View\View;

class Err404 extends AbstractController {
    public function getView(): String {
        return new View('Err404.html');
    }
}
<?php

namespace App\Src\Controller;

use App\App\Controller\AbstractController;
use App\App\View\View;

class Index extends AbstractController {
    public function getView(): String {
        $data["name"] = "József";
        $data["forDatas"] = array();
        $data["route"] = $_SERVER['DOCUMENT_ROOT'];
        $forDatas["href"] = "/";
        $forDatas["name"] = "Home";
        array_push($data["forDatas"],$forDatas);
        $forDatas["href"] = "/routing";
        $forDatas["name"] = "Routing";
        array_push($data["forDatas"],$forDatas);
        $view = new View('index.html',$data);
        return $view;
    }
}
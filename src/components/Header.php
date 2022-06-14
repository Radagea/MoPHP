<?php

namespace App\Src\Components;

use App\App\Components\AbstractComponent;
use App\App\View\CompView;

class Header extends AbstractComponent {
    public function returnComponent() : CompView {
        $datas["forDatas"] = array();
        $forData["href"] = '/';
        $forData["name"] = 'Home';
        array_push($datas["forDatas"],$forData);
        $forData["href"] = '/asd';
        $forData["name"] = '404';
        array_push($datas["forDatas"],$forData);
        $forData["href"] = '/routing/12';
        $forData["name"] = 'Routing';
        array_push($datas["forDatas"],$forData);
        return new CompView('header.html',$datas);
    }
}
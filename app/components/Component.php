<?php

namespace App\App\Components;

use App\App\View\CompView;

class Component {
    private String $name;
    private AbstractComponent $component;
    private CompView $compView;

    public function __construct($name,$file) {
        $this->name = $name;
        $namespace = "App\\Src\\Components\\".$file;
        $this->component = new $namespace();
        $this->compView =$this->component->returnComponent();
    }

    public function returnView() : String {
        $string = $this->compView;
        return $string;
    }

    public function getName() : String {
        return $this->name;
    }
}
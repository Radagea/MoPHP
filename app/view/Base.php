<?php

namespace App\App\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\App\Components\Component;

class Base {
    private Array $datas;
    private String $baseFile;
    private String $baseContent;
    private Environment $twig;
    private Array $components;

    protected function __construct() {
        $this->datas = Array();
        $this->twig = new Environment($this->loader);
        $this->loadSettings();
    }

    private function loadSettings() : Void {
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT']."/../settings.json");
        $arr = json_decode($file,1);
        $this->baseFile = $arr["baseHTML"];
        $this->datas["title"] = $arr["title"];
        $this->datas["baseCSS"] = $arr["baseCSS"];
        $this->datas["favicon"] = $arr["favicon"];
        $this->datas["custom"] = $arr["custom"];
        if ($arr["components"]) {
            $components = array();
            foreach ($arr["components"] as $element) {
                $component = new Component($element["name"],$element["file"]);
                array_push($components,$component);
            }
            $this->components = $components;
        }
        $this->baseContent = $this->twig->render($this->baseFile,$this->datas);
        $this->replaceComponents();
    }

    protected function replaceContent($childContent) : String {
        $this->baseContent = str_replace("{!baseView!}",$childContent,$this->baseContent);
        return $this->baseContent;
    }

    private function replaceComponents() : Void {
        foreach ($this->components as $component) {
            $search = "{!component.".$component->getName()."!}";
            $this->baseContent = str_replace($search,$component->returnView(),$this->baseContent);
        }
    }
}
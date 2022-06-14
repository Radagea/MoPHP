<?php

namespace App\App\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CompView {
    private String $path;
    private Array $datas;
    private Environment $twig;
    
    public function __construct(String $path) {
        $this->path = $path;
        
        $funcNum = func_num_args();

        $datas = array();

        if ($funcNum > 1) {
            $datas = func_get_arg(1);
        }

        $loader = new FilesystemLoader(__DIR__."/../../templates/components");
        $this->twig = new Environment($loader);
        $this->datas = $datas;

    }

    public function __toString() : String {
        return $this->twig->render($this->path,$this->datas);
    }
}
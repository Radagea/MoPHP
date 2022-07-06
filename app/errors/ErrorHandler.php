<?php

namespace App\App\Errors;

use App\App\App;
use App\App\Errors\MoError;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ErrorHandler {
    private MoError $error;
    private FilesystemLoader $loader;
    private Environment $twig;

    public function __construct(MoError $error) {
        $this->error = $error;
        $this->loader = new FilesystemLoader(__DIR__."/GUI");
        $this->twig = new Environment($this->loader);
        if (App::getApp()->getEnvironment() === 'dev') {
            $this->render();
        }
        
    }

    private function getErrorArray() : Array {
        $arr = array();
        $arr['message'] = $this->error->getMessage();
        $arr['file'] = $this->error->getFile();
        $arr['traces'] = $this->error->getTrace();
        $arr['css'] = "styles.css";
        return $arr;
    }

    private function render() : Void {
        $content = $this->twig->render('Error.html',$this->getErrorArray());
        echo $content;
    }
}
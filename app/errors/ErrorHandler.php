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
        } else {
            $this->generateErrorFile();
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

    private function generateErrorFile() : Void {
        $arr = array();
        $fo['time'] = date("Y-m-d h:i:sa");
        $arr['message'] = $this->error->getMessage();
        $arr['file'] = $this->error->getFile();
        $arr['traces'] = $this->error->getTrace();
        $fo['error'] = $arr;
        $temp_array = array();
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../errors.json');
        if (!$file == '') {
            $temp_array = json_decode($file,true);
            array_push($temp_array,$fo);
        }
        $jsonData = json_encode($temp_array);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/../errors.json',$jsonData);
    }
}
<?php

namespace App\App\View;

use App\App\Components\Component;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\App\View\Base;

class View extends Base{
    private string $fileName;
    private Array $datas;
    protected FilesystemLoader $loader;
    private Environment $twig;
    private String $content;
    private Array $components;

    public function __construct($fileName) {
        $this->fileName = $fileName;

        $funcNum = func_num_args();
        $this->datas = array();

        if ($funcNum > 1) {
            $this->datas = func_get_arg(1);
        }
        $this->loader = new FilesystemLoader(__DIR__."/../../templates");
        $this->twig = new Environment($this->loader);
        $this->content = $this->twig->render($this->fileName,$this->datas);
        $this->components = array();
        Parent::__construct();
    }
    
    /**
     * addComponent
     *
     * @param  mixed $name
     * @param  mixed $path by default is in the "App\\Src\\Components namespace"
     * If you want to add, new namespaces you should make a new directory in the components directory and use the directory name in the namespace like:
     * "App\\Src\\Components\\Header you should add the namespace and the file name into the method in the path field, the method call need to be look like this:
     * $view->addComponent('ComponentName','Header\\Header')
     * @return void
     */
    public function addComponent(String $name, String $path) : void {
        $component = new Component($name,$path);
        array_push($this->components,$component);
        $search = "{!component.".$component->getName()."!}";
        $this->content = str_replace($search, $component->returnView(),$this->content);
    }

    public function __toString() : String {
       return $this->replaceContent($this->content);
    }
}
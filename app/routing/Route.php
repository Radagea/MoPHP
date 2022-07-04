<?php
namespace App\App\Routing;


class Route {
    private string $name;
    private Array $paths = [];
    private string $fullPath;
    private string $controller;
    private Array $params = [];
    private Array $datas = [];
    private String|null $navGuard = null;

    
    public function compareWith(Route $that) : bool {
        $this->paths = explode('/',$this->fullPath);
        $comparablePaths = $that->getPaths();

        $egyezes = 0;
        $thatParamNumber = 0;
        $count = 0;

        if (count($this->paths) === count($comparablePaths)) {
            foreach ($comparablePaths as $path) {
                if ($path !== '*!PARAM!*') {
                    if ($path === $this->paths[$count]) {
                       $egyezes++;
                    }
                    else {
                        return false;
                    }
                } else {
                    $thatParamNumber++;
                }
                $count++;
            }
            if ($egyezes+$thatParamNumber == $count) {
                $this->params = $that->getParams();
                $arrayKeys = array_keys($this->params);
                $thatParamNumber = 0;
                $count = 0;

                foreach ($comparablePaths as $path) {
                    if ($path === '*!PARAM!*') {
                        $this->params[$arrayKeys[$thatParamNumber]] = $this->paths[$count];
                        $thatParamNumber++;
                    }
                    $count++;
                }
                return true;
            }
        }
        return false;
    }

    public function addRoute($data) : Void {
        $this->name = $data['name'];
        $this->controller = $data['controller'];
        if (array_key_exists('navGuard',$data)) {
            $this->navGuard = $data['navGuard'];
        } else {
            $this->navGuard = null;
        }
        if (array_key_exists('datas',$data)) {
            if ($data['datas']) {
                $this->datas = $data['datas'];
            }
        }
        $path = $this->pathClearanse($data['path']);
        $this->fullPath = $path;

        $pathArr = explode('/',$path);

        /*
        * Load parameters from the URI
        */
        foreach ($pathArr as $pathElement) {
            if (str_contains($pathElement,'{') && str_contains($pathElement,'}')) {
                $searchFor = array("{","}");
                $paramKey = str_replace($searchFor,"",$pathElement);
                $this->params[$paramKey] = '';
                array_push($this->paths,"*!PARAM!*");
            } else {
                array_push($this->paths,$pathElement);
            }
        }   
        
    }

    private function loadQueries() : Void {
        $questionMarkpos = strpos($this->fullPath,'?');
        $result = substr($this->fullPath,$questionMarkpos,strlen($this->fullPath)); 
        $this->fullPath = substr($this->fullPath,0,$questionMarkpos);
        $result = substr($result,1,strlen($result));                                        //For later I saved the queries into a string where I just need to explode at & after at =
    }

    private function pathClearanse($path) : String {
        if (substr($path,-1) === '/') {
            $path = substr($path,0,-1);
        }
        if (substr($path,0,1) === '/') {
            $path = substr($path,1);
        }
        return $path;
    }
    
    //Getters, Setters 
    //Getters

    public function getName() : String {
        return $this->name;
    }

    public function getFullPath() : String {
        return $this->fullPath;
    }
    
    public function getController() : String {
        return $this->controller;
    }

    public function getPaths() : Array {
        return $this->paths;
    }

    public function getParams() : Array {
        return $this->params;
    }

    public function getDatas() : Array {
        return $this->datas;
    }

    public function getAllowQueries() : bool {
        return $this->allowQueries;
    }

    public function getNavGuard() : String|null {
        return $this->navGuard;
    }

    //Setters

    public function setName(String $name) : Void {
        $this->name = $name;
    }

    public function setFullPath(String $path) : Void {
        $this->fullPath = $this->pathClearanse($path);
        if (str_contains($path,'?')) {
            $this->loadQueries();
        }
    }

    public function setController(String $controller) : Void {
        $this->controller = $controller;
    }

    public function setParams(Array $params) : Void {
        $this->params = $params;
    }

    public function setDatas(Array $datas) : Void {
        $this->datas = $datas;
    }

    public function setNavGuard(String|null $navGuard) : Void {
        $this->navGuard = $navGuard;
    }

}
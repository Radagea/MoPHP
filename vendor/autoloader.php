<?php

spl_autoload_register(function($className) {
    $fontos = explode("\\",$className);
    if ($fontos[0] === 'App' && count($fontos) === 2) {
        $route = "vendor/config";
        $className = $fontos[1];
    } else {
        array_shift($fontos);
        $className = array_pop($fontos);;
        

        $fontos = array_map('strtolower',$fontos);

        $route = implode("/",$fontos);
    }

    
    $className = "../".$route."/".$className.".php";


    include $className;
});

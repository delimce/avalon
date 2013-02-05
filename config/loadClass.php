<?php
//llama dinamicamente a todas las clases siempre y cuando tengan el mismo nombre del archivo .php para php5
//carga las clases de la carpeta core y vendor, las core son las clases hechas por el autor del framework

function __autoload($class) {
    
     $path =  "/../lib/core/";
         
     require_once(__DIR__ . $path . $class . '.php');
     
    
}

?>
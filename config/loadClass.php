<?php
//llama dinamicamente a todas las clases siempre y cuando tengan el mismo nombre del archivo .php para php5
//carga las clases de la carpeta core y vendor, las core son las clases hechas por el autor del framework


//spl_autoload_register(function ($class) {
// 	$path =  "/../lib/core/";
//    include (__DIR__ . $path . $class . '.php');
//});

/*
function __autoload($class) {  
     $path =  "/../lib/core/";         
     require_once(__DIR__ . $path . $class . '.php');
}
*/


function autoload_class_multiple_directory($class_name) 
{

    # List all the class directories in the array.
    $array_paths = array(
        '/../lib/core/', //core lib class
        '/../app/models/', //models class
        '/../lib/vendor/' //vendors lib class
    );

    foreach($array_paths as $path)
    {
        $file = sprintf('%s%s/%s.php', __DIR__, $path, $class_name);
        if(is_file($file)) 
        {
             require_once(__DIR__ . $path . $class_name . '.php');
             break;
        } 

    }
}

spl_autoload_register('autoload_class_multiple_directory');


?>
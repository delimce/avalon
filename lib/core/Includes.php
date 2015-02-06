<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Includes
 *
 * @author luis
 */
class Includes
{
    //put your code here


    /**importa un archivo css del proyecto
     * @param $file
     * @return string
     */
    static public function importCssFromPath($file)
    {

        $path = "@import ";
        $path .= '"' . Front::myUrl($file) . '";';
        return $path;
    }


    /**importa archivo js del proyecto
     * @param $file
     * @return string
     */
    static public function importJsFromPath($file)
    {

        $path = '<script src="';
        $path .= Front::myUrl($file);
        $path .= '" type="text/javascript"></script>';
        return $path;

    }

    /**importa url de javascript
     * @param $url
     * @return string
     */
    static public function importJsurl($url)
    {
        $path = '<script src="';
        $path .= $url;
        $path .= '" type="text/javascript"></script>';
        return $path;

    }


}

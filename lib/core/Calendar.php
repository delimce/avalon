<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DateTime
 *
 * @author luis
 */
class Calendar {

    //put your code here

    private $format; /// solo fecha

    private function setFormat($format) {

        $this->format = $format;
    }
    
    private function getFormat(){
        return $this->format;
    }

    public static function getCurrentDate() {

        $formato = $this->getFormat();
        return @date($formato);
    }

    public static function getCurrentTime() {
        return date("H:i:s");
    }
    
    public static function getDatabaseDateTime(){
        return date("Y-m-d H:i:s");
    }

}

?>

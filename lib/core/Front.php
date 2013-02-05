<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase con ciertas accion de accesibilidad y manejo de componentes html
 *
 * @author luis
 */
class Front {

    public static function myUrl($url = '', $fullurl = false) {

        $s = $fullurl ? WEB_DOMAIN : '';
        $s.=WEB_FOLDER . $url;
        return $s;
    }

    public static function redirect($url) {
        header('Location: ' . Front::myUrl($url));
        exit();
    }

}

?>

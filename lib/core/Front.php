<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase con ciertas accion de accesibilidad y manejo de componentes html
 *
 */
class Front {

    /**
     * funcion para llamar la url de los recursos y paginas
     */
    public static function myUrl($url = '', $fullurl = true) {

        $s = $fullurl ? WEB_DOMAIN : '';
        $s.=WEB_FOLDER . $url;
        return $s;
    }

    /**
     * funcion para redireccionar
     * @param type $url
     */
    public static function redirect($url) {
        header('Location: ' . Front::myUrl($url));
        exit();
    }

    /**
     * funcion para redireccionar al parent principal
     * @param type $url
     */
    public static function redirectTop($url) {
        echo '<script type="text/javascript">';
        echo 'top.location.href="' . Front::myUrl($url) . '"';
        echo '</script>';
        exit();
    }


    /**
     * habilita el uso de CORS
     * CORS (Cross-Origin-Resource-Sharing) es un mecanismo o protocolo de seguridad que permite hacer peticiones de forma
     * asincrónica a través de Javascript desde un servidor a otro,
     * con el fin de obtener información o recursos para usar en el servidor de origen (que realiza la petición original).
     * Si bien por defecto los navegadores rechazan este tipo de peticiones, a través de CORS es factible tanto habilitarlas
     * como especificar que tipo de peticiones y desde donde son permitidas.
     */
    public static function corsEnable(){

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
    }




}

?>

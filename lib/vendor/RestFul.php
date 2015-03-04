<?php

/**
 * Created by PhpStorm.
 * User: delimce
 * Date: 19/02/2015
 * Time: 10:10 AM
 */
class RestFul
{

    private $url_elements; ///uri
    private $verb; ///methods
    private $headers; ///headers request http
    private $format; //format sended
    private $contentType;
    public $responseCodes = array("401" => "HTTP/1.0 401 Unauthorized", "403" => "HTTP/1.0 403 Forbidden");


    public function __construct()
    {
        $this->verb = $_SERVER['REQUEST_METHOD']; ///methods
        $this->url_elements = explode('/', $_SERVER['REQUEST_URI']);
        $this->headers = apache_request_headers();

        return true;
    }

    /**
     * @return array
     */
    public function getUrlElements()
    {
        return $this->url_elements;
    }


    /**
     * print Uri Elements
     */
    public function printUrlElements()
    {
        print_r($this->url_elements);
    }


    /**
     * @return mixed
     */
    public function getVerb()
    {
        return $this->verb;
    }


    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**trae el valor del header http solicitado
     * @param $key
     * @return mixed
     */
    public function getHeader($key)
    {
        return $this->headers[$key];
    }


    /**
     * habilita el uso de CORS
     * CORS (Cross-Origin-Resource-Sharing) es un mecanismo o protocolo de seguridad que permite hacer peticiones de forma
     * asincrónica a través de Javascript desde un servidor a otro,
     * con el fin de obtener información o recursos para usar en el servidor de origen (que realiza la petición original).
     * Si bien por defecto los navegadores rechazan este tipo de peticiones, a través de CORS es factible tanto habilitarlas
     * como especificar que tipo de peticiones y desde donde son permitidas.
     */
    public function enableCORS()
    {

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }

        if ($this->verb == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
    }

    /**
     * muestra el header segun el codigo de response http
     * @param $code
     */
    public function getResponseCode($code)
    {

        if (array_key_exists ($code,$this->responseCodes)) {
            $response = $this->responseCodes[$code];
            header($response);
        }


    }


    /**hace un render de la estructura de datos en formato Json
     * @param $content
     */
    public function jsonRender($content)
    {
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($content);
    }


}
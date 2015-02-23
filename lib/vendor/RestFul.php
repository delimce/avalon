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
    private $parameters;  //params
    private $format; //format sended
    private $contentType;


    public function __construct()
    {
        $this->verb = $_SERVER['REQUEST_METHOD']; ///methods
        $this->url_elements = explode('/', $_SERVER['REQUEST_URI']);
        $this->parseIncomingParams();
        // initialise json as default format
        //   $this->format = 'html';
        if (isset($this->parameters['format'])) {
            $this->format = $this->parameters['format'];
        }
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
     * print parameters
     */
    public function printParameters()
    {
        print_r($this->$parameters);
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
    public function getParameters()
    {
        return $this->parameters;
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


    public function parseIncomingParams()
    {
        $parameters = array();

        // first of all, pull the GET vars
        if (isset($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $parameters);
        }

        // now how about PUT/POST bodies? These override what we got from GET
        $body = file_get_contents("http://localhost/vconsole");
        $content_type = false;
        if (isset($_SERVER['CONTENT_TYPE'])) {
            $content_type = $_SERVER['CONTENT_TYPE'];
        }
        switch ($content_type) {
            case "application/json":
                $body_params = json_decode($body);
                if ($body_params) {
                    foreach ($body_params as $param_name => $param_value) {
                        $parameters[$param_name] = $param_value;
                    }
                }
                $this->format = "json";
                break;
            case "application/x-www-form-urlencoded":
                parse_str($body, $postvars);
                foreach ($postvars as $field => $value) {
                    $parameters[$field] = $value;

                }
                $this->format = "html";
                break;
            default:
                // we could parse other supported formats here
                break;
        }
        $this->parameters = $parameters;
        $this->contentType = $content_type;
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



    /**hace un render de la estructura de datos en formato Json
     * @param $content
     */
    public function jsonRender($content) {
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($content);
    }


}
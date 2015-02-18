<?php

/**
 * Created by delimce
 * User: delimce
 * Date: 7/24/12
 * Time: 5:22 PM
 * configuracion inicial para el framework Avalon
 */
/*
 * notacion de variables de configuracion del framework Avalon
 */

//===============================================
// debug Settings
//===============================================
define(APP_PATH, 'app/'); //with trailing slash pls
define(WEB_FOLDER, '/avalon/'); //CARPETA CONTENEDORA
//===============================================
// Other Settings
//===============================================
define(WEB_DOMAIN, 'http://userver'); //with http:// and NO trailing slash pls
define(VIEW_PATH, 'app/views/'); //with trailing slash pls
define(LAYOUT_PATH, 'app/layouts/'); //with trailing slash pls
define(AV_defaultTimeZone,"America/Caracas"); //////zona horaria por defecto para la aplicacion
define(AV_defaultDs, "vconsole"); /////Data source por defecto. segun los data sources creados en el archivo dataSources.php
define(AV_noDsFound, "DataSource doesn't exist!");
define(AV_errorPath, "error/404"); ///ruta por defecto 404
define(AV_langPath, "lang/spanish.php"); ///archivo de lenguaje

///class library includes (No cambiar)
include_once(dirname(__FILE__) . "/" . "loadClass.php");
include_once (dirname(__FILE__) . "/" . "avalonMvc.php");
include_once (dirname(__FILE__) . "/" . "includes.php");
include_once(dirname(__FILE__) . "/" . "dataSources.php");

//===============================================
// errors handlers
//===============================================

ini_set('display_errors', 'Off');
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

////manejo de errores (opcional, la variable display errors deberia estar apagada para producción)
include_once(dirname(__FILE__) . "/" . "errorHandler.php");








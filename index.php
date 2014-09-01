<?php
/**
 * Created by delimce
 * User: luis
 * Date: 7/18/12
 * Time: 6:39 PM
 * To change this template use File | Settings | File Templates.
 */

include_once 'config/setup.php';
include_once AV_langPath; ///language

Security::initSession();
date_default_timezone_set(AV_defaultTimeZone); //set timezone

//===============================================
// Start the controller
//===============================================
$controller = new Controller(APP_PATH . 'controllers/', WEB_FOLDER, 'main', 'index');


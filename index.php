<?php

include_once 'config/setup.php';
include_once AV_langPath; ///language

Security::initSession();
date_default_timezone_set(AV_defaultTimeZone); //set timezone

//===============================================
// Start the controller
//===============================================
$controller = new Controller(APP_PATH . 'controllers/', WEB_FOLDER, 'main', 'index');


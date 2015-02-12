<?php
/**
 * Created by PhpStorm.
 * User: delimce
 * Date: 12/02/2015
 * Time: 02:31 PM
 */

$level = E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED;

set_error_handler('myErrorHandler', $level);

function myErrorHandler($errno, $message, $file, $line)
{

    http_response_code(500);
    error_log("Error $errno : $message in $file on line $line", 0);

    $logger = new Log("core");
    $logger->error("Error $errno : $message in $file on line $line");

    Front::redirect("error/errorContactUs"); ///redirect


}


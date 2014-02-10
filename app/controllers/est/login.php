<?php

function _login() {


    $code = Form::getVar("code", $_POST); ///para seleccionar datasource
    $token = Form::getVar("token", $_POST);
    $user = Form::getVar("usuario", $_POST);
    $clave = Form::getVar("clave", $_POST);

    $cliente = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $db = new ObjectDB($code);
    $db->setSql("call sp_est_login('$user','$clave','$cliente','$ip')");
    $valores = $db->vectorDb();

    $db->close();

    print json_encode($valores);
}

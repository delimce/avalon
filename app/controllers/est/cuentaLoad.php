<?php

function _cuentaLoad() {


    $userId = Form::getVar("id", $_POST);
    
    $code = Form::getVar("code", $_POST);
    
    $db = new ObjectDB($code);
    $db->setSql("call sp_est_getdata($userId)");
    $valores = $db->vectorDb();
    
    $db->close();
    
    
    print json_encode($valores);
}

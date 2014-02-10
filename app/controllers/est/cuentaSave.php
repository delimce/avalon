<?php

function _cuentaSave() {


    $id = Form::getVar("ide", $_POST);
    $clave = Form::getVar("clave", $_POST);
    
    $code = Form::getVar("code", $_POST);

    $db = new ObjectDB($code);
        
    ////determinar cambio de clave
    $db->setTable("tbl_estudiante");
    $db->getTableFields("pass", "id = $id");
    if($clave!=$db->getField("pass"))
        $_POST["r0pass"] = md5($clave);
    ////////////
    
    $db->dataUpdate("r", "0", "tbl_estudiante", $_POST, "id = $id");
   
    $db->close();
    
    echo 'ok';
    

}

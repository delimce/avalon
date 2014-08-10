<?php

function _estudianteByNumber($cedula = false) {
    
  //  $cedula = Form::getVar("cedula", $_POST);
        
   // $code = Form::getVar("code", $_POST);
    $code = "android";

    $db = new ObjectDB($code);
    
    $db->setTable("tbl_estudiante");
    $db->setFields("id,nombre,apellido,foto,sexo,fecha_nac,telefono_p,telefono_c,email,msn,twitter,user,pass,fecha_creado,activo","id_number = '$cedula'");
    $datos = $db->vectorDb();
    
    $db->close();
    
    print json_encode($datos);
    
    
}
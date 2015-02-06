<?php
//Procesa la petición de cambio de contraseña
function _verificarPeticion() {

    ////capturando variables
    $sesion   = Form::getVar("clave", $_POST);
    $password = Form::getVar("password1", $_POST);

    $peticion = new VbrUsuarioRecordarClave();
    
    $peticion->validarSolicitud($sesion);

    $usuarioId = $peticion->getUsuarioId();

    $respuesta = 0;
    if ($usuarioId > 0) {
        $usuario = new VbrUsuarioModel();
        $usuario->getDataById($usuarioId);
        $usuario->changePassOlvido($usuario->getId(), $usuario->getEmail(), $password, $sesion);
        $respuesta = 1;
    } 
    
    print $respuesta;
    
}

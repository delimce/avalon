<?php
//Procesa la petición de cambio de contraseña
function _validarPeticionOlvido() {

    ////capturando variables
    $email = Form::getVar("emailolvido", $_POST);

    $user = new VbrUsuarioModel();

    $user->setEmail($email);
    //$user->setUsuario($usuario);
    //$user->setPassword($pass);
    
    /////datos de acceso remoto
    $ip = $_SERVER['REMOTE_ADDR'];
    $cliente = $_SERVER['HTTP_USER_AGENT'];

    $result = 0; ///no esta autenticado

    if ($user->validarEmailOlvido($ip,$cliente)) { ///si es autenticado
        if ($user->isActivo()) { ///y esta activo
            $result = 1; ///autenticado y activo            
        } else {
            $result = 2; //no esta activo
        }
    }

    print $result;
}

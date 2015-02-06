<?php

function _validarLogin() {

    ////capturando variables
    $usuario = Form::getVar("usuario", $_POST);
    $pass = Form::getVar("password", $_POST);

    $user = new VbrUsuarioModel();

    $user->setUsuario($usuario);
    $user->setPassword($pass);
    
    /////datos de acceso remoto
    $ip = $_SERVER['REMOTE_ADDR'];
    $cliente = $_SERVER['HTTP_USER_AGENT'];

    $result = 0; ///no esta autenticado

    if ($user->validarLogin($ip,$cliente)) { ///si es autenticado
        if ($user->isActivo()) { ///y esta activo
            $result = 1; ///autenticado y activo
            Security::setUserID($user->getId());
            Security::setUserName($user->getNombre() . ' ' . $user->getApellido());
            Security::setUserProfileID($user->getPerfilId());
            Security::setUserDomainID($user->getEmpresaId()); /////la empresa del usuario
            Security::setUserProfileName($user->getPerfil());
            ////perfil nombre???
        } else {
            $result = 2; //no esta activo
        }
    }

    print $result;
}

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe para el manejo de sessiones y seguridad
 *
 * @author luis
 */
class Security
{

    //put your code here


    /*
     * inicializa la sesion
     */
    static public function initSession($id = false)
    {
        if ($id)
            session_id($id);
        session_start();
    }

    static public function getUserID()
    {
        return $_SESSION["USERID"];
    }

    static public function setUserID($userID)
    {
        $_SESSION["USERID"] = $userID;
    }

    static public function getUserName()
    {
        return $_SESSION["USERNAME"];
    }

    static public function setUserName($userName)
    {
        $_SESSION["USERNAME"] = $userName;
    }

    static public function getUserProfileID()
    {
        return $_SESSION["USERPROFILE"];
    }

    static public function setUserProfileID($userProfile)
    {
        $_SESSION["USERPROFILE"] = $userProfile;
    }

    static public function getUserProfileName()
    {
        return $_SESSION["USERPROFILENAME"];
    }

    static public function setUserProfileName($userProfileName)
    {
        $_SESSION["USERPROFILENAME"] = $userProfileName;
    }

    /////dominio o empresa asociada
    static public function getUserDomainID()
    {
        return $_SESSION["USERDOMAIN"];
    }

    static public function setUserDomainID($userDomainID)
    {
        $_SESSION["USERDOMAIN"] = $userDomainID;
    }

    /**
     * trae el perfil y el id del usuario logueado
     * @return type
     */
    static public function getCreador()
    {

        return $_SESSION["USERPROFILENAME"] . '_' . $_SESSION["USERID"];
    }


    /**devuelve el filtro para los sp consulta por id de empresa o id de usuario
     * @return mixed
     */
    static public function getFilterparams()
    {
        $params['filter'] = ($_SESSION["USERDOMAIN"] != "") ? 'empresa_id' : 'usuario_id';
        $params['value'] = ($_SESSION["USERDOMAIN"] != "") ? $_SESSION["USERDOMAIN"] : $_SESSION["USERID"];
        return $params;
    }


    /*
     * valida que la session este activa
     */

    static public function sessionActive()
    {

        $user = Security::getUserID();

        if (empty($user)) {
            Front::redirect("main/login");
        }
    }

    /*
     * function que cierra sesion y va a la pagina de inicio
     */

    static public function logOff()
    {

        Security::destroySession();
        Front::redirect("main/login");
    }

    /**
     * acceso restringido
     */
    static public function noAccessRedirect()
    {
        Front::redirect("error/noAccess");
    }

    /**
     * verifica si el usuario tiene permiso para entrar al modulo (en caso de que no sea administrador)
     * se debe pasar el nombre del modulo en cuestion (acepta varios perfiles separados por ,)
     */
    static public function hasPermissionTo($profile)
    {

        $arrayProfile = explode(",", strtolower($profile));
        Security::sessionActive();

        if (!in_array(strtolower(Security::getUserProfileName()), $arrayProfile)) {
            // Security::logOff();
            Security::noAccessRedirect(); ///envio a pagina de no acceso
        }
    }


    /**verifica si la empresa o el usuario tiene permiso para operar sobre informacion privada
     * @param $domain
     * @param bool $user
     */
    static public function hasPermissionToActions($domain, $user = false)
    {
        $enter = 0;
        if ($domain > 0 && Security::getUserDomainID() == $domain) { ///pertenece a la empresa, distinto de vacia
            $enter++;
        } else if ($user)  {

            if (Security::getUserID() == $user) ///pertenece al usuario
                $enter++;
        }
        if ($enter == 0) Security::noAccessRedirect(); ///envio a pagina de no acceso

    }

    /**
     * verifica si el perfil del usuario es igual al solicitado
     * @param type $profile
     * @return type
     */
    static public function isProfileName($profile)
    {

        return (Security::getUserProfileName() == $profile) ? true : false;
    }

    /**
     * para revisar si hay una session iniciada
     */
    static public function isSessionActive()
    {

        return isset($_SESSION["USERID"]) ? true : false;
    }


    /**determina si la variable de sesion esta activa
     * @param $var
     * @return bool
     */
    static public function isRegistered($var)
    {
        if (isset($_SESSION[$var]))
            return true;
        else
            return false;
    }




    static public function getCurrentVersion(){


        if(!self::isRegistered("APPVERSION")){
            $pathVersion = __DIR__ ."/../../config/version.info";
            $file = new File($pathVersion);
            $_SESSION["APPVERSION"] = $file->readLastLine();
        }

        return $_SESSION["APPVERSION"];
    }

    /*
     * para crear una variable de session
     */

    static public function setSessionVar($var, $value)
    {

        $_SESSION[$var] = $value;
    }


    static public function getSessionVar($var)
    {

        return $_SESSION[$var];
    }

    static public function unsetSessionVar($var)
    {
        unset($_SESSION[$var]);
    }

    static public function destroySession()
    {

        session_destroy();
    }

}

?>

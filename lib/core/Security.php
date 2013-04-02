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
class Security {

    //put your code here


    /*
     * inicializa la sesion
     */
    static public function initSession($id = false) {
        if ($id)
            session_id($id);
        session_start();
    }

    static public function getUserID() {
        return $_SESSION["USERID"];
    }

    static public function setUserID($userID) {
        $_SESSION["USERID"] = $userID;
    }

    static public function getUserName() {
        return $_SESSION["USERNAME"];
    }

    static public function setUserName($userName) {
        $_SESSION["USERNAME"] = $userName;
    }

    static public function getUserProfileID() {
        return $_SESSION["USERPROFILE"];
    }

    static public function setUserProfileID($userProfile) {
        $_SESSION["USERPROFILE"] = $userProfile;
    }

    static public function getUserProfileName() {
        return $_SESSION["USERPROFILENAME"];
    }

    static public function setUserProfileName($userProfileName) {
        $_SESSION["USERPROFILENAME"] = $userProfileName;
    }

    ////opcional para la cuenta

    static public function setCuentaID($cuenta) {
        $_SESSION["CUENTAID"] = $cuenta;
    }

    static public function getCuentaID() {
        return $_SESSION["CUENTAID"];
    }

    /*
     * valida que la session este activa
     */

    static public function sessionActive() {

        $user = Security::getUserID();

        if (empty($user)) {
            Front::redirect("main/login");
        }
    }

    /*
     * function que cierra sesion y va a la pagina de inicio
     */

    static public function logOff() {

        Security::destroySession();
        Front::redirect("main/login");
    }

    /*
     * verifica si es el administrador del sistema quien ingresa, basado en el perfil_id requerido
     */

    static public function isSessionAdmin($adminValue) {

        Security::sessionActive();
        if (Security::getUserProfileID() != $adminValue) {
            Security::logOff();
        }
    }

    /*
     * verifica si el usuario tiene permiso para entrar al modulo (en caso de que no sea administrador)
     * se debe pasar el id del modulo en cuestion
     */

    static public function hasPermissionTo($modulo) {

        Security::sessionActive();


        $db2 = new ObjectDB();
        $db2->setTable("tbl_permiso");
        $db2->getTableFields("modulo_id", "usuario_id = " . Security::getUserID() . " and cuenta_id = " . Security::getCuentaID() . " and modulo_id = $modulo");
        $db2->close();
        if ($db2->getNumRows() == 0)
            Front::redirect("error/noAccess");
    }

    /*
     * para revisar si hay una session iniciada
     */

    static public function isSessionActive() {

        return isset($_SESSION["USERID"]) ? true : false;
    }

    /*
     * para crear una variable de session
     */

    static public function setSessionVar($var, $value) {

        $_SESSION[$var] = $value;
    }

    static public function getSessionVar($var) {

        return $_SESSION[$var];
    }

    static public function unsetSessionVar($var) {
        unset($_SESSION[$var]);
    }

    static public function destroySession() {

        session_destroy();
    }

}

?>

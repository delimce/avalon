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
    static public function initSession($id=false) {
        if($id)
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

    static public function getUserProfile() {
        return $_SESSION["USERPROFILE"];
    }

    static public function setUserProfile($userProfile) {
        $_SESSION["USERPROFILE"] = $userProfile;
    }

    /*
     * valida que la session este activa
     */

    static public function sessionActive() {

        if (empty($_SESSION["USERID"])) {

            $out = new Front();

            $out->redirect("main/login");
        }
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

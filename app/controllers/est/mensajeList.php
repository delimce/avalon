<?php

function _mensajeList() {

    $userId = Form::getVar("id", $_POST);

    //$code = Form::getVar("code", $_POST);
    $code = "android";

    $db = new ObjectDB($code);

    $db->setSql("call sp_est_msgList($userId)");

    $valores = $db->getMatrixDb();

       
    print json_encode($valores);

    $db->close();
}
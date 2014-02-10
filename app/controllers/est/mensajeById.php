<?php

function _mensajeById() {

    $userId = Form::getVar("id", $_POST);
    $msgId = Form::getVar("msgId", $_POST);



    $code = Form::getVar("code", $_POST);

    $db = new ObjectDB($code);

    $db->setSql("call sp_est_msgById($userId,$msgId)");

    $valores = $db->vectorDb();

    print json_encode($valores);

    $db->close();
}
<?php

function _mensajeDelete() {


    $userId = Form::getVar("id", $_POST);
    $msgId = Form::getVar("msgId", $_POST);

    $code = Form::getVar("code", $_POST);

    $db = new ObjectDB($code);

    ////determinar cambio de clave
    $db->setTable("tbl_mensaje_est");
    $db->deleteWhere("id = $msgId");

    $db->close();

    echo 'ok';
}

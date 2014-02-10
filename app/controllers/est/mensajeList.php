<?php

function _mensajeList() {

    $userId = Form::getVar("id", $_POST);

    $code = Form::getVar("code", $_POST);

    $db = new ObjectDB($code);

    $db->setSql("call sp_est_msgList($userId)");

    $valores = $db->matrixDb();

    print json_encode($valores);

    $db->close();
}
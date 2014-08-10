<?php

function _estudianteListByCurso($curso = false) {

    //  $cedula = Form::getVar("cedula", $_POST);
    // $code = Form::getVar("code", $_POST);
    $code = "android";

    $db = new ObjectDB($code);

    $db->setSql(FactoryDao::getEstListByCurso($curso));

    $lista = $db->getMatrixDb();

    $db->close();

    print json_encode($lista);
}

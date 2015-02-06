<?php

function _index() {

    ////validando q se haya iniciado sesion
    Security::sessionActive();

    ////////lista de inmuebles
    $inmuebles = VbrTipoPropiedadModel::getActiveList();
    Security::setSessionVar("INMENU",$inmuebles);


    /////dashboard

    $data['siteTitle'] = 'inicio';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'main/index_view.php');
    View::do_dump(LAYOUT_PATH . 'layoutVconsole.php', $data);
}

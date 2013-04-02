<?php

function _noAccess() {

    Security::sessionActive();

    $data['siteTitle'] = 'Acceso denegado';
    $data['homeButton'] = 'main/index';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'error/noAccess.php');
    View::do_dump(LAYOUT_PATH . 'layoutMobile.php', $data);
}
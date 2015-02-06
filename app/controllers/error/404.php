<?php

function _404($url=false) {

    Security::sessionActive();

    $data['siteTitle'] = 'Recurso no encontrado';
    $data['homeButton'] = 'main/index';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'error/404.php');
    View::do_dump(LAYOUT_PATH . 'layoutModal.php', $data);
}
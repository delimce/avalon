<?php

function _index() {

    $data['siteTitle'] = 'Cursonet';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'main/index_view.php');
    View::do_dump(LAYOUT_PATH . 'layoutMobile.php', $data);
}
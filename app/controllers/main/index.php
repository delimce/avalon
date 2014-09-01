<?php

function _index() {

    $data['siteTitle'] = 'Avalon MVC';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'main/index_view.php');
    View::do_dump(LAYOUT_PATH . 'sample.php', $data);
}
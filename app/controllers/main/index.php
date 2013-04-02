<?php

function _index() {

    Security::sessionActive();

    $db = new ObjectDB();

    $db->setSql(FactoryDao::getModuleListLobi());
    $db->executeQuery();

    $db->freeAndClose();

    $data['siteTitle'] = 'Menú Principal';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'main/index_view.php', array("modulos" => $db));
    View::do_dump(LAYOUT_PATH . 'layoutLogin.php', $data);
}
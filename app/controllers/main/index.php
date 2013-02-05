<?php
function _index()
{

    Security::sessionActive();
    
    $menu = new BusinessMenu();

    $data['menuBar'] = $menu->showMenu();/// modulos accesibles por el usuario
    $data['siteTitle'] = Security::getSessionVar("site_title");
    $data['subTitle']  = Security::getSessionVar("site_desc");
    $data['body'][]    = View::do_fetch(VIEW_PATH . 'main/index_view.php');
    View::do_dump(LAYOUT_PATH . 'layout1.php', $data);
}
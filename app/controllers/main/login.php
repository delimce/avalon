<?php

function _login() {

    $perfil = new VbrPerfilModel();
    
       
    $data['siteTitle'] = LANG_adminSystem;
    $data['body'][] = View::do_fetch(VIEW_PATH . 'main/login_form.php');
    View::do_dump(LAYOUT_PATH . 'login.php', $data);
}

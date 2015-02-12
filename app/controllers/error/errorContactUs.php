<?php
function _errorContactUs()
{
    $data['siteTitle'] = 'Error Inesperado';
    $data['body'][] = View::do_fetch(VIEW_PATH . 'error/contactUs.php');
    View::do_dump(LAYOUT_PATH . 'layoutModal.php', $data);

}
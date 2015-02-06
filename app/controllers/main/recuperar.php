<?php

function _recuperar($sesion = false) {

	$validacion = new VbrUsuarioRecordarClave();

	$validacion->validarSolicitud($sesion);

	$usuarioId = $validacion->getUsuarioId();
   
    $data['siteTitle'] = LANG_adminSystem;
    $data['body'][] = View::do_fetch(VIEW_PATH . 'main/recuperar.php', 
    					array("sesion" => $sesion, "usuario" => $usuarioId));
    View::do_dump(LAYOUT_PATH . 'recuperar.php', $data);
}
<?php
//Procesa la petición de cambio de contraseña
function _enviarEmail() {

    ////capturando variables
    $email = Form::getVar("emailolvido", $_POST);

    $usuario = new VbrUsuarioModel();

    $usuario->getDataByEmail($email);

    $idUsuario    = $usuario->getId();
    $nombre       = $usuario->getNombre();
    $apellido     = $usuario->getApellido();
    $emailUsuario = $usuario->getEmail();

    $peticion = new VbrUsuarioRecordarClave();
    $peticion->setUsuarioId($idUsuario);
    $peticion->crearSolicitud($idUsuario);

    $sesion = $peticion->getSesion();

    $mensajetexto       = 'Solicitud de generación de contraseña';
    $asunto             = 'vBrokers Procesamiento de Contraseña';
    $nombreremitente    = 'vBrokers';
    $emailremitente     = 'soporte@vbrokers.com';
    $nombredestinatario = $nombre." ".$apellido;
    $emaildestinatario  = $email;

    $message  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
    $message .= '<html><head>';
    $message .= '<head>';
    $message .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
    $message .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $message .= '<title>vBrokers</title>';
    $message .= '</head>';
    $message .= '<body>';
    $message .= '<div align="left">';
    //$message .= '<strong>Hola '.$nombredestinatario.'</strong>';
    $message .= '</div>';
    $message .= '<br />';
    $message .= '<p>Hemos recibido una solicitud para reestablecer tu contrase&ntilde;a de acceso a ';
    $message .= 'vBrokers, para ejecutarla haz click en el siguiente enlace:</p>';
    $message .= '<br />';
    $message .= '<p>Tiene 24 horas para utilizar enlace, posterior a ese tiempo de hacer una nueva solicitud.</p>';
    $message .= '<a href="'.Front::myUrl('main/recuperar/'.$sesion).'">'.Front::myUrl('main/recuperar/'.$sesion).'</a>';
    $message .= '<br />';
    $message .= '<p>En caso que no hayas solicitado el reestablecimiento de tu contrase&ntilde;a, te pedimos que ignores este mensaje el cual caducar&aacute; en las proximas 24 horas.</p>';
    $message .= '<br />';
    $message .= '<p>Atentamente,</p>';
    $message .= '<br />';
    $message .= '<p><strong>vBrokers Support Team</strong></p>';
    $message .= "</body></html>";
    $message .= '<div align="left">';
    //$message .= '<img src="http://mipsicomama.com/images/temas/tema15img1.jpg" alt="mipsicomama.com" />';
    $message .= '</div>';

    $correos = new Email($message, $mensajetexto, $asunto, $nombreremitente, $emailremitente, $nombredestinatario, $emaildestinatario);
    $result = $correos->send();

    print $result;
    
}

<?php

function _login()
{

    $db = new ObjectDB();

    $user = Form::getVar("username", $_POST);
    ////logueandose
    if (!empty($user)) {

        $pass = Form::getVar("pass", $_POST);

        $db->setTable("tbl_usuario");
        $encript = base64_encode($pass);
        $db->getTableFields("id,perfil_id,nombre", "user = '$user' and password = '$encript'");
        
        if ($db->getNumRowsRequested() > 0) {
            
            ////guardando variables de sesion 
            Security::setUserID($db->getField("id"));
            Security::setUserName($db->getField("nombre"));
            Security::setUserProfile($db->getField("perfil_id"));
            
            /////busca los modulos que tengo acceso segun el perfil
            $db->setSql(FactoryDao::getModuleIds(Security::getUserProfile()));
            $modulos = $db->getArrayDb();
            Security::setSessionVar("user_modules", $modulos);
            
                 
            echo $db->getField("id");
            
            /////revisa los permisos de aprobar palabras y administrar foros
            $idadmin = Security::getUserProfile();
            $db->setTable("tbl_perfil");
            $db->getTableFields("aprueba,discusion", "id=$idadmin");
            
            Security::setSessionVar("is_aprobador", $db->getField("aprueba"));
            Security::setSessionVar("is_discutidor", $db->getField("discusion"));
            //////
            
        } else {
            echo 0;
        }
        
       
    } else { ///no se ha logueado
        $db->setTable("tbl_setup");
        $db->getTableFields("tituloweb,descripcionweb");


        ////guardando variables de sesion de descripcion del sitio
        Security::setSessionVar("site_title", $db->getField("tituloweb"));
        Security::setSessionVar("site_desc", $db->getField("descripcionweb"));


        $data['siteTitle'] = Security::getSessionVar("site_title");
        $data['subTitle'] = Security::getSessionVar("site_desc");
        $data['body'][] = '<h2>Acceso al Administrador</h2><br />';
        $data['body'][] = View::do_fetch(VIEW_PATH . 'main/login_form.php', array('username' => $username));
        $data['body'][] = '<p id="msg">Ud debe introducir sus credenciales de acceso para continuar con su visita</p>';
        View::do_dump(LAYOUT_PATH . 'layout1.php', $data);
    }

    $db->close(); //cerrando conexion
}
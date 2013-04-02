<?php

function _login() {


    $user = Form::getVar("user", $_POST);
    ////logueandose
    if (!empty($user)) {

        $db = new ObjectDB();

        $pass = Form::getVar("clave", $_POST);
        $nombre = Form::getVar("empresa", $_POST);


        ////validar que introdujo bien la empresa
        $db->setSql(FactoryDao::getIdEmpresa($nombre));
        $db->getResultFields();
        $cuenta = $db->getField("idEmp");

        if ($cuenta > 0) {

            $db->setSql(FactoryDao::getLoginData($cuenta, $user, $pass));
            $db->getResultFields();

            if ($db->getNumRows() > 0) {

                ////guardando variables de sesion 
                Security::setUserID($db->getField("id"));
                Security::setUserName($db->getField("nombre"));
                Security::setUserProfileID($db->getField("perfil_id"));
                Security::setUserProfileName($db->getField("profile"));
                Security::setCuentaID($cuenta);
                Security::setSessionVar("CUENTANAME", $db->getField("cuenta"));

                echo $db->getField("id");

                //////
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }

        $db->close(); //cerrando conexion
    } else { ///no se ha logueado
        $form = new Form();

        // $empresas = $form->dbComboMobile("empresa", FactoryDao::getEmpresas(), "nombre", "id");

        $data['siteTitle'] = 'Sistema de pedidos';
        $data['body'][] = View::do_fetch(VIEW_PATH . 'main/login_form.php', array('empresa' => $empresas));
        View::do_dump(LAYOUT_PATH . 'layoutMobile.php', $data);
    }
}
<?php

/**
 * Created by IntelliJ IDEA.
 * User: delimce
 * Date: 7/18/12
 * Time: 9:52 PM
 * To change this template use File | Settings | File Templates.
 */
class FactoryDao {

    /**
     * para hacer login de usuario al iniciar programa
     * @param type $user
     * @param type $pass
     * @return type
     */
    static public function getLoginData($user, $pass) {

        return "call sp_login('$user', '$pass')";
    }

    
    static public function getEstListByCurso($curso){
        
        return "call sp_est_listByCurso('$curso') ";
    }
    
    
    /**
     * trae la lista de distribuidores
     * @return string
     */
    static public function distribuidorList() {

        return "call sp_distribuidor_list() ";
    }

    /**
     * trae la lista de clientes
     * @param type $franquicia
     * @return type
     */
    static public function clienteList($franquicia) {
        return "call sp_cliente_list($franquicia) ";
    }

    /**
     * trae la lista de gsmKey
     * @return string
     */
    static public function gsmKeyList() {
        return "call sp_gsmkey_list() ";
    }

    /**
     * trae la lista de zonas
     * @return string
     */
    static public function zonasList() {
        return "call sp_zonas_list() ";
    }

    /**
     * trae lista de edificios
     * @param type $franquicia
     * @return type
     */
    static public function edificioList($franquicia) {

        return "call sp_edificio_list($franquicia) ";
    }

    /**
     * trae la lista de portones por franquicia
     * @param type $franquicia
     * @return type
     */
    static public function portonList($franquicia) {

        return "call sp_porton_list($franquicia) ";
    }

    /**
     * trae los datos del porton segun el id y la franquicia
     * @param type $idporton
     * @param type $idfrank
     */
    static public function portonGetById($idporton, $franquicia) {

        return "call sp_porton_getdatabyid($idporton , $franquicia) ";
    }

    /**
     * trae la lista de los administradores de edificios por franquicia
     * @param type $franquicia
     * @return type
     */
    static public function adminEdifList($franquicia) {


        return "call sp_adminEdif_list($franquicia) ";
    }

    /**
     * trae la lista de edificios por franquicia id, si se le pasa el id del admin trae los del administrador
     * @param type $franquicia
     * @return type
     */
    static public function getEdifByFranquicia($franquicia, $adminId) {

        return "call sp_edifbyfranq_list($franquicia,$adminId) ";
    }

    
    /**
     * trae una lista de gsmkey sin usar para asignarle al porton (por id de edificio)
     * @param type $edifid
     * @return type
     */
    static public function getGsmKeybyEdif($edifid) {

        return "call sp_edifgsmkey_list($edifid) ";
    }

    
    /**
     * inserta un gsmkey para un porton
     * @param type $portonId
     * @param type $gsmkeyId
     * @return type
     */
     static public function insertPortonGsmKey($portonId, $gsmkeyId) {

        return "call sp_insert_porton_gsmkey($portonId,$gsmkeyId) ";
    }
    
    
    
    static public function getUsersList($myId = false) {

        $query = "SELECT
                u.id,
                u.nombre,
                u.email,
                u.telefono1,
                u.user,
                u.password,
                u.perfil_id,
                p.nombre AS perfil,
                u.activo
                FROM
                tbl_usuario AS u
                INNER JOIN tbl_perfil AS p ON u.perfil_id = p.id
                where u.borrado=0";

        if ($myId)
            $query.= " and u.id = $myId";
        else
            $query.= " and u.id != " . Security::getUserID();

        $query.=" order by u.nombre";

        return $query;
    }

    static public function getProfiles() {

        return "select id,nombre from tbl_perfil order by nombre desc";
    }

    static public function getModuleIds($perfilId) {

        return "SELECT
                    m.id
                    FROM
                    tbl_perfil AS p
                    INNER JOIN tbl_perfil_modulo AS pm ON pm.perfil_id = p.id
                    INNER JOIN tbl_modulo AS m ON m.id = pm.modulo_id
                    WHERE
                    p.id = $perfilId ";
    }

    static public function getModuleList($userId = false, $cuentaId = false) {

        if ($userId) {

            $query = "SELECT
                        m.nombre,
                        m.id,
                        ifnull((select 1 from tbl_permiso where modulo_id = m.id and cuenta_id = $cuentaId and usuario_id = $userId),0) as per
                        FROM
                        tbl_modulo m";
        } else {

            $query = "SELECT m.id,m.nombre,m.descripcion FROM tbl_modulo m order by orden";
        }

        return $query;
    }

    static public function getModuleListLobi() {

        $userid = Security::getUserID();
        $cuentaid = Security::getCuentaID();

        return "call sp_usuario_modulos($userid,$cuentaid)";
    }

    /*
     * funciones para fechas consulta y grabacion 
     */

    public static function getCurrentdate() {

        $idcuenta = Security::getCuentaID();
        return "fc_fecha_actual($idcuenta) ";
    }

}

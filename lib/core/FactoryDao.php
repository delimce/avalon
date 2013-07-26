<?php

/**
 * Created by IntelliJ IDEA.
 * User: delimce
 * Date: 7/18/12
 * Time: 9:52 PM
 * To change this template use File | Settings | File Templates.
 */
class FactoryDao {

    static public function getEmpresas() {

        return "select id,nombre from tbl_cuenta where activo = 1";
    }

    static public function getIdEmpresa($nombre) {

        return "call sp_infoCuenta('$nombre') ";
    }

    static public function getLoginData($cuenta, $user, $pass) {

        return "call sp_login($cuenta, '$user', '$pass')";
    }

    static public function getModuleAccess($modulo, $usuario, $cuenta) {

        return "call sp_verificar_permiso($modulo,$usuario,$cuenta)";
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

    //////clientes
    static public function getClientList() {
        return "SELECT
                c.id,
                c.nombre,
                g.nombre as grupo,
                c.cif
                FROM
                tbl_cliente AS c
                INNER JOIN tbl_grupo_cliente AS g ON g.id = c.grupo_id
                order by nombre";
    }

    /*
     * sucursales
     */

    public static function getSucursalList() {

        return "SELECT
                c.nombre as cliente,
                s.id,
                s.nombre
                FROM
                tbl_cliente_sucursal AS s
                INNER JOIN tbl_cliente AS c ON s.cliente_id = c.id
                order by nombre";
    }

    /*
     * productos
     */

    public static function getProductList() {
        return "SELECT
                    p.nombre,
                    p.codigo,
                    p.id,
                    g.nombre as grupo
                    FROM
                    mantra2_db.tbl_grupo_producto AS g
                    INNER JOIN mantra2_db.tbl_producto AS p ON p.grupo_id = g.id
                    ";
    }

    /*
     * usuarios vendedores
     */

    public static function getUsersVendors() {
        $cuentaId = Security::getCuentaID();
        return "call sp_usuarios_vendedores($cuentaId); ";
    }
    
    

    /*
     * funciones para ventas
     */
    public static function getStockByproduct($prodId){
        return "SELECT 
                SUM(CASE WHEN i.operacion = 'sum' THEN i.cantidad ELSE 0 END) - SUM(CASE WHEN i.operacion = 'res' THEN i.cantidad ELSE 0 END) as inv
                FROM
                tbl_producto p
                LEFT OUTER JOIN tbl_inventario i ON (p.id = i.producto_id)
                where p.id = $prodId ";
    }

    
    public static function getProdDataOrden($idCli,$idProd){
        return "call sp_traer_prod_data_orden($idCli,$idProd)";
    }





    /*
     * funciones para fechas consulta y grabacion 
     */

    public static function getCurrentdate() {

        $idcuenta = Security::getCuentaID();
        return "fc_fecha_actual($idcuenta) ";
    }

}

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

        return "select ifnull(id,0) as idEmp from tbl_cuenta where nombre = trim(lower('$nombre')) ";
    }

    static public function getLoginData($cuenta, $user, $pass) {

        return "SELECT
                    u.id,
                    u.perfil_id,
                    u.nombre,
                    (select nombre from tbl_cuenta where id = $cuenta) as cuenta,
                    pe.nombre AS `profile`
                    FROM
                    tbl_usuario AS u
                    INNER JOIN tbl_perfil AS pe ON u.perfil_id = pe.id
                    WHERE
                    u.`user` = '$user' AND u.`password` = md5('$pass') AND
                    (u.activo = 1 AND u.borrado=0 )";
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

        $query = "SELECT distinct
                m.id,
                m.nombre,
                m.url,
                m.icono,
                m.descripcion
                FROM
                tbl_modulo AS m
                INNER JOIN tbl_permiso AS p ON m.id = p.modulo_id
                WHERE
                p.usuario_id = " . Security::getUserID() . " AND
                p.cuenta_id = " . Security::getCuentaID();

        return $query.="  ORDER BY m.orden ASC";
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

    public static function getVendorsList($cuentaid, $id = false) {
        $query = "SELECT
                u.id,
                v.id as id2,
                u.nombre,
                u.email,
                v.comision,
                v.comision2,
                v.comision3,
                v.comision4
                FROM
                tbl_usuario AS u
		INNER JOIN tbl_permiso as p ON p.usuario_id = u.id and p.modulo_id = 4 and p.cuenta_id = $cuentaid
		-- se trae los usuarios con el modulo de ventas activado de la cuenta solicitada 
                LEFT JOIN tbl_vendedor AS v ON v.usuario_id = u.id and v.cuenta_id = $cuentaid ";

        if ($id)
            $query.=" where u.id = " . $id;

        return $query.=" order by u.nombre";
    }

    /*
     * funciones para fechas consulta y grabacion 
     */

    public static function getCurrentdate() {

        $idcuenta = Security::getCuentaID();
        return "fc_fecha_actual($idcuenta) ";
    }

}

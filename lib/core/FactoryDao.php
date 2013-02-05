<?php

/**
 * Created by IntelliJ IDEA.
 * User: delimce
 * Date: 7/18/12
 * Time: 9:52 PM
 * To change this template use File | Settings | File Templates.
 */
class FactoryDao {

    static public function getUsersList($myId) {

        return "SELECT
                u.id,
                u.nombre,
                u.email,
                u.user,
                p.nombre AS perfil
                FROM
                tbl_usuario AS u
                INNER JOIN tbl_perfil AS p ON u.perfil_id = p.id
                where u.id != $myId";
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

    static public function getModuleList($perfilId = false) {

        if ($perfilId) {

            $query = "SELECT
                    m.id,m.nombre,m.url
                    FROM
                    tbl_perfil AS p
                    INNER JOIN tbl_perfil_modulo AS pm ON pm.perfil_id = p.id
                    INNER JOIN tbl_modulo AS m ON m.id = pm.modulo_id
                    WHERE
                    p.id = $perfilId order by orden";
        } else {

            $query = "SELECT m.id,m.nombre,m.url FROM tbl_modulo m order by orden";
        }

        return $query;
    }

    static public function getModuleListSelected($perfilId) {

        return "SELECT
                m.nombre,
                m.id,
                (select perfil_id from tbl_perfil_modulo where modulo_id = m.id and perfil_id = $perfilId ) as pid
                FROM
                tbl_modulo AS m
                left JOIN tbl_perfil_modulo AS p ON m.id = p.modulo_id
                GROUP BY m.nombre
                order by orden";
    }

    static public function getProfiles() {

        return "select id,nombre from tbl_perfil order by nombre";
    }

    static public function getProfileList() {

        return "SELECT
                    p.id,
                    p.nombre,
                    GROUP_CONCAT(m.nombre) as modulos,
                    if(aprueba=1,'SI','NO') as aprobador,
                    if(discusion=1,'SI','NO') as foro_admin
                    FROM
                    tbl_perfil AS p
                    INNER JOIN tbl_perfil_modulo AS pm ON p.id = pm.perfil_id
                    INNER JOIN tbl_modulo AS m ON m.id = pm.modulo_id
                    GROUP BY p.id";
    }

    ////foro

    static public function getForoList() {

        return "SELECT
                    f.id,
                    f.titulo,
                    count(c.id) as comentarios,
                    date_format(f.fecha,'%d/%m/%Y') as fecha,
                    u.nombre as autor
                    FROM
                    tbl_discusion AS f
                    LEFT JOIN tbl_discusion_comentario AS c ON f.id = c.discusion_id
                    INNER JOIN tbl_usuario AS u ON f.usuario_id = u.id
                    group by f.id";
    }

    static public function getCommentsList($id) {

        return "SELECT
                d.comentario,
                date_format(d.fecha,'%d/%m/%Y') as fecha,
                u.nombre,
                d.id
                FROM
                tbl_discusion_comentario AS d
                INNER JOIN tbl_usuario AS u ON d.usuario_id = u.id
                where d.discusion_id = $id order by fecha desc";
    }

    static public function getWords($tabla, $filtro) {


        return "select palabra from $tabla where palabra like '$filtro%' ";
    }

    static public function getWordsUnaproved($tabla) {

        return "select id_palabra as id,palabra from $tabla where aprobado = 0 ";
        
    }

    static public function getPageContent($id, $lang) {


        return "select titulo,contenido from tbl_page where id = $id and lenguaje = '$lang' ";
    }

}

<?php

/**
 * Created by IntelliJ IDEA.
 * User: luis
 * Date: 10/30/12
 * Time: 11:04 PM
 * To change this template use File | Settings | File Templates.
 */
class Form {
    /*
     * metodo que lee variables pasadas por metodo get o post
     */

    public static function getVar($var, $only = "", $secure = true) {

        /////////////////////validar el only
        if (!$only) {

            $var2 = $_REQUEST[$var];
        } else {

            if ($only == $_GET)
                $var2 = $_GET[$var]; else
                $var2 = $_POST[$var];
        }

        //////////quitando las comillas simples y dobles
        $seguro = trim($var2); ///fuera espacios en blanco

        if ($secure) {
            $seguro = str_replace('"', '', $seguro); ///fuera comillas dobles
            $seguro = str_replace("'", "", $seguro); ///fuera comillas simples
        }

        return $seguro;
    }

/////fin del metodo getvar


    /* metodo insert_data, que inserta valores de un formulario en una tabla de la base de datos
      $pref: toma el prefijo de cada campo que seran los valores que se van a insertar ejemplo r-nombre "r"
      $sep es el caracter que separa al nombre del campo y el prefiejo ejemplo r_nombre nota la separacion debe ser un "_"
      $tabla: la tabla de la base de datos que sufrir los cambios
      $metodo: vectores globales segun el metodo por el cual vienen los valores del formulario "$_GET" o "$_POST"
      IMPOTANTE: EL NOMBRE DE LOS CAMPOS DEBE SER EL NOMBRE DE LAS VARIABLES DE FORMULARIO PASADAS

     */

    public function dataInsert($pref, $sep, $table, $vars) {

        ////objeto de base de datos
        $db = new ObjectDB();
        $db->setTable($table);

        $r = 0;
        while (list($key, $value) = each($vars)) {


            $value = $this->getVar($key, $vars, false); ///hay confianza y no aplica la seguridad

            if (!empty($value)) { ///si el campo no es vacio lo inserto
                $nuevo = explode($sep, $key);

                if ($nuevo[0] == $pref) {


                    $db->setField($nuevo[1], $value);

                    $r++;
                }
            }
        }

        ///insertando en la tabla
        if ($db->getNumFields() > 0)
            $db->insertInTo();
        
        $db->close();
    }

    /* metodo edit_data, que edita valores de un formulario en una tabla de la base de datos
      $pref: toma el prefijo de cada campo que seran los valores que se van a insertar ejemplo r-nombre "r"
      $sep es el caracter que separa al nombre del campo y el prefiejo ejemplo r_nombre nota la separacion debe ser un "_"
      $tabla: la tabla de la base de datos que sufrir� los cambios
      $metodo: vectores globales segun el metodo por el cual vienen los valores del formulario "$_GET" o "$_POST"
      $where: condicion de edicion ejemplo id='1'
      IMPOTANTE: EL NOMBRE DE LOS CAMPOS DEBE SER EL NOMBRE DE LAS VARIABLES DE FORMULARIO PASADAS
     */

    public function dataUpdate($pref, $sep, $table, $vars, $where = "") {


        ////objeto de base de datos
        $db = new ObjectDB();
        $db->setTable($table);

        $r = 0;
        while (list($key, $value) = each($vars)) {

            $value = $this->getvar($key, $vars, false); ///hay confianza y no aplica la seguridad
            //$value = trim($_POST[$key]);
            $nuevo = explode($sep, $key);

            if ($nuevo[0] == $pref) {

                $db->setField($nuevo[1], $value);

                $r++;
            }
        }

        ///editando en la tabla
        if ($db->getNumFields() > 0)
            $db->updateWhere($where);
        
        $db->close();
    }

    /*
     * metodo que crea un combo box a partir de un query en base de datos
     */

    public function dbComboBox($id, $query, $option, $value, $select = false, $default = false) {

        $db = new ObjectDB();
        $db->simpleQuery($query);
        $combo = '<select name="' . $id . '" id="' . $id . '">';
        if ($select)
            $combo.= '<option value="0">' . $select . '</option>';
        while ($row = $db->getRegName()) {
            $combo.= '<option value="';
            $combo.= stripslashes($row["$value"]);
            $combo.= '"';
            if ($default == $row["$value"])
                $combo.= ' selected';
            $combo.= '>';
            $combo.= $row["$option"];
            $combo.= '</option>';
        }

        $combo.= '</select>';

        $db->freeResult();
        $db->close();

        return $combo;
    }

}

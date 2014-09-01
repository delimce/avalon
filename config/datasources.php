<?php


/**
 * Created by IntelliJ IDEA.
 * User: delimce
 * Date: 7/24/12
 * Time: 10:31 AM
 * To change this template use File | Settings | File Templates.
 */
$dataSources = array();


////estructura de conexion 1
/*
 * deben crearse tantas estructuras como datasource se requieran manejar
 */
$dt1 = array("dbms" => "Mysql",
    "host" => "userver",
    //  "port" => "3306",
    //  "schema" => "prueba",
    "database" => "vconsole",
    "user" => "root",
    "pwd" => "delimce",
    "encrypt" => true
);

////otro dataSource

$dt2 = array("dbms" => "Mysql",
    "host" => "localhost",
    //  "port" => "3306",
    //  "schema" => "prueba",
    "database" => "vconsole",
    "user" => "root",
    "pwd" => "delimce",
);



////asignacion
$dataSources["vconsole"] = $dt2;




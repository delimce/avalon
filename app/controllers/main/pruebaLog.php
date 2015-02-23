<?php

function _pruebaLog(){


    $db = new ObjectDB();
    $db->setSql("select 999");
    $db->executeQuery();
    echo "hola";
    $db->close();


/*
    $logger = new Log("vconsole");
    $logger->error("un error");
    $logger->info("una informacion");
    $logger->warn("cuidado");
    */
}
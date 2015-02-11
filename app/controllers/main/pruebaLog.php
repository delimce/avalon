<?php

function _pruebaLog(){

    $logger = new Log("vconsole");
    $logger->error("un error");
    $logger->info("una informacion");
    $logger->warn("cuidado");
}
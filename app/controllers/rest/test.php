<?php
function _test()
{
    $rest = new RestFul();
    $rest->printUrlElements();
    $rest->printParameters();

    echo $_SERVER['HTTP_ORIGIN'];



}
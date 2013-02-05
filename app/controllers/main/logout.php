<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function _logout() {

    Security::destroySession();
    Front::redirect("main/login");
}

<?php

/*
 * archivo para añadir includes al layout, vistas o controladores ext
 */


/*
 * añade archivos en javascript
 */
function include_javascripts(){
    
    echo '<script type="text/javascript" src="'.Front::myUrl('jscripts/jquery-1.8.2.min.js').'"></script>';
    echo '<script type="text/javascript" src="'.Front::myUrl('jscripts/jquery.validate.min.js').'"></script>';
    echo '<script type="text/javascript" src="'.Front::myUrl('jscripts/additional-methods.min.js').'"></script>';
    echo '<script type="text/javascript" src="'.Front::myUrl('jscripts/jquery.dataTables.js').'"></script>';
    echo '<script type="text/javascript" src="'.Front::myUrl('jscripts/TableTools.js').'"></script>';
    echo '<script type="text/javascript" src="'.Front::myUrl('jscripts/jquery-ui.js').'"></script>';

}



?>

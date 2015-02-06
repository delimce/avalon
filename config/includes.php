<?php

/*
 * archivo para añadir includes al layout, vistas o controladores ext
 */


/*
 * añade archivos en javascript
 */

function include_javascripts() {
    echo '<script src="' . Front::myUrl('js/vendor/modernizr.js') . '"></script>';
    //echo '<script src="' . Front::myUrl('js/vendor/jquery.js') . '"></script>';
	echo '<script src="' . Front::myUrl('js/vendor/jquery.min.js') . '"></script>';
    echo '<script src="' . Front::myUrl('js/foundation.min.js') . '"></script>';
}

function include_meta() {

    echo '<meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0" />';
}

?>

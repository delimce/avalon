<!DOCTYPE html> 
<html>
    <head>
        <?php include_meta(); ?>
        <link rel="stylesheet" href="<?= Front::myUrl('css/jquery.mobile.structure-1.2.0.min.css') ?>" />
        <link rel="stylesheet" href="<?= Front::myUrl('css/cursonet.min.css') ?>" />
        <link rel="stylesheet" href="<?= Front::myUrl('css/style1.css') ?>" />
        <?php echo (isset($css) && is_array($css)) ? implode("\n", $css) : '' ///para los ccs adicionales ?>
        <?php include_javascripts(); ?>
        <?php echo (isset($head) && is_array($head)) ? implode("\n", $head) : '' //para los javascripts adicionales ?>
        <title><?php echo $siteTitle ?></title>
    </head>

    <body>

        <div data-role="page">

            <div data-role="header">
                
                <?php echo (!empty($backButton) ? '<a data-rel="back" data-icon="back">volver</a>' : '') ?>
                 <?php echo (!empty($homeButton) ? '<a  href="'.Front::myUrl($homeButton).'" data-icon="home">Inicio</a>' : '') ?>
                <h1><?php echo $siteTitle ?></h1>
                <?php echo (!empty($newButton) ? '<a href="'.Front::myUrl($newButton).'" data-icon="pluss" data-ajax="false">Crear</a> ' : '') ?>
            </div><!-- /header -->

            <div data-role="content" style="max-width: 530px;position: relative; margin: 0 auto; overflow: hidden;">	
                <?php echo (isset($body) && is_array($body)) ? implode("\n", $body) : '' ?>
                <p>&nbsp;</p>
            </div><!-- /content -->

                    
        </div><!-- /page -->    


    </body>
</html>
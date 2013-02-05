<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        @import "<?= Front::myUrl('css/Mainstyle.css') ?>";
        @import "<?= Front::myUrl('css/demo_table_jui.css') ?>";
        @import "<?= Front::myUrl('css/smoothness/jquery-ui-1.8.4.custom.css') ?>";
        @import "<?= Front::myUrl('css/TableTools.css') ?>";
        @import "<?= Front::myUrl('css/jquery-ui.css') ?>";
    </style>
     <?php include_javascripts(); ?>
    <?php echo (isset($head) && is_array($head)) ? implode("\n",$head) : ''?>
    <title><?php echo $siteTitle ?></title>
</head>

<body>
    
 
<div id="container">

    <div id="logo">
        <?php if(Security::isSessionActive()){ ?>
         
        <div style="float:right; margin-right: 40px; margin-top: 14px;">
            <span id="username1" style="font-weight: bold"><?=  Security::getUserName() ?></span><br>
            <span><a href="<?= Front::myUrl('main/logout') ?>">Cerrar Sesión</a></span>
        </div>
        
        <?php } ?> 
      </div>


    <!--MENU DEL SITIO-->
    <ul id="navitab">
       <?=$menuBar ?>
    </ul>
    <!--MENU DEL SITIO-->


    <div id="desc">
        <p><?php echo $subTitle ?> </p><br>
    </div>

    <div id="main">

        <?php echo (isset($body) && is_array($body)) ? implode("\n", $body) : ''?>

        <p>&nbsp;</p>


    </div>


    <div id="footer">
        <p>Diccionario de Computación Español / Wayuunaiki | Pütchimaajatü komputatoorachiki wayuunaikiru’usu </p>
    </div>

</div>
</body>
</html>
<!DOCTYPE html> 
<html>
    <head>
        <?php include_meta(); ?>
        <link rel="stylesheet" href="<?= Front::myUrl('css/jquery.mobile-1.2.0.min.css') ?>" />
        <?php include_javascripts(); ?>
        <?php echo (isset($head) && is_array($head)) ? implode("\n", $head) : '' ?>
    </head>

    <body>

        <div data-role="page">

            <div data-role="header">
                <h1><?php echo $siteTitle ?></h1>
            </div><!-- /header -->

            <div data-role="content">	
                <?php echo (isset($body) && is_array($body)) ? implode("\n", $body) : '' ?>
                <p>&nbsp;</p>
            </div><!-- /content -->

        </div><!-- /page -->    


    </body>
</html>
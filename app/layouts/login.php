<!doctype html>
<html class="no-js" lang="es">
    <head>
        <?php include_meta() ?>
        <title>vBrokers :: <?= $siteTitle ?></title>
        <style type="text/css">
            @import "<?= Front::myUrl('css/foundation.css') ?>";
            @import "<?= Front::myUrl('css/style.css') ?>";
        </style>
        <style>
            html, body {
                height: 100%;
                background:#DDD;
            }

            .main {
                height: 100%;
                width: 100%;
                display: table;
            }

            .wrapper {
                display: table-cell;
                height: 100%;
                vertical-align: middle;
            }
            #login {
                width: 30%;
            }
            @media all and (max-width:800px) {
                #login {
                    width: 90%;
                }
            }
        </style>

        <?php include_javascripts(); ?>
        <?php echo (isset($head) && is_array($head)) ? implode("\n", $head) : '' ?>
        <title><?php echo $siteTitle ?></title>
    </head>
    <body>
        <div class="main">
            <div class="wrapper">
                <?php echo (isset($body) && is_array($body)) ? implode("\n", $body) : '' ?>
            </div>
        </div>

        <script>
            $(document).foundation();
        </script>
    </body>
</html>


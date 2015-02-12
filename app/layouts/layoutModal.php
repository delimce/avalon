<!doctype html>
<html class="no-js" lang="es">
<head>
    <?php include_meta() ?>
    <title>vBrokers :: <?= $siteTitle ?></title>
    <style type="text/css">
        @import "<?= Front::myUrl('css/foundation.css') ?>";
        @import "<?= Front::myUrl('css/foundation-icons.css') ?>";
        @import "<?= Front::myUrl('css/style.css') ?>";
    </style>
    <?php include_javascripts(); ?>
    <?php echo (isset($head) && is_array($head)) ? implode("\n", $head) : '' ?>
    <title><?php echo $siteTitle ?></title>
</head>
<body class="retrato">
<?php echo (isset($body) && is_array($body)) ? implode("\n", $body) : '' ?>
<script src="<?= Front::myUrl('js/foundation.min.js') ?>"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>
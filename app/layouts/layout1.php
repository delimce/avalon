<!doctype html>
<html class="no-js" lang="es">
<head>
    <?php include_meta() ?>
    <title>vBrokers :: <?= $siteTitle ?></title>
    <style type="text/css">
        @import "<?= Front::myUrl('css/bootstrap/bootstrap.min.css') ?>";
        @import "<?= Front::myUrl('css/foundation.css') ?>";
        @import "<?= Front::myUrl('css/foundation-icons.css') ?>";
        @import "<?= Front::myUrl('css/w2ui/w2ui-fields-1.0.min.css') ?>";
        @import "<?= Front::myUrl('css/fancybox/jquery.fancybox.css') ?>";
        @import "<?= Front::myUrl('css/style.css') ?>";

        <?php echo (isset($css) && is_array($css)) ? implode("\n", $css) : '' ?>
    </style>

    <?php include_javascripts(); ?>
    <?php echo (isset($head) && is_array($head)) ? implode("\n", $head) : '' ?>

    <title><?php echo $siteTitle ?></title>

    <script>
        $(window).bind("load", function () {
            var footer = $("#footer");
            var pos = footer.position();
            var height = $(window).height();
            height = height - pos.top;
            height = height - footer.height();
            if (height > 0) {
                footer.css({
                    'margin-top': height + 'px'
                });
            }
        });
    </script>
</head>

<body>

<div class="row top-head">
    <div class="col-md-12" style="background-color: #008CBA;">
        <nav class="top-bar" data-topbar role="navigation" style="background-color: #008CBA;">
            <ul class="title-area">
                <li class="name">
                    <a href="<?= Front::myUrl("main/index") ?>">
                        <img src="<?= Front::myUrl("img/vconsole/common/vBrokers_Logo1.png") ?>" width="60px"></a>

                    <h1></h1>
                </li>
                <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
            </ul>

            <section class="top-bar-section" style="background-color: #008CBA;">
                <!-- Right Nav Section -->
                <ul class="right">
                    <!--
							<li class="active"><a href="#"><i class="step fi-mail size-18"></i>&nbsp;<?= LANG_adminMessages ?></a></li>
							-->

                    <li class="has-dropdown" style="background-color: #008CBA;">
                        <a style="background-color: #008CBA;" href="#" data-dropdown="hover1"
                           data-options="is_hover:true; align: bottom" class="tip-right radius round">
                            <i class="step fi-torso-business size-18"></i>&nbsp;&nbsp;<?= Security::getUserName() ?></a>
                        <ul class="dropdown">
                            <li>
                                <a style="background-color: #008CBA;" href="<?= Front::myUrl("setup/main") ?>">
                                    <i class="step fi-widget size-18"></i>&nbsp;<?= LANG_setup ?></a>
                            </li>
                            <?php if (Security::getUserProfileID() == 1) { ?>
                                <li>
                                    <a style="background-color: #008CBA;"
                                       href="<?= Front::myUrl("usuarios/listaUsuarios") ?>">
                                        <i class="step fi-torsos-all size-18"></i>&nbsp;<?= LANG_users ?></a>
                                </li>
                            <?php } ?>
                            <li>
                                <a style="background-color: #008CBA;" href="<?= Front::myUrl("main/logout") ?>">
                                    <i class="step fi-power size-18"></i>&nbsp;<?= LANG_exitConsole ?></a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Left Nav Section -->
                <ul class="left">
                    <li>
                        <a style="background-color: #008CBA;" href="<?= Front::myUrl("cuentas/lista") ?>"><i
                                class="step fi-results-demographics size-21"></i>&nbsp;<?= LANG_accounts ?> </a>
                    </li>
                    <li><a style="background-color: #008CBA;" href="<?= Front::myUrl("contactos/lista") ?>"><i
                                class="step fi-torsos-all size-21"></i>&nbsp;<?= LANG_contacts ?></a></li>
                    <li><a style="background-color: #008CBA;" href="<?= Front::myUrl("prospectos/lista") ?>"><i
                                class="step fi-torsos-all size-21"></i>&nbsp;<?= LANG_prospects ?></a></li>
                    <li class="has-dropdown" style="background-color: #008CBA;">
                        <a style="background-color: #008CBA;" href="<?= Front::myUrl("propiedades/listAll") ?>"
                           data-dropdown="hover1"
                           data-options="is_hover:true; align: bottom" class="tip-right radius round">
                            <i class="step fi-home size-21"></i>&nbsp;<?= LANG_realEstate ?></a>
                        <ul class="dropdown">
                            <li>
                                <?php foreach (Security::getSessionVar("INMENU")  as $menu) { ?>
                            <li><a style="background-color: #008CBA;"
                                   href="<?= Front::myUrl("propiedades/lista/" . $menu) ?>"><i
                                        class="step fi-home size-21"></i>&nbsp;<?= $menu ?></a></li>
                            <?php } ?>
                    </li>
                </ul>
                </li>
                <li><a style="background-color: #008CBA;" href="<?= Front::myUrl("oportunidades/lista") ?>"><i
                            class="step fi-home size-21"></i>&nbsp;<?= LANG_opportunities ?></a></li>
                </ul>
            </section>
        </nav>
    </div>
    <div class="col-md-12 breadcrumbs">

    </div>
</div>

<div class="row">

    <div class="large-12  columns">

        <?php echo (isset($body) && is_array($body)) ? implode("\n", $body) : '' ?>

    </div>

</div>

<footer id="footer" class="row">
    <div class="large-12 columns">
        <hr/>
        <div class="row">
            <div class="large-6 columns">
                <p style="color:#fff;">vBrokers © Copyright <?= date("Y") ?>, Versión: <?= Security::getCurrentVersion() ?></p>
            </div>
            <div class="large-6 columns">
                <i class="fa fa-twitter-square"></i>
            </div>
        </div>
    </div>
</footer>

<script src="<?= Front::myUrl('js/bootstrap/bootstrap.js') ?>"></script>
<script src="<?= Front::myUrl('js/foundation.min.js') ?>"></script>
<script src="<?= Front::myUrl('js/w2ui/w2ui-fields-1.0.min.js') ?>"></script>
<script src="<?= Front::myUrl('js/fancybox/jquery.fancybox.js') ?>"></script>
<script src="<?= Front::myUrl('js/fancybox/galeria.js') ?>"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>
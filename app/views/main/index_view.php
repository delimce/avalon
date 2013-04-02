<p><h5 style="text-transform: capitalize">Bienvenid@: <?php echo Security::getUserName() ?></h5></p>
<p><h5 style="color:blue"><?php echo Security::getUserProfileName() ?></h5></p>
<p><h5 style="text-transform: capitalize">Empresa: <?php echo Security::getSessionVar("CUENTANAME") ?></h5></p>

<div style="alignment-adjust: middle">

     <div class="icono" onclick="javascript:window.location='<?= Front::myUrl('micuenta/index') ?>'" >
        <img src="<?= Front::myUrl('images/icons/micuenta.png') ?>"/>
        <div>Mis datos</div>
    </div>
    
    <?php while ($row = $modulos->getRowFields()) { ?>
    
    <div class="icono" onclick="javascript:window.location='<?= Front::myUrl($row->url) ?>'" >
        <img src="<?= Front::myUrl('images/icons/'.$row->icono) ?>"/>
        <div><?=$row->nombre ?></div>
    </div>
    
    <?php } ?>
    
    <?php if(Security::getUserProfileID()==99){ ?>
    <div class="icono" onclick="javascript:window.location='<?= Front::myUrl('admin/index') ?>'" >
        <img src="<?= Front::myUrl('images/icons/config.png') ?>"/>
        <div>Administración</div>
    </div>
    <?php } ?>
    <div class="icono" onclick="javascript:window.location='<?= Front::myUrl('main/logout') ?>'" >
        <img src="<?= Front::myUrl('images/icons/salir.png') ?>"/>
        <div>Salir</div>
    </div>
    
    

</div>

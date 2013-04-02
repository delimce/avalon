<div>N° de Vendedores: <?= $datos->getNumRows() ?></div>
<ul data-role="listview" data-inset="true">
    <?php while ($row = $datos->getRowFields()) { ?>
        <li>
            <a class="check" data-ajax="false" href="<?= Front::myUrl("finanzas/vendedor/edit/$row->id") ?>">
                <div><span style="color:blue"><?php echo $row->nombre ?></span><br><?php echo $row->email ?></div>
            </a>
        </li>

    <?php } ?>  
</ul>
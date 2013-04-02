<div>N° de Almacenes: <?= $datos->getNumRows() ?></div>
<ul data-role="listview" data-inset="true">
    <?php while ($row = $datos->getRowFields()) { ?>
        <li>
            <a class="check" data-ajax="false" href="<?= Front::myUrl("almacen/almacen/edit/$row->id") ?>">
                <div style="color:blue"><?php echo $row->nombre ?><br></div>
            </a>
        </li>

    <?php } ?>  
</ul>
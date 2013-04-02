<div>N° de sucursales: <?= $datos->getNumRows() ?></div>
<br>
<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Buscar">
    <?php while ($row = $datos->getRowFields()) { ?>
        <li>
            <a class="check" data-ajax="false" href="<?= Front::myUrl("clientes/sucursal/edit/$row->id") ?>">
                <div style="color:blue"><?php echo $row->nombre ?>&nbsp;&nbsp;<?php echo $row->cif ?><br>
                    <b style="color:black"><?php echo $row->cliente ?></b></div>
            </a>
        </li>

    <?php } ?>  
</ul>
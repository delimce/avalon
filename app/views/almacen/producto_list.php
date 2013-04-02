<div>N° de Productos: <?= $datos->getNumRows() ?></div>
<br>
<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Buscar">
    <?php while ($row = $datos->getRowFields()) { ?>
        <li>
            <a class="check" data-ajax="false" href="<?= Front::myUrl("almacen/productos/edit/$row->id") ?>">
                 <div style="color:blue"><?php echo $row->nombre ?>&nbsp;(<?php echo $row->codigo ?>)<br>
                    <b style="color:black"><?php echo $row->grupo ?></b></div>
            </a>
        </li>

    <?php } ?>  
</ul>
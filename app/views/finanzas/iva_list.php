<div>N° de registros: <?= $datos->getNumRows() ?></div>
<ul data-role="listview" data-inset="true">
    <?php while ($row = $datos->getRowFields()) { ?>
        <li>
            <a class="check" data-ajax="false" href="<?= Front::myUrl("finanzas/iva/edit/$row->id") ?>">
                <div><span style="color:blue"><?php echo $row->tipoiva ?></span>
                    &nbsp;<?php echo number_format($row->porcentaje, 2) ?>%<br>
                    <?php echo $row->fecha ?>
                </div>
            </a>
        </li>

    <?php } ?>  
</ul>
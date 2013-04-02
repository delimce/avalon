<div>N° de Cajas: <?= $datos->getNumRows() ?></div>
<ul data-role="listview" data-inset="true">
    <?php while ($row = $datos->getRowFields()) { ?>
        <li>

            <div><span style="color:blue"><?php echo $row->nombre ?></span><br><?php echo number_format($row->saldo, 2) ?></div>

        </li>

    <?php } ?>  
</ul>
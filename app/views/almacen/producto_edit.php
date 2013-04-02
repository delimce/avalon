<script>

    $("div[data-role*='page']").live('pageshow', function() {

        $('#form1').validate({
            rules: {
                
                 r0codigo: {
                    required: true
                },
                r0nombre: {
                    required: true
                }

            },
            errorElement: "div"
        });


        $("#submit").click(function() {

            //validando
            if (!$("#form1").valid())
                return false;

           $('#form1').append('<input type="hidden" name="ide" id="ide" value="<?= $datos["id"] ?>" />');
            var formData = $("#form1").serialize();

            $.ajax({
                type:"POST",
                url:"<?= Front::myUrl('almacen/productos_crud'); ?>",
                cache:false,
                data:formData,
                success:function(data) {
                    $("#notification").text(data);
                    $("#notification").css({color:"blue", fontWeight:"bold"});
                }
            });

            return false;
        });

    });
</script>

<form id="form1" action="index.php" data-transition="slide"  method="post">

    <div data-role="fieldcontain">

        <label style="font-weight:bold" for="r0codigo">Codigo</label>
        <input type="text" data-mini="true" id="r0codigo" name="r0codigo" value="<?=$datos["codigo"] ?>" />

        <label style="font-weight:bold" for="r0codalt">Codigo Alt.</label>
        <input type="text" data-mini="true" id="r0codalt" name="r0codalt" value="<?=$datos["codalt"] ?>" />

        <label style="font-weight:bold" for="r0nombre">Nombre</label>
        <input type="text" data-mini="true" id="r0nombre" name="r0nombre" value="<?=$datos["nombre"] ?>" />

        <label style="font-weight:bold" for="r0nomalt">Nombre Alt.</label>
        <input type="text" data-mini="true" id="r0nomalt" name="r0nomalt" value="<?=$datos["nomalt"] ?>" />

        <label style="font-weight:bold" for="r0grupo_id">Grupo</label>
        <?= $grupo ?>

        <label style="font-weight:bold" for="r0marca_id">Marca</label>
        <?= $marca ?>


        <label style="font-weight:bold" for="r0resumen">Resumen</label>
        <textarea name="r0resumen" id="r0resumen"><?=$datos["resumen"] ?> </textarea>

        <p>&nbsp;</p>

        <label style="font-weight:bold" for="r0iva">Tipo IVA</label>
        <?= $iva ?>
        
        <label style="font-weight:bold" for="r0precio_a">Precio A</label>
        <input type="number" data-mini="true" id="r0precio_a" name="r0precio_a" value="<?=$datos["precio_a"] ?>"/>

        <label style="font-weight:bold" for="r0precio_a">Precio B</label>
        <input type="number" data-mini="true" id="r0precio_b" name="r0precio_b" value="<?=$datos["precio_b"] ?>"/>

        <label style="font-weight:bold" for="r0precio_a">Precio C</label>
        <input type="number" data-mini="true" id="r0precio_c" name="r0precio_c" value="<?=$datos["precio_c"] ?>"/>

        <label style="font-weight:bold" for="r0precio_a">Precio D</label>
        <input type="number" data-mini="true" id="r0precio_d" name="r0precio_d" value="<?=$datos["precio_d"] ?>"/>
        <p>&nbsp;</p>

        <label style="font-weight:bold" for="r0des_a">Desc. A</label>
        <input type="number" data-mini="true" id="r0des_a" name="r0des_a" value="<?=$datos["des_a"] ?>"/>

        <label style="font-weight:bold" for="r0des_a">Desc. B</label>
        <input type="number" data-mini="true" id="r0des_b" name="r0des_b" value="<?=$datos["des_b"] ?>"/>

        <label style="font-weight:bold" for="r0des_c">Desc. C</label>
        <input type="number" data-mini="true" id="r0des_c" name="r0des_c" value="<?=$datos["des_c"] ?>"/>

        <label style="font-weight:bold" for="r0des_c">Desc. D</label>
        <input type="number" data-mini="true" id="r0des_d" name="r0des_d" value="<?=$datos["des_d"] ?>"/>

        <label style="font-weight:bold" for="r0almacen_id">Almacen</label>
        <?= $almacen ?>



        <label style="font-weight:bold" for="r0exmin">Exist. min</label>
        <input type="number" data-mini="true" id="r0exmin" name="r0exmin" value="<?=$datos["exmin"] ?>"/>

        <label style="font-weight:bold" for="r0exmax">Exist. max</label>
        <input type="number" data-mini="true" id="r0exmax" name="r0exmax" value="<?=$datos["exmax"] ?>"/>

        <label style="font-weight:bold" for="r0precio_min">Precio min.</label>
        <input type="number" data-mini="true" id="r0precio_min" name="r0precio_min" value="<?=$datos["precio_min"] ?>"/>

        <label style="font-weight:bold" for="r0precio_max">Precio max.</label>
        <input type="number" data-mini="true" id="r0precio_max" name="r0precio_max" value="<?=$datos["precio_max"] ?>"/>

        <label style="font-weight:bold" for="r0peso">Peso</label>
        <input type="number" data-mini="true" id="r0peso" name="r0peso" value="<?=$datos["peso"] ?>" />

        <label style="font-weight:bold" for="r0altura">Altura</label>
        <input type="number" data-mini="true" id="r0altura" name="r0altura" value="<?=$datos["altura"] ?>"/>  

        <label style="font-weight:bold" for="r0ancho">Ancho</label>
        <input type="number" data-mini="true" id="r0ancho" name="r0ancho" value="<?=$datos["ancho"] ?>"/> 

        <label style="font-weight:bold" for="r0profun">Profundidad</label>
        <input type="number" data-mini="true" id="r0profun" name="r0profun" value="<?=$datos["profun"] ?>"/> 


        <label style="font-weight:bold" for="r0iva">Unidad de medida</label>
        <?= $unidad ?>
        
        <label style="font-weight:bold" for="r0cantidad">cantidad</label>
        <input type="number" data-mini="true" id="r0cantidad" name="r0cantidad" value="<?=$datos["cantidad"] ?>"/> 

        <p>

  
            <label for="r0activo">Activo</label>
            <select name="r0activo" id="r0activo" data-role="slider">
                <option value="0" <?php echo ($datos["compuesto"]) == 0 ? 'selected' : '' ?>>NO</option>
                <option value="1" <?php echo ($datos["compuesto"]) == 1 ? 'selected' : '' ?>selected>SI</option>
            </select>
            
              <p id="notification"></p>

    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true">Guardar</button>

</form>   
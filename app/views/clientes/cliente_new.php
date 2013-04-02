<script>

    $("div[data-role*='page']").live('pageshow', function() {

        $('#form1').validate({
            rules: {
                r0nombre: {
                    required: true
                },
                r0cif: {
                    required: true
                },
                r0porriva: {
                    required: true,
                    number:true
                }

            },
            errorElement: "div"
        });


        $("#consulta").click(function() {

            $.ajax({
                type: "post",
                url: "<?= Front::myUrl('clientes/seniat'); ?>",
                dataType:'json',
                data: {rif: $('#r0cif').val()},
                success: function(data) {
                   if(data.estatus=="error"){
                       alert("el Rif no existe o es inválido");
                   }else{
                       $('#r0nombre').val(data.nombre);
                       var reten = (data.retiene == "SI" ? 75 : 100);
                       $('#r0porriva').val(reten);
                   }
                }
            });

        });




        $("#submit").click(function() {

            //validando
            if (!$("#form1").valid())
                return false;

            var formData = $("#form1").serialize();
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('clientes/clientes_crud'); ?>",
                cache: false,
                data: formData,
                success: function(data) {
                    history.back();
                }
            });

            return false;
        });

    });
</script>

<form id="form1">

    <div>Agregar nuevo cliente</div>

    <div data-role="fieldcontain">

        <div data-role="fieldcontain">
            <label style="font-weight:bold" for="r0cif">CI / RIF</label>
            <input type="text" data-mini="true" id="r0cif" name="r0cif" />

            <label style="font-weight:bold" for="r0nombre">Nombre</label>
            <input type="text" data-mini="true" id="r0nombre" name="r0nombre" />

            <label style="font-weight:bold" for="r0porriva">% Retenc.</label>
            <input type="number" data-mini="true" id="r0porriva" name="r0porriva" />

            <a id="consulta" href="#" data-inline="true" data-role="button">Consultar</a> 

        </div>



        <label style="font-weight:bold" for="r0grupo_id">Grupo</label>
        <?= $grupo ?>
        <label style="font-weight:bold" for="r0dia_id">Día asignado</label>
        <?= $dia ?>

        <label style="font-weight:bold" for="r0contacto">Pers. Contacto</label>
        <input type="text" data-mini="true" id="r0contacto" name="r0contacto" />

        <label style="font-weight:bold" for="r0email">Email</label>
        <input type="email" data-mini="true" id="r0email" name="r0email" />

        <label style="font-weight:bold" for="r0direc1">Dirección 1</label>
        <input type="text" data-mini="true" id="r0direc1" name="r0direc1" />

        <label style="font-weight:bold" for="r0direc2">Dirección 2</label>
        <input type="text" data-mini="true" id="r0direc2" name="r0direc2" />

        <label style="font-weight:bold" for="r0direc3">Dirección 3</label>
        <input type="text" data-mini="true" id="r0direc3" name="r0direc3" />

        <label style="font-weight:bold" for="r0direc4">Dirección 4</label>
        <input type="text" data-mini="true" id="r0direc4" name="r0direc4" />


        <label style="font-weight:bold" for="r0tlf1">Telefono 1</label>
        <input type="number" data-mini="true" id="r0tlf1" name="r0tlf1" />

        <label style="font-weight:bold" for="r0tlf2">Telefono 2</label>
        <input type="number" data-mini="true" id="r0tlf2" name="r0tlf2" />


        <label style="font-weight:bold" for="r0fax">Fax</label>
        <input type="text" data-mini="true" id="r0fax" name="r0fax" />

        <label style="font-weight:bold" for="r0lim_cre">Limit. credito</label>
        <input type="number" data-mini="true" id="r0lim_cre" name="r0lim_cre" />

        <label style="font-weight:bold" for="r0lim_dias">Días credito</label>
        <input type="number" data-mini="true" id="r0lim_dias" name="r0lim_dias" />
        
        <label style="font-weight:bold" for="r0lim_nfac">Limit. fact</label>
        <input type="number" data-mini="true" id="r0lim_nfac" name="r0lim_nfac" />

        <label style="font-weight:bold" for="r0descuento">Descuento</label>
        <input type="number" data-mini="true" id="r0descuento" name="r0descuento" />

        <label style="font-weight:bold" for="r0saldo">Saldo</label>
        <input type="number" data-mini="true" id="r0saldo" name="r0saldo" />

        <label style="font-weight:bold" for="r0tarifa">tarifa</label>
        <?= $tarifa ?>

        <label style="font-weight:bold" for="r0zona_id">Zona</label>
        <?= $zona ?>

        <label style="font-weight:bold" for="vendedor">Vendedor</label>
        <?= $vendedor ?>
        <label style="font-weight:bold" for="r0banco_id">Banco</label>
        <?= $banco ?>

        <label style="font-weight:bold" for="r0ctabanco">Cta. banco</label>
        <input type="number" data-mini="true" id="r0ctabanco" name="r0ctabanco" />

        <label style="font-weight:bold" for="r0nit">NIT</label>
        <input type="text" data-mini="true" id="r0nit" name="r0nit" />  

        <label style="font-weight:bold" for="r0forma_id">Forma</label>
        <?= $forma ?>


        <label style="font-weight:bold" for="r0observa">Observación</label>
        <input type="text" data-mini="true" id="r0observa" name="r0observa" />  

        <label for="r0cli_esp">Cliente Especial</label>
        <select name="r0cli_esp" id="r0cli_esp" data-role="slider">
            <option value="0" selected>NO</option>
            <option value="1">SI</option>
        </select>




        <label for="r0activo">Cliente Activo</label>
        <select name="r0activo" id="r0activo" data-role="slider">
            <option value="0">NO</option>
            <option value="1"selected>SI</option>
        </select>

        <label for="r0regmerc">Reg. Mercantil</label>
        <select name="r0regmerc" id="r0regmerc" data-role="slider">
            <option value="0">NO</option>
            <option value="1"selected>SI</option>
        </select>



    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>

</form>   
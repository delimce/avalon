<script>
  
    $("div[data-role*='page']").live('pageshow', function() { 
                    
        $('#form1').validate({
            rules:{
                r0nombre:{
                    required:true
                },
                r0cliente_id:{
                    required:true
                }
                
            }, 
            errorElement: "div"
        });
        
    
        $("#submit").click(function () {

            //validando
            if (!$("#form1").valid()) return false;
            
            $('#form1').append('<input type="hidden" name="ide" id="ide" value="<?= $datos["id"] ?>" />');
            
            var formData = $("#form1").serialize();
            
            $.ajax({
                type:"POST",
                url:"<?= Front::myUrl('clientes/sucursal_crud'); ?>",
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

<form id="form1" data-transition="slide"  method="post">

    <div data-role="fieldcontain">

        <label style="font-weight:bold" for="r0cliente_id">Cliente</label>
        <?= $clientes ?>

        <label style="font-weight:bold" for="r0nombre">Nombre</label>
        <input type="text" data-mini="true" id="r0nombre" name="r0nombre" value="<?= $datos["nombre"] ?>"/>

        <label style="font-weight:bold" for="r0zona_id">Zona</label>
        <?= $zona ?>

        <label style="font-weight:bold" for="r0contacto">Pers. contacto</label>
        <input type="text" data-mini="true" id="r0contacto" name="r0contacto" value="<?= $datos["contacto"] ?>"/>

        <label style="font-weight:bold" for="vendedor">Vendedor</label>
        <?= $vendedor ?>

        <label style="font-weight:bold" for="r0direc1">Dirección 1</label>
        <input type="text" data-mini="true" id="r0direc1" name="r0direc1" value="<?= $datos["direc1"] ?>"/>

        <label style="font-weight:bold" for="r0direc2">Dirección 2</label>
        <input type="text" data-mini="true" id="r0direc2" name="r0direc2" value="<?= $datos["direc2"] ?>"/>

        <label style="font-weight:bold" for="r0direc3">Dirección 3</label>
        <input type="text" data-mini="true" id="r0direc3" name="r0direc3" value="<?= $datos["direc3"] ?>"/>

        <label style="font-weight:bold" for="r0direc4">Dirección 4</label>
        <input type="text" data-mini="true" id="r0direc4" name="r0direc4" value="<?= $datos["direc4"] ?>"/>


        <label style="font-weight:bold" for="r0tlf1">Telefono 1</label>
        <input type="number" data-mini="true" id="r0tlf1" name="r0tlf1" value="<?= $datos["tlf1"] ?>" />

        <label style="font-weight:bold" for="r0tlf2">Telefono 2</label>
        <input type="number" data-mini="true" id="r0tlf2" name="r0tlf2" value="<?= $datos["tlf2"] ?>"/>


        <p id="notification"></p>

    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true">Guardar</button>

</form>   
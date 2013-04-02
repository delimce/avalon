<script>
  
    $("div[data-role*='page']").live('pageshow', function() { 
                    
        $('#form1').validate({
            rules:{
                r0nombre:{
                    required:true
                }
                
            }, 
            errorElement: "div"
        });
        
    
        $("#submit").click(function () {

            //validando
            if (!$("#form1").valid()) return false;
            
            $('#form1').append('<input type="hidden" name="ide" id="ide" value="<?= $datos->getField("id") ?>" />');
            var formData = $("#form1").serialize();

            $.ajax({
                type:"POST",
                url:"<?= Front::myUrl('almacen/grupos_crud'); ?>",
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

        <label style="font-weight:bold" for="r0nombre">Nombre</label>
        <input type="text" data-mini="true" id="r0nombre" name="r0nombre" value="<?=$datos->getField("nombre") ?>"/>

        <label style="font-weight:bold" for="r0margen_a">Margen A</label>
        <input type="number" data-mini="true" id="r0margen_a" name="r0margen_a" value="<?=$datos->getField("margen_a") ?>"/>

        <label style="font-weight:bold" for="r0margen_b">Margen B</label>
        <input type="number" data-mini="true" id="r0margen_b" name="r0margen_b" value="<?=$datos->getField("margen_b") ?>"/>

        <label style="font-weight:bold" for="r0margen_c">Margen C</label>
        <input type="number" data-mini="true" id="r0margen_c" name="r0margen_c" value="<?=$datos->getField("margen_c") ?>"/>

        <label style="font-weight:bold" for="r0margen_d">Margen D</label>
        <input type="number" data-mini="true" id="r0margen_d" name="r0margen_d" value="<?=$datos->getField("margen_d") ?>"/>

        <label style="font-weight:bold" for="r0comision">Comisión</label>
        <input type="number" data-mini="true" id="r0comision" name="r0comision" value="<?=$datos->getField("comision") ?>"/>

        <p>

            <label for="r0activo">Grupo Activo</label>
            <select name="r0activo" id="r0activo" data-role="slider">
                  <option value="0" <?php echo ($datos->getField("activo")) == 0 ? 'selected' : '' ?> >NO</option>
                <option value="1" <?php echo ($datos->getField("activo")) > 0 ? 'selected' : '' ?> >SI</option>
            </select>

            <p id="notification"></p>

    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true">Guardar</button>

</form>   
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
            
            var formData = $("#form1").serialize();
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type:"POST",
                url:"<?= Front::myUrl('almacen/grupos_crud'); ?>",
                cache:false,
                data:formData,
                success:function(data) {
                    history.back();
                }
            });

            return false;
        });         
     
    });
</script>

<form id="form1" action="index.php" data-transition="slide"  method="post">

    <div data-role="fieldcontain">

        <label style="font-weight:bold" for="r0nombre">Nombre</label>
        <input type="text" data-mini="true" id="r0nombre" name="r0nombre" />

         <label style="font-weight:bold" for="r0margen_a">Margen A</label>
        <input type="number" data-mini="true" id="r0margen_a" name="r0margen_a" />
        
         <label style="font-weight:bold" for="r0margen_b">Margen B</label>
        <input type="number" data-mini="true" id="r0margen_b" name="r0margen_b" />
        
         <label style="font-weight:bold" for="r0margen_c">Margen C</label>
        <input type="number" data-mini="true" id="r0margen_c" name="r0margen_c" />
        
         <label style="font-weight:bold" for="r0margen_d">Margen D</label>
        <input type="number" data-mini="true" id="r0margen_d" name="r0margen_d" />
        
         <label style="font-weight:bold" for="r0comision">Comisión</label>
        <input type="number" data-mini="true" id="r0comision" name="r0comision" />
        
        <p>

            <label for="r0activo">Grupo Activo</label>
            <select name="r0activo" id="r0activo" data-role="slider">
                <option value="0">NO</option>
                <option value="1" selected>SI</option>
            </select>


    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true">Guardar</button>

</form>   
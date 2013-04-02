
<script>
  
    $("div[data-role*='page']").live('pageshow', function() { 
        
        $('#form1').validate({
            rules : {
                r9nombre : {
                    required : true
                }
                     
            }, 
            errorElement: "div"
        });
        
        
        
                      
        $("#submit").click(function(){
                                
           
            if(!$("#form1").valid()) return false; 
           
            var formData = $("#form1").serialize();
            $('#submit').attr('disabled', 'disabled');
 
            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('almacen/almacen_crud'); ?>",
                cache: false,
                data: formData,
                success: function(){
                    history.back();
                }
            });
 
            return false;
        });
    });
</script>



<div id="titulo2">Agregar Almacen</div>

<form id="form1" method="post">

    <div data-role="fieldcontain">
        <label style="font-weight:bold" for="r9nombre">Nombre</label>
        <input type="text" data-mini="true" id="r9nombre" name="r9nombre"/>

 <!--
        <label style="font-weight:bold" for="r9dif_hora">campo1</label>
        <input type="text" data-mini="true" id="r9dif_hora" name="r9dif_hora" value="<?php echo $datos["dif_hora"] ?>"  />


        <label style="font-weight:bold" for="r9moneda1">campo2</label>
        <input type="text" data-mini="true" id="r9moneda1" name="r9moneda1" value="<?php echo $datos["moneda1"] ?>"  />
-->


        <p id="notification"></p>
    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true">Guardar</button>
</form>
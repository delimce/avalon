<script>
  
    $("div[data-role*='page']").live('pageshow', function() { 
                    
        $('#form1').validate({
            rules:{
                r9nombre:{
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
                url:"<?= Front::myUrl('clientes/zonas_crud'); ?>",
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

        <label style="font-weight:bold" for="r9nombre">Nombre</label>
        <input type="text" data-mini="true" id="r9nombre" name="r9nombre"  value="<?=$datos->getField("nombre") ?>"  />

                    
           <p id="notification"></p>

    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true">Guardar</button>

</form>   
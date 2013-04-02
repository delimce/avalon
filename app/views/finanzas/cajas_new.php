<script>
  
    $("div[data-role*='page']").live('pageshow', function() { 
                    
        $('#form1').validate({
            rules:{
                r0nombre:{
                    required:true
                },
                 r0saldo:{
                    number:true
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
                url:"<?= Front::myUrl('finanzas/cajas_crud'); ?>",
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

<form id="form1">

    <div data-role="fieldcontain">

        <label style="font-weight:bold" for="r0nombre">Nombre</label>
        <input type="text" data-mini="true" id="r0nombre" name="r0nombre" />

        <label style="font-weight:bold" for="r0saldo">Saldo inicial</label>
        <input type="number" data-mini="true" id="r0saldo" name="r0saldo" value="0.0" />


    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true">Guardar</button>

</form>   
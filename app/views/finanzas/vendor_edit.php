<script>
  
    $("div[data-role*='page']").live('pageshow', function() { 
                    
        $('#form1').validate({
            rules:{
                r0comision:{
                    number: true
                },
                r0comision2:{
                    number: true
                },
                r0comision3:{
                    number: true
                },
                r0comision4:{
                    number: true
                }
                
            }, 
            errorElement: "div"
        });
        
    
        $("#submit").click(function () {

            //validando
            if (!$("#form1").valid()) return false;
            
              $('#form1').append('<input type="hidden" name="ide" id="ide" value="<?= $datos["id"] ?>" />'); 
              $('#form1').append('<input type="hidden" name="id2" id="id2" value="<?= $datos["id2"] ?>" />'); 
            
            var formData = $("#form1").serialize();
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type:"POST",
                url:"<?= Front::myUrl('finanzas/vendedor_crud'); ?>",
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

        <div style="text-transform: capitalize;font-weight: bold"><?=$datos["nombre"] ?></div>
        <div><?=$datos["email"] ?></div>
        <p>&nbsp;</p>
       <label style="font-weight:bold" for="r0comision">comision 1</label>
       <input type="number" data-mini="true" id="r0comision" name="r0comision"  value="<?=$datos["comision"] ?>"  />
      
        <label style="font-weight:bold" for="r0comision2">comision 2</label>
       <input type="number" data-mini="true" id="r0comision2" name="r0comision2"  value="<?=$datos["comision2"] ?>"  />

        <label style="font-weight:bold" for="r0comision3">comision 3</label>
       <input type="number" data-mini="true" id="r0comision3" name="r0comision3"  value="<?=$datos["comision3"] ?>"  />

        <label style="font-weight:bold" for="r0comision4">comision 4</label>
       <input type="number" data-mini="true" id="r0comision4" name="r0comision4"  value="<?=$datos["comision4"] ?>"  />


    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true">Guardar</button>

</form>   
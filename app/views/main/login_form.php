<script>
      $("div[data-role*='page']").live('pageshow', function() { 
          
          
          $('#form1').validate({
            rules:{
                empresa:{
                    required:true
                },
                user:{
                    required:true
                },
                clave:{
                    required:true
                }
                
            }, 
            errorElement: "div"
        });
     
        $("#submit").click(function(){
            
            //validando
            if (!$("#form1").valid()) return false;
            
            var formData = $("#form1").serialize();
            
            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('main/login'); ?>",
                cache: false,
                data: formData,
                success: function(data){
                    data = $.trim(data);
                    if(data>0){
                        $(location).attr('href','<?= Front::myUrl('main/index'); ?>');
                    }else{
                        alert('nombre de Empresa, clave ó usuario incorrectos');

                    }
                }
            });
 
            return false;
        });
    });
</script>


<!--div de login-->
<div align="center">
    <img  src="<?= Front::myUrl('images/logo-movil.png') ?>" width="156" height="79"/>
    <p><?php echo LANG_adlogin ?></p> 
</div>

<form id="form1" action="modules/lobi.php" data-transition="slide" method="post">

    <div data-role="fieldcontain">

        <label style="font-weight:bold" for="empresa">Empresa</label>
        <input type="text" data-mini="true" id="empresa" name="empresa" />

        <label style="font-weight:bold" for="user">Usuario</label>
        <input type="text" data-mini="true" id="user" name="user" />

        <label style="font-weight:bold" for="clave">Clave</label>
        <input type="password" data-mini="true" id="clave" name="clave" />

    </div>

    <button type="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_enter ?></button>
</form>
<!--div de login--> 
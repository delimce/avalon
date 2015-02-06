<script>
    $(document).ready(function() {	
        
		$('#formulario-recuperar').on('valid', function(e) {
            e.preventDefault();
			
            var pass1   = $("#password1").val();
            var pass2   = $("#password2").val();
            
            if (pass1.length == 0 || pass2.length == 0) {
                $("#amessage").html("TODOS LOS CAMPOS SON OBLIGATORIOS");
                $("#amessage").fadeIn(2000);
                return;
            }
            
            if (pass1 !== pass2) {
                $("#amessage").html("LA CONTRASE&Ntilde;A DEBE SER IGUAL EN AMBOS CAMPOS");
                $("#amessage").fadeIn(2000);
                return;
            }

            // Handle the submission of the form
            var formData = $('#formulario-recuperar').serialize();
            var mensaje;
            			
            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('main/verificarPeticion'); ?>",
                cache: false,
                data: formData,
                success: function(data) {
                    data = $.trim(data);
                    if (data == 1) {
                        mensaje = 'Su contrase&ntilde;a ha sido actualizada. En un momento ser&aacute; redireccionado a la p&aacute;gina principal';
                        $("#amessage").fadeOut(100);
                        $("#formulario-recuperar").fadeOut(100);
                        $("#smessage").html(mensaje).hide().fadeIn(2000);
                        setTimeout ("redireccionar()", 4000);
                    } else if (data == 0) {///inactivo
                    	mensaje = 'Petci&oacute;n Inactiva';
                    	$("#smessage").fadeOut(100);
                    	$("#omessage").html(mensaje).hide().fadeIn(2000);
                    } else { ///no se loguea
                        mensaje = 'No se puede contactar al Servidor';
                    }                    
                }
            });
			
            return false;
        });

    });

    function redireccionar(){
        $(location).attr('href',"<?= Front::myUrl('main/index'); ?>");
    }

</script>

<?php if($usuario > 0) { ?>
<div id="contrasena" class="row" >
    <div class="col-md-4 col-md-push-4 text-center">
        <img class="img-responsive" style="padding-bottom: 10px" src="<?= Front::myUrl("img/vconsole/common/vlogo375x203.png") ?>" alt="logo"/>
        <div style="text-align: right; margin-right: 4px">vConsole Beta</div>
        <br />
        <div><h4>RECPERACI&Oacute;N DE CONTRASE&Ntilde;A</h4></div>
        <form id="formulario-recuperar" data-abide="ajax" >    
            <div class="form-group" >
                <input class="form-control" id="password1" name="password1" type="password"  placeholder="<?= LANG_pass_input ?>"  />                				
            </div>
            <div class="form-group">
                <input class="form-control" id="password2" name="password2" type="password"   placeholder="<?= LANG_pass2 ?>"   />
                <input class="form-control" name="clave" type="hidden"   value="<?= $sesion ?>"  />
            </div>
            <button class="btn btn-primary" style="width: 100%" id="botonenviar" type="submit"><?= LANG_process ?></button>
        </form>
    </div>
</div>

<div class"row" align="center">
    <span  id="smessage" class="text-center alert alert-success" role="alert" style="display:none"></span>
    <div  id="amessage" class="text-center alert alert-danger" role="alert" style="display:none"></div>
</div>

<?php } else { ?>
    <div class="container">
        <div class"col-md-12" align="center">            
            <img class="img-responsive" style="padding-bottom: 10px" src="<?= Front::myUrl("img/vconsole/common/vlogo375x203.png") ?>" alt="logo"/>
        </div>
        <div class"col-md-12" align="center">          
            <div  class="col-md-6 col-md-push-3 text-center alert alert-danger lead" role="alert">
                LA PETICI&Oacute;N SOLICITADA NO EXISTE
            </div>
        </div>
        <div class="col-md-12">
            <div  id="enlace" role="alert" class="text-center" ><a href="<?= Front::myUrl('main/index'); ?>"><h4>Ir al Inicio</h4></a></div>
        </div>
    </div>
    
<?php } ?>
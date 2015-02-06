<script>
    $(document).ready(function() {
        $('#form1').on('submit', function(e) {
            e.preventDefault();
			console.log('entrada');
            // Handle the submission of the form
            var formData = $('#form1').serialize();
            var mensaje;

            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('main/validarLogin'); ?>",
                cache: false,
                data: formData,
                success: function(data) {
                    data = $.trim(data);
                    if (data == 1) {
                        $(location).attr('href', '<?= Front::myUrl('main/index'); ?>');
                    } else if (data == 2) {///inactivo
                        mensaje = 'Ud está inactivo';
                    } else { ///no se loguea
                        mensaje = 'Error de usuario ó clave';
                    }

                    $("#mensaje").html(mensaje).hide().fadeIn(1100);

                }
            });
            return false;
        });
		
		$('#formulario-olvido').on('submit', function(e) {
            e.preventDefault();

            if($("#emailolvido").val().length == 0) {
                mensaje  = "Indica tu Email";
                $("#omessage").html(mensaje);
                $("#omessage").fadeIn(100);
                $("#omessage").fadeOut(100000);
                return;
            }
			
            // Handle the submission of the form
            var formData = $('#formulario-olvido').serialize();
            var mensaje;
            			
            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('main/validarPeticionOlvido'); ?>",
                cache: false,
                data: formData,
                success: function(data) {
                    data = $.trim(data);
                    if (data == 1) {
                        $.ajax({
			                type: "POST",
			                url: "<?= Front::myUrl('main/enviarEmail'); ?>",
			                cache: false,
			                data: formData,
			                success: function(data) {
			                	if (data === 'sent' || data === 'queued') {
                                    $("#omessage").fadeOut(100);
                                    /*
			                		mensaje  = "Te enviamos un email a "+$("#emailolvido").val()+".";
                                    mensaje += "<br />";
                                    mensaje += "Por favor ingresa a tu cuenta de correo electr&oacute;nico "+$("#emailolvido").val()+" y sigue las instrucciones para reestablecer tu contrase&ntilde;a."
                                    */
                                    mensaje = '<span style="color:green;font-size:2em;" class="glyphicon glyphicon-ok-sign"></span>';
			                		$("#smessage").html(mensaje);
									$("#smessage").fadeIn(2000);
                                    $("#emailolvido").val('');
			                	} else {
			                		mensaje = data;
			                	}			                	
			             	}
			            });
                    } else if (data == 2) {///inactivo
                    	mensaje = 'Sus datos se encuentran inactivos';
                    	$("#smessage").fadeOut(100);
                    	$("#omessage").html(mensaje).hide().fadeIn(2000);
                    } else if (data == 0) {///inactivo
                        mensaje = 'Email no registrado';
                        $("#smessage").fadeOut(100);
                        $("#omessage").html(mensaje).hide().fadeIn(2000);
                    } else { ///no se loguea
                        mensaje = 'No se puede contactar al Servidor';
                        $("#smessage").fadeOut(100);
                        $("#omessage").html(mensaje).hide().fadeIn(2000);
                    }                    
                }
            });
			
			
			//$("#retorno").text("Hemos enviado un Correo Electrónico a su cuenta de Correo "+$("#emailusuario").val()+" para reestablecer su contraseña. Por favor Ingrese y siga las Instrucciones");
			//$("#respuesta").fadeIn(2000);
            return false;
        });
		
		$('#form-registro').on('submit', function(e) {
            e.preventDefault();
			
            console.log("prueba");
			var email1 = $("#email").val();
			var email2 = $("#email_confirma").val();
			
			if (email1 !== email2){
				$("#retorno-registro").text("EL EMAIL DEBE SER IGUAL EN AMBOS CAMPOS");
				$("#respuesta-registro").fadeIn(2000);
				$("#respuesta-registro").fadeOut(2000);
				return;
			}
			
            // Handle the submission of the form
            var formData = $('#form-registro').serialize();
            var mensaje;
			
            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('prospectos/crearProspecto'); ?>",
                cache: false,
                data: formData,
                success: function(data) {
                    data = $.trim(data);
                    if (data === "ok") {
                        $("#form-registro").fadeOut(800);
						$("#retorno-registro").text("SUS DATOS HAN SIDO RECIBIDOS");
						$("#respuesta-registro").fadeIn(2000);
						$('#form-registro')[0].reset();
                    } else {
						alert(data);
					}
                    $("#mensaje").html(mensaje).hide().fadeIn(1100);

                    console.log('psando');

                    //Crear el registro en vbroker
                    $.ajax({
                        type: "POST",
                        url: "<?= Front::myUrl('usuarios/crearUsuario'); ?>",
                        cache: false,
                        data: formData,
                        success: function(data) {
                            console.log('veamos');
                            console.log(data);
                        }
                    });
                }
            });
            return false;
        });
		
		
		$('#enlace-registro').on('click', function() {
			$('#form-registro')[0].reset();
			$("#form-registro").fadeIn(500);
			$("#respuesta-registro").fadeOut(0);
		});

        $('input').on('click', function() {

            $("#mensaje").hide();

        });


    });

</script>

<div class="col-md-6">
    <img class="img-responsive" style="padding-bottom: 10px" src="<?= Front::myUrl("img/vconsole/common/vBrokers_Logo1.png") ?>" alt="logo"/>    
</div>


<div class="col-md-12">
    <div class="col-md-4 col-md-push-4">
        <p class="text-center" style="font-size:1.8em;color:#fff;">
            Iniciar Sesi&oacute;n
        </p>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-4 col-md-push-4" style="background-color:#fff;border-radius:5px;padding-top:1em;">
        <div class="col-md-12">
            <form id="form1" class="contact-form" role="form">
                <div id="login">
                <div class="form-group">
                    <label class="sr-only" for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" required placeholder="<?= LANG_login ?>" class="form-control input-lg">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="password">Contrase&ntilde;a</label>
                    <input type="password" id="password" name="password" required placeholder="<?= LANG_pass ?>" class="form-control input-lg">
                </div>
                <div class="form-group">
                    <p class="text-center">
                        <a href="#recuperar" data-toggle="modal" style="color:#666;">Olvidaste tu contrase&ntilde;a?</a>
                    </p>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg" type="submit" style="width:100%;background-color:#71c5bb;color:#fff;">
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>
                </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <button class="btn btn-lg" style="width:100%;background-color:#0087b2;color:#fff;">
                    <i class="icon-large icon-linkedin"></i>&nbsp; iniciar sesi&oacute;n con Linkedin
                </button>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <button class="btn btn-lg" style="width:100%;background-color:#d13e36;color:#fff;">
                    <i class="icon-large icon-google-plus"></i>&nbsp; iniciar sesi&oacute;n con Google+
                </button>
            </div>
        </div>
    </div>
    
</div>

<div class="col-md-12 contenedor-secundario">
    <div class="col-md-4 col-md-push-4" style="background-color:#000;opacity: 0.6;border-radius: 5px;">
        <p class="text-center" >
            <a href="#ventana-registro" data-toggle="modal" style="color:#fff;">Eres nuevo en vBrokers? Suscribete ahora.</a>
        </p>
    </div>
</div>

<!-- Ventana de Registro -->   
<div class="modal fade" id="ventana-registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" align="center">
                <form id="form-registro" role="form" class="contact-form" >
                    <div clas="form-group">                        
                        <label class="sr-only" for="nombre">Nombre</label>
                        <input name="nombre" id="nombre" type="text" required placeholder="<?= LANG_name ?>" class="form-control input-lg" />
                    </div>
                    <div clas="form-group">
                        <br />
                        <label class="sr-only" for="apellido">Apellido</label>
                        <input name="apellido" id="apellido" type="text" required placeholder="<?= LANG_lastname ?>" class="form-control input-lg" />
                    </div>
                    <div clas="form-group">
                        <br />
                        <label class="sr-only" for="email">Email</label>
                        <input name="email" id="email" type="email" required placeholder="<?= LANG_email ?>" class="form-control input-lg" />
                    </div>
                    <div clas="form-group">
                        <br />
                        <label class="sr-only" for="email_confirma">Email</label>
                        <input name="email_confirma" id="email_confirma" type="email" required placeholder="<?= LANG_email2 ?>" class="form-control input-lg" />
                    </div>
                    <div clas="form-group">
                        <br />
                        <button type="submit" class="btn btn-lg" style="background-color:#38ccda;color:#fff;width:100%;">Continuar</button>
                    </div>
                </form>
                <div id="respuesta-registro" style="display:none" class="text-center"><h3 id="retorno-registro"></h3></div>
            </div>
        </div>
    </div>
</div>

<!-- Ventana de Recuperar Contraseña -->
<div class="modal fade" id="recuperar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-sm">
    	<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
      		<div class="modal-body" align="center">
                <div clas="col-md-12">
                    <p style="font-size:1.3em;color:#888;">
                        Si conoces tu email, introd&uacute;celo a continuaci&oacute;n.
                    </p>
                </div>
                <div clas="col-md-12">
            		<form id="formulario-olvido" data-abide="ajax">
    				  	<div class="form-group">
    				    	<label class="sr-only" for="emailolvido">Email</label>
    				    	<div class="input-group">
    				      		<input style="background-color:#f0f0f0;" type="email" required class="form-control" id="emailolvido" name="emailolvido" placeholder="Indique su Email">
    				      		<div class="input-group-addon">@</div>
    				    	</div>
    				  	</div>
    				  	<button type="submit" class="btn" style="background-color:#38ccda;color:#fff;width:100%;">Continuar</button>
    				</form>
                </div>
                <div clas="col-md-12" style="padding-top:1em;color:#777;">
                    <p>
                        Pr&oacute;ximamente te enviaremos un email con instrucciones
                        sobre c&oacute;mo acceder a tu cuenta.
                    </p>
                </div>
                <div clas="col-md-12" style="padding-top:1em;color:#777;">
                    <p>
                        Olvidaste tu email? <a href="#" style="color:#666;font-style:bold;"><b>Hax clic aqu&iacute;</b></a>
                    </p>
                </div>
                
      		</div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <div id="smessage" style="display:none" class="text-center"></div>
                    <div id="omessage" style="display:none" class="text-center bg-danger"></div>
                </div>
            </div>
    	</div>
  	</div>
</div>

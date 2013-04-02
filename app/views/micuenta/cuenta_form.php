<script>
  
    $("div[data-role*='page']").live('pageshow', function() { 
           
        $.validator.addMethod("not_blank_between", function () {

            var n = $('#r0user').val().split(" ");
            if (n.length > 1)
                return false;
            else
                return true;

        }, "El usuario no puede tener espacios en blanco");
        
                      
        $('#form1').validate({
            rules:{
                r0nombre:{
                    required:true
                },
                r0email:{
                    email:true
                },
                r0telefono1:{
                    digits:true
                },
                r0user:{
                    required:true,
                    not_blank_between:true
                },
                clave:{
                    required:true,
                    minlength: 4
                },
                clave2:{
                    required:true,
                    minlength: 4,
                    equalTo: "#clave"
                }

            }, 
            errorElement: "div"
        });
        
    
        $("#submit").click(function () {


            //validando
            if (!$("#form1").valid()) return false;

            var formData = $("#form1").serialize();

            $.ajax({
                type:"POST",
                url:"<?= Front::myUrl('micuenta/save'); ?>",
                cache:false,
                data:formData,
                success:function(data, status) {
                    data = $.trim(data);

                    $("#notification").text(data);
                    $("#notification").css({color:"blue", fontWeight:"bold"});


                }
            });

            return false;
        });         
     
    });
</script>

<div id="titulo2">Edición de datos</div>

<form id="form1" method="post">

    <div data-role="fieldcontain">
        <label style="font-weight:bold" for="r0nombre">Nombre</label>
        <input type="text" id="r0nombre" name="r0nombre" value="<?= $datos->getField("nombre") ?>"/>

        <label style="font-weight:bold" for="r0email">Email</label>
        <input type="email" id="r0email" name="r0email" value="<?= $datos->getField("email") ?>">

        <label style="font-weight:bold" for="r0telefono1">Telefono</label>
        <input type="text" id="r0telefono1" name="r0telefono1" value="<?= $datos->getField("telefono1") ?>">

        <label style="font-weight:bold" for="r0user">Usuario</label>
        <input type="text" data-mini="true" id="r0user" name="r0user" value="<?= $datos->getField("user") ?>"/>

        <label style="font-weight:bold" for="clave">Clave:</label>
        <input type="password" data-mini="true" id="clave" name="clave" value="<?= $datos->getField("password") ?>"/>

        <label style="font-weight:bold" for="clave2">Confirme clave:</label>
        <input type="password" data-mini="true" id="clave2" name="clave2" value="<?= $datos->getField("password") ?>"/>

        <p id="notification"></p>
    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value"
            data-inline="true">Guardar</button>
</form>
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
                r0user:{
                    required:true,
                    not_blank_between:true
                },
                r0email:{
                    email:true
                },
                r0telefono1:{
                    digits:true
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
            
            $('#form1').append('<input type="hidden" name="ide" id="ide" value="<?= $datos->getField("id") ?>" />'); 

            var formData = $("#form1").serialize();

            $.ajax({
                type:"POST",
                url:"<?= Front::myUrl('admin/users_crud'); ?>",
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


<div id="notification">Editar usuario</div>

<form id="form1" data-transition="slide" method="post">

    <div data-role="fieldcontain">

        <label style="font-weight:bold" for="r0nombre">Nombre</label>
        <input type="text" data-mini="true" id="r0nombre" name="r0nombre" value="<?= $datos->getField("nombre"); ?>"/>

        <label style="font-weight:bold" for="r0email">Email</label>
        <input type="email" data-mini="true" id="r0email" name="r0email" value="<?= $datos->getField("email"); ?>"/>

        <label style="font-weight:bold" for="r0telefono1">Telefono</label>
        <input type="text" data-mini="true" id="r0telefono1" name="r0telefono1" value="<?= $datos->getField("telefono1"); ?>"/>

        <label style="font-weight:bold" for="r0perfil_id">Perfil</label>
        <?= $perfiles ?>

        <label style="font-weight:bold" for="r0user">Usuario</label>
        <input type="text" data-mini="true" id="r0user" name="r0user" value="<?= $datos->getField("user"); ?>"/>

        <label style="font-weight:bold" for="clave">Clave:</label>
        <input type="password" data-mini="true" id="clave" name="clave" value="<?= $datos->getField("password"); ?>"/>

        <label style="font-weight:bold" for="clave">Confirme clave:</label>
        <input type="password" data-mini="true" id="clave2" name="clave2" value="<?= $datos->getField("password"); ?>"/>

        <fieldset data-role="controlgroup">
            <legend>Habilitar Módulos:</legend>
            <?php foreach ($modulos as $i => $value) { ?>
                <input type="checkbox" name="mod_<?= $modulos[$i]['id'] ?>" id="mod_<?= $modulos[$i]['id'] ?>" class="custom" <?php echo ($modulos[$i]['per']) > 0 ? 'checked' : '' ?>/>
                <label for="mod_<?= $modulos[$i]['id'] ?>"><?= $modulos[$i]['nombre'] ?></label>
            <?php } ?>
        </fieldset>

        <p>

            <label for="r0activo">Usuario Activo</label>
            <select name="r0activo" id="r0activo" data-role="slider">
                <option value="0" <?php echo ($datos->getField("activo")) == 0 ? 'selected' : '' ?> >NO</option>
                <option value="1" <?php echo ($datos->getField("activo")) > 0 ? 'selected' : '' ?> >SI</option>
            </select>

        <p id="notification"></p>
    </div>



    <button data-role="submit" id="submit" value="submit"  data-inline="true">Guardar</button>

</form>
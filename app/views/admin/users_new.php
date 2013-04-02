<script>
  
    $("div[data-role*='page']").live('pageshow', function() { 
        
        
        $.validator.addMethod("not_blank_between", function () {

            var n = $('#r0user').val().split(" ");
            if (n.length > 1)
                return false;
            else
                return true;

        }, "El usuario no puede tener espacios en blanco");
        
                  
        $.validator.addMethod('atLeastOneChecked', function(value, element) {
            return ($('.controlgroup input:checked').length > 0);
        }); 
        
        
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

            var formData = $("#form1").serialize();
            
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type:"POST",
                url:"<?= Front::myUrl('admin/users_crud'); ?>",
                cache:false,
                data:formData,
                success:function() {
                    history.back();
                }
            });

            return false;
        });         
     
    });
</script>


<div id="notification">Agregar nuevo usuario</div>

<form id="form1" action="index.php" data-transition="slide" method="post">

    <div data-role="fieldcontain">

        <label style="font-weight:bold" for="r0nombre">Nombre</label>
        <input type="text" data-mini="true" id="r0nombre" name="r0nombre"/>

        <label style="font-weight:bold" for="r0email">Email</label>
        <input type="email" data-mini="true" id="r0email" name="r0email"/>

        <label style="font-weight:bold" for="r0telefono1">Telefono</label>
        <input type="text" data-mini="true" id="r0telefono1" name="r0telefono1"/>

        <label style="font-weight:bold" for="r0perfil_id">Perfil</label>
        <?= $perfiles ?>

        <label style="font-weight:bold" for="r0user">Usuario</label>
        <input type="text" data-mini="true" id="r0user" name="r0user"/>

        <label style="font-weight:bold" for="clave">Clave:</label>
        <input type="password" data-mini="true" id="clave" name="clave"/>

        <label style="font-weight:bold" for="clave">Confirme clave:</label>
        <input type="password" data-mini="true" id="clave2" name="clave2"/>

        <fieldset data-role="controlgroup">
            <legend>Habilitar Módulos:</legend>
            <?php foreach ($modulos as $i => $value) { ?>
                <input type="checkbox" name="mod_<?= $modulos[$i]['id'] ?>" id="mod_<?= $modulos[$i]['id'] ?>" class="competecheckbox"/>
                <label for="mod_<?= $modulos[$i]['id'] ?>"><?= $modulos[$i]['nombre'] ?></label>
            <?php } ?>
        </fieldset>

        <p>

            <label for="r0activo">Usuario Activo</label>
            <select name="r0activo" id="r0activo" data-role="slider">
                <option value="0">NO</option>
                <option value="1" selected>SI</option>
            </select>

    </div>

    <button data-role="submit" id="submit" value="submit"  data-inline="true">Guardar</button>

</form>


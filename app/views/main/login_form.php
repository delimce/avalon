<script type="text/javascript">
    $(document).ready(function () {


          $('#form1').validate({
            rules:{
                username:{
                    required:true
                },
                pass:{
                    required:true
                }

            }
        });



        $("#submit").click(function () {
            
            
            if (!$("#form1").valid()) return false;
            
            var formData = $("#form1").serialize();
            $.ajax({
                type:"POST",
                url:"<?=Front::myUrl('main/login'); ?>",
                cache:false,
                data:formData,
                success:function (data) {
                 
                 if(data!=0){
                         location.replace('<?=Front::myUrl('main/index'); ?>');
                     }else{
                        $("#msg").text("sus credenciales de acceso son inválidas");
                        $("#msg").css({color:"red", fontWeight:"bold"});
                     }
                  
                }
            });

            return false;

        });


    });
    
</script>


<form id="form1" method="post" onsubmit="return false;">
    <div>
        <input type="hidden" name="LoginForm" value="1"/>
        <table style="width:auto">
            <thead>
            <tr>
                <th>LOGIN</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Usuario<br/><input  type="text" name="username" id="username" value=""/></td>
            </tr>
            <tr>
                <td>Password<br/><input type="password" name="pass" id="pass" value=""/>
                    <br>
                    <input class="button" type="button" name="submit" id="submit" value="Aceptar"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</form>
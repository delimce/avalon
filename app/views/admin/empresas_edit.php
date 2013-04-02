<script type="text/javascript">

    /***********************************************
     * Local Time script- © Dynamic Drive (http://www.dynamicdrive.com)
     * This notice MUST stay intact for legal use
     * Visit http://www.dynamicdrive.com/ for this script and 100s more.
     ***********************************************/

    var weekdaystxt=["Sun", "Mon", "Tues", "Wed", "Thurs", "Fri", "Sat"]

    function showLocalTime(container, servermode, offsetMinutes, displayversion){
        if (!document.getElementById || !document.getElementById(container)) return
        this.container=document.getElementById(container)
        this.displayversion=displayversion
        var servertimestring=(servermode=="server-php")? '<? print date("F d, Y H:i:s", time()) ?>' : (servermode=="server-ssi")? '<!--#config timefmt="%B %d, %Y %H:%M:%S"--><!--#echo var="DATE_LOCAL" -->' : '<%= Now() %>'
        this.localtime=this.serverdate=new Date(servertimestring)
        this.localtime.setTime(this.serverdate.getTime()+offsetMinutes*60*1000) //add user offset to server time
        this.updateTime()
        this.updateContainer()
    }

    showLocalTime.prototype.updateTime=function(){
        var thisobj=this
        this.localtime.setSeconds(this.localtime.getSeconds()+1)
        setTimeout(function(){thisobj.updateTime()}, 1000) //update time every second
    }

    showLocalTime.prototype.updateContainer=function(){
        var thisobj=this
        if (this.displayversion=="long")
            this.container.innerHTML=this.localtime.toLocaleString()
        else{
            var hour=this.localtime.getHours()
            var minutes=this.localtime.getMinutes()
            var seconds=this.localtime.getSeconds()
            var ampm=(hour>=12)? "PM" : "AM"
            var dayofweek=weekdaystxt[this.localtime.getDay()]
            this.container.innerHTML=formatField(hour, 1)+":"+formatField(minutes)+":"+formatField(seconds)+" "+ampm
        }
        setTimeout(function(){thisobj.updateContainer()}, 1000) //update container every second
    }

    function formatField(num, isHour){
        if (typeof isHour!="undefined"){ //if this is the hour field
            var hour=(num>12)? num-12 : num
            return (hour==0)? 12 : hour
        }
        return (num<=9)? "0"+num : num//if this is minute or sec field
    }

</script>



<script>
  
    $("div[data-role*='page']").live('pageshow', function() { 
    
        $('#form1').validate({
            rules : {
                r9nombre : {
                    required : true
                },
                r9moneda1 :  {
                    required : true
                },
                r9dif_hora :  {
                    required : true,
                    number: true
                }
                     
            }, 
            errorElement: "div"
        });
    
                  
        $("#submit").click(function(){
                    
                    
            if(!$("#form1").valid()) return false; 
                                
            $('#form1').append('<input type="hidden" name="ide" id="ide" value="<?= $datos->getField("id") ?>" />');                     
            var formData = $("#form1").serialize();
 
            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('admin/empresas_crud'); ?>",
                cache: false,
                data: formData,
                success: function(data){
                    $("#notification").text(data);
                    $("#notification").css({color:"blue", fontWeight:"bold"});
                }
            });
 
            return false;
        });
    });
</script>   


<div id="titulo2">Editar Empresa</div>

<form id="form1" method="post">

    <div data-role="fieldcontain">
        <label style="font-weight:bold" for="r9nombre">Nombre</label>
        <input type="text" data-mini="true" id="r9nombre" name="r9nombre" value="<?php echo $datos->getField("nombre") ?>"  />

        <label style="font-weight:bold" for="r9site_titulo">Titulo</label>
        <input type="text" id="r9site_titulo" name="r9site_titulo" value="<?php echo $datos->getField("site_titulo") ?>" >

        <div>
            <label style="font-weight:bold">hora actual:</label>
            <span id="timecontainer"></span>

            <?php echo @date("d/m/Y"); ?> 
            <script type="text/javascript">
                new showLocalTime("timecontainer", "server-php", 0, "short")
            </script>
        </div>
        <label style="font-weight:bold" for="r9dif_hora">dif. hora server</label>
        <input type="text" data-mini="true" id="r9dif_hora" name="r9dif_hora" value="<?php echo $datos->getField("dif_hora"); ?>"  />


        <label style="font-weight:bold" for="r9moneda1">Moneda</label>
        <input type="text" data-mini="true" id="r9moneda1" name="r9moneda1" value="<?php echo $datos->getField("moneda1"); ?>"  />

        <!-- envio de emails -->
        <label style="font-weight:bold" for="r9envio_email">Envio de Emails</label>
        <select name="r9envio_email" id="r9envio_email" data-role="slider">
            <option value="0" <?php if ($datos->getField("envio_email") == 0) echo 'selected'; ?> >NO</option>
            <option value="1" <?php if ($datos->getField("envio_email") == 1) echo 'selected'; ?> >SI</option>
        </select>


        <p id="notification"></p>
    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true">Guardar</button>
</form>
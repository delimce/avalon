<script>

    $("div[data-role*='page']").live('pageshow', function() {


        ///para la fecha por defecto
        var today = new Date();
        
        var date = today.getDate();
        var month = (today.getMonth() + 1);
        var year = today.getFullYear();

        var todayStr = year + "-" + month + "-" + date;
        $('#r0fecha').trigger('datebox', {'method': 'set', 'value': todayStr});



        $('#form1').validate({
            rules: {
                r0fecha: {
                    required: true
                },
                r0porcentaje: {
                    number: true
                }

            },
            errorElement: "div"
        });


        $("#submit").click(function() {

            //validando
            if (!$("#form1").valid())
                return false;

            var formData = $("#form1").serialize();
            $('#submit').attr('disabled', 'disabled');

            $.ajax({
                type: "POST",
                url: "<?= Front::myUrl('finanzas/iva_crud'); ?>",
                cache: false,
                data: formData,
                success: function(data) {
                    history.back();
                }
            });

            return false;
        });

    });
</script>

<form id="form1">

    <div data-role="fieldcontain">

        <label style="font-weight:bold" for="r0fecha">Fecha</label>
        <input name="r0fecha" id="r0fecha" type="date" data-role="datebox"
               data-options='{"mode": "calbox","dateFormat":"%m/%d/%Y","calUsePickers": true, "calNoHeader": true,"highDates": ["2012-12-07" , "2012-07-12"] }' ></input>

         <label style="font-weight:bold" for="r0tipoiva">I.V.A</label>
        <?=$iva ?>
        
        <label style="font-weight:bold" for="r0porcentaje">procentaje</label>
        <input type="number" data-mini="true" id="r0porcentaje" name="r0porcentaje" value="0.0" />

    </div>

    <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true">Guardar</button>

</form>   
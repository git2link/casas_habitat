<section class="dataContainer">
    <h2>Actividades</h2>
<div id="output"></div><br>
<script type="text/javascript">
    
    var loadChart = function() {
        
        url="<?=base_url('reporte/get_report/1')?>";
        
        google.load("visualization", "1", {packages:["corechart", "charteditor"]});
        var derivers = $.pivotUtilities.derivers;
        var renderers = $.extend($.pivotUtilities.renderers, 
        $.pivotUtilities.gchart_renderers);
        $.getJSON(url,{format:"json"}, function(mps) {
            $("#output").pivotUI(mps, {
                renderers: renderers,
                rendererName: 'Table',
                rows: ['empleado'],
                cols: ['actividad'],
                aggregatorName: 'Cuenta'
            },false,'es');
        }).error(function(a, b, c) { console.log(a) })
    };
    loadChart();
    /*
    $( '#saveExport' ).on('click', function(event) {
        if ( $('.pvtRenderer').val() === 'Table' ) {
            functionPNotify('Exportando (Se exportarán los datos conforme la visibilidad de la tabla).','info');
            $(".pvtTable").attr('id', 'tblExport');
            var uriContent = $(".pvtTable").battatech_excelexport({
                containerid: "tblExport", 
                datatype: 'table',
                returnUri: true
            });
            $(this).attr("href", uriContent).attr("download", "ReporteMovil_Profunda_CONSEG.xls");
        }else{
            functionPNotify('Sólo puedes exportar los datos, si has seleccionado la opción: Table','info');
            $('.pvtRenderer').focus();
            return false;
        };
    });
    loadChart('','');*/
</script>

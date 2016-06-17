<div id="modal_1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Agendar Propuesta</h3>
            </div>
            <div class="modal-body">
                <form id="form_1">
                    <div align="center">
                        <label>Detalles de la Propuesta</label>
                    </div>

                    <label>Pago de Contado</label>
                    <input name="pago_contado" class="form-control" onkeyup="formatear_num(this)" onchange="formatear_num(this)" onfocus="formatear_num(this)">
                    <label>Precio Pactado</label>
                    <input name="precio_pactado" class="form-control" onkeyup="formatear_num(this)" onchange="formatear_num(this)" onfocus="formatear_num(this)">
                    <label>Anticipo</label>
                    <input name="anticipo" class="form-control" onkeyup="formatear_num(this)" onchange="formatear_num(this)" onfocus="formatear_num(this)">
                    <label># Pagos</label>
                    <input type="number" name="mensualidades" class="form-control" >
                    <br>
                    <div align="center" id="div_btn_pago">
                        <button onclick="agregarPago()" class="btn btn-success" >Agregar Pago</button>
                    </div>

                    <table id="tbl_2" class="table-bordered table-highlight display" style="width:100%" hidden>
                        <thead>
                        <tr>
                            <th>Monto</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                    </table>
                    <label>Comercializacion</label>
                    <input name="comercializacion" class="form-control" id="comercializacion" >
                    <input name="propuesta_tmp_k" id="propuesta_tmp" hidden>
                    <br>
                    <input class="action" hidden>
                    <input id="casa_propuesta"    name="casa_k" hidden>
                    <input id="cliente_propuesta" name="cliente_k" hidden>
                    <div class="modal-footer">
                        <button data-dismiss="modal" id="submit_form_1" class="btn btn-default" >Continuar</button>
                    </div>
                </form>
                <div id="pagos" hidden>
                    <form id="form_2">
                        <label>Fecha de Pago</label>
                        <input name="fecha" id='fecha' class="form-control date">
                        <label>Monto</label>
                        <input name="monto" id='monto' class="form-control" onkeyup="formatear_num(this)" onchange="formatear_num(this)" onfocus="formatear_num(this)">
                        <input name="propuesta_tmp_k" id="propuesta_tmp_k" hidden>
                        <div class="modal-footer">
                            <button data-dismiss="modal" id="submit_form_2" class="btn btn-default" >Agregar Pago</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('form').click(function(){
            return false;
        });

    });

    function agregarPago(){

        $('#div_btn_pago').hide();
        $("#pagos").show();
        $('#monto').focus();

    }

    $('#submit_form_1').on('click', function(e){
        e.preventDefault();
        var data = $('#form_1').serialize();
        pnotify_common('info');
        $.ajax({
            type: 'POST',
            url: "<?=base_url('propuestas/insertar_propuesta')?>",
            data: data,
            success: function(data){
                if (data == 1) {
                    pnotify_common('success');
                    $('#modal_1').modal('hide');
                    $('#pago_contado').val('');
                    $('#precio_pactado').val('');
                    $('#anticipo').val('');
                    $('#mensualidades').val('');
                    $('#comercializacion').val('');
                    table_1.ajax.reload();
                }else{
                    pnotify_common('error');
                    $('#modal_1').modal('hide');
                }
            },
            error: function(a, b, c){
                pnotify_common('error');
                console.log(a);
                console.log(b);
                console.log(c);
                $('#modal_1').modal('hide');
            }
        });
    });

    function obtenerPagosPropuesta(){

        var table_2 = $('#tbl_2').DataTable({
            destroy: true,
            info: false,
            bLengthChange: false,
            bPaginate: false,
            bFilter: false,
            dom: 'T<"clear">lfrtip',
            tableTools: {
                sRowSelect: 'single',
                aButtons: []
            },
            language: {
                "url": "../../../../js/datatables/datatables.es.js"
            },
            ajax: {
                url: '../../../casa/pagosdatatable',
                type: "POST",
                data: { propuesta_tmp_k: $('#propuesta_tmp').val() }
            },
            columns: [{
                "data": "monto"
            }, {
                "data": "fecha"
            }],
            createdRow: function(row, data, index) {
            },
            "fnInitComplete": function(oSettings, json) {
                //$(".DTTT_container").appendTo(".table_functions_left");
                $(".dataTables_filter").appendTo(".table_functions_right");
                //$(".DTTT_button").addClass('btn btn-sm btn-success').removeClass('DTTT_button');
            }
        });
    }

    $('#submit_form_2').on('click', function(){
        $("#modal_1").mask({'label':""});
        var data = $('#form_2').serialize();
        $.ajax({
            type: 'POST',
            url: "<?=base_url('propuestas/insertar_pago_tmp')?>",
            data: data,
            success: function(data){
                $("#modal_1").unmask({'label':""});
                $('#div_btn_pago').show();
                $("#pagos").hide();
                $("#tbl_2").show();
                obtenerPagosPropuesta();
                $('#monto').val('');
                $('#fecha').val('');
            },
            error: function(a, b, c){
                pnotify_common('error');
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });
    });


</script>
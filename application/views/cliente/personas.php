<div class="page-header">
    <h1> <?= ucwords($tipo) ?> <small> gestión </small> </h1> 
    <div class="pull-left table_functions_left">
        <?php if ($tipo=='prospecto'): ?>
            <a id="btn_modal_client" data-toggle="modal" href="#modal_1" class="btn btn-sm btn-success btn_upload" class="btn btn-success" title="Agregar imagen">
                <i class="fa fa-plus"></i>
            </a>
        <?php endif ?>
        <a id="btn_modal_update" data-toggle="modal" href="#modal_1" class="btn btn-sm btn-secondary" class="btn btn-success" title="Agregar imagen">
            <i class="fa fa-pencil-square-o"></i>
        </a>
    </div>
    <div class="pull-right table_functions_right">
    </div>
</div>

<br>

<div id="table_elemnts_left" class="col-lg-6"></div>
<div id="table_elemnts_right" class="col-lg-6"></div>
<table id="tbl_1" class="table-bordered table-highlight display" style="width:100%">
    <thead>
    	<tr>
        	<th>Nombre</th>
            <th>Ocupación</th>
            <th>Empresa</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Movil</th>
       	</tr>
   	</thead>
</table>

<script type="text/javascript">

	var table_1 = $('#tbl_1').DataTable({
            destroy: true,
            info: false,
            bLengthChange: false,
            dom: 'T<"clear">lfrtip',
            tableTools: {
              sRowSelect: 'single',
              aButtons: []
            },
            language: {
                "url": "<?=base_url('../js/datatables/datatables.es.js')?>"
            },
            ajax: {
                url: "<?=base_url('cliente/datatable')?>",
                type: "POST",
                data: { table: 1,
                        tipo: "<?=$tipo?>" }
            },
            columns: [{
                "data": "name"
            }, {
                "data": "ocupacion"
            },{
                "data": "empresa"
            },{
                "data": "email"
            }, {
                "data": "telefono_casa"
            }, {
                "data": "telefono_celular"
            }],
            createdRow: function(row, data, index) {
            },
            "fnInitComplete": function(oSettings, json) {
              //$(".DTTT_container").appendTo(".table_functions_left");
              $(".dataTables_filter").appendTo(".table_functions_right");
              //$(".DTTT_button").addClass('btn btn-sm btn-success').removeClass('DTTT_button');
            }
        });
    
    $('#btn_modal_client').on('click', function(e){
        e.preventDefault();
        $('#form_1')[0].reset();
        $('.action').val('insert_prospecto');
    });

    $('#btn_modal_update').on('click', function(e){
        e.preventDefault();
        var dta_table = table_1.row($('tr.selected')).data();
        if (dta_table != undefined) {
            $('#codigo_postal').val(dta_table['codigo_postal']);
            $('#codigo_postal').blur();
            setTimeout(function(){ 
                $.each(dta_table, function( index, value ) {
                    $('#form_1 input, #form_1 select, #form_1 textarea').each(function(){
                        var name = $(this).attr('name');
                        if (name == index) {
                            if ($(this).prop("tagName") == 'SELECT') {
                                $(this).val(value).change();
                            }else{
                                $(this).val(value);
                            }
                        }
                    });
                });
            }, 2500);
            $('.action').val('update_client');
            $('#cliente_k').val(dta_table['cliente_k']);
        }else{
            alert('Seleccione un registro');
            return false;
        }
    });

</script>
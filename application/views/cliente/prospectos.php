<div class="page-header">
    <h1> <?= ucwords($tipo) ?> <small> gestión </small> </h1> 
    <div class="pull-left table_functions_left">
    	<?php if ($tipo=='prospectos'): ?>
    		<a id="btn_modal_upload" data-toggle="modal" href="#modal_upload" class="btn btn-sm btn-success btn_upload" class="btn btn-success" title="Agregar imagen">
	            <i class="fa fa-plus"></i>
	        </a>
    	<?php endif ?>
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
           	<th>Dirección</th>
           	<th>Email</th>
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
                data: { table: 1 }
            },
            columns: [{
                "data": "nombre"
            }, {
                "data": "colonia"
            }, {
                "data": "email"
            }],
            createdRow: function(row, data, index) {
            },
            "fnInitComplete": function(oSettings, json) {
              //$(".DTTT_container").appendTo(".table_functions_left");
              $(".dataTables_filter").appendTo(".table_functions_right");
              //$(".DTTT_button").addClass('btn btn-sm btn-success').removeClass('DTTT_button');
            }
        });

</script>
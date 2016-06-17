<input type="text" id='casa' value="<?= $casa_k ?>" hidden>
<input type="text" id='cliente' value="<?= $cliente_k ?>" hidden>
<div class="page-header">
  <h1> Propuestas <small> gestión  </small> </h1> 
  <div class="pull-left table_functions_left">
  		<a href="<?=base_url('casa')?>" class="btn btn-danger btn-sm" title="Regresar">
            <i class="fa fa-arrow-left"></i>
        </a>
	    <a id="btn_propuesta_1" data-toggle="modal" href="#modal_1" class="btn btn-success btn-sm" title="Agregar">
	    	<i class="fa fa-plus"></i>
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
      	<th>Pago de Contado</th>
        <th>Precio Pactado</th>
        <th># de Pagos</th>
       	<th>% Comercializacion</th>
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
                "url": "../../../../js/datatables/datatables.es.js"
            },
            ajax: {
                url: '../../../propuestas/datatable/'+$('#casa').val()+'/'+$('#cliente').val(),
                type: "POST",
                data: { table: 1 }
            },
            columns: [{
                "data": "pago_contado"
            }, {
                "data": "precio_pactado"
            }, {
                "data": "mensualidades"
            }, {
                "data": "comercializacion"
            }],
            createdRow: function(row, data, index) {
            },
            "fnInitComplete": function(oSettings, json) {
              //$(".DTTT_container").appendTo(".table_functions_left");
              $(".dataTables_filter").appendTo(".table_functions_right");
              //$(".DTTT_button").addClass('btn btn-sm btn-success').removeClass('DTTT_button');
            }
        });


  $('#btn_propuesta_1').on('click', function(e){
        e.preventDefault();
        $("#modal_1").mask({'label':""});
        $.ajax({
            type: 'POST',
            url: "<?=base_url('propuestas/insertar_tmp')?>",
            success: function(data){
                $("#modal_1").unmask({'label':""});
                $("#propuesta_tmp_k").val(data);
                $("#propuesta_tmp").val(data);
            },
            error: function(a, b, c){
                pnotify_common('error');
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });

        var casa_k     = $('#casa').val();
        var cliente_k  = $('#cliente').val();
        $('#casa_propuesta').val(casa_k);
        $('#cliente_propuesta').val(cliente_k);

    });
  
</script>
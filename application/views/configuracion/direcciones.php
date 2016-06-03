<div class="page-header">
  <h1> Direcciones </h1> 
  <div class="pull-left table_functions_left col-md-2">
      <a id="btn_add_1" data-toggle="modal" href="#modal_1" class="btn btn-success btn-sm" title="Agregar">
        <i class="fa fa-plus"></i>
      </a>
      <a id="btn_edit_1" data-toggle="modal" href="#modal_1" class="btn btn-secondary btn-sm" title="Editar">
        <i class="fa fa-pencil-square-o"></i>
      </a>
  </div>
      <div class="form-group">

        <?= form_label('Estado', 'estado_k', array('for'=>'select-input' , 'class' => 'col-md-1')); ?>
        <div class="col-md-3">
        	<?= form_dropdown('estado_k', $estados, 1 , 'id="estado_k" class="form-control"'); ?>
        </div>

        <?= form_label('Municipio', 'municipio', array('for'=>'text-input', 'class' => 'col-md-1')); ?>
        <div class="col-md-3">
        <select name="municipio_k" id="municipio_k"  class="form-control">
        	</select>
        </div>
        <div class="">
        	<button class="btn btn-primary col-md-2" onclick="filtrar()"> Filtrar </button>
        </div>
      </div>
  <br>
  <br>
  <div class="pull-right table_functions_right">
  </div>
</div>
<br>

<div id="table_elemnts_left" class="col-lg-6"></div>
<div id="table_elemnts_right" class="col-lg-6"></div>
<table id="tbl_1" class="table-bordered table-highlight display" style="width:100%">
    <thead>
      <tr>
        <th>Estado</th>
        <th>Municipio</th>
        <th>Colonia</th>
        <th>Código Postal</th>
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
                url: "<?=base_url('configuracion/direccionesdatatable')?>",
                type: "POST",
                data: function() {
                  return {
                    	estado_k : 	 $('#estado_k').val(),
                    	municipio_k: $('#municipio_k').val()
                    }   
                }
            },
            columns: [{
                "data": "estado"
            }, {
                "data": "municipio"
            }, {
                "data": "colonia"
            }, {
                "data": "codigo_postal"
            }],
            createdRow: function(row, data, index) {
            },
            "fnInitComplete": function(oSettings, json) {
              //$(".DTTT_container").appendTo(".table_functions_left");
              $(".dataTables_filter").appendTo(".table_functions_right");
              //$(".DTTT_button").addClass('btn btn-sm btn-success').removeClass('DTTT_button');
            }
        });
  $('#btn_add_1').on('click', function(e){
    e.preventDefault();
    $('#form_1')[0].reset();
    $('.action').val('add_direccion');
  });

  $('#btn_edit_1').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    if (dta_table != undefined) {
      var colonia  = dta_table['colonia_k'];
      $('#codigo_postal').val(dta_table['codigo_postal']);
      $('#codigo_postal').blur();
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
      $('#colonia_k').val(dta_table['colonia_k']);
      $('.action').val('update_colonia');
    }else{
      alert('Seleccione un registro');
      return false;
    }
  });

  function filtrar (){
	table_1.ajax.reload();
  }

  $( document ).ready(function() {
    obtenerMunicipios($('#estado_k').val());
  });
</script>


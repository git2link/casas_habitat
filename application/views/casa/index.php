<div class="page-header">
  <h1> Prospectos <small> gestión  </small> </h1> 
  <div class="pull-left table_functions_left">
      <a id="btn_add_1" data-toggle="modal" href="#modal_1" class="btn btn-success btn-sm" title="Agregar">
        <i class="fa fa-plus"></i>
      </a>
      <a id="btn_edit_1" data-toggle="modal" href="#modal_1" class="btn btn-secondary btn-sm" title="Editar">
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
      	<th>Origen</th>
       	<th>Paquete</th>
        <th>Clave</th>
       	<th>Dirección</th>
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
                "url": "../js/datatables/datatables.es.js"
            },
            ajax: {
                url: 'casa/datatable',
                type: "POST",
                data: { table: 1 }
            },
            columns: [{
                "data": "cliente"
            }, {
                "data": "descripcion_paquete_casa"
            }, {
                "data": "clave_interna"
            }, {
                "data": "clave_interna",
                render: function(data, type, row) {
                    return row['calle_numero'] + ' ' + row['lote'] + ', ' + row['colonia'];
                }
            }],
            createdRow: function(row, data, index) {
            },
            "fnInitComplete": function(oSettings, json) {
              //$(".DTTT_container").appendTo(".table_functions_left");
              $(".dataTables_filter").appendTo(".table_functions_right");
              //$(".DTTT_button").addClass('btn btn-sm btn-success').removeClass('DTTT_button');
            }
        });

  $('#btn_add_1').on('click', function(){
    $('#form_1')[0].reset();
    $('#div_cliente').hide();
    $('.action').val('insert');
  });

  $('#btn_edit_1').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    if (dta_table != undefined) {
      var casa  = dta_table['casa_k'];
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
        $('#cliente_k').val(dta_table['cliente_k']).change();
      }, 3000);

      $('#casa_k').val(casa);
      $('.action').val('update');
    }else{
      alert('Seleccione un registro');
      return false;
    }
  });
</script>

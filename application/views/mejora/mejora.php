<div class="page-header">
  <h1> <?=$clave?> <small> <?=$casa[0]->direccion?> </small> </h1> 
  <div class="pull-left table_functions_left">
      <a href="<?=base_url('casa/inventario')?>" class="btn btn-danger btn-sm" title="Regresar">
        <i class="fa fa-arrow-left"></i>
      </a>
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
        <th>Proveedor</th>
        <th>Responsable</th>
        <th>Descripcion</th>
        <th>Fecha Inicio</th>
        <th>Fecha Termino</th>
        <th>Presupuesto</th>
        <th>Estatus</th>
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
                url: "<?=base_url('mejora/datatable')?>",
                type: "POST",
                data: { table: 1,
                        casa: "<?=$casa_k?>" }
            },
            columns: [{
                "data": "empresa"
            }, {
                "data": "nombre"
            }, {
                "data": "descripcion"
            }, {
                "data": "fecha_inicio_trabajos"
            }, {
                "data": "fecha_entrega_trabajos"
            }, {
                "data": "presupuesto"
            }, {
                "data": "casa_k"
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
    $('.action').val('insert');
  });

  $('#btn_edit_1').on('click', function(e){
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
        }, 3000);
        $('#proveedor_k').val(dta_table['proveedor_k']);
        $('.action').val('update');
    }else{
      alert('Seleccione un registro');
      return false;
    }
  });
</script>


  
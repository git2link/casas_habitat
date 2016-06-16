<div class="page-header">
  <h1> Venta <small> gestión </small> </h1> 
  <div class="pull-left table_functions_left">
      <a id="btn_add_1" data-toggle="modal" href="#modal_1" class="btn btn-success btn-sm" title="Agregar">
        <i class="fa fa-plus"></i>
      </a>
      <a id="btn_edit_1" data-toggle="modal" href="#modal_1" class="btn btn-secondary btn-sm" title="Editar">
        <i class="fa fa-pencil-square-o"></i>
      </a>
      <button id="btn_checklist_1" class="btn btn-success btn-sm" title="Checklist">
        <i class="fa fa-check-square-o "></i>
      </button>
      <!--<button id="btn_galery_1" class="btn btn-warning btn-sm" title="Agendar visita" disabled>
        <i class="fa fa-eye"></i>
      </button>-->
      <a id="btn_visita_1" data-toggle="modal" href="#modal_2" class="btn btn-warning btn-sm" title="Agendar visita" disabled>
        <i class="fa fa-eye"></i>
      </a>
      <button id="btn_mejora_1" class="btn btn-success btn-sm" title="Agregar mejora">
        <i class="fa fa-cogs"></i>
      </button>
  </div>
  <div class="pull-right table_functions_right">
  </div>
</div>

<br>

<div id="table_elemnts_left" class="col-lg-6"></div>
<div id="table_elemnts_right" class="col-lg-6"></div>
<div class="table-responsive">
  <table id="tbl_1" class="table-bordered table-highlight display" style="width:100%">
      <thead>
        <tr>
          <th>Cliente-Prospecto</th>
          <th>Clave Casa</th>
          <th>Direccion</th>
          <th>Urgencia</th>
          <th>Estatus</th>
        </tr>
      </thead>
  </table>
</div>
  

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
                url: "<?=base_url('servicio/datatable')?>",
                type: "POST",
                data: { table: 1 }
            },
            columns: [{
                "data": "cliente"
            }, {
                "data": "clave_interna"
            }, {
                "data": "direccion"
            }, {
                "data": "nivel_urgencia"
            }, {
                "data": "estatus"
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


  $('#btn_galery_1').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    if (dta_table != undefined) {
      var casa  = dta_table['casa_k'];
      var clave  = dta_table['clave_interna'];
      window.location.replace("<?=base_url('casa/galeria/" + casa + "/" + clave + "')?>");
    }else{
      alert('Seleccione un registro');
      return false;
    }
  });

  $('#btn_mejora_1').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    if (dta_table != undefined) {
      var casa  = dta_table['casa_k'];
      var clave  = dta_table['clave_interna'];
      window.location.replace("<?=base_url('mejora/create/" + casa + "')?>");
    }else{
      alert('Seleccione un registro');
      return false;
    }
  });

  $('#btn_checklist_1').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    if (dta_table != undefined) {
      var casa  = dta_table['casa_k'];
      var clave  = dta_table['clave_interna'];
      window.location.replace("<?=base_url('checklist/index/" + casa + "/" + clave + "')?>");
    }else{
      alert('Seleccione un registro');
      return false;
    }
  });

  $('#tbl_1 tbody').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    if (dta_table != undefined) {
      if (dta_table['visita'] == 1) {
        $('#btn_visita_1').attr('disabled', false);
        $('#casa_visita').val(dta_table['casa_k']);
      }else{
        $('#btn_visita_1').attr('disabled', true);
      }
    }else{
      $('#btn_visita_1').attr('disabled', true);
    }
  });


</script>


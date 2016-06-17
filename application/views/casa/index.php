<div class="list-group menu" title="Selecciona una opción o presiona esc para quitar!">
  <a href="" id="menu_pdf" class="list-group-item list-group-item-info">Consultar PDF</a>
</div>

<div class="page-header">
  <h1> Prospectos <small> gestión  </small> </h1> 
  <div class="pull-left table_functions_left">
      <a id="btn_add_1" data-toggle="modal" href="#modal_1" class="btn btn-success btn-sm" title="Agregar">
        <i class="fa fa-plus"></i>
      </a>
      <a id="btn_edit_1" data-toggle="modal" href="#modal_1" class="btn btn-secondary btn-sm need_selection" title="Editar" disabled>
        <i class="fa fa-pencil-square-o"></i>
      </a>
      <button id="btn_checklist_1" class="btn btn-success btn-sm need_selection" title="Checklist" disabled>
        <i class="fa fa-check-square-o "></i>
      </button>
      <a id="btn_visita_1" data-toggle="modal" href="#modal_2" class="btn btn-warning btn-sm need_selection" title="Agendar visita" disabled>
        <i class="fa fa-eye"></i>
      </a>
      <a id="btn_propuesta_1" data-toggle="modal" href="#modal_4" class="btn btn-info btn-sm need_selection" title="Agregar propuesta" disabled>
          <i class="fa fa-money"></i>
      </a>
      &nbsp;
      <a id="btn_stock_1" data-toggle="modal" href="#modal_3" class="btn btn-success btn-sm need_selection" title="Incluir a inventario" disabled>
        <i class="fa fa-check"></i>
      </a>
      <button id="btn_dismiss_1" class="btn btn-danger btn-sm need_selection" title="Descartar" disabled>
        <i class="fa fa-times"></i>
      </button>
      <!--<button id="btn_mejora_1" class="btn btn-success btn-sm" title="Agregar mejora" >
        <i class="fa fa-cogs"></i>
      </button>-->
  </div>
  <div class="pull-right table_functions_right">
  </div>
</div>

<br>

<div id="table_elemnts_left" class="col-lg-6"></div>
<div id="table_elemnts_right" class="col-lg-6"></div>
<table id="tbl_1" class="table-bordered table-highlight display context_menu" style="width:100%">
    <thead>
    	<tr>
      	<th>Origen</th>
        <th>Clave</th>
        <th>Paquete</th>
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
                "data": "clave_interna"
            }, {
                "data": "descripcion_paquete_casa"
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

  $('#tbl_1 tbody').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    console.log( dta_table );
    if (dta_table != undefined) {

      $('.need_selection').attr('disabled', false);

      if (dta_table['visita'] == 1) {
        $('#casa_visita').val(dta_table['casa_k']);
      }else{
        $('#btn_visita_1').attr('disabled', true);
      }
    }else{
      $('.need_selection').attr('disabled', true);
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


    $('#btn_stock_1').on('click', function(e){
        e.preventDefault();
        var dta_table = table_1.row($('tr.selected')).data();
        $('#casa_stock').val( dta_table['casa_k'] );
        if ( dta_table['cliente_k'] == null) {
          $('#cliente_1').val(0);
        }else{
          $('#cliente_1').val(dta_table['cliente_k']);
        }
    })

    $('#btn_propuesta_1').on('click', function(e){
        e.preventDefault();
        $("#modal_4").mask({'label':""});
        var dta_table = table_1.row($('tr.selected')).data();
        if (dta_table != undefined) {

            $.ajax({
                type: 'POST',
                url: "<?=base_url('servicio/insert_propuesta_temporal')?>",
                success: function(data){
                    $("#modal_4").unmask({'label':""});
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

            var casa_k     = dta_table['casa_k'];
            var cliente_k  = dta_table['cliente_k'];
            $('#casa_k').val(casa_k);
            $('#cliente_k').val(casa_k);

            $('.action').val('update');
        }else{
            alert('Seleccione un registro');
            return false;
        }
    });

</script>

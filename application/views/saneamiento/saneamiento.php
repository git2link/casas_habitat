<div class="list-group menu" title="Selecciona una opción o presiona esc para quitar!">
    <a href="" id="pdf_saneamiento" class="list-group-item list-group-item-info">Consultar Evidencia</a>
</div>

<div class="page-header">
  <h1> <?=$clave?> <small> <?=$estatus?> </small> </h1> 
  <div class="pull-left table_functions_left">
      <a href="<?=base_url('casa/inventario')?>" class="btn btn-danger btn-sm" title="Regresar">
        <i class="fa fa-arrow-left"></i>
      </a>
      <?php if ( $estatus == 'creacion' ): ?>
        <a id="btn_add_1" data-toggle="modal" href="#modal_1" class="btn btn-success btn-sm" title="Agregar">
          <i class="fa fa-plus"></i>
        </a>
        <a id="btn_edit_1" data-toggle="modal" href="#modal_1" class="btn btn-secondary btn-sm need_selection" title="Editar" disabled>
          <i class="fa fa-pencil-square-o"></i>
        </a>
        <a id="btn_remove_1" data-toggle="modal" href="#modal_2" class="btn btn-warning btn-sm need_selection" title="Eliminar" disabled>
          <i class="fa fa-minus"></i>
        </a>
      <?php elseif ( $estatus == 'autorizado' ): ?>
        <a id="btn_uploadfile_1" data-toggle="modal" href="#modal_upload" class="btn btn-secondary btn-sm need_selection" title="Cargar evidencia" disabled>
          <i class="fa fa-cloud-upload"></i>
        </a>
        <button id="btn_end_1" class="btn btn-success btn-sm" onClick="authorization_request( 'completo' )" title="Finalizar" >
          Finalizar <i class="fa fa-check"></i>
        </button>
      <?php endif ?>
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
        <th>Concepto</th>
        <th>Descripción</th>
        <th>Total</th>
        <th>Evidencia de pago</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th colspan="2" style="text-align:right">
          Total: &emsp; &emsp; 
        </th>
        <th id="tbl_total">$1000</th>
        <th></th>
      </tr>
    </tfoot>
</table>
<?php if ( $estatus == 'creacion' ): ?>
  <div class="col-lg-12">
    <br>
    <button class="btn btn-secondary form-control" id="btn_authorization_request"  onClick="authorization_request( 'autorizacion solicitada' )" disabled>
      Solicitar autorización <i class="fa fa-share"></i>
    </button>
  </div>

<?php elseif ( $estatus == 'autorizacion solicitada' ): ?>
  <div class="col-lg-6">
    <br>
    <button class="btn btn-success form-control" onClick="authorization_request( 'autorizado' )">
      Autorizar <i class="fa fa-check-circle-o"></i>
    </button>
  </div>

  <div class="col-lg-6">
    <br>
    <button class="btn btn-warning form-control" onClick="authorization_request( 'creacion' )">
      No utorizar <i class="fa fa-times-circle-o"></i>
    </button>
  </div>
<?php endif ?>


  

<script type="text/javascript">
  var table_1 = null;
  
  function set_table_concepts(){
    var tbl_total = 0;

    $('.need_selection').attr('disabled', true);
    $('#btn_authorization_request').prop('disabled', true);
    $('#btn_end_1').prop('disabled', false);
    $('.table_functions_right').html('');

    table_1 = $('#tbl_1').DataTable({
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
                  url: "<?=base_url('saneamiento/datatable')?>",
                  type: "POST",
                  data: { table: 1,
                          casa: "<?=$casa_k?>" }
              },
              columns: [{
                  "data": "concepto"
              }, {
                  "data": "descripcion"
              }, {
                  "data": "monto"
              }, {
                  "data": "evidencia_estatus", render: function( data, type, row ) { 
                    
                    if ( data == 'Cargada' ) {
                      data = '<b style="color: rgb(66, 139, 202);">' + data + '</b>';
                    }else if( data == 'No Cargada' ){
                      data = '<b style="color: rgb(217, 83, 79);">' + data + '</b>';
                      $('#btn_end_1').prop('disabled', true);
                    }

                    return  data;
                  }
              }],
              createdRow: function(row, data, index) {
                tbl_total +=  parseFloat(data['monto']);
                $('#btn_authorization_request').prop('disabled', false);
              },
              "fnInitComplete": function(oSettings, json) {
                $(".dataTables_filter").appendTo(".table_functions_right");
                $('#tbl_total').html('$' + tbl_total);
              }
          });
  }
  
  set_table_concepts();

  $('#btn_add_1').on('click', function(e){
    e.preventDefault();
    $('#form_1')[0].reset();
    $('#saneamiento').val("<?=$saneamiento?>");
    $('.action').val('insert');
  });

  $('#btn_edit_1').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    if (dta_table != undefined) {
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
      $('.action').val('update');
      $('#saneamiento_concepto').val(dta_table['saneamiento_concepto_k']);
    }
  });

  $('#btn_remove_1').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    $('#saneamiento_concepto_2').val(dta_table['saneamiento_concepto_k']);
  });

  $('#btn_uploadfile_1').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    $('#saneamiento_concepto_3').val(dta_table['saneamiento_concepto_k']);
  });

  function authorization_request( estatus ){
    pnotify_common('info');
    $.ajax({
            type: 'POST',
            url: "<?=base_url('saneamiento/update_saneamiento')?>",
            data: {
                  saneamiento_k: '<?=$saneamiento?>', 
                  estatus: estatus},
            success: function(data){
                if ( data == 1) {
                  pnotify_common('success');
                  location.reload();
                }
            },
            error: function(a, b, c){
                pnotify_common('error');
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });
  }

  $('#pdf_saneamiento').on('click', function(e){
    e.preventDefault();
    var dta_table = table_1.row($('tr.selected')).data();
    var url = "<?=base_url('pdf_file/saneamiento')?>/" + '<?=$casa_k?>' + '/' + dta_table['evidencia'];
    var popup = window.open(url, 'Cotización', 'height=' + (window.innerHeight) + ',width=' + (window.innerWidth * 0.75) + ',scrollbars=1');
    if (!popup.opener) {
      popup.opener = self
    };
    popup.focus();
  });
</script>

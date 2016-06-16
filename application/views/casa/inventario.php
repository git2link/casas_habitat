<div class="list-group menu" title="Selecciona una opción o presiona esc para quitar!">
    <a href="" id="menu_pdf" class="list-group-item list-group-item-info">Consultar PDF</a>
</div>

<div class="page-header">
  <h1> Inventario <small> gestión  </small> </h1> 
  <div class="pull-left table_functions_left">
      <a id="btn_edit_1" data-toggle="modal" href="#modal_1" class="btn btn-secondary btn-sm need_selection" title="Editar" >
        <i class="fa fa-pencil-square-o"></i>
      </a>
      <button class="btn btn-success btn-sm need_selection" title="Checklist" >
        <i class="fa fa-check-square-o "></i>
      </button>
      <button class="btn btn-warning btn-sm" title="CLG" >
        CLG
      </button>
      <button class="btn btn-success btn-sm need_selection" title="Saneamineto" onClick="saneamiento()">
        <i class="fa fa-money"></i>
      </button>
      <button class="btn btn-secondary btn-sm need_selection" title="Mejora" onClick="mejora()" >
        <i class="fa fa-cogs"></i>
      </button>
      <button class="btn btn-success btn-sm need_selection" title="Avaluo" >
        <i class="fa fa-usd"></i>
      </button>
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
                "url": "<?=base_url('../js/datatables/datatables.es.js')?>"
            },
            ajax: {
                url: "<?=base_url('casa/datatable')?>",
                type: "POST",
                data: { table: 2 }
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
  $('#menu_pdf').on('click', function(e){
    e.preventDefault();
    alert('sss');
  }); 

  function mejora(){
    var dta_table = table_1.row($('tr.selected')).data();
    var casa  = dta_table['casa_k'];
    var clave  = dta_table['clave_interna'];
    window.location.replace("<?=base_url('mejora/create/" + casa + "')?>");
  }

  function saneamiento(){
    var dta_table = table_1.row($('tr.selected')).data();
    var casa  = dta_table['casa_k'];
    var clave  = dta_table['clave_interna'];
    window.location.replace("<?=base_url('saneamiento/create/" + casa + "')?>");
  }

</script>

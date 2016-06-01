<form id="form_1">
    <div id="modal_1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Casa</h3>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <label>Detalles de venta</label>
                    </div>
                    <label>Prospecto - Cliente</label>
                    <select id="cliente" class="form-control">
                        <option value="">Seleccione una opción...</option>
                        <?php $cliente_k = '';?>
                        <?php foreach ($cliente as $row): ?>
                          <?php if ($cliente_k != $row->cliente_k): ?>
                            <option estatus="<?= $row->estatus_cliente ?>" value="<?= $row->cliente_k ?>"><?= $row->cliente ?></option>
                            <?php  $cliente_k = $row->cliente_k;?>
                          <?php endif ?>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <label>Tipo persona</label>
                    <input id="cliente_estatus" class="form-control" disabled>
                    <br>
                    <label>Casa</label>
                    <select id="casa" name="casa_cliente_k" class="form-control">
                        <option value="">Seleccione una opción...</option>
                        <?php foreach ($cliente as $row): ?>
                            <option reference="<?= $row->cliente_k ?>" value="<?= $row->casa_cliente_k ?>" hidden><?= $row->clave_interna ?></option>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <label>Nivel de urgencia</label>
                    <select name="nivel_urgencia" class="form-control">
                        <option value="">Seleccione una opción...</option>
                        <option value="baja">Baja</option>
                        <option value="media">Media</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" id="submit_form_1" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
</form>

<form id="form_2">
    <div id="modal_2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Agendar visita</h3>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <label>Detalles de visita</label>
                    </div>
                    <label>Empleado</label>
                    <select class="form-control" name="usuario_k">
                      <option value="">Seleccione una opción</option>
                      <?php foreach ($employee as $row): ?>
                        <option value="<?= $row->id ?>"><?= $row->employee ?></option>
                      <?php endforeach ?>
                    </select>
                    <br>
                    <label>Fecha de visita</label>
                    <input name="fecha_visita" class="form-control date">
                <div class="modal-footer">
                    <button data-dismiss="modal" id="submit_form_2" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
    <input id="casa_visita" name="casa_k" hidden>
</form>

<script type="text/javascript">
   
    $('#cliente').on('change', function(e){
      e.preventDefault();
      var cliente =  $(this).val();
      $('#cliente_estatus').val($('#cliente option:selected').attr('estatus'));
      $('#casa option').each(function(i){
        var reference = $(this).attr('reference');
        if (cliente == reference) {
          $(this).show();
        }else{
          $(this).hide();
        }
      });
      $('#casa').val('').change();
    });

    $('#submit_form_1').on('click', function(e){
      e.preventDefault();
      var data = $('#form_1').serialize();
      $.ajax({
        type: 'POST',
        url: "<?=base_url('servicio/insert_servicio_venta')?>",
        data: data,
        success: function(data){
            if (data == 1) {
              table_1.ajax.reload();
            }
        },
        error: function(a, b, c){
            console.log(a);
            console.log(b);
            console.log(c);
        }
      });
    });

    $('#submit_form_2').on('click', function(e){
      e.preventDefault();
      var data = $('#form_2').serialize();
      $.ajax({
        type: 'POST',
        url: "<?=base_url('servicio/set_visita')?>",
        data: data,
        success: function(data){
            if (data == 1) {
              table_1.ajax.reload();
            }
        },
        error: function(a, b, c){
            console.log(a);
            console.log(b);
            console.log(c);
        }
      });
    });
</script>


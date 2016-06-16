<form id="form_1">
    <div id="modal_1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Mejora</h3>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <label>Proveedor</label>
                    </div>
                    <label>Proveedor</label>
                    <select id="proveedor" name="proveedor_k" class="form-control">
                      <option email="" responsible="" value="">Seleccione una opción...</option>
                      <?php foreach ($proveedor as $row): ?>
                          <option email="<?= $row->email ?>" responsible="<?= $row->nombre ?>" value="<?= $row->proveedor_k ?>"><?= $row->empresa ?></option>
                      <?php endforeach ?>
                    </select>
                    <br>
                    <label>Responsable</label>
                    <input id="responsible" name="nombre" class="form-control" disabled>
                    <br>
                    <label>email</label>
                    <input id="email" name="email" class="form-control">
                    <br>
                    <div align="center">
                        <label>Detalles</label>
                    </div>
                    <br>
                    <label>Descripción de mejora</label>
                    <textarea class="form-control" rows="2" name="descripcion"></textarea>
                    <br>
                    <label>Fecha de inicio</label>
                    <input name="fecha_inicio_trabajos" class="date form-control" data-date-format="yyyy-mm-dd">
                    <br>
                    <?php foreach ($casa as $row): ?>
                      <div align="center">
                          <label>Ubicación de la casa</label>
                      </div>
                      <br>
                      <label>Codigo Postal</label>
                      <input class="form-control address" value="<?= $row->codigo_postal?>" name="codigo_postal" disabled>
                      <br>
                      <label>Estado</label>
                      <input class="form-control address" value="<?= $row->estado?>" name="estado" disabled>
                      <br>
                      <label>Municipio</label>
                      <input class="form-control address" value="<?= $row->municipio?>" name="municipio" disabled>
                      <br>
                      <label>Colonia</label>
                      <input class="form-control address" value="<?= $row->colonia?>" name="colonia" disabled>
                      <br>
                      <label>Calle</label>
                      <input class="form-control address" value="<?= $row->calle_numero?>" name="calle" disabled>
                      <br>
                      <label>Lote</label>
                      <input class="form-control address" value="<?= $row->lote?>" name="lote" disabled>
                    <?php endforeach ?>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" id="submit_form_1" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
    <input id="casa_k" name="casa_k" value="<?=$casa_k?>" hidden>
</form>

<script type="text/javascript">
    
    $('.date').datepicker({dateFormat: "yy-mm-dd"});

    $('#submit_form_1').on('click', function(e){
        e.preventDefault();
        var action = $('.action').val();
        $('.address').prop('disabled', false);
        var data = $('#form_1').serialize();
        $('.address').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: "<?=base_url('mejora')?>/" + action,
            data: data,
            success: function(data){
                alert(data);
                table_1.ajax.reload();
            },
            error: function(a, b, c){
                alert(a.responseText);
                console.log(b);
                console.log(c);
            }
        });

    });

    $('#proveedor').on('change', function(e){
      e.preventDefault();
      var responsible = $('#proveedor option:selected').attr('responsible');
      var email       = $('#proveedor option:selected').attr('email');
      $('#responsible').val(responsible);
      $('#email').val(email);
      
    });
     
</script>




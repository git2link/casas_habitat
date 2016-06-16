<form id="form_upload">
    <div id="modal_upload" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="cutton" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Cargar Documento</h3>
                </div>
                <div class="modal-body">
                    <!--<input id="file_upload" name="file_upload" type="file" accept="image/*" capture="camera" data-browse-label="archivo..." data-upload-label="cargar" data-show-remove="false" data-show-upload="false" class="file">-->
                    <input id="file_upload" name="file_upload" type="file" accept="application/pdf"  data-browse-label="archivo..." data-upload-label="cargar" data-show-remove="false" data-show-upload="false" class="file">
                </div>
                <div class="modal-footer">
                    <button id="btn_upload" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-upload"></i> Cargar</button>
                </div>
                <input name="casa_k" value="<?=$casa_k?>" hidden>
                <input id="saneamiento_concepto_3" name="saneamiento_concepto_k" hidden>
            </div>
        </div>
    </div>
</form>

<form id="form_1">
    <div id="modal_1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Saneamineto</h3>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <label>Detalles</label>
                    </div>
                    <label>Concepto</label>
                    <input class="form-control" name="concepto">
                    <br>
                    <label>Descripcion</label>
                    <textarea class="form-control" rows="2" name="descripcion"></textarea>
                    <br>
                    <label>Monto</label>
                    <input class="form-control" name="monto">
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" id="submit_form_1" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
    <input id="saneamiento" name="saneamiento_k" hidden>
    <input id="saneamiento_concepto" name="saneamiento_concepto_k" hidden>
</form>

<form id="form_2">
    <div id="modal_2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Eliminar</h3>
                </div>
                <div class="modal-body" align="center">
                    <label>¿Desea eliminar este concepto?</label>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" >Cancelar</button>
                    <button data-dismiss="modal" id="submit_form_2" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input name="activo" value="0">
    <input id="saneamiento_concepto_2" name="saneamiento_concepto_k" hidden>
</form>

<script type="text/javascript">
    
    $('.date').datepicker({dateFormat: "yy-mm-dd"});

    $('#submit_form_1').on('click', function(e){
        e.preventDefault();
        var data = $('#form_1').serialize();
        var action = $('.action').val();
        pnotify_common('info');
        $.ajax({
            type: 'POST',
            url: "<?=base_url('saneamiento')?>/" + action,
            data: data,
            success: function(data){
                if ( data == 1) {
                  pnotify_common('success');
                  set_table_concepts();
                }
            },
            error: function(a, b, c){
                pnotify_common('error');
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });
    });

    $('#submit_form_2').on('click', function(e){
        e.preventDefault();
        var data = $('#form_2').serialize();
        pnotify_common('info');
        $.ajax({
            type: 'POST',
            url: "<?=base_url('saneamiento/update')?>",
            data: data,
            success: function(data){
                if ( data == 1) {
                  pnotify_common('success');
                  set_table_concepts();
                }
            },
            error: function(a, b, c){
                pnotify_common('error');
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });
    });

    $("#btn_upload").on("click", function(e){
        e.preventDefault();
        var data = new FormData($("#form_upload")[0]);
        pnotify_common('info');
        $.ajax({
            type: 'POST',
            url: "<?=base_url('saneamiento/uploadfile')?>",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                if( data == 1 ){
                    pnotify_common('success');
                    set_table_concepts();
                }else{
                    pnotify_common('error');
                    console.log(data);
                }
            },
            error: function(a, b, c){
                pnotify_common('error');
                console.log(a); console.log(b); console.log(c);
            }
        });
    });
     
</script>




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
                <input class="element" name="" hidden>
                <input class="table"   name="table" hidden>
            </div>
        </div>
    </div>
</form>

<form id="form_pdf">
    <div id="modal_pdf" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Documento Cargado</h3>
                </div>
                <div class="modal-body">
                    <object id="pdf_area_1" data="" type="application/pdf" width="100%" height="100%"></object>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="form_description">
    <div id="modal_description" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Descripción</h3>
                </div>
                <div class="modal-body" >
                    <div id="div_description_text" align="center">
                    </div>
                    <div id="div_description_inpt" hidden>
                        <textarea id="inpt_description" class="form-control element" name="" rows="5"></textarea>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" id="btn_addDescription">Agregar descripción</button>
                    <button class="btn btn-default" data-dismiss="modal" id="btn_saveDescription" disabled>Guardar</button>
                </div>
                <input name="casa_k" value="<?=$casa_k?>" hidden>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $("#btn_upload").on("click", function(e){
        e.preventDefault();
        var data = new FormData($("#form_upload")[0]);
        $.ajax({
            type: 'POST',
            url: "<?=base_url('checklist/uploadfile')?>",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                if( data == 1 ){
                    location.reload(); 
                }else{
                    console.log(data);
                }
            },
            error: function(a, b, c){
                console.log(a); console.log(b); console.log(c);
            }
        });
    });

    $('#btn_addDescription').on('click', function(e){
        e.preventDefault();
        $(this).attr('disabled', true);
        $('#div_description_text').hide();
        $('#btn_saveDescription').attr('disabled', false);
        $('#div_description_inpt').show();
    });

    $('#btn_saveDescription').on('click', function(e){
        e.preventDefault();
        var data = $("#form_description").serialize();
        $.ajax({
            type: 'POST',
            url: "<?=base_url('checklist/setDescription')?>",
            data: data,
            success: function(data){
                alert(data);
                if( data == 1 ){
                    location.reload(); 
                }else{
                    console.log(data);
                }
            },
            error: function(a, b, c){
                console.log(a); console.log(b); console.log(c);
            }
        });
    });


</script>
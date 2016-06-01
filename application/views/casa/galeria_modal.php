<form id="form_upload">
    <div id="modal_upload" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Cargar Documento</h3>
                </div>
                <div class="modal-body">
                    <label>Archivo:</label>
                    <br>
                    <input id="file_upload" name="file_upload" type="file" accept="image/*" capture="camera" data-browse-label="archivo..." data-upload-label="cargar" data-show-remove="false" data-show-upload="false" class="file">
                    <br>
                    <label>Descipcion:</label>
                    <br>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                    <br>
                    <label>Latitud:</label>
                    <br>
                    <input name="latitud" id="latitud" class="form-control latlng" disabled>
                    <br>
                    <label>Longitud:</label>
                    <br>
                    <input name="longitud" id="longitud" class="form-control latlng" disabled>
                    <br>
                    <label>Ubicacion:</label>
                    <br>
                    <input name="ubicacion" id="ubicacion" class="form-control" >
                </div>
                <div class="modal-footer">
                    <button id="btn_get_location" class="btn btn-default" ><i class="fa fa-info-circle"></i> Obtener ubicación</button>
                    <button data-dismiss="modal" id="btn_upload" class="btn btn-default" ><i class="glyphicon glyphicon-upload"></i> Cargar</button>
                </div>
                <input class="casa_k" name="casa_k" value="<?= $casa_k ?>" hidden>
            </div>
        </div>
    </div>
</form>

<form id="form_end">
    <div id="modal_end" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Finalizar visita</h3>
                </div>
                <div class="modal-body" align="center">
                    <label>¿Desea finalizar visita?</label>
                    <br>
                    Una vez concluida la visita no podra editar las actividades realizadas sobre ésta.
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" >Cancelar</button>
                    <button data-dismiss="modal" id="btn_end" class="btn btn-default" >Continuar</button>
                </div>
                <input name="visita_k" value="<?= $visita_k ?>" hidden>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $("#btn_get_location").on("click", function(e){
        e.preventDefault();
        
        var latitud     = $("#latitud").val();
        var longitud    = $("#longitud").val();

        if (latitud=="" || longitud=="") {
            alert("Acepte la opción compartir ubicación");
            getLocation();
        }else{
            $.ajax({
                type: 'POST',
                url: "<?=base_url('casa/getLocation')?>",
                data: {latitud: latitud, longitud:longitud},
                success: function(data){
                    var jsonData = $.parseJSON(data);
                    if (jsonData.status=="OK") {
                        $.each(jsonData.results, function(idx, obj) {
                            if (obj.formatted_address != "") {
                                $("#ubicacion").val(obj.formatted_address);
                                return false;
                            }
                        });
                    }
                },
                error: function(a, b, c){
                    console.log(a); console.log(b); console.log(c);
                }
            });
        }      
    });

    $("#btn_upload").on("click", function(e){
        e.preventDefault();
        $(".latlng").prop( "disabled", false );
        var data = new FormData($("#form_upload")[0]);
        $(".latlng").prop( "disabled", true );
        $.ajax({
            type: 'POST',
            url: "<?=base_url('casa/insertGaleria')?>",
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


    $(".dlt_file").on("click", function(e){
        e.preventDefault();
        var galeria_k = $(this).attr("reference");
        $.ajax({
            type: 'POST',
            url: "<?=base_url('casa/updategaleria')?>",
            data: { galeria_k: galeria_k, activo: 0 },
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

    $('#btn_end').on('click', function(e){
        e.preventDefault();
        var data = $('#form_end').serialize();
        $.ajax({
            type: 'POST',
            url: "<?=base_url('actividades/set_visita_done')?>",
            data: data,
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
</script>


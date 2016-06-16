<form id="form_1">
    <div id="modal_1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Usuario</h3>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <label>Datos generales</label>
                    </div>
                    <br>
                    <label>Nombre</label>
                    <input name="nombre" class="form-control">
                    <br>
                    <label>Apellido paterno</label>
                    <input name="apellido_paterno" class="form-control">
                    <br>
                    <label>Apellido materno</label>
                    <input name="apellido_materno" class="form-control">
                    <br>
                    <label>Fecha de nacimiento</label>
                    <input name="fecha_nacimiento" class="form-control date">
                    <br>
                    <label>CURP</label>
                    <input name="curp" class="form-control">
                    <br>
                    <label>RFC</label>
                    <input name="rfc" class="form-control">
                    <br>
                    <label>NSS</label>
                    <input name="nss" class="form-control">
                    <br>
                    <div align="center">
                        <label>Usuario</label>
                    </div>
                    <br>
                    <label>Sucursal</label>
                    <select name="sucursal_k" class="form-control">
                      <?php foreach ($sucursales as $row): ?>
                        <option value="<?=$row->sucursal_k?>"><?=$row->descripcion?></option>
                      <?php endforeach ?>
                    </select>
                    <br>
                    <label>Puesto</label>
                    <select name="puesto_k" class="form-control">
                      <?php foreach ($puestos as $row): ?>
                        <option value="<?=$row->puesto_k?>"><?=$row->descripcion?></option>
                      <?php endforeach ?>
                    </select>
                    <br>
                    <label>Perfil</label>
                    <select name="perfil_id" class="form-control">
                      <?php foreach ($perfil as $row): ?>
                        <option value="<?=$row->id?>"><?=$row->name?></option>
                      <?php endforeach ?>
                    </select>
                    <br>
                    <label>Nombre de usuario</label>
                    <input name="login" class="form-control">
                    <br>
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control">
                    <br>
                    <label>Verificación de contraseña</label>
                    <input type="password" name="password" class="form-control">
                    <br>
                    <label>Correo electrónico asignado</label>
                    <input name="email_empresa" class="form-control">
                    <br>
                    <div align="center">
                        <label>Contacto</label>
                    </div>
                    <br>
                    <label>Coreo electrónico personal</label>
                    <input name="email" class="form-control">
                    <br>
                    <label>Celular</label>
                    <input name="telefono_celular" class="form-control">
                    <br>
                    <label>En caso de emergencia llamar a</label>
                    <input name="nombre_emergencia" class="form-control">
                    <br>
                    <label>Teléfono de emergencia</label>
                    <input name="telefono_emergencia" class="form-control">
                    <br>
                    <div align="center">
                        <label>Datos de banca</label>
                    </div>
                    <br>
                    <label>Banco</label>
                    <input name="banco" class="form-control">
                    <br>
                    <label>Cuenta</label>
                    <input name="cuenta" class="form-control">
                    <br>
                    <label>Clabe</label>
                    <input name="clabe" class="form-control">
                    <br>
                    <div align="center">
                        <label>Dirección</label>
                    </div>
                    <br>
                    <label>Codigo postal</label>
                    <input name="codigo_postal" id="codigo_postal" class="form-control">
                    <br>
                    <label>Estado</label>
                    <select name="estado_k" id="estado" class="form-control"></select>
                    <br>
                    <label>Municipio</label>
                    <select name="municipio_k" id="municipio" class="form-control"></select>
                    <br>
                    <label>Colonia</label>
                    <select name="colonia_k" id="colonia" class="form-control"></select>
                    <br>
                    <label>Calle</label>
                    <input name="calle_numero" class="form-control">
                    <br>
                    <label>Lote</label>
                    <input name="lote" class="form-control">
                </div>
                <div class="modal-footer">
                    <a id="eliminar" data-dismiss="modal" data-toggle="modal" href="#modal_disable" class="btn btn-default">Eliminar</a>
                    <button data-dismiss="modal" id="submit_form_1" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
    <input id="id" name="id" class="element" hidden>
</form>
<form id="form_2">
    <div id="modal_2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Foto</h3>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <div class="tgg_1" id="div_camera" align="center"></div>
                    </div>
                    <div align="center">
                        <img class="tgg_1" id="img_picture">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_set_camera"     class="btn btn-default tgg_1" >Tomar foto</button>
                    <button id="btn_set_camera_2"   class="btn btn-default" >Tomar foto</button>
                    <button id="btn_take_picture"   class="btn btn-default tgg_1" >Capturar</button>
                    <button data-dismiss="modal" id="submit_form_2" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
    <input class="element" name="usuario_k" hidden>
    <input id="foto" name="foto" hidden>
    <input id="file_upload" name="file_upload" type="file" accept="image/*" capture="camera" hidden>
</form>

<form id="form_disable">
    <div id="modal_disable" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Eliminar elemento</h3>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <h4>¿Está seguro que desea eliminar este elemento?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" >Cancelar</button>
                    <button data-dismiss="modal" class="btn btn-default" id="disable_1" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="element" name="id" hidden>
</form>

<canvas id="canvas" hidden></canvas>

<script type="text/javascript">
    
    function getBase64Image(str_img, str_canvas) {
        var img = document.getElementById(str_img);
        var canvas   = document.createElement(str_canvas);
        canvas.width = img.width;
        canvas.height = img.height;

        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);
        var dataURL = canvas.toDataURL("image/png");
        return dataURL;
    }

    $('#codigo_postal').blur(function(){
     obtenerDirecciones($(this).val(), "<?=base_url('')?>");
    });
    $('#codigo_postal_casa').blur(function(){
     obtenerDireccionesCasa($('#codigo_postal_casa').val(), "<?=base_url('')?>");
    });

    $('#codigo_postal_edit').blur(function(){
     obtenerDireccionesEdit($('#codigo_postal_edit').val(), "<?=base_url('')?>");
    });
    $('#estado_k').change(function(){
        console.log('entro');
        obtenerMunicipios($('#estado_k').val(), "<?=base_url('')?>");
    });

    $('#submit_form_1').on('click', function(e){
        e.preventDefault();
        var action = $('.action').val();
        var data = $('#form_1').serialize();
        pnotify_common('info');
        $.ajax({
            type: 'POST',
            url: "<?=base_url('usuario')?>/" + action,
            data: data,
            success: function(data){
                if (data == 1) {
                    pnotify_common('success');
                    table_1.ajax.reload();
                }else{
                    pnotify_common('error');
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

    $('#disable_1').on('click', function(e){
        e.preventDefault();
        var data = $('#form_disable').serialize();
        pnotify_common('info');
        $.ajax({
            type: 'POST',
            url: "<?=base_url('usuario/disable')?>",
            data: data,
            success: function(data){
                if (data==1) {
                    pnotify_common('success');
                    table_1.ajax.reload();
                };
                        
            },
            error: function(a, b, c){
                pnotify_common('error');
                console.log(a);
                console.log(b);
                console.log(c);
            }
        });
    });
    

    function setPCevents(){
        $('#btn_take_picture').on('click', function(e){
            e.preventDefault();
            Webcam.snap( function(data_uri) {
                $('#img_picture').attr('src', data_uri);
                $('#foto').val(data_uri);
            });
            $('.tgg_1').toggle();
        });   

        $('#btn_set_camera').on('click', function(e){
            e.preventDefault();
            Webcam.set({
                width: 320 * 1.3,
                height: 240 * 1.3,
                      
                dest_width: 320 * 1.3,
                dest_height: 240 * 1.3,
                      
                crop_width: 240 * 1.3,
                crop_height: 240 * 1.3,
                      
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach( '#div_camera' );
            $('.tgg_1').toggle();
        });

        $('#submit_form_2').on('click', function(e){
            e.preventDefault();
            var action = $('.action').val();
            var data = $('#form_2').serialize();
            pnotify_common('info');
            $.ajax({
                type: 'POST',
                url: "<?=base_url('usuario/set_picture')?>",
                data: data,
                success: function(data){
                    if (data==1) {
                        pnotify_common('success');
                        table_1.ajax.reload();
                    };
                },
                error: function(a, b, c){
                    pnotify_common('error');
                    console.log(a);
                    console.log(b);
                    console.log(c);
                }
            });
        });

        $('#btn_set_camera_2').hide();
    }

    

    function setMobileEvents(){
        
        $('#btn_set_camera').hide();
        
        $('#btn_set_camera_2').on('click', function(e){
            e.preventDefault();
            $('#file_upload').click();
        });

        $('#file_upload').on('change', function(e){
            e.preventDefault();
            var data = new FormData($("#form_2")[0]);
            pnotify_common('info');
            $.ajax({
                type: 'POST',
                url: "<?=base_url('usuario/set_image_size')?>",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    if (data == 1) {
                        pnotify_common('success');
                        $('#img_picture').attr('src', "<?=base_url('../server/usuarios/photo/photo_std.jpeg')?>");
                    }
                },
                error: function(a, b, c){
                    pnotify_common('error');
                    console.log(a); console.log(b); console.log(c);
                }
            });

        });

        $('#submit_form_2').on('click', function(e){
            e.preventDefault();
            var img_base64 = getBase64Image('img_picture', 'canvas');
            $('#foto').val(img_base64);
            var data = $('#form_2').serialize();
            pnotify_common('info');
            $.ajax({
                type: 'POST',
                url: "<?=base_url('usuario/set_picture')?>",
                data: data,
                success: function(data){
                    pnotify_common('success');
                    alert(data);
                        //table_1.ajax.reload();
                },
                error: function(a, b, c){
                    pnotify_common('error');
                    console.log(a);
                    console.log(b);
                    console.log(c);
                }
            });
        });

    }
            
    if ($( window ).width() <= 760) {
        setMobileEvents();
    }else{
        setPCevents();
    }

    $('#btn_take_picture').hide();     
    $('#div_camera').hide();

    $('#img_picture').on('load', function(e){
        e.preventDefault();
        
    });
</script>


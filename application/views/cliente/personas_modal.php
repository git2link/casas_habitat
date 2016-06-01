<form id="form_1">
    <div id="modal_1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Prospecto</h3>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <label>Procedencia</label>
                    </div>
                    <br>
                    <label>Tipo de procedencia</label>
                    <select class="form-control" name="procedencia_k">
                        <?php foreach ($procedencia as $row): ?>
                            <option value="<?=$row->procedencia_k?>"><?=$row->descripcion?></option>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <div align="center">
                        <label>Generales</label>
                    </div>
                    <br>
                    <label>Nombre</label>
                    <input class="form-control" name="nombre">
                    <br>
                    <label>Apellido paterno</label>
                    <input class="form-control" name="apellido_paterno">
                    <br>
                    <label>Apellido materno</label>
                    <input class="form-control" name="apellido_materno">
                    <br>
                    <label>Genero</label>
                    <select class="form-control" name="sexo">
                        <option value="1">Femenino</option>
                        <option value="2">Masculino</option>
                    </select>
                    <br>
                    <label>Fecha nacimiento</label>
                    <input class="form-control date" name="fecha_nacimiento">
                    <br>
                    <label>Lugar de nacimiento</label>
                    <select class="form-control" name="estado_nacimiento_k">
                        <?php foreach ($estado as $key => $value): ?>
                            <option value="<?=$key?>"><?=$value?></option>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <label>RFC</label>
                    <input class="form-control" name="rfc">
                    <br>
                    <label>CURP</label>
                    <input class="form-control" name="curp">
                    <br>
                    <label>Ocupación</label>
                    <input class="form-control" name="ocupacion">
                    <br>
                    <label>Empresa</label>
                    <input class="form-control" name="empresa">
                    <br>
                    <div align="center">
                        <label>Domicilio</label>
                    </div>
                    <br>
                    <label>Codigo postal</label>
                    <input class="form-control" id="codigo_postal" name="codigo_postal">
                    <br>
                    <label>Estado</label>
                    <select class="form-control" id="estado" name="estado_k"></select>
                    <br>
                    <label>Municipio</label>
                    <select class="form-control" id="municipio" name="municipio_k"></select>
                    <br>
                    <label>Colonia</label>
                    <select class="form-control" id="colonia" name="colonia_k"></select>
                    <br>
                    <label>Calle</label>
                    <input class="form-control" name="calle_numero">
                    <br>
                    <label>Lote - numero</label>
                    <input class="form-control" name="lote">
                    <br>
                    <div align="center">
                        <label>Contacto</label>
                    </div>
                    <br>
                    <label>Telefono casa</label>
                    <input class="form-control" name="telefono_casa">
                    <br>
                    <label>Telefono trabajo</label>
                    <input class="form-control" name="telefono_trabajo">
                    <br>
                    <label>Movil</label>
                    <input class="form-control" name="telefono_celular">
                    <br>
                    <label>Correo electronico</label>
                    <input class="form-control" name="email">
                    <br>
                    <label>Twitter</label>
                    <input class="form-control" name="twitter">
                    <br>
                    <label>Facebook</label>
                    <input class="form-control" name="fb">
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" id="submit_form_1" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
    <input id="cliente_k" name="cliente_k" hidden>
</form>

<script type="text/javascript">
  
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
            url: "<?=base_url('cliente')?>/" + action,
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
</script>


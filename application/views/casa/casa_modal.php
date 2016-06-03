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
                        <label>Condiciones Adquisición</label>
                    </div>
                    <label>Tipo</label>
                    <select id="tipo_casa_k" name="tipo_casa_k" class="form-control">
                        <option value="">Seleccione una opción...</option>
                        <?php $tipo = ''; ?>
                        <?php foreach ($tipo_paquete as $registro): ?> 
                            <?php if ( $tipo !=  $registro->tipo ): ?>
                                <option value="<?= $registro->tipo_casa_k ?>"><?= $registro->tipo ?></option>
                                <?php $tipo = $registro->tipo; ?>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <label>Paquete</label>
                    <select id="paquete_casa_k" name="paquete_casa_k" class="form-control">
                        <option value="">Seleccione una opción...</option>
                        <?php foreach ($tipo_paquete as $registro): ?> 
                            <option cliente="<?= $registro->cliente ?>" tipo="<?= $registro->tipo_casa_k ?>" value = "<?= $registro->paquete_casa_k ?>" hidden><?= $registro->paquete ?></option>  
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <div id="div_cliente" hidden>
                        <label>Prospecto - Cliente</label>
                        <select id="cliente_k" name="cliente_k" class="form-control">
                            <option value="">Seleccione una opción...</option>
                            <?php foreach ($cliente as $registro): ?> 
                                <option value = "<?= $registro->cliente_k ?>"><?= $registro->nombre ?> <?= $registro->apellido_paterno ?> <?= $registro->apellido_materno ?></option>  
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <br>
                    <label>Invadida</label>
                    <select name="estatus_invadida_k" class="form-control">
                        <option value="1">Si</option>
                        <option value="2">No</option>
                        <option value="3">Tal vez</option>
                    </select>
                    <br>
                    <label>Llaves</label>
                    <select name="llaves" class="form-control">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                    <br>
                    <label>Credito Anterior</label>
                    <input name="credito_anterior" class="form-control">
                    <br>
                    <label>Estatus para la venta</label>
                    <select name="estatus_venta_k" class="form-control">
                        <option value="1">disponible</option>
                        <option value="2">disponible invadida</option>
                        <option value="3">reservada</option>
                    </select>
                    <br>
                    <label>Antecedentes</label>
                    <textarea name="antecedentes" class="form-control" rows="2"></textarea>
                    <br>
                    <div align="center">
                        <label>Costos</label>
                    </div>
                    <br>
                    <label>Costo</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input name="costo" class="form-control" onkeyup="formatear_num(this)" onchange="formatear_num(this)" onfocus="formatear_num(this)">
                        </div>
                    </div>
                    <label>Precio de venta</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input name="precio_venta" class="form-control" onkeyup="formatear_num(this)" onchange="formatear_num(this)" onfocus="formatear_num(this)">
                        </div>
                    </div>
                    <label>Apartado</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input name="apartado" class="form-control" onkeyup="formatear_num(this)" onchange="formatear_num(this)" onfocus="formatear_num(this)">
                        </div>
                    </div>
                    <label>Comision de venta</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">%</span>
                            <input name="comision_venta" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div align="center">
                        <label>Dirección</label>
                    </div>
                    <br>
                    <label>Codigo Postal</label>
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
                    <label>Manzana</label>
                    <input name="manzana" class="form-control">
                    <br>
                    <label>Lote</label>
                    <input name="lote" class="form-control">
                    <br>
                    <div align="center">
                        <label>Detalles vivienda</label>
                    </div>
                    <br>
                    <label>Tipo de vivienda</label>
                    <select name="tipo_vivienda_k" class="form-control">
                        <option value="1">Casa</option>
                        <option value="2">Departamento</option>
                        <option value="3">Casa duplex</option>
                    </select>
                    <br>
                    <label>M2 Terreno</label>
                    <input name="m2_terreno" class="form-control">
                    <br>
                    <label>M2 Contrucción</label>
                    <input name="m2_construccion" class="form-control">
                    <br>
                    <label>Pisos/Nivel</label>
                    <input name="pisos_nivel" class="form-control">
                    <br>
                    <label>Recamaras</label>
                    <input name="recamaras" class="form-control">
                    <br>
                    <label>Baños</label>
                    <input name="banios" class="form-control">
                    <br>
                    <label>Estacionamiento</label>
                    <input name="estacionamiento" class="form-control">
                    <br>
                    <label>Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="2"></textarea>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" id="submit_form_1" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
    <input id="casa_k" name="casa_k" hidden>
</form>

<script type="text/javascript">

  function obtenerDirecciones(cp){
    $.ajax({
        type: 'GET',
        url: 'direccion/obtenerDirecciones/'+cp,
        dataType: "json",
        success: renderDirecciones,
        error: function(a,b,c){
            console.log(a);
            console.log(b);
            console.log(c);
        }

    });
  }

  function obtenerDireccionesEdit(cp){
    $.ajax({
        type: 'GET',
        url: 'direccion/obtenerDirecciones/'+cp,
        dataType: "json",
    success: renderDirecciones
    });
  }

 function renderDirecciones(data){

    $('#estado    option').remove();
    $('#municipio option').remove();
    $('#colonia   option').remove();

    var list = data == null ? [] : (data.direcciones instanceof Array ? data.direcciones : [data.direcciones ]);

    if (list.length < 1) {

       alert("SIN NINGÚN RESULTADO EN LA BD");

    } else {

        $('#estado').append('<option value="0">Seleccione una opción</option>');
        $('#estado').append('<option value='+list[0].estado_k+' selected>'+list[0].estado+'</option>');


        $('#municipio').append('<option value="0">Seleccione una opción</option>');
        $('#municipio').append('<option value='+list[0].municipio_k+' selected >'+list[0].municipio+'</option>');


        $('#colonia').append('<option value="0">Seleccione una opción</option>');
        $.each(list, function(index, direccion) {

            $('#colonia').append('<option value='+direccion.colonia_k+'>'+direccion.colonia+'</option>');

        });

        $('#colonia').focus();
    }
 }
 function obtenerMunicipios(estado_k){
    $.ajax({
        type: 'GET',
        url: 'direccion/obtenerMunicipios/'+estado_k,
        dataType: "json",
    success: renderMunicipios
    });
  }

  function renderMunicipios(data){

    $('#municipio_k option').remove();

    var list = data == null ? [] : (data.municipios instanceof Array ? data.municipios : [data.municipios ]);

    if (list.length < 1) {

       alert("SIN NINGÚN RESULTADO EN LA BD");

    } else {


        $('#municipio_k').append('<option value="0">Seleccione una opción</option>');
        $.each(list, function(index, direccion) {

            $('#municipio_k').append('<option value='+direccion.municipio_k+'>'+direccion.municipio+'</option>');

        });

        $('#municipio_k').focus();
        
    }
 }


  function obtenerDireccionesCasa(cp){
    $.ajax({
        type: 'GET',
        url: 'direccion/obtenerDirecciones/'+cp,
        dataType: "json",
    success: renderDireccionesCasa
    });
  }


function renderDireccionesCasa(data){

    $('#estado_casa    option').remove();
    $('#municipio_casa option').remove();
    $('#colonia_casa   option').remove();

    var list = data == null ? [] : (data.direcciones instanceof Array ? data.direcciones : [data.direcciones ]);

    if (list.length < 1) {

       alert("SIN NINGÚN RESULTADO EN LA BD");

    } else {

        $('#estado_casa').append('<option value="0">Seleccione una opción</option>');
        $('#estado_casa').append('<option value='+list[0].estado_k+' selected>'+list[0].estado+'</option>');


        $('#municipio_casa').append('<option value="0">Seleccione una opción</option>');
        $('#municipio_casa').append('<option value='+list[0].municipio_k+' selected >'+list[0].municipio+'</option>');


        $('#colonia_casa').append('<option value="0">Seleccione una opción</option>');
        $.each(list, function(index, direccion) {

            $('#colonia_casa').append('<option value='+direccion.colonia_k+'>'+direccion.colonia+'</option>');

        });

        $('#colonia_casa').focus();
        
    }
}

    $('#codigo_postal').blur(function(){
     obtenerDirecciones($(this).val());
    });
    $('#codigo_postal_casa').blur(function(){
     obtenerDireccionesCasa($('#codigo_postal_casa').val());
    });

    $('#codigo_postal_edit').blur(function(){
     obtenerDireccionesEdit($('#codigo_postal_edit').val());
    });
    $('#estado_k').change(function(){
        console.log('entro');
        obtenerMunicipios($('#estado_k').val());
    });

    $('#submit_form_1').on('click', function(e){
        e.preventDefault();
        var action = $('.action').val();
        var data = $('#form_1').serialize();
        pnotify_common('info');
        $.ajax({
            type: 'POST',
            url: 'casa/' + action,
            data: data,
            success: function(data){
                if (data==1) {
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

    $('#tipo_casa_k').on('change', function(e){
        e.preventDefault();
        
        $('#paquete_casa_k').val('').change();
        $('#div_cliente').hide();

        var tipo_1 = $(this).val();
        $('#paquete_casa_k option').each(function(i){
            $(this).hide();
            var tipo_2 = $(this).attr('tipo');
            if (tipo_2 == tipo_1 || tipo_2 == '') {
                $(this).show();
            }
        });
    });

    $('#paquete_casa_k').on('change', function(e){
        e.preventDefault();
        $('#cliente_k').val('').change();
        var cliente = $('#paquete_casa_k option:selected').attr('cliente');
        if ( cliente == 1) {
            $('#div_cliente').show();
        }else{
            $('#div_cliente').hide();
        }
    });
     
</script>


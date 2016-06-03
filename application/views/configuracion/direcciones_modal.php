<form id="form_1">
    <div id="modal_1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Dirección</h3>
                </div>
                <div class="modal-body">
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
                    <input name="colonia" class="form-control">
                    <br>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" id="submit_form_1" class="btn btn-default" >Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <input class="action" hidden>
    <input id="colonia_k   " name="colonia_k" hidden>
</form>

<script type="text/javascript">

  function obtenerDirecciones(cp){
    $.ajax({
        type: 'GET',
        url: '../direccion/obtenerDirecciones/'+cp,
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
        url: '../direccion/obtenerMunicipios/'+estado_k,
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
        obtenerMunicipios($('#estado_k').val());
    });

    $('#submit_form_1').on('click', function(e){
        e.preventDefault();
        var action = $('.action').val();
        var data = $('#form_1').serialize();
        pnotify_common('info');
        $.ajax({
            type: 'POST',
            url:  action,
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


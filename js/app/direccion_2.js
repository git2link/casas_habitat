  function obtenerDirecciones(cp, base){
    $.ajax({
        type: 'GET',
        url: base + 'direccion/obtenerDirecciones/'+cp,
        dataType: "json",
	success: renderDirecciones
    });
  }

  function obtenerDireccionesEdit(cp, base){
    $.ajax({
        type: 'GET',
        url: base + 'direccion/obtenerDirecciones/'+cp,
        dataType: "json",
    success: renderDirecciones
    });
  }

  function obtenerDireccionesCasa(cp){
    $.ajax({
        type: 'GET',
        url: base + 'direccion/obtenerDirecciones/'+cp,
        dataType: "json",
    success: renderDireccionesCasa
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

        $('#estado').append('<option value="0">SELECCIONAR...</option>');
        $('#estado').append('<option value='+list[0].estado_k+' selected>'+list[0].estado+'</option>');


        $('#municipio').append('<option value="0">SELECCIONAR...</option>');
        $('#municipio').append('<option value='+list[0].municipio_k+' selected >'+list[0].municipio+'</option>');


        $('#colonia').append('<option value="0">SELECCIONAR...</option>');
        $.each(list, function(index, direccion) {

            $('#colonia').append('<option value='+direccion.colonia_k+'>'+direccion.colonia+'</option>');

        });

        $('#colonia').focus();
        
    }
 }

 function obtenerMunicipios(estado_k, base){
    $.ajax({
        type: 'GET',
        url: base + 'direccion/obtenerMunicipios/' + estado_k,
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


        $('#municipio_k').append('<option value="0">SELECCIONAR...</option>');
        $.each(list, function(index, direccion) {

            $('#municipio_k').append('<option value='+direccion.municipio_k+'>'+direccion.municipio+'</option>');

        });

        $('#municipio_k').focus();
        
    }
 }

function renderDireccionesCasa(data){

    $('#estado_casa    option').remove();
    $('#municipio_casa option').remove();
    $('#colonia_casa   option').remove();

    var list = data == null ? [] : (data.direcciones instanceof Array ? data.direcciones : [data.direcciones ]);

    if (list.length < 1) {

       alert("SIN NINGÚN RESULTADO EN LA BD");

    } else {

        $('#estado_casa').append('<option value="0">SELECCIONAR...</option>');
        $('#estado_casa').append('<option value='+list[0].estado_k+' selected>'+list[0].estado+'</option>');


        $('#municipio_casa').append('<option value="0">SELECCIONAR...</option>');
        $('#municipio_casa').append('<option value='+list[0].municipio_k+' selected >'+list[0].municipio+'</option>');


        $('#colonia_casa').append('<option value="0">SELECCIONAR...</option>');
        $.each(list, function(index, direccion) {

            $('#colonia_casa').append('<option value='+direccion.colonia_k+'>'+direccion.colonia+'</option>');

        });

        $('#colonia_casa').focus();
        
    }
 }

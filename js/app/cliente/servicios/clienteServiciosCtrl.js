app.controller('clienteServiciosCtrl', function ($scope, $http, $modal, $filter, Data) {

});


app.controller('clienteServiciosComprarCasasSinInteresCtrl', function ($scope, $http, $modal, $filter, Data) {

    $scope.usuario_ke = document.getElementById("usuario_k").value;
    datafilter = {};
    Data.post('../../servicio/casas_sin_interes/'+$scope.usuario_ke , datafilter).then(function(data){
        $scope.casas_sin_interes = data.data;
    });

    Data.get('../../direccion/get_estados_json').then( function ( data ){
      $scope.estados = data.data;
    });

    Data.get('../../catalogo/get_tipo_vivienda_json').then( function ( data ){
      $scope.tipos_vivienda = data.data;
    });

    $scope.rango_precios = [
      { rango_k : '1' , rango : '< $200,000'},
      { rango_k : '2' , rango : '$200,000 a $500,000'},
      { rango_k : '3' , rango : '$500,000 >'}
    ];
    $scope.numeros = [
      {numero_k : '1' , descripcion : '1'},
      {numero_k : '2' , descripcion : '2'},
      {numero_k : '3' , descripcion : '3'},
      {numero_k : '4' , descripcion : '4'},
      {numero_k : '5' , descripcion : '5 >'},

    ];

    $scope.columnas_compra_sin_interes = [
                    {text:"Interes",predicate:"interes",sortable:true,dataType:"number"},
                    {text:"ID",predicate:"casa_k",sortable:true,dataType:"number"},
                    {text:"Direccion",predicate:"direccion",sortable:true},
                    {text:"Precio de Venta",predicate:"precio_venta",sortable:true},
                    {text:"Pisos/Nivel",predicate:"pisos_nivel",sortable:true},
                    {text:"Recamaras",predicate:"recamaras",sortable:true},
                    {text:"Baños",predicate:"baños",sortable:true}
                ];

    $scope.casas = {
        interes: []
    };

    $scope.getmunicipios = function ( estado ){
      
      Data.get('../../direccion/get_municipios_json/'+estado.estado_k).then( function ( data ){
        $scope.municipios = data.data;
      });

    };


    $scope.casas_agregar_interes = function (arreglo){
        $http.post('../../servicio/agregar_interes/'+$scope.usuario_ke,{
            casas: arreglo,
        })
        .success( function (data , status, headers, config ){
            $http.get('../../servicio/casas_sin_interes/'+$scope.usuario_ke)  
                .success( function ( data ){
                    $scope.casas_sin_interes = data.data;
                })
        })
        .error( function (data , status, headers , config ){
            console.log('error');
        });
    };

    $scope.filtrarCasas = function (estado_k, municipio_k, tipo_vivienda_k, rango_k, 
                                    recamaras, banios , estacionamientos){
      datafilter.estado_k         = estado_k;
      datafilter.municipio_k      = municipio_k;
      datafilter.tipo_vivienda_k  = tipo_vivienda_k;
      datafilter.rango_k          = rango_k;
      datafilter.recamaras        = recamaras;
      datafilter.banios           = banios;
      datafilter.estacionamientos = estacionamientos;
      Data.post('../../servicio/casas_sin_interes/'+$scope.usuario_ke , datafilter).then(function(data){
        $scope.casas_sin_interes = data.data;
      });

      

    };

    $scope.prueba = function (municipio){
      console.log("prueba");
      console.log(municipio);
    };

});
app.controller('clienteServiciosComprarCasasConInteresCtrl', function ( $scope, $http, $modal , $filter , Data , $resource , $location){
    $scope.usuario_ke = document.getElementById("usuario_k").value;
    Data.get('../../servicio/casas_con_interes/'+$scope.usuario_ke).then(function(data){
        $scope.casas_con_interes = data.data;
    });

    $scope.columnas_compra_con_interes = [
                    //{text:"ID",predicate:"interes_k",sortable:true,dataType:"number"},
                    {text:"Direccion",predicate:"direccion",sortable:true},
                    {text:"Precio de Venta",predicate:"precio_venta",sortable:true},
                    {text:"Pisos/Nivel",predicate:"pisos_nivel",sortable:true},
                    {text:"Recamaras",predicate:"recamaras",sortable:true},
                    {text:"Baños",predicate:"baños",sortable:true},
                    {text:"Acciones",predicate:"acciones",sortable:false}
                ];
    $scope.eliminarInteres = function(interes){
        if(confirm("¿Seguro que desea eliminar el interes por esta casa?")){
            Data.delete("../../servicio/eliminar_interes/"+interes.interes_k).then(function(result){
                $scope.casas_con_interes = _.without($scope.casas_con_interes, _.findWhere($scope.casas_con_interes, {interes_k:interes.interes_k}));
            });
        }
    };



    $scope.evaluacionVenta = function (p,size) {

        if(confirm("¿Está seguro que el cliente no desea comprar ?")){
          var modalInstance = $modal.open({
          templateUrl: '../../../templates/cliente/servicios/evaluacionVenta.html',
          controller: 'evaluacionVentaCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });

        modalInstance.result.then(function(selectedObject) {
          window.location="../../home/";
        });
      }
    };
});

app.controller('evaluacionVentaCtrl', function ($scope, $modalInstance, item, Data) {
  $scope.cliente_k = document.getElementById("usuario_k").value;
  $scope.razones = {
    razonSelect: null,
    availableOptions: [
      {id: 'No le pude vender', name: 'No le pude vender'},
      {id: 'No puede comprar', name: 'No puede comprar'},
      {id: 'No tenemos propiedades de su interes', name: 'No tenemos propiedades de su interes'},
    ],
    selectedOption: {}
   };

  $scope.evaluacion = angular.copy(item);
        
  $scope.cancel = function () {
      $modalInstance.dismiss('Close');
  };
  $scope.title =  'Agregar Evaluacion';
  $scope.buttonText = 'Agregar Nueva Evaluacion';

  var original = item;
  $scope.isClean = function() {
      return angular.equals(original, $scope.evaluacion);
  }
  $scope.guardarEvaluacion = function ( comentarios , razones , cliente_k ) { 
    evaluacion = {};
     evaluacion.razon             = razones.id;
     evaluacion.cliente_k         = cliente_k;
     evaluacion.tabla_propietario = 'Vendedores';
     evaluacion.comentarios       = comentarios;
  
      Data.post('../../servicio/insertar_evaluacion', evaluacion).then(function (result) {
          if(result.status != 'error'){
              var x       = angular.copy(evaluacion);
              x.save      = 'insert';
              x.evaluacion_k  = result.data;
              $modalInstance.close(x);
          }else{
              console.log(result);
          }
      });
      
  };

});


app.controller('clienteServiciosVenderCtrl', function ( $scope, $http, $modal , $filter , Data){
  $scope.propuesta = {};
    $scope.usuario_ke = document.getElementById("usuario_k").value;
     Data.get('../../usuario/find_json/'+$scope.usuario_ke).then(function(data){
        $scope.datos_usuario = data.data;
    });
     Data.get('../../servicio/casas_en_venta/'+$scope.usuario_ke).then(function(data){
        $scope.casas_en_venta = data.data;
    });

    $scope.columnas_casas_en_venta = [
                    {text:"ID",predicate:"interes_k",sortable:true,dataType:"number"},
                    {text:"Direccion",predicate:"direccion",sortable:true},
                    {text:"Nivel de Urgencia",predicate:"nivel_urgencia",sortable:true},
                    {text:"Acciones",predicate:"acciones",sortable:false}
                ];
    $scope.evaluacionCompra = function (p,size) {

        if(confirm("¿Está seguro que el cliente no desea vender ?")){
          var modalInstance = $modal.open({
          templateUrl: '../../../templates/cliente/servicios/evaluacionCompra.html',
          controller: 'evaluacionCompraCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });

        modalInstance.result.then(function(selectedObject) {
          window.location="../../home/";
        });
      }
    };

});

app.controller('evaluacionCompraCtrl', function ($scope, $modalInstance, item, Data) {
  $scope.cliente_k = document.getElementById("usuario_k").value;
  $scope.razones = {
    razonSelect: null,
    availableOptions: [
      {id: 'No logre cerrar el trato', name: 'No logre cerrar el trato'},
      {id: 'No tiene facultades para vender', name: 'No tiene facultades para vender'}
    ],
    selectedOption: {}
   };

  $scope.evaluacion = angular.copy(item);
        
  $scope.cancel = function () {
      $modalInstance.dismiss('Close');
  };
  $scope.title =  'Agregar Evaluacion';
  $scope.buttonText = 'Agregar Nueva Evaluacion';

  var original = item;
  $scope.isClean = function() {
      return angular.equals(original, $scope.evaluacion);
  }
  $scope.guardarEvaluacion = function ( comentarios , razones , cliente_k ) { 
    evaluacion = {};
     evaluacion.razon             = razones.id;
     evaluacion.cliente_k         = cliente_k;
     evaluacion.tabla_propietario = 'Compradores';
     evaluacion.comentarios       = comentarios;
  
      Data.post('../../servicio/insertar_evaluacion', evaluacion).then(function (result) {
          if(result.status != 'error'){
              var x       = angular.copy(evaluacion);
              x.save      = 'insert';
              x.evaluacion_k  = result.data;
              $modalInstance.close(x);
          }else{
              console.log(result);
          }
      });
      
  };

});


app.controller('clienteServiciosVisitaCtrl', function ($scope, $http, $modal, $filter, Data , $routeParams) {
    $scope.visita = {};
    $scope.visitas_casa = {};
    $scope.usuario_ke = document.getElementById("usuario_k").value;
    Data.get("../../servicio/visitas_casa/"+$routeParams.id+"/"+$scope.usuario_ke).then(function(data){

        for (i = 0; i < data.data.length; i++) { 
            data.data[i].realizada = ( data.data[i].realizada == 1) ? true : false ;
        }

        $scope.visitas_casa = data.data;
    });

    $scope.columnas_visitas = [
                    {text:"Asesor",predicate:"asesor",sortable:true},
                    {text:"Visita Realizada",predicate:"realizada",sortable:true},
                    {text:"Fecha de Visita",predicate:"fecha_visita",sortable:true},
                    {text:"Acciones",predicate:"acciones",sortable:false}
                ];

    $scope.open = function (p,size) {
        p.cliente_k = $scope.usuario_ke;
        var modalInstance = $modal.open({
          templateUrl: '../../../templates/cliente/servicios/visita_form.html',
          controller: 'editarVisitaCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.visitas_casa.push(selectedObject);
                $scope.visitas_casa = $filter('orderBy')($scope.visitas_casa, 'fecha_visita', 'reverse');
            }else if(selectedObject.save == "update"){
                p.nombre_usuario = selectedObject.nombre_usuario;
                selectedObject.realizada = (selectedObject.realizada == '1') ? true : false;
                p.realizada = selectedObject.realizada;
                p.fecha_visita = selectedObject.fecha_visita;
            }
        });
    };

});

app.controller('editarVisitaCtrl', function ($scope, $modalInstance, item, Data , $routeParams) {
  $scope.visita         = angular.copy(item);
  $scope.visita.casa_k  = $routeParams.id;
  $fecha = new Date($scope.visita.fecha_visita);
  $scope.visita.realizada = ( $scope.visita.realizada == true ) ? '1' : '0';
  $scope.visita.anio = String($fecha.getFullYear()); 
  $scope.visita.mes = String($fecha.getMonth() + 1);
  $scope.visita.dia = String($fecha.getDate()+ 1);

  $scope.anios = {
    aniosSelect: null,
    availableOptions: [
      {id: '2016', name: '2016'}
    ],
    selectedOption: {id: $scope.visita.anio}
   };
   $scope.meses = {
    mesesSelect: null,
    availableOptions: [
      {id: '1', name: 'Enero'},
      {id: '2', name: 'Febrero'},
      {id: '3', name: 'Marzo'},
      {id: '4', name: 'Abril'},
      {id: '5', name: 'Mayo'},
      {id: '6', name: 'Junio'},
      {id: '7', name: 'Julio'},
      {id: '8', name: 'Agosto'},
      {id: '9', name: 'Septiembre'},
      {id: '10', name: 'Octubre'},
      {id: '11', name: 'Noviembre'},
      {id: '12', name: 'Diciembre'}
    ],
    selectedOption: {id: $scope.visita.mes}
   };
   $scope.dias = {
    diasSelect: null,
    availableOptions: [
      {id: '1', name: '01'},
      {id: '2', name: '02'},
      {id: '3', name: '03'},
      {id: '4', name: '04'},
      {id: '5', name: '05'},
      {id: '6', name: '06'},
      {id: '7', name: '07'},
      {id: '8', name: '08'},
      {id: '9', name: '09'},
      {id: '10', name: '10'},
      {id: '11', name: '11'},
      {id: '12', name: '12'},
      {id: '13', name: '13'},
      {id: '14', name: '14'},
      {id: '15', name: '15'},
      {id: '16', name: '16'},
      {id: '17', name: '17'},
      {id: '18', name: '18'},
      {id: '19', name: '19'},
      {id: '20', name: '20'},
      {id: '21', name: '21'},
      {id: '22', name: '22'},
      {id: '23', name: '23'},
      {id: '24', name: '24'},
      {id: '25', name: '25'},
      {id: '26', name: '26'},
      {id: '27', name: '27'},
      {id: '28', name: '28'},
      {id: '29', name: '29'},
      {id: '30', name: '30'},
      {id: '31', name: '31'}
    ],
    selectedOption: {id: $scope.visita.dia}
   };

   $scope.realizada = {
    realizadaSelect: null,
    availableOptions: [
      {id: '1', name: 'Realizada'},
      {id: '0', name: 'No Realizada'},
    ],
    selectedOption: {id: $scope.visita.realizada}
   };
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.visita_k > 0) ? 'Editar Visita :' : 'Agregar Visita';
        $scope.buttonText = (item.visita_k > 0) ? 'Actualizar Visita' : 'Agregar Nueva Visita';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.visita);
        }
        $scope.guardarVisita = function (visita , anio , mes , dia , realizada) {

            mes = ( mes.id < 10 ) ? '0'+mes.id : mes.id;
            dia = ( dia.id < 10 ) ? '0'+dia.id : dia.id;
            visita.fecha_visita = anio.id+'-'+mes+'-'+dia;
            visita.realizada    = realizada.id;
            visita.uid = $scope.uid;
            if(visita.visita_k > 0){
                Data.put('../../servicio/actualizar_visita/'+visita.visita_k, visita).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(visita);
                        x.save = 'update';
                        $modalInstance.close(x);
                        location.reload();

                    }else{
                        console.log(result);
                    }
                });
            }else{
                Data.post('../../servicio/insertar_visita', visita).then(function (result) {
                    if(result.status != 'error'){
                        var x       = angular.copy(visita);
                        x.save      = 'insert';
                        x.visita_k  = result.data.id;
                        x.nombre_usuario = result.data.nombre_usuario;
                        $modalInstance.close(x);
                        location.reload();
                    }else{
                        console.log(result);
                    }
                });
            }
        };
});

app.controller('ofertasCasaCtrl', function ($scope, $http, $modal, $filter, Data , $routeParams) {
  $scope.oferta = {};
  $scope.casa_k  = $routeParams.casa_k;
  $scope.cliente_k = $routeParams.cliente_k;

  $scope.columnas_ofertas = [
                    {text:"Usuario",predicate:"nombre_usuario",sortable:true},
                    {text:"Oferta",predicate:"oferta",sortable:true},
                    {text:"Estatus",predicate:"estatus",sortable:true},
                    {text:"Tipo",predicate:"tipo",sortable:true}
                    //{text:"Acciones",predicate:"acciones",sortable:false}
                ];
  Data.get("../../servicio/ofertas_casa/"+$scope.casa_k+"/"+$scope.cliente_k).then(function(data){
        $scope.ofertas_casa = data.data;
    });

  $scope.ofertar = function (p,size) {
        p.casa_k    = $scope.casa_k;
        p.cliente_k = $scope.cliente_k ;
        var modalInstance = $modal.open({
          templateUrl: '../../../templates/cliente/servicios/ofertar_form.html',
          controller: 'agregarOfertasCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.ofertas_casa.push(selectedObject);
                $scope.ofertas_casa = $filter('orderBy')($scope.ofertas_casa, 'fecha_visita', 'reverse');
            }else if(selectedObject.save == "update"){
                p.nombre_usuario = selectedObject.nombre_usuario;
                selectedObject.realizada = (selectedObject.realizada == '1') ? true : false;
                p.realizada = selectedObject.realizada;
                p.fecha_visita = selectedObject.fecha_visita;
            }
        });
    };

    /*$scope.autorizarContraOferta = function(oferta){
      console.log(oferta);
    };*/

});
app.controller('agregarOfertasCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.oferta = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = 'Agregar Oferta';
        $scope.buttonText =  'Agregar Nueva Oferta';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.oferta);
        }
        $scope.guardarOferta = function (oferta) {
            oferta.uid = $scope.uid;
            /*if(oferta.oferta_k > 0){
                Data.put('../../oferta/update/'+oferta.oferta_k, oferta).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(oferta);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{*/
                Data.post('../../servicio/insertar_oferta/1', oferta).then(function (result) {
                    if(result.status != 'error'){
                        var x            = angular.copy(oferta);
                        x.save           = 'insert';
                        x.oferta_k       = result.data.id;
                        x.nombre_usuario = result.data.nombre_usuario;
                        x.estatus        = result.data.estatus;
                        x.tipo           = result.data.tipo;
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            //}
        };
});




app.controller('clienteServiciosEditarCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.cliente = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.cliente_k > 0) ? 'Editar Cliente :' : 'Agregar Cliente';
        $scope.buttonText = (item.cliente_k > 0) ? 'Actualizar Cliente' : 'Agregar Nuevo Cliente';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.cliente);
        }
        $scope.guardarCliente = function (cliente) {
            cliente.uid = $scope.uid;
            if(cliente.cliente_k > 0){
                Data.put('../../cliente/update/'+cliente.cliente_k, cliente).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(cliente);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                Data.post('../../cliente/insert', cliente).then(function (result) {
                    if(result.status != 'error'){
                        var x       = angular.copy(cliente);
                        x.save      = 'insert';
                        x.cliente_k  = result.data;
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }
        };
});


app.controller('clienteServiciosVisitaVentasCtrl', function ($scope, $http, $modal, $filter, Data , $routeParams) {
    $scope.visita = {};
    $scope.visitas_casa = {};
    $scope.usuario_ke = document.getElementById("usuario_k").value;
    Data.get("../../servicio/visitas_casa/"+$routeParams.id+"/"+$scope.usuario_ke).then(function(data){

        for (i = 0; i < data.data.length; i++) { 
            data.data[i].realizada = ( data.data[i].realizada == 1) ? true : false ;
        }

        $scope.visitas_casa = data.data;
    });

    $scope.columnas_visitas = [
                    {text:"Asesor",predicate:"asesor",sortable:true},
                    {text:"Visita Realizada",predicate:"realizada",sortable:true},
                    {text:"Fecha de Visita",predicate:"fecha_visita",sortable:true},
                    {text:"Acciones",predicate:"acciones",sortable:false}
                ];

    $scope.open = function (p,size) {
        p.cliente_k = $scope.usuario_ke;
        var modalInstance = $modal.open({
          templateUrl: '../../../templates/cliente/servicios/visita_form.html',
          controller: 'editarVisitaCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.visitas_casa.push(selectedObject);
                $scope.visitas_casa = $filter('orderBy')($scope.visitas_casa, 'fecha_visita', 'reverse');
            }else if(selectedObject.save == "update"){
                p.nombre_usuario = selectedObject.nombre_usuario;
                selectedObject.realizada = (selectedObject.realizada == '1') ? true : false;
                p.realizada = selectedObject.realizada;
                p.fecha_visita = selectedObject.fecha_visita;
            }
        });
    };

});

app.controller('propuestasCasaCtrl', function ($scope, $http, $modal, $filter, Data , $routeParams) {
  $scope.propuesta = {};
  $scope.mostrar   = true;
  $scope.casa_k  = $routeParams.casa_k;

  $scope.cliente_k = $routeParams.cliente_k;

  $scope.columnas_propuestas = [
                    {text:"Usuario",predicate:"nombre_usuario",sortable:true},
                    {text:"Pago de Contado",predicate:"precio_contado",sortable:true},
                    {text:"Precio Pactado",predicate:"precio_pactado",sortable:true},
                    {text:"Anticipo",predicate:"anticipo",sortable:true},
                    {text:" # Mensualidades",predicate:"mensualidades",sortable:true},
                    {text:"Monto de las mensualidades",predicate:"monto_mensualidades",sortable:true},
                    {text:"% Comercializacion",predicate:"comercializacion",sortable:true},
                    {text:"Estatus",predicate:"estatus",sortable:true},
                    {text:"Acciones",predicate:"acciones",sortable:false}
                ];
  Data.get("../../servicio/propuestas_casa/"+$scope.casa_k+"/"+$scope.cliente_k).then(function(data){
      lista = {};
      lista = data.data;
      angular.forEach(lista, function(item) {
            if (item.estatus == 'Autorizada'){
              $scope.mostrar = false;
              $scope.columnas_propuestas = [
                    {text:"Usuario",predicate:"nombre_usuario",sortable:true},
                    {text:"Pago de Contado",predicate:"precio_contado",sortable:true},
                    {text:"Precio Pactado",predicate:"precio_pactado",sortable:true},
                    {text:"Anticipo",predicate:"anticipo",sortable:true},
                    {text:" # Mensualidades",predicate:"mensualidades",sortable:true},
                    {text:"Monto de las mensualidades",predicate:"monto_mensualidades",sortable:true},
                    {text:"% Comercializacion",predicate:"comercializacion",sortable:true},
                    {text:"Estatus",predicate:"estatus",sortable:true}
                    ];
            }
         });
      $scope.propuestas_casa = data.data;
    });


  

  $scope.openEnviarPropuesta = function (p,size) {
        p.casa_k    = $scope.casa_k;
        p.cliente_k = $scope.cliente_k ;
        var modalInstance = $modal.open({
          templateUrl: '../../../templates/cliente/servicios/enviarPropuesta.html',
          controller: 'clienteEnviarPropuestaCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.propuestas_casa.push(selectedObject);
                $scope.propuestas_casa = $filter('orderBy')($scope.propuestas_casa, 'fecha_visita', 'reverse');
            }else if(selectedObject.save == "update"){
                p.nombre_usuario = selectedObject.nombre_usuario;
                selectedObject.realizada = (selectedObject.realizada == '1') ? true : false;
                p.realizada = selectedObject.realizada;
                p.fecha_visita = selectedObject.fecha_visita;
            }
        });
    };

    $scope.autorizarPropuesta = function(propuesta){
 
      Data.get('../../servicio/autorizar_propuesta/'+propuesta.propuesta_k).then(function (result) {
                    if(result.status != 'error'){
                      location.reload();
                    }else{
                        console.log(result);
                    }
                });
    };


    $scope.rechazarPropuesta = function(propuesta){
 
      Data.get('../../servicio/rechazar_propuesta/'+propuesta.propuesta_k).then(function (result) {
                    if(result.status != 'error'){
                      location.reload();
                    }else{
                        console.log(result);
                    }
                });
    };

});

app.controller('clienteEnviarPropuestaCtrl', function ($scope, $modalInstance, item, Data) {
  $scope.usuario_ke = document.getElementById("usuario_k").value;
  $scope.propuesta = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };


        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.propuesta);
        }
        $scope.guardarPropuesta = function (propuesta) {
                Data.post('../../servicio/insertpropuesta/'+$scope.usuario_ke, propuesta).then(function (result) {
                    if(result.status != 'error'){
                        var x       = angular.copy(propuesta);
                        x.save      = 'insert';
                        x.propuesta_k  = result.data;
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
        };

        $scope.calcularMontoMensualidades = function (propuesta){
          propuesta.monto_mensualidades = (propuesta.precio_pactado - propuesta.anticipo) / propuesta.mensualidades;
        }
});


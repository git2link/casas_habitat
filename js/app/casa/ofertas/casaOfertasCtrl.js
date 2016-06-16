app.controller('casaOfertasCtrl', function ($scope, $http, $modal, $filter, Data ) {
  $scope.oferta = {};
  $scope.columnas_ofertas = [
                    {text:"Autorizar",predicate:"autorizar",sortable:false},
                    {text:"Usuario",predicate:"nombre_usuario",sortable:true},
                    {text:"Direccion",predicate:"direccion",sortable:true},
                    {text:"Precio Venta",predicate:"precio_venta",sortable:true},
                    {text:"Oferta",predicate:"oferta",sortable:true},
                    {text:"Estatus",predicate:"estatus",sortable:true},
                    {text:"Acciones",predicate:"acciones",sortable:false}
                ];
  Data.get("../servicio/ofertas_casas/").then(function(data){
        $scope.ofertas_casas = data.data;
    });

  

    $scope.ofertas = {
        ofertas: []
    };

    $scope.casas_autorizar_ofertas = function (arreglo){
        $http.post('../servicio/autorizar_ofertas',{
            ofertas: arreglo,
        })
        .success( function (data , status, headers, config ){
            $http.get('../servicio/ofertas_casas/')  
                .success( function ( data ){
                    $scope.ofertas_casas = data.data;
                })
        })
        .error( function (data , status, headers , config ){
            console.log('error');
        });
    };

    $scope.contraofertar = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: '../../templates/casa/ofertar_form.html',
          controller: 'agregarOfertasCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            $http.get('../servicio/ofertas_casas/')  
                .success( function ( data ){
                    $scope.ofertas_casas = data.data;
                });
        });
    };

});

app.controller('agregarOfertasCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.oferta = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = 'Agregar ContraOferta';
        $scope.buttonText =  'Agregar Nueva ContraOferta';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.oferta);
        }
        $scope.guardarContraOferta = function (oferta) {
            oferta.uid = $scope.uid;
            /*if(oferta.oferta_k > 0){
                Data.put('../../oferta/upeate/'+oferta.oferta_k, oferta).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(oferta);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{*/
                Data.post('../servicio/insertar_contraoferta/', oferta).then(function (result) {
                    if(result.status != 'error'){
                        var x            = angular.copy(oferta);
                        x.save           = 'insert';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            //}
        };
});

app.controller('casaVentaCtrl', function ($scope, $modal, $filter, Data) {

    $scope.mejora = {};
    Data.get('../../casa/all').then(function(data){
        $scope.casas = data.data;
    });
    $scope.borrarMejora = function(mejora){
        if(confirm("¿Seguro que desea eliminar la mejora?")){
            Data.delete("../../mejora/delete/"+mejora.casa_k).then(function(result){
                $scope.casas = _.without($scope.casas, _.findWhere($scope.casas, {casa_k:mejora.casa_k}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: '../../../templates/casa_venta/casaVentaEditar.html',
          controller: 'casaVentaEditarCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.casas.push(selectedObject);
                $scope.casas = $filter('orderBy')($scope.casas, 'casa_k', 'reverse');
            }else if(selectedObject.save == "update"){
                p.empresa = selectedObject.empresa;
                p.presupuesto = selectedObject.presupuesto;
                p.fecha_inicio_trabajos = selectedObject.fecha_inicio_trabajos;
                p.fecha_entrega_trabajos = selectedObject.fecha_entrega_trabajos;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"mejora_k",sortable:true,dataType:"number"},
                    {text:"Empresa",predicate:"empresa",sortable:true},
                    {text:"Presupuesto",predicate:"presupuesto",sortable:true},
                    {text:"Fecha Inicio de Trabajo",predicate:"fecha_inicio_trabajos",sortable:true},
                    {text:"Fecha Termino de Trabajo",predicate:"fecha_entrega_trabajos",reverse:true,sortable:true},
                    {text:"Action",predicate:"",sortable:false}
                ];

});


app.controller('casaVentaEditarCtrl', function ($scope, $modalInstance, item, Data) {

  $scope.mejora = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.mejora_k > 0) ? 'Editar Mejora :' : 'Agregar Mejora';
        $scope.buttonText = (item.mejora_k > 0) ? 'Actualizar Mejora' : 'Agregar Nueva Mejora';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.mejora);
        }
        $scope.guardarMejora = function (mejora) {
            mejora.uid = $scope.uid;
            if(mejora.mejora_k > 0){
                Data.put('../../mejora/update/'+mejora.mejora_k, mejora).then(function (result) {
                    if(result.status != 'error'){
                        var x = angular.copy(mejora);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
                Data.post('../../mejora/insert', mejora).then(function (result) {
                    if(result.status != 'error'){
                        var x       = angular.copy(mejora);
                        x.save      = 'insert';
                        x.mejora_k  = result.data;
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }
        };
});

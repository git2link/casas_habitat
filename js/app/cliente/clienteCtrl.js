app.controller('clienteCtrl', function ($scope, $modal, $filter, Data) {
    $scope.cliente = {};
    filter = {};
    filter.estatus_cliente = 'cliente'
    Data.post('cliente/all', filter).then(function(data){
        $scope.clientes = data.data;
    });
    $scope.borrarCliente = function(cliente){
        if(confirm("¿Seguro que desea eliminar al cliente?")){
            Data.delete("../../cliente/delete/"+cliente.casa_k).then(function(result){
                $scope.clientes = _.without($scope.clientes, _.findWhere($scope.clientes, {casa_k:cliente.casa_k}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: '../templates/cliente/clienteEditar.html',
          controller: 'clienteEditarCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.clientes.push(selectedObject);
                $scope.clientes = $filter('orderBy')($scope.clientes, 'cliente_k', 'reverse');
            }else if(selectedObject.save == "update"){
                p.empresa = selectedObject.empresa;
                p.presupuesto = selectedObject.presupuesto;
                p.fecha_inicio_trabajos = selectedObject.fecha_inicio_trabajos;
                p.fecha_entrega_trabajos = selectedObject.fecha_entrega_trabajos;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"cliente_k",sortable:true,dataType:"number"},
                    {text:"Nombre",predicate:"nombre",sortable:true},
                    {text:"Direccion",predicate:"direccion",sortable:true},
                    {text:"Email",predicate:"email",sortable:true},
                    {text:"Fecha Creacion",predicate:"fecha_hora_creacion",sortable:true},
                    {text:"Acciones",predicate:"acciones",sortable:false}
                ];
    $scope.cliente_servicios = function (data){
        window.location= "cliente/servicios/"+data.cliente_k;
        
    }

});

app.controller('prospectoCtrl', function ($scope, $modal, $filter, Data) {
    $scope.cliente = {};
    filter = {};
    filter.estatus_cliente = 'prospecto'
    Data.post('cliente/all', filter).then(function(data){
        $scope.clientes = data.data;
    });
    $scope.borrarCliente = function(cliente){
        if(confirm("¿Seguro que desea eliminar al cliente?")){
            Data.delete("../../cliente/delete/"+cliente.casa_k).then(function(result){
                $scope.clientes = _.without($scope.clientes, _.findWhere($scope.clientes, {casa_k:cliente.casa_k}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: '../templates/cliente/clienteEditar.html',
          controller: 'clienteEditarCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.clientes.push(selectedObject);
                $scope.clientes = $filter('orderBy')($scope.clientes, 'cliente_k', 'reverse');
            }else if(selectedObject.save == "update"){
                p.empresa = selectedObject.empresa;
                p.presupuesto = selectedObject.presupuesto;
                p.fecha_inicio_trabajos = selectedObject.fecha_inicio_trabajos;
                p.fecha_entrega_trabajos = selectedObject.fecha_entrega_trabajos;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"cliente_k",sortable:true,dataType:"number"},
                    {text:"Nombre",predicate:"nombre",sortable:true},
                    {text:"Direccion",predicate:"direccion",sortable:true},
                    {text:"Email",predicate:"email",sortable:true},
                    {text:"Fecha Creacion",predicate:"fecha_hora_creacion",sortable:true},
                    {text:"Acciones",predicate:"acciones",sortable:false}
                ];
    $scope.cliente_servicios = function (data){
        window.location= "cliente/servicios/"+data.cliente_k;
        
    }

});


app.controller('clienteEditarCtrl', function ($scope, $modalInstance, item, Data) {

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
                Data.put('cliente/update/'+cliente.cliente_k, cliente).then(function (result) {
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

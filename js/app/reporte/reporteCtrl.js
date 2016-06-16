app.run(['$rootScope', '$route', function( $rootScope , $route ) {

    $rootScope.$on( '$routeChangeSuccess' , function() {

        $rootScope.title        = $route.current.title;
    });

}]);
app.controller( 'comprasCtrl' , function ( $scope, $modal, $filter , Data ) {
    $scope.fecha_actual = document.getElementById("fecha_actual").value;
    Data.get( '../reporte/atencion_compras' ).then( function( data ){

        $scope.atenciones = data.data;
        
    });

$scope.columns = [
    {text:"Cliente",                predicate:"nombre_cliente",         sortable:true},
    {text:"Estatus",                predicate:"estatus_atencion",       sortable:true},
    {text:"fecha_atencion",         predicate:"fecha_atencion",         sortable:true},
    {text:"fecha_proxima_atencion", predicate:"fecha_proxima_atencion", sortable:true},
    {text:"Usuario",                predicate:"nombre_usuario",         sortable:true}
    ];

    $scope.calcularDiasTranscurridos = function (fecha_atencion , fecha_actual){
        console.log(fecha_atencion);
        console.log(fecha_actual);
    };

});


app.controller('ventasCtrl', function ($scope, $modal, $filter, Data) {
    $scope.fecha_actual = document.getElementById("fecha_actual").value;
    Data.get( '../reporte/atencion_ventas' ).then( function( data ){

        $scope.atenciones = data.data;

    });

    $scope.columns = [
        {text:"Clave Interna",          predicate:"clave_interna",          sortable:true},
        {text:"Estatus",                predicate:"estatus_atencion",       sortable:true},
        {text:"fecha_atencion",         predicate:"fecha_atencion",         sortable:true},
        {text:"fecha_proxima_atencion", predicate:"fecha_proxima_atencion", sortable:true},
        {text:"Usuario",                predicate:"nombre_usuario",         sortable:true}
    ];

});
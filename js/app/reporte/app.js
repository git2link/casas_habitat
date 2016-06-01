var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/compras', {
      title: 'Atención de Compras',
      templateUrl: '../../templates/reporte/atencion.html',
      controller: 'comprasCtrl'
    })
    .when('/ventas', {
      title: 'Atención de Ventas',
      templateUrl: '../../templates/reporte/atencion.html',
      controller: 'ventasCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    
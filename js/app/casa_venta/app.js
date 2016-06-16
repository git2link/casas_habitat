var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Casas en Venta',
      templateUrl: '../../../templates/casa_venta/casa.html',
      controller: 'casaVentaCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    
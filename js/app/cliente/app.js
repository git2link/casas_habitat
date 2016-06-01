var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Clientes',
      templateUrl: '../templates/cliente/cliente.html',
      controller: 'prospectoCtrl'
    })
    .when('/clientes', {
      title: 'Clientes',
      templateUrl: '../templates/cliente/cliente.html',
      controller: 'clienteCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    
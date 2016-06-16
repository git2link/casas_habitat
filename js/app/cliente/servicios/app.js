var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'checklist-model', 'ngResource']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Clientes',
      templateUrl: '../../../templates/cliente/servicios/servicios.html',
      controller: 'clienteServiciosCtrl'
    })
    .when('/visitas/:id', {
      templateUrl: '../../../templates/cliente/servicios/visitas.html',
      controller: 'clienteServiciosVisitaCtrl'
    })
    .when('/casas_sin_interes', {
      templateUrl: '../../../templates/cliente/servicios/comprar_casas_sin_interes.html',
      controller: 'clienteServiciosComprarCasasSinInteresCtrl'
    })
    .when('/casas_con_interes', {
      templateUrl: '../../../templates/cliente/servicios/comprar_casas_con_interes.html',
      controller: 'clienteServiciosComprarCasasConInteresCtrl'
    })
    .when('/vender', {
      templateUrl: '../../../templates/cliente/servicios/vender.html',
      controller: 'clienteServiciosVenderCtrl'
    })
    .when('/ofertas/:casa_k/:cliente_k', {
      templateUrl: '../../../templates/cliente/servicios/ofertas_casa.html',
      controller: 'ofertasCasaCtrl'
    })
    .when('/visitas_ventas/:id', {
      templateUrl: '../../../templates/cliente/servicios/visitas_ventas.html',
      controller: 'clienteServiciosVisitaVentasCtrl'
    })
    .when('/propuestas/:casa_k/:cliente_k', {
      templateUrl: '../../../templates/cliente/servicios/propuestas_casa.html',
      controller: 'propuestasCasaCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);


    
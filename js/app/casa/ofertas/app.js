var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate', 'checklist-model', 'ngResource']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Ofertas',
      templateUrl: '../../templates/casa/ofertas_casa.html',
      controller: 'casaOfertasCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);


    
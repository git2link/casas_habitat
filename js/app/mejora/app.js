var app = angular.module('myApp', ['ngRoute', 'ui.bootstrap', 'ngAnimate']);

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      title: 'Mejoras',
      templateUrl: '../../../templates/mejora/mejora.html',
      controller: 'mejoraCtrl'
    })
    .otherwise({
      redirectTo: '/'
    });;
}]);
    
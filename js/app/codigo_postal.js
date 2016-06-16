//Define an angular module for our app
var app = angular.module('myApp', ['ui.bootstrap']);

app.controller('autocompleteController', function($scope, $http) {
  obtenerCodigosPostales(); // Load all countries with capitals
  function obtenerCodigosPostales(){  
  $http.get("../direccion/obtenerCodigosPostales").success(function(data){
        $scope.codigos_postales = data;
       });
  };
});
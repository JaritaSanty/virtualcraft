var myApp = angular.module('AppAlumnos',['ngRoute', 'ngMaterial', 'ngMessages', 'material.svgAssetsCache', 'ngCookies', 'ui.bootstrap']);

//*******************************************************************************************
//******************************************RUTAS MENU***************************************
//*******************************************************************************************

myApp.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'panelAlumno.php',
            controller  : 'PanelAvataresController'
        })
        .when('/equipos', {
            templateUrl : 'equiposClaseAlumno.php',
            controller  : 'EquiposClaseAlumnoController'
        })
        .when('/trabajos', {
            templateUrl : 'trabajosAlumno.php',
            controller  : 'TrabajosAlumnoController'
        })
        .when('/404', {
            templateUrl : '404.html'
        })
        .otherwise({
            redirectTo:'/404'
        });
});

myApp.filter("Capitalize", function(){
    return function(text) {
        if(text != null){
            return text.substring(0,1).toUpperCase()+text.substring(1);
        }
    }
})

myApp.service("postsService", ["$http", "$q", "$cookies", function($http, $q, $cookies)
{

  return {
    items: function() {
      var deferred, result = [];
      deferred = $q.defer();
      $http({
        method: 'POST',
        url: '../srv/getInfoAlumno.php',
        data:"datosUsuario="+JSON.stringify(angular.fromJson($cookies.get('datosUsuario')))+"&datosCurso="+JSON.stringify(angular.fromJson($cookies.get('datosCurso'))),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).then(function(res){
        deferred.resolve(res);
      }).then(function(error){
        deferred.reject(error);
      });
      return deferred.promise;
    }
  }
}]);


//*******************************************************************************************
//*********************************ALUMNOS CONTROLLER****************************************
//*******************************************************************************************

myApp.controller('AlumnosController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));

    $http({
			method: 'POST',
			url: '../srv/getCursosAlumno.php',
      data:"datosUsuario="+JSON.stringify($scope.usuario),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data) {
      $scope.cursos = data;
		});

    $scope.goPanelAlumno = function(curso) {
      $cookies.put('datosCurso', JSON.stringify(curso));
      window.location.href = '../web_alumnos/master.php';
    }
}]);

//*******************************************************************************************
//*******************************PANEL ALUMNOS CONTROLLER************************************
//*******************************************************************************************

myApp.controller('PanelAlumnoController', ['$scope', '$http', '$cookies', '$mdDialog', '$location', "postsService", "$interval",
function($scope, $http, $cookies, $mdDialog, $location, postsService, $interval) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
    $scope.curso = angular.fromJson($cookies.get('datosCurso'));

    $scope.posts = function()
  	{
  	   postsService.items().then(function(res)
  	   {
         $scope.alumno = res.data[0];
         $cookies.put('datosAlumno', JSON.stringify($scope.alumno));
  		 });
  	}
  	var promise = $interval(function()
  	{
  	   $scope.posts();
  	},
  	5000);

  	$scope.$on('$destroy', function ()
  	{
  		$interval.cancel(promise);
  	});

    /*$http({
      method: 'POST',
      url: '../srv/getInfoAlumno.php',
      data:"datosUsuario="+JSON.stringify($scope.usuario)+"&datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.alumno = data[0];
    });*/
}]);

//*******************************************************************************************
//*******************************PANEL AVATARES CONTROLLER***********************************
//*******************************************************************************************

myApp.controller('PanelAvataresController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
    $scope.curso = angular.fromJson($cookies.get('datosCurso'));

    $http({
      method: 'POST',
      url: '../srv/getAvatarAlumnosEquipo.php',
      data:"datosUsuario="+JSON.stringify($scope.usuario)+"&datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.avatares = data;
    });
}]);

//*******************************************************************************************
//***************************EQUIPOS ALUMNO CLASE CONTROLLER*********************************
//*******************************************************************************************

myApp.controller('EquiposClaseAlumnoController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
    $scope.curso = angular.fromJson($cookies.get('datosCurso'));

    $http({
      method: 'POST',
      url: '../srv/getEquiposCurso.php',
      data:"datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.equipos = data;
    });
}]);

//*******************************************************************************************
//***************************TRABAJOS ALUMNO CLASE CONTROLLER********************************
//*******************************************************************************************

myApp.controller('TrabajosAlumnoController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
    $scope.curso = angular.fromJson($cookies.get('datosCurso'));
    $scope.alumno = angular.fromJson($cookies.get('datosAlumno'));

    $http({
      method: 'POST',
      url: '../srv/getTrabajosAsignadosAlumno.php',
      data:"datosAlumno="+JSON.stringify($scope.alumno),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.trabajos = data;
    });
}]);

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
        .when('/privilegios', {
            templateUrl : 'privilegiosAlumno.php',
            controller  : 'PrivilegiosAlumnoController'
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

myApp.service("postsServiceTrabajos", ["$http", "$q", "$cookies", function($http, $q, $cookies)
{

  return {
    items: function() {
      var deferred, result = [];
      deferred = $q.defer();
      $http({
        method: 'POST',
        url: '../srv/getTrabajosAsignadosAlumno.php',
        data:"datosAlumno="+JSON.stringify(angular.fromJson($cookies.get('datosAlumno'))),
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

myApp.controller('TrabajosAlumnoController', ['$scope', '$http', '$cookies', '$mdDialog', '$location', "postsServiceTrabajos", "$interval",
function($scope, $http, $cookies, $mdDialog, $location, postsServiceTrabajos, $interval) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
    $scope.curso = angular.fromJson($cookies.get('datosCurso'));
    $scope.alumno = angular.fromJson($cookies.get('datosAlumno'));

    /*$http({
      method: 'POST',
      url: '../srv/getTrabajosAsignadosAlumno.php',
      data:"datosAlumno="+JSON.stringify($scope.alumno),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.trabajos = data;
      console.log(data);
      for(i=0; i<$scope.trabajos.length; i++){
        if($scope.trabajos[i].trasig_aprobado_trabajo === "1"){
          $scope.trabajos[i].btnAprobado = true;
          console.log($scope.trabajos[i].btnAprobado);
        }else{
          $scope.trabajos[i].btnAprobado = false;
          console.log($scope.trabajos[i].btnAprobado);
        }
      }
    });*/

    $scope.posts = function()
  	{
  	   postsServiceTrabajos.items().then(function(res)
  	   {
         $scope.trabajos = res.data;
         for(i=0; i<$scope.trabajos.length; i++){
           if($scope.trabajos[i].trasig_aprobado_trabajo === "1"){
             $scope.trabajos[i].btnAprobado = true;
           }else{
             $scope.trabajos[i].btnAprobado = false;
           }
         }
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

    $scope.showDescripcionTrabajo = function(ev, trabajo) {
      $scope.trabajo = trabajo;
      $mdDialog.show({
        templateUrl: '../web_alumnos/popupDescripcionTrabajo.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
      });
    };

    $scope.showDesarrollarTrabajo = function(ev, trabajo) {
      $scope.trabajo = trabajo;
      $mdDialog.show({
        templateUrl: '../web_alumnos/popupDesarrolloTrabajo.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="guardar") {
            var class_data='trasig_id=' +answer.obj1.trasig_id+'&trasig_titulo_trabajo=' +answer.obj1.trasig_titulo_trabajo+'&trasig_texto_trabajo=' +answer.obj1.trasig_texto_trabajo;

            $http({
                method: 'POST',
                url: '../srv/updateGuardarTrabajo.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data !== 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Advertencia:')
                        .textContent('No s\'ha pogut desar el treball ... !!! Informa al teu professor/a')
                        .ariaLabel('Alert Dialog Demo')
                        .ok('Aceptar')
                        .targetEvent(ev)
                    );
                    console.log(response);
                }
            });
        }
      });
    };

    $scope.cancel = function() {
        $mdDialog.cancel();
    };

    $scope.answer = function(value, obj1) {
        var x = {};
        x.obj1 = obj1;
        x.respuesta = value;
        $mdDialog.hide(x);
    };
}]);

//*******************************************************************************************
//*************************PRIVILEGIOS ALUMNO CLASE CONTROLLER*******************************
//*******************************************************************************************

myApp.controller('PrivilegiosAlumnoController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
    $scope.curso = angular.fromJson($cookies.get('datosCurso'));
    $scope.alumno = angular.fromJson($cookies.get('datosAlumno'));

    $http({
      method: 'POST',
      url: '../srv/getPrivilegiosAlumnoClase.php',
      data:"datosCurso=" + JSON.stringify($scope.curso) + "&datosAlumno="+JSON.stringify($scope.alumno),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.privilegios = data;
      for(i=0; i<$scope.privilegios.length; i++){
        if($scope.privilegios[i].pri_comprado === "1"){
          $scope.privilegios[i].btnPrivilegio = 'privactivo';
          $scope.privilegios[i].btnDescripcion = true;
        }else{
          $scope.privilegios[i].btnPrivilegio = 'privdesactivo';
          $scope.privilegios[i].btnDescripcion = false;
        }
        if($scope.privilegios[i].pri_comprar === "1"){
          $scope.privilegios[i].btnComprar = false;
        }else{
          $scope.privilegios[i].btnComprar = true;
        }
        if($scope.privilegios[i].pri_ejecutar === "1"){
          $scope.privilegios[i].btnEjecutar = false;
        }else{
          $scope.privilegios[i].btnEjecutar = true;
        }
      }
      console.log($scope.privilegios);
    });

    $scope.showDescripcionPrivilegio = function(ev, privilegio) {
      $scope.privilegio = privilegio;
      $mdDialog.show({
        templateUrl: '../web_alumnos/popupDescripcionPrivilegio.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="ganar") {
            var class_data='pri_id=' +answer.obj1.pri_id+'&pri_costPV=' +answer.obj1.pri_costPV+'&pri_costPD=' +answer.obj1.pri_costPD+'&pri_costPO=' +answer.obj1.pri_costPO+'&pri_costPP=' +answer.obj1.pri_costPP+'&pri_costFO=' +answer.obj1.pri_costFO+'&prieje_tipo=ganado'+ "&datosAlumno="+JSON.stringify($scope.alumno);

            $http({
                method: 'POST',
                url: '../srv/ganarPrivilegio.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Privilegi guanyat correctament...!!!')
                      .ariaLabel('Alert Dialog Demo')
                      .ok('Aceptar')
                      .targetEvent(ev)
                  ).then(function() {
                      location.reload(true);
                  });
                }else{
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Advertencia:')
                      .textContent('No s\'ha pogut guanyar el privilegi ... !!! Informa al teu professor/a')
                      .ariaLabel('Alert Dialog Demo')
                      .ok('Aceptar')
                      .targetEvent(ev)
                  );
                  console.log(response);
                }
            });
        } else if (answer.respuesta==="comprar") {
            var class_data='pri_id=' +answer.obj1.pri_id+'&pri_aluPV=' +answer.obj1.pri_aluPV+'&pri_aluPD=' +answer.obj1.pri_aluPD+'&pri_aluPO=' +answer.obj1.pri_aluPO+'&pri_aluPP=' +answer.obj1.pri_aluPP+'&pri_aluFO=' +answer.obj1.pri_aluFO+'&pri_equPV=' +answer.obj1.pri_equPV+'&pri_equPD=' +answer.obj1.pri_equPD+'&pri_equPO=' +answer.obj1.pri_equPO+'&pri_equPP=' +answer.obj1.pri_equPP+'&pri_equFO=' +answer.obj1.pri_equFO+'&prieje_tipo=comprado'+ "&datosAlumno="+JSON.stringify($scope.alumno);

            $http({
                method: 'POST',
                url: '../srv/comprarPrivilegio.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Privilegi comprat correctament...!!!')
                      .ariaLabel('Alert Dialog Demo')
                      .ok('Aceptar')
                      .targetEvent(ev)
                  ).then(function() {
                      location.reload(true);
                  });
                }else{
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Advertencia:')
                      .textContent('No s\'ha pogut comprar el privilegi ... !!! Informa al teu professor/a')
                      .ariaLabel('Alert Dialog Demo')
                      .ok('Aceptar')
                      .targetEvent(ev)
                  );
                  console.log(response);
                }
            });
        }
      });
    };

    $scope.cancel = function() {
        $mdDialog.cancel();
    };

    $scope.answer = function(value, obj1) {
        var x = {};
        x.obj1 = obj1;
        x.respuesta = value;
        $mdDialog.hide(x);
    };
}]);

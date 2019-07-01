var myApp = angular.module('AppGestor',['ngRoute', 'ngMaterial', 'ngMessages', 'material.svgAssetsCache', 'ngCookies', 'ui.bootstrap']);

//*******************************************************************************************
//******************************************RUTAS MENU***************************************
//*******************************************************************************************

myApp.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'principal.php',
            controller  : 'PrincipalController'
        })
        .when('/alumnos', {
            templateUrl : 'listAlumnos.php',
            controller  : 'AlumnosController'
        })
        .when('/profesores', {
            templateUrl : 'listProfesores.php',
            controller  : 'ProfesoresController'
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

//*******************************************************************************************
//*********************************ALUMNOS CONTROLLER****************************************
//*******************************************************************************************

myApp.controller('PrincipalController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
}]);

//*******************************************************************************************
//*********************************ALUMNOS CONTROLLER****************************************
//*******************************************************************************************

myApp.controller('AlumnosController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));

    $http({
			method: 'POST',
			url: '../srv/getAlumnos.php',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data) {
      $scope.alumnos = data;
      $scope.propertyName = 'alu_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
		});

    $scope.showNewAlumno = function(ev) {
        $mdDialog.show({
            templateUrl: '../web_gestor/popupNuevoAlumno.php',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:false,
            fullscreen: $scope.customFullscreen,
            scope: $scope,
            preserveScope:true
        }).then(function(answer) {
          if (answer.respuesta==="nuevo") {
            var class_data='usu_nombre=' +answer.alumno.usu_nombre+'&usu_apellido='+answer.alumno.usu_apellido+'&usu_genero='+answer.alumno.usu_genero+'&usu_password='+answer.alumno.usu_password;

            $http({
                method: 'POST',
                url: '../srv/newAlumno.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('El registro se ingresó correctamente...!!!')
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
                        .textContent('El registro no se ingresó correctamente...!!! Informe al administrador del Sistema')
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

    $scope.showEditAlumno = function(ev, alumno) {
      $scope.alumno = alumno;
        $mdDialog.show({
            templateUrl: '../web_gestor/popupEditarAlumno.php',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:false,
            fullscreen: $scope.customFullscreen,
            scope: $scope,
            preserveScope:true
        }).then(function(answer) {
          if (answer.respuesta==="editar") {
            var class_data='usu_id=' +answer.alumno.usu_id+'&usu_nombre=' +answer.alumno.usu_nombre+'&usu_apellido='+answer.alumno.usu_apellido+'&usu_genero='+answer.alumno.usu_genero+'&usu_password='+answer.alumno.usu_password;

            $http({
                method: 'POST',
                url: '../srv/editAlumno.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('El registro se actualizó correctamente...!!!')
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
                        .textContent('El registro no se actualizó correctamente...!!! Informe al administrador del Sistema')
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
      location.reload(true);
      $mdDialog.cancel();
    };

    $scope.answer = function(value, obj) {
        var x = {};
        x.alumno = obj;
        x.respuesta = value;
        $mdDialog.hide(x);
    };
}]);

//*******************************************************************************************
//********************************PROFESORES CONTROLLER**************************************
//*******************************************************************************************

myApp.controller('ProfesoresController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));

    $http({
			method: 'POST',
			url: '../srv/getProfesores.php',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data) {
      $scope.profesores = data;
      $scope.propertyName = 'pro_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
		});

    $scope.showNewProfesor = function(ev) {
        $mdDialog.show({
            templateUrl: '../web_gestor/popupNuevoProfesor.php',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:false,
            fullscreen: $scope.customFullscreen,
            scope: $scope,
            preserveScope:true
        }).then(function(answer) {
          if (answer.respuesta==="nuevo") {
            var class_data='usu_nombre=' +answer.profesor.usu_nombre+'&usu_apellido='+answer.profesor.usu_apellido+'&usu_genero='+answer.profesor.usu_genero+'&usu_password='+answer.profesor.usu_password;

            $http({
                method: 'POST',
                url: '../srv/newProfesor.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('El registro se ingresó correctamente...!!!')
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
                        .textContent('El registro no se ingresó correctamente...!!! Informe al administrador del Sistema')
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

    $scope.showEditProfesor = function(ev, profesor) {
      $scope.profesor = profesor;
        $mdDialog.show({
            templateUrl: '../web_gestor/popupEditarProfesor.php',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:false,
            fullscreen: $scope.customFullscreen,
            scope: $scope,
            preserveScope:true
        }).then(function(answer) {
          if (answer.respuesta==="editar") {
            var class_data='usu_id=' +answer.profesor.usu_id+'&usu_nombre=' +answer.profesor.usu_nombre+'&usu_apellido='+answer.profesor.usu_apellido+'&usu_genero='+answer.profesor.usu_genero+'&usu_password='+answer.profesor.usu_password;

            $http({
                method: 'POST',
                url: '../srv/editProfesor.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('El registro se actualizó correctamente...!!!')
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
                        .textContent('El registro no se actualizó correctamente...!!! Informe al administrador del Sistema')
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
      location.reload(true);
      $mdDialog.cancel();
    };

    $scope.answer = function(value, obj) {
        var x = {};
        x.profesor = obj;
        x.respuesta = value;
        $mdDialog.hide(x);
    };
}]);

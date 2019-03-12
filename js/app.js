var myApp = angular.module('AppIndex',['ngRoute', 'ngMaterial', 'ngMessages', 'material.svgAssetsCache', 'ngCookies', 'ui.bootstrap']);

//*******************************************************************************************
//*************************************LOGIN CONTROLLER**************************************
//*******************************************************************************************

myApp.controller('LoginController', ['$scope', '$http', '$cookies', '$mdDialog',
function($scope, $http, $cookies, $mdDialog) {
	this.loginForm = function() {
		var nombre = (this.inputData.usuario).substring(0,(this.inputData.usuario).indexOf(" "));
		var apellido = (this.inputData.usuario).substring((this.inputData.usuario).indexOf(" ")+1);
		var user_data='usu_nombre=' +nombre+'&usu_apellido=' +apellido+'&usu_password='+this.inputData.password;

		$http({
			method: 'POST',
			url: 'srv/login.php',
			data: user_data,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data) {
			if (data[0].pro_id > 0) {
        $cookies.put('datosUsuario', JSON.stringify(data[0]));
        window.location.href = 'web_profesores/master.php';
        var class_data='log_operacion=LoginProfesor&log_aplicacion=Web';
        $http({
            method: 'POST',
            url: 'srv/createNuevoLog.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: class_data
        }).then(function(response) {
            if(response.data === 'true'){
            }else{
                console.log(response);
            }
        });
			} else if (data[0].alu_id > 0) {
        $cookies.put('datosUsuario', JSON.stringify(data[0]));
				window.location.href = 'web_alumnos/alumnos.php';
        var class_data='log_operacion=LoginAlumno&log_aplicacion=Web';
        $http({
            method: 'POST',
            url: 'srv/createNuevoLog.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: class_data
        }).then(function(response) {
            if(response.data === 'true'){
            }else{
                console.log(response);
            }
        });
			} else if (data === 'ProfesorAlumno') {
				$mdDialog.show(
					$mdDialog.alert()
					.clickOutsideToClose(false)
					.title('Advertencia:')
					.textContent('No pot tenir dos comptes. Contacti amb l\'administrador.')
					.ok('Aceptar')
				);
        var class_data='log_operacion=LoginProfesorAlumno&log_aplicacion=Web';
        $http({
            method: 'POST',
            url: 'srv/createNuevoLog.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: class_data
        }).then(function(response) {
            if(response.data === 'true'){
            }else{
                console.log(response);
            }
        });
			} else {
				$mdDialog.show(
					$mdDialog.alert()
					.clickOutsideToClose(false)
					.title('Advertencia:')
					.textContent('Usuari i Contrasenya Invalidos')
					.ok('Aceptar')
				);
        var class_data='log_operacion=LoginIncorrecto&log_aplicacion=Web';
        $http({
            method: 'POST',
            url: 'srv/createNuevoLog.php',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: class_data
        }).then(function(response) {
            if(response.data === 'true'){
            }else{
                console.log(response);
            }
        });
			}
		})
	}
}]);

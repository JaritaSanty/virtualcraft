var myApp = angular.module('AppProfesores',['ngRoute', 'ngMaterial', 'ngMessages', 'material.svgAssetsCache', 'ngCookies', 'ui.bootstrap']);

//*******************************************************************************************
//*******************************FUNCIONES Y DIRECTIVAS**************************************
//*******************************************************************************************

myApp.run(function($rootScope) {
  $rootScope.typeOf = function(value) {
    return typeof value;
  };
})

myApp.directive('stringToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(value) {
        return '' + value;
      });
      ngModel.$formatters.push(function(value) {
        return parseFloat(value);
      });
    }
  };
});

// Funciones para el Zero Padding

/**
 * Método encargado de meter n (length) caracteres a la izquierda de una cadena
 * @param padString
 * @param length
 * @returns {String}
 */
String.prototype.lpad = function(padString, length) {
    var str = this;
    while (str.length < length)
        str = padString + str;
    return str;
};

/**
 * Método encargado de meter n (length) ceros a la izquierda de una cadena
 * @param length
 * @returns {String}
 */
String.prototype.zeroPad = function(length) {
    return this.lpad('0', length);
};

//Agregamos la directiva

myApp.directive('stopWatch', function () {
  var stopWatch = function(elem, options) {
    var timer = createTimer(),
        startButton = createButton("<button class=\"btn btn-default\">Iniciar</button> &nbsp;", start),
        stopButton  = createButton("<button class=\"btn btn-default\">Detener</button> &nbsp;", stop),
        resetButton = createButton("<button class=\"btn btn-default\">Resetear</button><br/>", reset),
        offset,
        clock,
        interval;

    // default options
    options = options || {};
    options.delay = options.delay || 150;

    // append elements
    elem.appendChild(timer);
    elem.appendChild(startButton);
    elem.appendChild(stopButton);
    elem.appendChild(resetButton);

    // initialize
    reset();

    // private functions
    function createTimer() {
      return document.createElement("span");
    }

    function createButton(action, handler) {
      var a = document.createElement("a");
      a.href = "#" + action;
      a.innerHTML = action;
      a.addEventListener("click", function(event) {
        handler();
        event.preventDefault();
      });
      return a;
    }

    function start() {
      if (!interval) {
        offset   = Date.now();
        interval = setInterval(update, options.delay);
      }
    }

    function stop() {
      if (interval) {
        clearInterval(interval);
        interval = null;
      }
    }

    function reset() {
      clock = 0;
      render();
    }

    function update() {
      clock += delta();
      render();
    }

    function getClockInfo() {
      var hours = Math.floor( ((clock/1000) / 60) / 60 ),
          minutes = Math.floor( ((clock/1000) / 60) -  hours * 60 ),
          seconds =
              Math.floor(
                  (clock/1000) -
                  (minutes * 60) -
                  (hours * 60 * 60)
              ),
          milliSeconds =
              Math.floor(
                  clock -
                  (seconds * 1000) -
                  (minutes * 60 * 1000) -
                  (hours * 60 * 60 * 1000)
              );

      return {
        'hours' : hours,
        'minutes' : minutes,
        'seconds' : seconds,
        'milliSeconds' : milliSeconds
      };
    }

    function render() {
      var clockInfo = getClockInfo()

      timer.innerHTML =
          '<h2 class="text-center"><span class="hours">' +
              clockInfo.hours.toString().zeroPad(2) + '</span> : ' +
          '<span class="minutes">' +
              clockInfo.minutes.toString().zeroPad(2) + '</span> : ' +
          '<span class="seconds">' +
              clockInfo.seconds.toString().zeroPad(2) + '</span>.' +
          '<span class="milliSeconds">' +
              clockInfo.milliSeconds.toString().zeroPad(3) + '</span></h2>';
    }

    function delta() {
      var now = Date.now(),
          d   = now - offset;

      offset = now;
      return d;
    }

    // public API
    this.start  = start;
    this.stop   = stop;
    this.reset  = reset;
  };

  return {
    restrict: 'E',
    transclude: true,
    scope: {},
    link: function (scope, element) {
        var sw = new stopWatch(element[0]);
    }
  };
});

//*******************************************************************************************
//******************************************RUTAS MENU***************************************
//*******************************************************************************************

myApp.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'profesores.php',
            controller  : 'ProfesoresController'
        })
        .when('/cursoprofesor', {
            templateUrl : 'cursoProfesor.php',
            controller  : 'ProfesorCursoController'
        })
        .when('/alumnoscurso', {
            templateUrl : 'alumnosCurso.php',
            controller  : 'AlumnosCursoController'
        })
        .when('/alumnoscursoequipo', {
            templateUrl : 'cursoEquipoProfesor.php',
            controller  : 'ProfesorEquipoCursoController'
        })
        .when('/equiposcurso', {
            templateUrl : 'equiposcurso.php',
            controller  : 'EquiposCursoController'
        })
        .when('/alumnosequipo', {
            templateUrl : 'alumnosEquipo.php',
            controller  : 'AlumnosEquipoController'
        })
        .when('/premioscurso', {
            templateUrl : 'premiosCurso.php',
            controller  : 'PremiosCursoController'
        })
        .when('/castigoscurso', {
            templateUrl : 'castigosCurso.php',
            controller  : 'CastigosCursoController'
        })
        .when('/privilegioscurso', {
            templateUrl : 'privilegiosCurso.php',
            controller  : 'PrivilegiosCursoController'
        })
        .when('/trabajoscurso', {
            templateUrl : 'trabajosCurso.php',
            controller  : 'TrabajosCursoController'
        })
        .when('/404', {
            templateUrl : '404.html'
        })
        .otherwise({
            redirectTo:'/404'
        });
});


//*******************************************************************************************
//*******************************PROFESORES CONTROLLER***************************************
//*******************************************************************************************

myApp.controller('ProfesoresController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
    $http({
			method: 'POST',
			url: '../srv/getCursosProfesor.php',
      data:"datosUsuario="+JSON.stringify($scope.usuario),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(data) {
      $scope.cursos = data;
		});

    $scope.goCursoProfesor = function(curso) {
      $cookies.put('datosCurso', JSON.stringify(curso));
      $location.path('/cursoprofesor');
    }

    $scope.goAlumnosCurso = function(curso) {
      $cookies.put('datosCurso', JSON.stringify(curso));
      $location.path('/alumnoscurso');
    }

    $scope.goEquiposCurso = function(curso) {
      $cookies.put('datosCurso', JSON.stringify(curso));
      $location.path('/equiposcurso');
    }

    $scope.goPremiosCurso = function(curso) {
      $cookies.put('datosCurso', JSON.stringify(curso));
      $cookies.put('actuacion', "premio");
      $location.path('/premioscurso');
    }

    $scope.goCastigosCurso = function(curso) {
      $cookies.put('datosCurso', JSON.stringify(curso));
      $cookies.put('actuacion', "castigo");
      $location.path('/castigoscurso');
    }

    $scope.goPrivilegiosCurso = function(curso) {
      $cookies.put('datosCurso', JSON.stringify(curso));
      $location.path('/privilegioscurso');
    }

    $scope.goTrabajosCurso = function(curso) {
      $cookies.put('datosCurso', JSON.stringify(curso));
      $cookies.put('actuacion', "trabajo");
      $location.path('/trabajoscurso');
    }

    $scope.showNuevoCurso = function(ev) {
        $mdDialog.show({
            templateUrl: '../web_profesores/popupNuevoCurso.php',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:false,
            fullscreen: $scope.customFullscreen,
            scope: $scope,
            preserveScope:true
        }).then(function(answer) {
          if (answer.respuesta==="nuevo") {
              var class_data='cla_nombre=' +answer.clase.Nombre+'&cla_descripcion='+answer.clase.Descripcion;
              $http({
                  method: 'POST',
                  url: '../srv/createNuevoCurso.php',
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

    $scope.showEditarCurso = function(ev, curso) {
      $scope.curso = curso;
        $mdDialog.show({
          templateUrl: '../web_profesores/popupEditarCurso.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
        }).then(function(answer) {
          if (answer.respuesta==="editar") {
              var class_data='cla_id=' +answer.clase.cla_id+'&cla_nombre=' +answer.clase.cla_nombre+'&cla_descripcion='+answer.clase.cla_descripcion;
              $http({
                  method: 'POST',
                  url: '../srv/updateCurso.php',
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

    $scope.showSeleccionarFondo = function(ev, curso) {
      $scope.curso = curso;
      $http({
  			method: 'POST',
  			url: '../srv/getImagenes.php',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: 'img_tipo=clase'
  		}).success(function(data) {
        $scope.imagenes = data;
  		});

      $mdDialog.show({
          templateUrl: '../web_profesores/popupSeleccionarFondoClase.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="actfondo") {
            var post_data='cla_id=' +answer.clase.cla_id+'&cla_fondo='+answer.imagen.img_id+"&datosCurso="+JSON.stringify($scope.curso);
            $http({
                method: 'POST',
                url: '../srv/updateFondoClase.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: post_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Fondo Actualizado...!!!')
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
                        .textContent('No se pudo actualizar el fondo...!!! Informe al administrador del Sistema')
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

    $scope.answer = function(value, clase, imagen) {
        var x = {};
        x.clase = clase;
        x.imagen = imagen;
        x.respuesta = value;
        $mdDialog.hide(x);
    };
}]);

//*******************************************************************************************
//***************************PROFESORES CURSO CONTROLLER*************************************
//*******************************************************************************************

myApp.controller('ProfesorCursoController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
  $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
  $scope.curso = angular.fromJson($cookies.get('datosCurso'));

  $scope.equipohide = true;
  $scope.alumnohide = true;

  $http({
    method: 'POST',
    url: '../srv/getAlumnosCursoEquipo.php',
    data: "datosCurso="+JSON.stringify($scope.curso),
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  })
  .success(function(data) {
    $scope.alumnos = data;
    for(i=0; i<$scope.alumnos.length; i++){
      if($scope.alumnos[i].rolniv_id == 0){
        $scope.alumnos[i].btnRol = true;
      }else{
        $scope.alumnos[i].btnRol = false;
      }
    }
    $scope.propertyName = 'aluclaequ_nombre';
    $scope.reverse = false;
    $scope.sortBy = function(propertyName){
        $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
        $scope.propertyName = propertyName;
    };
  });

  $scope.goEquiposCurso = function(curso) {
    $cookies.put('datosCurso', JSON.stringify(curso));
    $location.path('/equiposcurso');
  }

  $scope.showCronometro = function(ev) {
      $mdDialog.show({
          templateUrl: '../web_profesores/popupCronometro.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      });
  };

  $scope.showAleatorio = function(ev) {
    $mdDialog.show({
        templateUrl: '../web_profesores/popupAleatorio.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
    });
  };

  $scope.generarEquipoAleatorio = function (){
    $http({
      method: 'POST',
      url: '../srv/getEquipoAleatorio.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.equipoAleatorio = data[0];
      $scope.equipohide = false;
      $scope.alumnohide = true;
    });
  };

  $scope.generarAlumnoAleatorio = function (){
    $http({
      method: 'POST',
      url: '../srv/getAlumnoAleatorio.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.alumnoAleatorio = data[0];
      $scope.equipohide = true;
      $scope.alumnohide = false;
    });
  };

  $scope.showLog = function(ev) {
    $http({
      method: 'POST',
      url: '../srv/getPrivilegiosLogCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.privilegiosLog = data;
      $scope.propertyName = 'prieje_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
          $scope.propertyName = propertyName;
      };
    });

    $mdDialog.show({
      templateUrl: '../web_profesores/popupLogProfesor.php',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:false,
      fullscreen: $scope.customFullscreen,
      scope: $scope,
      preserveScope:true
    });
  };

  $scope.CargarTablaLog=function(rol)
  {
    if(rol == 0){
      $http({
        method: 'POST',
        url: '../srv/getPrivilegiosLogCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.privilegiosLog = data;
        $scope.propertyName = 'prieje_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
            $scope.propertyName = propertyName;
        };
      });
    }else if(rol == 1){
      $http({
        method: 'POST',
        url: '../srv/getPremiosLogCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.premiosLog = data;
        $scope.propertyName = 'acteje_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
            $scope.propertyName = propertyName;
        };
      });
    }else if (rol == 2){
      $http({
        method: 'POST',
        url: '../srv/getCastigosLogCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.castigosLog = data;
        $scope.propertyName = 'acteje_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
            $scope.propertyName = propertyName;
        };
      });
    }else if (rol == 3){
      $http({
        method: 'POST',
        url: '../srv/getTrabajosLogCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.trabajosLog = data;
        $scope.propertyName = 'trasig_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
            $scope.propertyName = propertyName;
        };
      });
    } else if (rol == 4){
      $http({
        method: 'POST',
        url: '../srv/getLogProfesorCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.otrosLog = data;
        $scope.propertyName = 'trasig_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
            $scope.propertyName = propertyName;
        };
      });
    }
  };

  $scope.showAsignarRolNivelAlumno = function(ev, alumno) {
    var datosRoles = $http.post("../srv/getRoles.php", "datosCurso="+JSON.stringify($scope.curso));
    var datosNiveles = $http.post("../srv/getNiveles.php", "datosCurso="+JSON.stringify($scope.curso));

    datosRoles.success(function(data){
      $http.post("../srv/getRoles.php", "datosCurso="+JSON.stringify($scope.curso));
      $scope.roles = data;
    });

    datosNiveles.success(function(data){
      $http.post("../srv/getNiveles.php", "datosCurso="+JSON.stringify($scope.curso));
      $scope.niveles = data;
    });

    $scope.alumno = alumno;
      $mdDialog.show({
        templateUrl: '../web_profesores/popupAsignarRolNivelAlumno.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="editar") {
            var class_data='aluclaequ_id=' +answer.obj1.aluclaequ_id+'&rol_id=' +answer.obj1.rol_id+'&niv_id='+answer.obj1.niv_id;
            $http({
                method: 'POST',
                url: '../srv/asignarRolNivelAlumno.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Rol asignado correctamente...!!!')
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
                        .textContent('El rol no se pudo asignar correctamente...!!! Informe al administrador del Sistema')
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

  $scope.showSubirBajarPuntosAlumno = function(ev, alumno) {
    $scope.alumno = alumno;
    $scope.alumno.aluclaequ_aluPV = 0;
    $scope.alumno.aluclaequ_aluPD = 0;
    $scope.alumno.aluclaequ_aluPO = 0;
    $scope.alumno.aluclaequ_aluPP = 0;
    $scope.alumno.aluclaequ_aluFO = 0;
      $mdDialog.show({
        templateUrl: '../web_profesores/popupSubirBajarPuntosAlumno.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="editar") {
            var class_data='aluclaequ_id=' +answer.obj1.aluclaequ_id+'&aluclaequ_aluPV=' +answer.obj1.aluclaequ_aluPV+'&aluclaequ_aluPD=' +answer.obj1.aluclaequ_aluPD+'&aluclaequ_aluPO=' +answer.obj1.aluclaequ_aluPO+'&aluclaequ_aluPP=' +answer.obj1.aluclaequ_aluPP+'&aluclaequ_aluFO=' +answer.obj1.aluclaequ_aluFO+'&log_descripcion=' +answer.obj1.log_descripcion+'&equ_id=' +answer.obj1.equ_id;
            $http({
                method: 'POST',
                url: '../srv/updatePuntosAlumno.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Puntos actualizados correctamente...!!!')
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
                        .textContent('Los puntos no se han actualizado correctamente...!!! Informe al administrador del Sistema')
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

  $scope.showSubirBajarPuntosEquipo = function(ev, alumno) {
    $scope.alumno = alumno;
    $scope.alumno.aluclaequ_equPV = 0;
    $scope.alumno.aluclaequ_equPD = 0;
    $scope.alumno.aluclaequ_equPO = 0;
    $scope.alumno.aluclaequ_equPP = 0;
    $scope.alumno.aluclaequ_equFO = 0;
      $mdDialog.show({
        templateUrl: '../web_profesores/popupSubirBajarPuntosEquipo.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="sumar") {
            var class_data='equ_id=' +answer.obj1.equ_id+'&aluclaequ_equPV=' +answer.obj1.aluclaequ_equPV+'&aluclaequ_equPD=' +answer.obj1.aluclaequ_equPD+'&aluclaequ_equPO=' +answer.obj1.aluclaequ_equPO+'&aluclaequ_equPP=' +answer.obj1.aluclaequ_equPP+'&aluclaequ_equFO=' +answer.obj1.aluclaequ_equFO+'&log_descripcion=' +answer.obj1.log_descripcion;
            $http({
                method: 'POST',
                url: '../srv/updatePuntosEquipo.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Puntos actualizados correctamente...!!!')
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
                        .textContent('Los puntos no se han actualizado correctamente...!!! Informe al administrador del Sistema')
                        .ariaLabel('Alert Dialog Demo')
                        .ok('Aceptar')
                        .targetEvent(ev)
                    );
                    console.log(response);
                }
            });
        }else if (answer.respuesta==="restar") {
            var class_data='equ_id=' +answer.obj1.equ_id+'&aluclaequ_equPV=' +answer.obj1.aluclaequ_equPV+'&aluclaequ_equPD=' +answer.obj1.aluclaequ_equPD+'&aluclaequ_equPO=' +answer.obj1.aluclaequ_equPO+'&aluclaequ_equPP=' +answer.obj1.aluclaequ_equPP+'&aluclaequ_equFO=' +answer.obj1.aluclaequ_equFO+'&log_descripcion=' +answer.obj1.log_descripcion;
            $http({
                method: 'POST',
                url: '../srv/updateRestarPuntosEquipo.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Puntos actualizados correctamente...!!!')
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
                        .textContent('Los puntos no se han actualizado correctamente...!!! Informe al administrador del Sistema')
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

  $scope.showPremioAlumno = function(ev, alumno) {
    $scope.alumno = alumno;

    $http({
      method: 'POST',
      url: '../srv/getPremiosCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.premios = data;
      $scope.propertyName = 'act_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });

    $mdDialog.show({
      templateUrl: '../web_profesores/popupPremioAlumno.php',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:false,
      fullscreen: $scope.customFullscreen,
      scope: $scope,
      preserveScope:true
    }).then(function(answer) {
      if (answer.respuesta==="premio") {
          var class_data='aluclaequ_id=' +answer.obj1.aluclaequ_id+'&act_id=' +answer.obj2.act_id+'&act_PV=' +answer.obj2.act_PV+'&act_PD=' +answer.obj2.act_PD+'&act_PO=' +answer.obj2.act_PO+'&act_PP=' +answer.obj2.act_PP+'&act_FO=' +answer.obj2.act_FO+ "&datosCurso="+JSON.stringify($scope.curso);

          $http({
              method: 'POST',
              url: '../srv/premiarAlumno.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Alumno premiado correctamente...!!!')
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
                      .textContent('No se ha podido premiar al alumno...!!! Informe al administrador del Sistema')
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

  $scope.showCastigoAlumno = function(ev, alumno) {
    $scope.alumno = alumno;

    $http({
      method: 'POST',
      url: '../srv/getCastigosCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.castigos = data;
      $scope.propertyName = 'act_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });

    $mdDialog.show({
      templateUrl: '../web_profesores/popupCastigoAlumno.php',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:false,
      fullscreen: $scope.customFullscreen,
      scope: $scope,
      preserveScope:true
    }).then(function(answer) {
      if (answer.respuesta==="castigo") {
          var class_data='aluclaequ_id=' +answer.obj1.aluclaequ_id+'&act_id=' +answer.obj2.act_id+'&act_PV=' +answer.obj2.act_PV+'&act_PD=' +answer.obj2.act_PD+'&act_PO=' +answer.obj2.act_PO+'&act_PP=' +answer.obj2.act_PP+'&act_FO=' +answer.obj2.act_FO+"&datosCurso="+JSON.stringify($scope.curso);

          $http({
              method: 'POST',
              url: '../srv/castigarAlumno.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Alumno castigado correctamente...!!!')
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
                      .textContent('No se ha podido castigar al alumno...!!! Informe al administrador del Sistema')
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

  $scope.showTrabajosClase = function(ev, alumno) {
    $scope.alumno = alumno;
    var class_data='trasig_aprobado_trabajo=0' + "&datosCurso="+JSON.stringify($scope.curso);

    $http({
      method: 'POST',
      url: '../srv/getTrabajosAsignadosAlumnos.php',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: class_data
    }).success(function(data) {
      $scope.stasignados = data;
      for(i=0; i<$scope.stasignados.length; i++){
        if($scope.stasignados[i].trasig_aprobado_trabajo === "1"){$scope.stasignados[i].trasig_aprobado_trabajo = true;}else{$scope.stasignados[i].trasig_aprobado_trabajo = false;}
      }
      $scope.propertyName = 'trasig_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });

    $mdDialog.show({
      templateUrl: '../web_profesores/popupTrabajosClase.php',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:false,
      fullscreen: $scope.customFullscreen,
      scope: $scope,
      preserveScope:true
    }).then(function(answer) {
      if (answer.respuesta==="aprobar") {
          var class_data='trasig_id=' +answer.obj1.trasig_id+'&aluclaequ_id=' +answer.obj1.aluclaequ_id+'&tra_nombre=' +answer.obj1.tra_nombre+'&tra_id=' +answer.obj1.tra_id;

          $http({
              method: 'POST',
              url: '../srv/updateAprobarTrabajo.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Trabajo aprobado correctamente...!!!')
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
                      .textContent('No se ha podido aprobar el trabajo...!!! Informe al administrador del Sistema')
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

  $scope.CargarTablaTrabajosAsignados=function(aprobado)
  {
    if(aprobado == 0){
      var class_data='trasig_aprobado_trabajo=0' + "&datosCurso="+JSON.stringify($scope.curso);
      $http({
        method: 'POST',
        url: '../srv/getTrabajosAsignadosAlumnos.php',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: class_data
      }).success(function(data) {
        $scope.stasignados = data;
        for(i=0; i<$scope.stasignados.length; i++){
          if($scope.stasignados[i].trasig_aprobado_trabajo === "1"){$scope.stasignados[i].trasig_aprobado_trabajo = true;}else{$scope.stasignados[i].trasig_aprobado_trabajo = false;}
        }
        $scope.propertyName = 'trasig_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
            $scope.propertyName = propertyName;
        };
      });
    }else if(aprobado == 1){
      var class_data='trasig_aprobado_trabajo=1' + "&datosCurso="+JSON.stringify($scope.curso);
      $http({
        method: 'POST',
        url: '../srv/getTrabajosAsignadosAlumnos.php',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: class_data
      }).success(function(data) {
        $scope.atasignados = data;
        for(i=0; i<$scope.atasignados.length; i++){
          if($scope.atasignados[i].trasig_aprobado_trabajo === "1"){$scope.atasignados[i].trasig_aprobado_trabajo = true;}else{$scope.atasignados[i].trasig_aprobado_trabajo = false;}
        }
        $scope.propertyName = 'trasig_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
            $scope.propertyName = propertyName;
        };
      });
    }
  };

  $scope.showTrabajoAlumno = function(ev, alumno) {
    $scope.alumno = alumno;
    $scope.trabajos = "";
    var class_data='aluclaequ_id=' +alumno.aluclaequ_id + "&datosCurso="+JSON.stringify($scope.curso);
    $http({
      method: 'POST',
      url: '../srv/getTrabajosCurso.php',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: class_data
    }).success(function(data) {
      $scope.trabajos = data;
      for(i=0; i<$scope.trabajos.length; i++){
        if($scope.trabajos[i].trasig_clase == 'true'){
          $scope.trabajos[i].btnAlumno = false;
          $scope.trabajos[i].btnEquipo = false;
          $scope.trabajos[i].btnClase = false;
        }else if($scope.trabajos[i].trasig_equipo == 'true'){
          $scope.trabajos[i].btnAlumno = false;
          $scope.trabajos[i].btnEquipo = false;
          $scope.trabajos[i].btnClase = true;
        }else if($scope.trabajos[i].trasig_alumno == 'true'){
          $scope.trabajos[i].btnAlumno = false;
          $scope.trabajos[i].btnEquipo = true;
          $scope.trabajos[i].btnClase = true;
        }else{
          $scope.trabajos[i].btnAlumno = true;
          $scope.trabajos[i].btnEquipo = true;
          $scope.trabajos[i].btnClase = true;
        }
      }
      $scope.propertyName = 'tra_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });

    $mdDialog.show({
      templateUrl: '../web_profesores/popupTrabajoAlumno.php',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:false,
      fullscreen: $scope.customFullscreen,
      scope: $scope,
      preserveScope:true
    }).then(function(answer) {
      if (answer.respuesta==="talumno") {
          var class_data='aluclaequ_id=' +answer.obj1.aluclaequ_id+'&tra_id=' +answer.obj2.tra_id;

          $http({
              method: 'POST',
              url: '../srv/asignarTrabajoAlumno.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Trabajo asignado correctamente...!!!')
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
                      .textContent('El trabajo no se ha podido asignar al alumno...!!! Informe al administrador del Sistema')
                      .ariaLabel('Alert Dialog Demo')
                      .ok('Aceptar')
                      .targetEvent(ev)
                  );
                  console.log(response);
              }
          });
      } else if (answer.respuesta==="tequipo") {
          var class_data='equ_id=' +answer.obj1.equ_id+'&tra_id=' +answer.obj2.tra_id + "&datosCurso="+JSON.stringify($scope.curso);

          $http({
              method: 'POST',
              url: '../srv/asignarTrabajoEquipo.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Trabajo asignado correctamente...!!!')
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
                      .textContent('El trabajo no se ha podido asignar al equipo...!!! Informe al administrador del Sistema')
                      .ariaLabel('Alert Dialog Demo')
                      .ok('Aceptar')
                      .targetEvent(ev)
                  );
                  console.log(response);
              }
          });
      } else if (answer.respuesta==="tcurso") {
          var class_data='tra_id='+answer.obj2.tra_id + "&datosCurso="+JSON.stringify($scope.curso);

          $http({
              method: 'POST',
              url: '../srv/asignarTrabajoClase.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Trabajo asignado correctamente...!!!')
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
                      .textContent('El trabajo no se ha podido asignar a la clase...!!! Informe al administrador del Sistema')
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

  $scope.answer = function(value, obj1, obj2) {
      var x = {};
      x.obj1 = obj1;
      x.obj2 = obj2;
      x.respuesta = value;
      $mdDialog.hide(x);
  };

}]);

//*******************************************************************************************
//************************PROFESORES EQUIPO CURSO CONTROLLER*********************************
//*******************************************************************************************

myApp.controller('ProfesorEquipoCursoController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
  $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
  $scope.curso = angular.fromJson($cookies.get('datosCurso'));
  $scope.equipo = angular.fromJson($cookies.get('datosEquipo'));
  $scope.equipohide = true;
  $scope.alumnohide = true;

  $http({
    method: 'POST',
    url: '../srv/getAlumnosCursoPorEquipo.php',
    data: "datosCurso="+JSON.stringify($scope.curso)+"&datosEquipo="+JSON.stringify($scope.equipo),
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  })
  .success(function(data) {
    $scope.alumnos = data;
    for(i=0; i<$scope.alumnos.length; i++){
      if($scope.alumnos[i].rolniv_id == 0){
        $scope.alumnos[i].btnRol = true;
      }else{
        $scope.alumnos[i].btnRol = false;
      }
    }
    $scope.propertyName = 'aluclaequ_nombre';
    $scope.reverse = false;
    $scope.sortBy = function(propertyName){
        $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
        $scope.propertyName = propertyName;
    };
  });

  $scope.goEquiposCurso = function(curso) {
    $cookies.put('datosCurso', JSON.stringify(curso));
    $location.path('/equiposcurso');
  }

  $scope.showCronometro = function(ev) {
      $mdDialog.show({
          templateUrl: '../web_profesores/popupCronometro.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      });
  };

  $scope.showAleatorio = function(ev) {
    $mdDialog.show({
        templateUrl: '../web_profesores/popupAleatorio.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
    });
  };

  $scope.generarEquipoAleatorio = function (){
    $http({
      method: 'POST',
      url: '../srv/getEquipoAleatorio.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.equipoAleatorio = data[0];
      $scope.equipohide = false;
      $scope.alumnohide = true;
    });
  };

  $scope.generarAlumnoAleatorio = function (){
    $http({
      method: 'POST',
      url: '../srv/getAlumnoAleatorio.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.alumnoAleatorio = data[0];
      $scope.equipohide = true;
      $scope.alumnohide = false;
    });
  };

  $scope.showLog = function(ev) {
    $http({
      method: 'POST',
      url: '../srv/getPrivilegiosLogCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.privilegiosLog = data;
      $scope.propertyName = 'prieje_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
          $scope.propertyName = propertyName;
      };
    });

    $mdDialog.show({
      templateUrl: '../web_profesores/popupLogProfesor.php',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:false,
      fullscreen: $scope.customFullscreen,
      scope: $scope,
      preserveScope:true
    });
  };

  $scope.CargarTablaLog=function(rol)
  {
    if(rol == 0){
      $http({
        method: 'POST',
        url: '../srv/getPrivilegiosLogCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.privilegiosLog = data;
        $scope.propertyName = 'prieje_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
            $scope.propertyName = propertyName;
        };
      });
    }else if(rol == 1){
      $http({
        method: 'POST',
        url: '../srv/getPremiosLogCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.premiosLog = data;
        $scope.propertyName = 'acteje_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
            $scope.propertyName = propertyName;
        };
      });
    }else if (rol == 2){
      $http({
        method: 'POST',
        url: '../srv/getCastigosLogCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.castigosLog = data;
        $scope.propertyName = 'acteje_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
            $scope.propertyName = propertyName;
        };
      });
    }else if (rol == 3){
      $http({
        method: 'POST',
        url: '../srv/getTrabajosLogCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.trabajosLog = data;
        $scope.propertyName = 'trasig_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
            $scope.propertyName = propertyName;
        };
      });
    } else if (rol == 4){
      $http({
        method: 'POST',
        url: '../srv/getLogProfesorCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.otrosLog = data;
        $scope.propertyName = 'trasig_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
            $scope.propertyName = propertyName;
        };
      });
    }
  };

  $scope.showAsignarRolNivelAlumno = function(ev, alumno) {
    var datosRoles = $http.post("../srv/getRoles.php", "datosCurso="+JSON.stringify($scope.curso));
    var datosNiveles = $http.post("../srv/getNiveles.php", "datosCurso="+JSON.stringify($scope.curso));

    datosRoles.success(function(data){
      $http.post("../srv/getRoles.php", "datosCurso="+JSON.stringify($scope.curso));
      $scope.roles = data;
    });

    datosNiveles.success(function(data){
      $http.post("../srv/getNiveles.php", "datosCurso="+JSON.stringify($scope.curso));
      $scope.niveles = data;
    });

    $scope.alumno = alumno;
      $mdDialog.show({
        templateUrl: '../web_profesores/popupAsignarRolNivelAlumno.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="editar") {
            var class_data='aluclaequ_id=' +answer.obj1.aluclaequ_id+'&rol_id=' +answer.obj1.rol_id+'&niv_id='+answer.obj1.niv_id;
            $http({
                method: 'POST',
                url: '../srv/asignarRolNivelAlumno.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Rol asignado correctamente...!!!')
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
                        .textContent('El rol no se pudo asignar correctamente...!!! Informe al administrador del Sistema')
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

  $scope.showSubirBajarPuntosAlumno = function(ev, alumno) {
    $scope.alumno = alumno;
    $scope.alumno.aluclaequ_aluPV = 0;
    $scope.alumno.aluclaequ_aluPD = 0;
    $scope.alumno.aluclaequ_aluPO = 0;
    $scope.alumno.aluclaequ_aluPP = 0;
    $scope.alumno.aluclaequ_aluFO = 0;
      $mdDialog.show({
        templateUrl: '../web_profesores/popupSubirBajarPuntosAlumno.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="editar") {
            var class_data='aluclaequ_id=' +answer.obj1.aluclaequ_id+'&aluclaequ_aluPV=' +answer.obj1.aluclaequ_aluPV+'&aluclaequ_aluPD=' +answer.obj1.aluclaequ_aluPD+'&aluclaequ_aluPO=' +answer.obj1.aluclaequ_aluPO+'&aluclaequ_aluPP=' +answer.obj1.aluclaequ_aluPP+'&aluclaequ_aluFO=' +answer.obj1.aluclaequ_aluFO+'&log_descripcion=' +answer.obj1.log_descripcion;
            $http({
                method: 'POST',
                url: '../srv/updatePuntosAlumno.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Puntos actualizados correctamente...!!!')
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
                        .textContent('Los puntos no se han actualizado correctamente...!!! Informe al administrador del Sistema')
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

  $scope.showSubirBajarPuntosEquipo = function(ev, alumno) {
    $scope.alumno = alumno;
    $scope.alumno.aluclaequ_equPV = 0;
    $scope.alumno.aluclaequ_equPD = 0;
    $scope.alumno.aluclaequ_equPO = 0;
    $scope.alumno.aluclaequ_equPP = 0;
    $scope.alumno.aluclaequ_equFO = 0;
      $mdDialog.show({
        templateUrl: '../web_profesores/popupSubirBajarPuntosEquipo.php',
        parent: angular.element(document.body),
        targetEvent: ev,
        clickOutsideToClose:false,
        fullscreen: $scope.customFullscreen,
        scope: $scope,
        preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="sumar") {
            var class_data='equ_id=' +answer.obj1.equ_id+'&aluclaequ_equPV=' +answer.obj1.aluclaequ_equPV+'&aluclaequ_equPD=' +answer.obj1.aluclaequ_equPD+'&aluclaequ_equPO=' +answer.obj1.aluclaequ_equPO+'&aluclaequ_equPP=' +answer.obj1.aluclaequ_equPP+'&aluclaequ_equFO=' +answer.obj1.aluclaequ_equFO+'&log_descripcion=' +answer.obj1.log_descripcion;
            $http({
                method: 'POST',
                url: '../srv/updatePuntosEquipo.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Puntos actualizados correctamente...!!!')
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
                        .textContent('Los puntos no se han actualizado correctamente...!!! Informe al administrador del Sistema')
                        .ariaLabel('Alert Dialog Demo')
                        .ok('Aceptar')
                        .targetEvent(ev)
                    );
                    console.log(response);
                }
            });
        }else if (answer.respuesta==="restar") {
            var class_data='equ_id=' +answer.obj1.equ_id+'&aluclaequ_equPV=' +answer.obj1.aluclaequ_equPV+'&aluclaequ_equPD=' +answer.obj1.aluclaequ_equPD+'&aluclaequ_equPO=' +answer.obj1.aluclaequ_equPO+'&aluclaequ_equPP=' +answer.obj1.aluclaequ_equPP+'&aluclaequ_equFO=' +answer.obj1.aluclaequ_equFO+'&log_descripcion=' +answer.obj1.log_descripcion;
            $http({
                method: 'POST',
                url: '../srv/updateRestarPuntosEquipo.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: class_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Puntos actualizados correctamente...!!!')
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
                        .textContent('Los puntos no se han actualizado correctamente...!!! Informe al administrador del Sistema')
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

  $scope.showPremioAlumno = function(ev, alumno) {
    $scope.alumno = alumno;

    $http({
      method: 'POST',
      url: '../srv/getPremiosCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.premios = data;
      $scope.propertyName = 'act_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });

    $mdDialog.show({
      templateUrl: '../web_profesores/popupPremioAlumno.php',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:false,
      fullscreen: $scope.customFullscreen,
      scope: $scope,
      preserveScope:true
    }).then(function(answer) {
      if (answer.respuesta==="premio") {
          var class_data='aluclaequ_id=' +answer.obj1.aluclaequ_id+'&act_id=' +answer.obj2.act_id+'&act_PV=' +answer.obj2.act_PV+'&act_PD=' +answer.obj2.act_PD+'&act_PO=' +answer.obj2.act_PO+'&act_PP=' +answer.obj2.act_PP+'&act_FO=' +answer.obj2.act_FO+ "&datosCurso="+JSON.stringify($scope.curso);

          $http({
              method: 'POST',
              url: '../srv/premiarAlumno.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Alumno premiado correctamente...!!!')
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
                      .textContent('No se ha podido premiar al alumno...!!! Informe al administrador del Sistema')
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

  $scope.showCastigoAlumno = function(ev, alumno) {
    $scope.alumno = alumno;

    $http({
      method: 'POST',
      url: '../srv/getCastigosCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).success(function(data) {
      $scope.castigos = data;
      $scope.propertyName = 'act_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });

    $mdDialog.show({
      templateUrl: '../web_profesores/popupCastigoAlumno.php',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:false,
      fullscreen: $scope.customFullscreen,
      scope: $scope,
      preserveScope:true
    }).then(function(answer) {
      if (answer.respuesta==="castigo") {
          var class_data='aluclaequ_id=' +answer.obj1.aluclaequ_id+'&act_id=' +answer.obj2.act_id+'&act_PV=' +answer.obj2.act_PV+'&act_PD=' +answer.obj2.act_PD+'&act_PO=' +answer.obj2.act_PO+'&act_PP=' +answer.obj2.act_PP+'&act_FO=' +answer.obj2.act_FO+"&datosCurso="+JSON.stringify($scope.curso);

          $http({
              method: 'POST',
              url: '../srv/castigarAlumno.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Alumno castigado correctamente...!!!')
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
                      .textContent('No se ha podido castigar al alumno...!!! Informe al administrador del Sistema')
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

  $scope.showTrabajosClase = function(ev, alumno) {
    $scope.alumno = alumno;
    var class_data='trasig_aprobado_trabajo=0' + "&datosCurso="+JSON.stringify($scope.curso);

    $http({
      method: 'POST',
      url: '../srv/getTrabajosAsignadosAlumnos.php',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: class_data
    }).success(function(data) {
      $scope.stasignados = data;
      for(i=0; i<$scope.stasignados.length; i++){
        if($scope.stasignados[i].trasig_aprobado_trabajo === "1"){$scope.stasignados[i].trasig_aprobado_trabajo = true;}else{$scope.stasignados[i].trasig_aprobado_trabajo = false;}
      }
      $scope.propertyName = 'trasig_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });

    $mdDialog.show({
      templateUrl: '../web_profesores/popupTrabajosClase.php',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:false,
      fullscreen: $scope.customFullscreen,
      scope: $scope,
      preserveScope:true
    }).then(function(answer) {
      if (answer.respuesta==="aprobar") {
          var class_data='trasig_id=' +answer.obj1.trasig_id+'&aluclaequ_id=' +answer.obj1.aluclaequ_id+'&tra_nombre=' +answer.obj1.tra_nombre+'&tra_id=' +answer.obj1.tra_id;

          $http({
              method: 'POST',
              url: '../srv/updateAprobarTrabajo.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Trabajo aprobado correctamente...!!!')
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
                      .textContent('No se ha podido aprobar el trabajo...!!! Informe al administrador del Sistema')
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

  $scope.CargarTablaTrabajosAsignados=function(aprobado)
  {
    if(aprobado == 0){
      var class_data='trasig_aprobado_trabajo=0' + "&datosCurso="+JSON.stringify($scope.curso);
      $http({
        method: 'POST',
        url: '../srv/getTrabajosAsignadosAlumnos.php',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: class_data
      }).success(function(data) {
        $scope.stasignados = data;
        for(i=0; i<$scope.stasignados.length; i++){
          if($scope.stasignados[i].trasig_aprobado_trabajo === "1"){$scope.stasignados[i].trasig_aprobado_trabajo = true;}else{$scope.stasignados[i].trasig_aprobado_trabajo = false;}
        }
        $scope.propertyName = 'trasig_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
            $scope.propertyName = propertyName;
        };
      });
    }else if(aprobado == 1){
      var class_data='trasig_aprobado_trabajo=1' + "&datosCurso="+JSON.stringify($scope.curso);
      $http({
        method: 'POST',
        url: '../srv/getTrabajosAsignadosAlumnos.php',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: class_data
      }).success(function(data) {
        $scope.atasignados = data;
        for(i=0; i<$scope.atasignados.length; i++){
          if($scope.atasignados[i].trasig_aprobado_trabajo === "1"){$scope.atasignados[i].trasig_aprobado_trabajo = true;}else{$scope.atasignados[i].trasig_aprobado_trabajo = false;}
        }
        $scope.propertyName = 'trasig_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
            $scope.propertyName = propertyName;
        };
      });
    }
  };

  $scope.showTrabajoAlumno = function(ev, alumno) {
    $scope.alumno = alumno;
    $scope.trabajos = "";
    var class_data='aluclaequ_id=' +alumno.aluclaequ_id + "&datosCurso="+JSON.stringify($scope.curso);
    $http({
      method: 'POST',
      url: '../srv/getTrabajosCurso.php',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      data: class_data
    }).success(function(data) {
      $scope.trabajos = data;
      for(i=0; i<$scope.trabajos.length; i++){
        if($scope.trabajos[i].trasig_clase == 'true'){
          $scope.trabajos[i].btnAlumno = false;
          $scope.trabajos[i].btnEquipo = false;
          $scope.trabajos[i].btnClase = false;
        }else if($scope.trabajos[i].trasig_equipo == 'true'){
          $scope.trabajos[i].btnAlumno = false;
          $scope.trabajos[i].btnEquipo = false;
          $scope.trabajos[i].btnClase = true;
        }else if($scope.trabajos[i].trasig_alumno == 'true'){
          $scope.trabajos[i].btnAlumno = false;
          $scope.trabajos[i].btnEquipo = true;
          $scope.trabajos[i].btnClase = true;
        }else{
          $scope.trabajos[i].btnAlumno = true;
          $scope.trabajos[i].btnEquipo = true;
          $scope.trabajos[i].btnClase = true;
        }
      }
      $scope.propertyName = 'tra_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });

    $mdDialog.show({
      templateUrl: '../web_profesores/popupTrabajoAlumno.php',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:false,
      fullscreen: $scope.customFullscreen,
      scope: $scope,
      preserveScope:true
    }).then(function(answer) {
      if (answer.respuesta==="talumno") {
          var class_data='aluclaequ_id=' +answer.obj1.aluclaequ_id+'&tra_id=' +answer.obj2.tra_id;

          $http({
              method: 'POST',
              url: '../srv/asignarTrabajoAlumno.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Trabajo asignado correctamente...!!!')
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
                      .textContent('El trabajo no se ha podido asignar al alumno...!!! Informe al administrador del Sistema')
                      .ariaLabel('Alert Dialog Demo')
                      .ok('Aceptar')
                      .targetEvent(ev)
                  );
                  console.log(response);
              }
          });
      } else if (answer.respuesta==="tequipo") {
          var class_data='equ_id=' +answer.obj1.equ_id+'&tra_id=' +answer.obj2.tra_id + "&datosCurso="+JSON.stringify($scope.curso);

          $http({
              method: 'POST',
              url: '../srv/asignarTrabajoEquipo.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Trabajo asignado correctamente...!!!')
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
                      .textContent('El trabajo no se ha podido asignar al equipo...!!! Informe al administrador del Sistema')
                      .ariaLabel('Alert Dialog Demo')
                      .ok('Aceptar')
                      .targetEvent(ev)
                  );
                  console.log(response);
              }
          });
      } else if (answer.respuesta==="tcurso") {
          var class_data='tra_id='+answer.obj2.tra_id + "&datosCurso="+JSON.stringify($scope.curso);

          $http({
              method: 'POST',
              url: '../srv/asignarTrabajoClase.php',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              data: class_data
          }).then(function(response) {
              if(response.data === 'true'){
                  $mdDialog.show(
                      $mdDialog.alert()
                      .clickOutsideToClose(false)
                      .title('Información:')
                      .textContent('Trabajo asignado correctamente...!!!')
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
                      .textContent('El trabajo no se ha podido asignar a la clase...!!! Informe al administrador del Sistema')
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

  $scope.answer = function(value, obj1, obj2) {
      var x = {};
      x.obj1 = obj1;
      x.obj2 = obj2;
      x.respuesta = value;
      $mdDialog.hide(x);
  };

}]);

//*******************************************************************************************
//******************************ALUMNOS CURSO CONTROLLER*************************************
//*******************************************************************************************

myApp.controller('AlumnosCursoController', ['$scope', '$http', '$cookies', '$mdDialog',
function($scope, $http, $cookies, $mdDialog) {
  $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
  $scope.curso = angular.fromJson($cookies.get('datosCurso'));

  $http({
    method: 'POST',
    url: '../srv/getAlumnosCurso.php',
    data: "datosCurso="+JSON.stringify($scope.curso),
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  })
  .success(function(data) {
    $scope.alumnos = data;
  });

  $http({
    method: 'POST',
    url: '../srv/getAlumnosSinCurso.php',
    data: "datosCurso="+JSON.stringify($scope.curso),
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  })
  .success(function(data) {
    $scope.noalumnos = data;
  });

  $scope.ActualizarCombos = function(){
    $http({
      method: 'POST',
      url: '../srv/getAlumnosSinCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.noalumnos = data;
    });

    $http({
      method: 'POST',
      url: '../srv/getAlumnosCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.alumnos = data;
    });
  }

  $scope.quitarAlumno = function(ev,alucla_id){
    for (var i=0; i<(alucla_id.length); i++) {
      var post_data='alucla_id='+alucla_id[i]+"&datosCurso="+JSON.stringify($scope.curso);
      $http({
          method: 'POST',
          url: '../srv/quitarAlumnoCurso.php',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data: post_data
      }).then(function(response) {
          if(response.data === 'true'){
          }else{
              $mdDialog.show(
                  $mdDialog.alert()
                  .clickOutsideToClose(false)
                  .title('Advertencia:')
                  .textContent('Algunos alumnos no se pudieron quitarlos del curso...!!! Informe al administrador del Sistema')
                  .ariaLabel('Alert Dialog Demo')
                  .ok('Aceptar')
                  .targetEvent(ev)
              );
              console.log(response);
          }
          $scope.ActualizarCombos();
      });
    }
  };

  $scope.asignarAlumno = function(ev,alu_id){
    for (var i=0; i<(alu_id.length); i++) {
      var post_data='alu_id='+alu_id[i]+"&datosCurso="+JSON.stringify($scope.curso);
      $http({
          method: 'POST',
          url: '../srv/asignarAlumnoCurso.php',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data: post_data
      }).then(function(response) {
          if(response.data === 'true'){
          }else{
              $mdDialog.show(
                  $mdDialog.alert()
                  .clickOutsideToClose(false)
                  .title('Advertencia:')
                  .textContent('Algunos alumnos no se pudieron agregarlos al curso...!!! Informe al administrador del Sistema')
                  .ariaLabel('Alert Dialog Demo')
                  .ok('Aceptar')
                  .targetEvent(ev)
              );
              console.log(response);
          }
          $scope.ActualizarCombos();
      });
    }
  };
}]);

//*******************************************************************************************
//*******************************EQUIPOS CURSO  CONTROLLER***********************************
//*******************************************************************************************

myApp.controller('EquiposCursoController', ['$scope', '$http', '$cookies', '$mdDialog', '$location',
function($scope, $http, $cookies, $mdDialog, $location) {
    $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
    $scope.curso = angular.fromJson($cookies.get('datosCurso'));

    $http({
			method: 'POST',
			url: '../srv/getEquiposCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(data) {
      $scope.equipos = data;
		});

    $scope.goAlumnosEquipo = function(equipo) {
      $cookies.put('datosEquipo', JSON.stringify(equipo));
      $location.path('/alumnosequipo');
    }

    $scope.goCursoProfesor = function(curso, equipo) {
      $cookies.put('datosCurso', JSON.stringify(curso));
      $cookies.put('datosEquipo', JSON.stringify(equipo));
      $location.path('/alumnoscursoequipo');
    }

    $scope.showNuevoEquipo = function(ev) {
        $mdDialog.show({
            templateUrl: '../web_profesores/popupNuevoEquipo.php',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:false,
            fullscreen: $scope.customFullscreen,
            scope: $scope,
            preserveScope:true
        }).then(function(answer) {
          if (answer.respuesta==="nuevo") {
              var post_data='equ_nombre=' +answer.equipo.Nombre+'&equ_descripcion='+answer.equipo.Descripcion+"&datosCurso="+JSON.stringify($scope.curso);
              $http({
                  method: 'POST',
                  url: '../srv/createNuevoEquipo.php',
                  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                  data: post_data
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

    $scope.showEditarEquipo = function(ev, equipo) {
      $scope.equipo = equipo;
        $mdDialog.show({
            templateUrl: '../web_profesores/popupEditarEquipo.php',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:false,
            fullscreen: $scope.customFullscreen,
            scope: $scope,
            preserveScope:true
        }).then(function(answer) {
          if (answer.respuesta==="editar") {
              var post_data='equ_id=' +answer.equipo.equ_id+'&equ_nombre=' +answer.equipo.equ_nombre+'&equ_descripcion='+answer.equipo.equ_descripcion+"&datosCurso="+JSON.stringify($scope.curso);
              $http({
                  method: 'POST',
                  url: '../srv/updateEquipo.php',
                  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                  data: post_data
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

    $scope.showSeleccionarEscudo = function(ev, equipo) {
      $scope.equipo = equipo;
      $http({
  			method: 'POST',
  			url: '../srv/getImagenes.php',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: 'img_tipo=escudo'
  		}).success(function(data) {
        $scope.imagenes = data;
  		});

      $mdDialog.show({
          templateUrl: '../web_profesores/popupSeleccionarEscudo.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="actescudo") {
            var post_data='equ_id=' +answer.equipo.equ_id+'&equ_escudo='+answer.imagen.img_id+"&datosCurso="+JSON.stringify($scope.curso);
            $http({
                method: 'POST',
                url: '../srv/updateEscudoEquipo.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: post_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Escudo Actualizado...!!!')
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
                        .textContent('No se pudo actualizar el escudo...!!! Informe al administrador del Sistema')
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

    $scope.showSeleccionarFondo = function(ev, equipo) {
      $scope.equipo = equipo;
      $http({
  			method: 'POST',
  			url: '../srv/getImagenes.php',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: 'img_tipo=fondo'
  		}).success(function(data) {
        $scope.imagenes = data;
  		});

      $mdDialog.show({
          templateUrl: '../web_profesores/popupSeleccionarFondo.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="actfondo") {
            var post_data='equ_id=' +answer.equipo.equ_id+'&equ_fondo='+answer.imagen.img_id+"&datosCurso="+JSON.stringify($scope.curso);
            $http({
                method: 'POST',
                url: '../srv/updateFondoEquipo.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: post_data
            }).then(function(response) {
                if(response.data === 'true'){
                    $mdDialog.show(
                        $mdDialog.alert()
                        .clickOutsideToClose(false)
                        .title('Información:')
                        .textContent('Fondo Actualizado...!!!')
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
                        .textContent('No se pudo actualizar el fondo...!!! Informe al administrador del Sistema')
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

    $scope.answer = function(value, equipo, imagen) {
        var x = {};
        x.equipo = equipo;
        x.imagen = imagen;
        x.respuesta = value;
        $mdDialog.hide(x);
    };
}]);

//*******************************************************************************************
//*******************************ALUMNOS EQUIPO CONTROLLER***********************************
//*******************************************************************************************

myApp.controller('AlumnosEquipoController', ['$scope', '$http', '$cookies', '$mdDialog',
function($scope, $http, $cookies, $mdDialog) {
  $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
  $scope.curso = angular.fromJson($cookies.get('datosCurso'));
  $scope.equipo = angular.fromJson($cookies.get('datosEquipo'));

  $http({
    method: 'POST',
    url: '../srv/getAlumnosEquipo.php',
    data: "datosCurso="+JSON.stringify($scope.curso)+"&datosEquipo="+JSON.stringify($scope.equipo),
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  })
  .success(function(data) {
    $scope.alumnos = data;
  });

  $http({
    method: 'POST',
    url: '../srv/getAlumnosSinEquipo.php',
    data: "datosCurso="+JSON.stringify($scope.curso)+"&datosEquipo="+JSON.stringify($scope.equipo),
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  })
  .success(function(data) {
    $scope.noalumnos = data;
  });

  $scope.ActualizarCombos = function(){
    $http({
      method: 'POST',
      url: '../srv/getAlumnosSinEquipo.php',
      data: "datosCurso="+JSON.stringify($scope.curso)+"&datosEquipo="+JSON.stringify($scope.equipo),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.noalumnos = data;
    });

    $http({
      method: 'POST',
      url: '../srv/getAlumnosEquipo.php',
      data: "datosCurso="+JSON.stringify($scope.curso)+"&datosEquipo="+JSON.stringify($scope.equipo),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.alumnos = data;
    });
  }

  $scope.quitarAlumno = function(ev,aluclaequ_id){
    for (var i=0; i<(aluclaequ_id.length); i++) {
      var post_data='aluclaequ_id='+aluclaequ_id[i]+"&datosCurso="+JSON.stringify($scope.curso)+"&datosEquipo="+JSON.stringify($scope.equipo);
      $http({
          method: 'POST',
          url: '../srv/quitarAlumnoEquipo.php',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data: post_data
      }).then(function(response) {
          if(response.data === 'true'){
          }else{
            console.log(response);
            $mdDialog.show(
                $mdDialog.alert()
                .clickOutsideToClose(false)
                .title('Advertencia:')
                .textContent('Algunos alumnos no se pudieron quitar del equipo...!!! Informe al administrador del Sistema')
                .ariaLabel('Alert Dialog Demo')
                .ok('Aceptar')
                .targetEvent(ev)
            );
            console.log(response);
          }
          $scope.ActualizarCombos();
      });
    }
  };

  $scope.asignarAlumno = function(ev,alucla_id){
    for (var i=0; i<(alucla_id.length); i++) {
      var post_data='alucla_id='+alucla_id[i]+"&datosCurso="+JSON.stringify($scope.curso)+"&datosEquipo="+JSON.stringify($scope.equipo);
      $http({
          method: 'POST',
          url: '../srv/asignarAlumnoEquipo.php',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data: post_data
      }).then(function(response) {
          if(response.data === 'true'){
          }else{
              $mdDialog.show(
                  $mdDialog.alert()
                  .clickOutsideToClose(false)
                  .title('Advertencia:')
                  .textContent('Algunos alumnos no se pudieron agregarlos al curso...!!! Informe al administrador del Sistema')
                  .ariaLabel('Alert Dialog Demo')
                  .ok('Aceptar')
                  .targetEvent(ev)
              );
              console.log(response);
          }
          $scope.ActualizarCombos();
      });
    }
  };
}]);

//*******************************************************************************************
//*******************************PREMIOS CURSO CONTROLLER************************************
//*******************************************************************************************

myApp.controller('PremiosCursoController', ['$scope', '$http', '$cookies', '$mdDialog',
function($scope, $http, $cookies, $mdDialog) {
  $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
  $scope.curso = angular.fromJson($cookies.get('datosCurso'));

  $http({
    method: 'POST',
    url: '../srv/getActuacionesCurso.php',
    data: "datosCurso="+JSON.stringify($scope.curso)+"&actuacion=premio",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  })
  .success(function(data) {
    $scope.premios = data;
    for(i=0; i<$scope.premios.length; i++){
      if($scope.premios[i].act_estado === "1"){$scope.premios[i].act_estado = true;}else{$scope.premios[i].act_estado = false;}
    }
    $scope.propertyName = 'act_id';
    $scope.reverse = false;
    $scope.sortBy = function(propertyName){
        $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
        $scope.propertyName = propertyName;
    };
  });

  $scope.CargarTabla=function()
  {
    $http({
      method: 'POST',
      url: '../srv/getActuacionesCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso)+"&actuacion=premio",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.premios = data;
      for(i=0; i<$scope.premios.length; i++){
        if($scope.premios[i].act_estado === "1"){$scope.premios[i].act_estado = true;}else{$scope.premios[i].act_estado = false;}
      }
      $scope.propertyName = 'act_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });
  }

  $scope.CambiarEstado=function(premio)
  {
    if(premio.act_estado === true){premio.act_estado = 1;}else{premio.act_estado = 0;}

    var post_data='act_id=' +premio.act_id+'&act_estado='+premio.act_estado+'&act_tipo='+premio.act_tipo+"&datosCurso="+JSON.stringify($scope.curso);

      $http({
          method: 'POST',
          url: '../srv/updateEstadoActuacion.php',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data: post_data
      });

      $scope.CargarTabla();
  };

  $scope.showNuevoPremio = function(ev) {
      $mdDialog.show({
          templateUrl: '../web_profesores/popupNuevoPremio.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="nuevo") {
            var post_data='act_nombre=' +answer.premio.act_nombre+'&act_descripcion='+answer.premio.act_descripcion+'&act_PV='+answer.premio.act_PV+'&act_PD='+answer.premio.act_PD+'&act_PO='+answer.premio.act_PO+'&act_PP='+answer.premio.act_PP+'&act_FO='+answer.premio.act_FO+'&act_tipo=premio'+"&datosCurso="+JSON.stringify($scope.curso);
            $http({
                method: 'POST',
                url: '../srv/createNuevaActuacion.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: post_data
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

  $scope.showEditarPremio = function(ev, premio) {
    $scope.premio = premio;
      $mdDialog.show({
          templateUrl: '../web_profesores/popupEditarPremio.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="editar") {
          var post_data='act_id=' +answer.premio.act_id+'&act_nombre=' +answer.premio.act_nombre+'&act_descripcion='+answer.premio.act_descripcion+'&act_PV='+answer.premio.act_PV+'&act_PD='+answer.premio.act_PD+'&act_PO='+answer.premio.act_PO+'&act_PP='+answer.premio.act_PP+'&act_FO='+answer.premio.act_FO+'&act_tipo=premio'+"&datosCurso="+JSON.stringify($scope.curso);

            $http({
                method: 'POST',
                url: '../srv/updateActuaciones.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: post_data
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
      $mdDialog.cancel();
  };

  $scope.answer = function(value, premio) {
      var x = {};
      x.premio = premio;
      x.respuesta = value;
      $mdDialog.hide(x);
  };
}]);

//*******************************************************************************************
//*******************************CASTIGOS CURSO CONTROLLER***********************************
//*******************************************************************************************

myApp.controller('CastigosCursoController', ['$scope', '$http', '$cookies', '$mdDialog',
function($scope, $http, $cookies, $mdDialog) {
  $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
  $scope.curso = angular.fromJson($cookies.get('datosCurso'));

  $http({
    method: 'POST',
    url: '../srv/getActuacionesCurso.php',
    data: "datosCurso="+JSON.stringify($scope.curso)+"&actuacion=castigo",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  }).success(function(data) {
    $scope.castigos = data;
    for(i=0; i<$scope.castigos.length; i++){
      if($scope.castigos[i].act_estado === "1"){$scope.castigos[i].act_estado = true;}else{$scope.castigos[i].act_estado = false;}
    }
    $scope.propertyName = 'act_id';
    $scope.reverse = false;
    $scope.sortBy = function(propertyName){
        $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
        $scope.propertyName = propertyName;
    };
  });

  $scope.CargarTabla=function()
  {
    $http({
      method: 'POST',
      url: '../srv/getActuacionesCurso.php',
      data: "datosCurso="+JSON.stringify($scope.curso)+"&actuacion=castigo",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.castigos = data;
      for(i=0; i<$scope.castigos.length; i++){
        if($scope.castigos[i].act_estado === "1"){$scope.castigos[i].act_estado = true;}else{$scope.castigos[i].act_estado = false;}
      }
      $scope.propertyName = 'act_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });
  }

  $scope.CambiarEstado=function(castigo)
  {
    if(castigo.act_estado === true){castigo.act_estado = 1;}else{castigo.act_estado = 0;}

    var post_data='act_id=' +castigo.act_id+'&act_estado='+castigo.act_estado+'&act_tipo='+castigo.act_tipo+"&datosCurso="+JSON.stringify($scope.curso);

      $http({
          method: 'POST',
          url: '../srv/updateEstadoActuacion.php',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data: post_data
      });

      $scope.CargarTabla();
  };

  $scope.showNuevoCastigo = function(ev) {
      $mdDialog.show({
          templateUrl: '../web_profesores/popupNuevoCastigo.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="nuevo") {
            var post_data='act_nombre=' +answer.castigo.act_nombre+'&act_descripcion='+answer.castigo.act_descripcion+'&act_PV='+answer.castigo.act_PV+'&act_PD='+answer.castigo.act_PD+'&act_PO='+answer.castigo.act_PO+'&act_PP='+answer.castigo.act_PP+'&act_FO='+answer.castigo.act_FO+'&act_tipo=castigo'+"&datosCurso="+JSON.stringify($scope.curso);
            $http({
                method: 'POST',
                url: '../srv/createNuevaActuacion.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: post_data
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

  $scope.showEditarCastigo = function(ev, castigo) {
    $scope.castigo = castigo;
      $mdDialog.show({
          templateUrl: '../web_profesores/popupEditarCastigo.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="editar") {
          var post_data='act_id=' +answer.castigo.act_id+'&act_nombre=' +answer.castigo.act_nombre+'&act_descripcion='+answer.castigo.act_descripcion+'&act_PV='+answer.castigo.act_PV+'&act_PD='+answer.castigo.act_PD+'&act_PO='+answer.castigo.act_PO+'&act_PP='+answer.castigo.act_PP+'&act_FO='+answer.castigo.act_FO+'&act_tipo=castigo'+"&datosCurso="+JSON.stringify($scope.curso);

            $http({
                method: 'POST',
                url: '../srv/updateActuaciones.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: post_data
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
      $mdDialog.cancel();
  };

  $scope.answer = function(value, castigo) {
      var x = {};
      x.castigo = castigo;
      x.respuesta = value;
      $mdDialog.hide(x);
  };
}]);

//*******************************************************************************************
//*******************************TRABAJOS CURSO CONTROLLER***********************************
//*******************************************************************************************

myApp.controller('TrabajosCursoController', ['$scope', '$http', '$cookies', '$mdDialog',
function($scope, $http, $cookies, $mdDialog) {
  $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
  $scope.curso = angular.fromJson($cookies.get('datosCurso'));

  $http({
    method: 'POST',
    url: '../srv/getTrabajosCursoPrincipal.php',
    data: "datosCurso="+JSON.stringify($scope.curso),
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  }).success(function(data) {
    $scope.trabajos = data;
    for(i=0; i<$scope.trabajos.length; i++){
      if($scope.trabajos[i].tra_estado === "1"){$scope.trabajos[i].tra_estado = true;}else{$scope.trabajos[i].tra_estado = false;}
    }
    $scope.propertyName = 'tra_id';
    $scope.reverse = false;
    $scope.sortBy = function(propertyName){
        $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
        $scope.propertyName = propertyName;
    };
  });

  $scope.CargarTabla=function()
  {
    $http({
      method: 'POST',
      url: '../srv/getTrabajosCursoPrincipal.php',
      data: "datosCurso="+JSON.stringify($scope.curso),
      headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    })
    .success(function(data) {
      $scope.trabajos = data;
      for(i=0; i<$scope.trabajos.length; i++){
        if($scope.trabajos[i].tra_estado === "1"){$scope.trabajos[i].tra_estado = true;}else{$scope.trabajos[i].tra_estado = false;}
      }
      $scope.propertyName = 'tra_id';
      $scope.reverse = false;
      $scope.sortBy = function(propertyName){
          $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
          $scope.propertyName = propertyName;
      };
    });
  }

  $scope.CambiarEstado=function(trabajo)
  {
    if(trabajo.tra_estado === true){trabajo.tra_estado = 1;}else{trabajo.tra_estado = 0;}

    var post_data='tra_id=' +trabajo.tra_id+'&tra_estado='+trabajo.tra_estado+"&datosCurso="+JSON.stringify($scope.curso);

      $http({
          method: 'POST',
          url: '../srv/updateEstadoTrabajo.php',
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
          data: post_data
      });

      $scope.CargarTabla();
  };

  $scope.showNuevoTrabajo = function(ev) {
      $mdDialog.show({
          templateUrl: '../web_profesores/popupNuevoTrabajo.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="nuevo") {
            var post_data='tra_nombre=' +answer.trabajo.tra_nombre+'&tra_descripcion='+answer.trabajo.tra_descripcion+'&tra_PV='+answer.trabajo.tra_PV+'&tra_PD='+answer.trabajo.tra_PD+'&tra_PO='+answer.trabajo.tra_PO+'&tra_PP='+answer.trabajo.tra_PP+'&tra_FO='+answer.trabajo.tra_FO+"&datosCurso="+JSON.stringify($scope.curso);
            $http({
                method: 'POST',
                url: '../srv/createNuevoTrabajo.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: post_data
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

  $scope.showEditarTrabajo = function(ev, trabajo) {
    $scope.trabajo = trabajo;
      $mdDialog.show({
          templateUrl: '../web_profesores/popupEditarTrabajo.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="editar") {
          var post_data='tra_id=' +answer.trabajo.tra_id+'&tra_nombre=' +answer.trabajo.tra_nombre+'&tra_descripcion='+answer.trabajo.tra_descripcion+'&tra_PV='+answer.trabajo.tra_PV+'&tra_PD='+answer.trabajo.tra_PD+'&tra_PO='+answer.trabajo.tra_PO+'&tra_PP='+answer.trabajo.tra_PP+'&tra_FO='+answer.trabajo.tra_FO+"&datosCurso="+JSON.stringify($scope.curso);

            $http({
                method: 'POST',
                url: '../srv/updateTrabajo.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: post_data
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
      $mdDialog.cancel();
  };

  $scope.answer = function(value, trabajo) {
      var x = {};
      x.trabajo = trabajo;
      x.respuesta = value;
      $mdDialog.hide(x);
  };
}]);

//*******************************************************************************************
//*****************************PRIVILEGIOS CURSO CONTROLLER**********************************
//*******************************************************************************************

myApp.controller('PrivilegiosCursoController', ['$scope', '$http', '$cookies', '$mdDialog',
function($scope, $http, $cookies, $mdDialog) {
  $scope.usuario = angular.fromJson($cookies.get('datosUsuario'));
  $scope.curso = angular.fromJson($cookies.get('datosCurso'));

  $http({
    method: 'POST',
    url: '../srv/getPrivilegiosAbadCurso.php',
    data: "datosCurso="+JSON.stringify($scope.curso),
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  }).success(function(data) {
    $scope.privilegiosAbad = data;
    $scope.propertyName = 'pri_id';
    $scope.reverse = false;
    $scope.sortBy = function(propertyName){
        $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
        $scope.propertyName = propertyName;
    };
  });

  $scope.showEditarPrivilegios = function(ev, privilegio) {
    $scope.privilegio = privilegio;
      $mdDialog.show({
          templateUrl: '../web_profesores/popupEditarPrivilegios.php',
          parent: angular.element(document.body),
          targetEvent: ev,
          clickOutsideToClose:false,
          fullscreen: $scope.customFullscreen,
          scope: $scope,
          preserveScope:true
      }).then(function(answer) {
        if (answer.respuesta==="editar") {
          var post_data='pri_id=' +answer.privilegio.pri_id+'&pri_descripcion=' +answer.privilegio.pri_descripcion+'&pri_aluPV='+answer.privilegio.pri_aluPV+'&pri_aluPD='+answer.privilegio.pri_aluPD +'&pri_aluPO='+answer.privilegio.pri_aluPO +'&pri_aluPP='+answer.privilegio.pri_aluPP +'&pri_aluFO='+answer.privilegio.pri_aluFO+'&pri_equPV='+answer.privilegio.pri_equPV+'&pri_equPD='+answer.privilegio.pri_equPD+'&pri_equPO='+answer.privilegio.pri_equPO+'&pri_equPP='+answer.privilegio.pri_equPP+'&pri_equFO='+answer.privilegio.pri_equFO+'&pri_costPV='+answer.privilegio.pri_costPV+'&pri_costPD='+answer.privilegio.pri_costPD+'&pri_costPO='+answer.privilegio.pri_costPO+'&pri_costPP='+answer.privilegio.pri_costPP+'&pri_costFO='+answer.privilegio.pri_costFO+"&datosCurso="+JSON.stringify($scope.curso);

            $http({
                method: 'POST',
                url: '../srv/updatePrivilegios.php',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: post_data
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

  $scope.CargarTabla=function(rol)
  {
    if(rol == 0){
      $http({
        method: 'POST',
        url: '../srv/getPrivilegiosAbadCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.privilegiosAbad = data;
        $scope.propertyName = 'pri_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
            $scope.propertyName = propertyName;
        };
      });
    }else if(rol == 1){
      $http({
        method: 'POST',
        url: '../srv/getPrivilegiosCaballeroCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.privilegiosCaballero = data;
        $scope.propertyName = 'pri_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
            $scope.propertyName = propertyName;
        };
      });
    }else if (rol == 2){
      $http({
        method: 'POST',
        url: '../srv/getPrivilegiosCondeCurso.php',
        data: "datosCurso="+JSON.stringify($scope.curso),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      }).success(function(data) {
        $scope.privilegiosConde = data;
        $scope.propertyName = 'pri_id';
        $scope.reverse = false;
        $scope.sortBy = function(propertyName){
            $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : true;
            $scope.propertyName = propertyName;
        };
      });
    }
  };

  $scope.cancel = function() {
      $mdDialog.cancel();
  };

  $scope.answer = function(value, privilegio) {
      var x = {};
      x.privilegio = privilegio;
      x.respuesta = value;
      $mdDialog.hide(x);
  };
}]);

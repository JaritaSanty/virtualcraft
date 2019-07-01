<!DOCTYPE html>
<html lang="es" ng-app="AppGestor">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtual Craft</title>
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/bootstrap-theme.css" rel="stylesheet" />
    <link href="../css/angular-material.css" rel="stylesheet" type="text/css"/>
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../css/plugins/morris.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
</head>

<body ng-controller="PrincipalController">
    <div id="wrapper">
        <!-- Menus -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Menu Pantalla Celular -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#/"><img src="../images/logo.png" width="25" alt=""/> Virtual Craft</a>
            </div>
            <!-- Menu Usuario - Notificaciones -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{usuario.usu_nombre | uppercase}} {{usuario.usu_apellido | uppercase}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../srv/logout.php"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Menu Principal -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="#/"><i class="fa fa-fw fa-dashboard"></i> Inicio </a>
                    </li>
                    <li>
                        <a href="#/alumnos"><i class="fa fa-fw fa-users"></i> Alumnos </a>
                    </li>
                    <li>
                        <a href="#/profesores"><i class="fa fa-fw fa-user"></i> Profesores </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenido -->
        <div id="page-wrapper">
            <div id="graph-area" ng-view>

            </div>
        </div>
        <hr>
        <footer class="text-center">
            <p style="color: white">&copy; Virtual Craft 2019</p>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="../js/bootstrap.js" type="text/javascript"></script>
    <script src="../js/angular.js" type="text/javascript"></script>
    <script src="../js/angular-route.js" type="text/javascript"></script>
    <script src="../js/angular-cookies.js" type="text/javascript"></script>
    <script src="../js/angular-messages.js" type="text/javascript"></script>
    <script src="../js/angular-animate.js" type="text/javascript"></script>
    <script src="../js/angular-aria.min.js" type="text/javascript"></script>
    <script src="../js/angular-material.js" type="text/javascript"></script>
    <script src="../js/svg-assets-cache.js" type="text/javascript"></script>
    <script src="../js/app_gestor.js" type="text/javascript"></script>
    <script src="../js/ui-bootstrap-tpls-2.4.0.min.js" type="text/javascript"></script>
</body>

</html>

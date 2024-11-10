<?php
session_start();
error_reporting(0);
if($_SESSION["usu"]==null){
    header('Location: ../index.html'); 
    echo '<script language="javascript">alert("Bienvenido al menu del sistema de evidencias");</script>';
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Proyecto integrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/global.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>

<body >
<header id="Encabezado" class="navbar navbar-dark sticky-top bg-primary text-white flex-md-nowrap p-0 shadow">
        <div >
            <h3 href="menu.php">🚀 SISEVID</h3>
        </div>
            <div class="row">
                <div>
                    <a class="nav-link px-3 text-white" href="cerrarSesion.php" >Cerrar Sesión</a>
                </div>
            </div>
    </header>
    <div class="row">
        <div id="BarraLateral"class=" col-lg-2 d-md-block bg-primary sidebar collapse ">
            <!-- CONTENIDO Y FORMA DE BARRA LATERAL -->
            <div class="row">
                <nav id="MenuLateral">
                <div class="col">
                    <br>
                    <li><a class="nav-link text-white "href="vistafacultad.php">
                        <span data-feather="bar-chart-2"></span>
                            Facultad
                        </a>
                    </li>
                    <a class="nav-link text-white "href="vistaprofesor.php">
                        <span data-feather="bar-chart-2"></span>
                            Profesor
                        </a>
                    <a class="nav-link text-white "href="vistaestudiante.php">
                    <span data-feather="bar-chart-2"></span>
                            Estudiante
                    </a>
                    <a class="nav-link text-white "href="vistaprograma.php">
                    <span data-feather="bar-chart-2"></span>
                            Programa
                    </a>
                    </a>
                    <a class="nav-link text-white "href="vistaevidencia.php">
                    <span data-feather="bar-chart-2"></span>
                            Evidencia
                    </a>
                    <a class="nav-link text-white "href="vistavinculacion.php">
                    <span data-feather="bar-chart-2"></span>
                            Vinculacion
                    </a>
                    </div>
                    <a class="nav-link text-white "href="vistaasignatura.php">
                    <span data-feather="bar-chart-2"></span>
                            Asignatura
                    </a>
                    <a class="nav-link text-white "href="vistausuario.php">
                    <span data-feather="bar-chart-2"></span>
                            Usuarios
                    </a>
                    </div>
                </nav>
            </div>
        </div>
        <div id="contenido" class="col-md-12">
        </div><!-- FIN DEL DIV CONTENIDO -->  
    </div><!-- FIN DEL ROW PRINCIPAL -->
</html>